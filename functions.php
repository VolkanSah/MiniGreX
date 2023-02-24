<?php

// Verbindung zur Datenbank herstellen
function get_connection() {
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if ($conn->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
  }
  return $conn;
}

// Benutzer hinzufügen
function add_user($username, $password) {
  $hash = password_hash($password, PASSWORD_DEFAULT);
  $conn = get_connection();
  $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
  $stmt->bind_param("ss", $username, $hash);
  $stmt->execute();
  $stmt->close();
  $conn->close();
}

// Benutzer aktualisieren
function update_user($id, $username, $password) {
  $hash = password_hash($password, PASSWORD_DEFAULT);
  $conn = get_connection();
  $stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
  $stmt->bind_param("ssi", $username, $hash, $id);
  $stmt->execute();
  $stmt->close();
  $conn->close();
}

// Benutzer löschen
function delete_user($id) {
  $conn = get_connection();
  $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
  $conn->close();
}

// Benutzer nach ID abrufen
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

// Alle Benutzer abrufen
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

// Admin-ID abrufen
function get_admin_id() {
  if (!isset($_SESSION['admin_id'])) {
    return 0;
  }
  return intval($_SESSION['admin_id']);
}

// Admin überprüfen
function is_admin() {
  return get_admin_id() > 0;
}

// Admin einloggen
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

// Admin ausloggen

function logout_admin() {
  unset($_SESSION['admin_id']);
}
function is_admin() {
  session_start();
  if (isset($_SESSION['admin_id'])) {
    return true;
  } else {
    return false;
  }
}
