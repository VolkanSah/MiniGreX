<?php
define('MGREX_ROLE_MANAGER', ROOT_PATH . 'role_manager.php'); // Initialization script
require_once MGREX_ROLE_MANAGER; // MGREX_ROLE_MANAGER initialization

// Role Manager Plugin functions

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

