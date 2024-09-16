<?php
/**
 *
 * MiniGreX - designed with security in mind!
 *
 * @file    includes/security.php
 * @package MiniGreX
 * @copyright  Volkan Kücükbudak 
 * @version 0.9 Beta
 * @license MIT
 * @link    https://github.com/VolkanSah/MiniGreX
 *
 * Security options for MiniGreX 
 * 
 */

// Add security headers
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: strict-origin");
header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self';");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
header("Feature-Policy: geolocation 'none'; microphone 'none'; camera 'none'");

// Hash passwords with bcrypt - 12-15 randoms are ok
function hash_password($password) {
    $options = [
        'cost' => 12,
    ];
    return password_hash($password, PASSWORD_BCRYPT, $options);
}

// Escape strings for secure SQL-query
function escape_string($string) {
    global $pdo;
    return $pdo->quote($string);
}

// Validate user-input
function validate_input($input, $type) {
    switch ($type) {
        case 'email':
            return filter_var($input, FILTER_VALIDATE_EMAIL) !== false;
        case 'url':
            return filter_var($input, FILTER_VALIDATE_URL) !== false;
        case 'date':
            $date = DateTime::createFromFormat('Y-m-d', $input);
            return $date !== false && !array_sum($date->getLastErrors());
        default:
            return true;
    }
}

// Check user permissions
function check_permission($user_id, $permission) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM permissions WHERE user_id = :user_id AND permission = :permission");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':permission', $permission, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return ($result > 0);
}

// Generate CSRF token
/*
function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Validate CSRF token
function validate_csrf_token($token) {
    return hash_equals($_SESSION['csrf_token'], $token);
}
*/
// Regenerate session ID to prevent session fixation
function regenerate_session() {
    if (session_status() == PHP_SESSION_ACTIVE) {
        session_regenerate_id(true);
    }
}


?>
