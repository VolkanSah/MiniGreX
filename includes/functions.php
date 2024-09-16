<?php
/**
 *
 * MiniGreX - designed with security in mind!
 *
 * @file    includes/functions.php
 * @package MiniGreX
 * @copyright  Volkan Kücükbudak 
 * @version 0.9 Beta
 * @license MIT
 * @link    https://github.com/VolkanSah/MiniGreX
 *
 * Core functions file
 * 
 */

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


?>
