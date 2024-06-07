<?php 
/* 
Security Options for MiniGreX CMS
*/
// include der "init.php"
require_once INIT_MGREX;

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

// Regenerate session ID to prevent session fixation
function regenerate_session() {
    if (session_status() == PHP_SESSION_ACTIVE) {
        session_regenerate_id(true);
    }
}

// Role Manager functions

function add_role($role_name) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO roles (name) VALUES (:name)");
    $stmt->bindParam(':name', $role_name, PDO::PARAM_STR);
    $stmt->execute();
}

function delete_role($role_id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM roles WHERE id = :id");
    $stmt->bindParam(':id', $role_id, PDO::PARAM_INT);
    $stmt->execute();
}

function assign_role($user_id, $role_id) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (:user_id, :role_id)");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
    $stmt->execute();
}

function remove_role($user_id, $role_id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM user_roles WHERE user_id = :user_id AND role_id = :role_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
    $stmt->execute();
}

function get_user_roles($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT roles.name FROM roles
                           INNER JOIN user_roles ON roles.id = user_roles.role_id
                           WHERE user_roles.user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function user_has_role($user_id, $role_name) {
    $roles = get_user_roles($user_id);
    return in_array($role_name, $roles);
}
?>
