<?php 
/* Comment: file ready!
Security Options for MiniGreX CMS
This file is used externaly to get a better overview for the security of the cms
Customs-Plugins must interact with security.php before they can call init.php
*/
// include der "init.php"
require_once("init.php");

// Hashen passwwords with bcrypt
function hash_password($password) {
    $options = [
        'cost' => 12,
    ];
    return password_hash($password, PASSWORD_BCRYPT, $options);
}

// Escapen strings for secure SQL-query
function escape_string($string) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT :string");
    $stmt->bindParam(':string', $string, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
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

// check user permissions
function check_permission($user_id, $permission) {
    global $pdo;

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM permissions WHERE user_id = :user_id AND permission = :permission");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':permission', $permission, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchColumn();

    return ($result > 0);
}
