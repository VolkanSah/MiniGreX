<?php
// load init.php
require_once INIT_MGREX;

// Add user
function add_user($username, $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $conn = get_connection();
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hash);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

// Update user
function update_user($id, $username, $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $conn = get_connection();
    $stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $hash, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

// Delete user
function delete_user($id) {
    $conn = get_connection();
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

// Get user by id
function get_user($id) {
    $conn = get_connection();
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $user;
}

// Get all users
function get_users() {
    $conn = get_connection();
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $result = $stmt->get_result();
    $users = array();
    while ($user = $result->fetch_assoc()) {
        $users[] = $user;
    }
    $stmt->close();
    $conn->close();
    return $users;
}

// Get Admin-ID
function get_admin_id() {
    if (!isset($_SESSION['admin_id'])) {
        return 0;
    }
    return intval($_SESSION['admin_id']);
}

// Check if user is admin
function is_admin() {
    return get_admin_id() > 0;
}

// Admin login
function login_admin($username, $password) {
    $conn = get_connection();
    $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    if (password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        return true;
    }
    return false;
}

// Admin logout
function logout_admin() {
    unset($_SESSION['admin_id']);
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
