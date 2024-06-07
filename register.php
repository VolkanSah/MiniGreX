<?php
/**
 *
 * MiniGreX - designed with security in mind!
 *
 * @file    register.php
 * @package MiniGreX
 * @copyright  Volkan Kücükbudak 
 * @version 0.9 Beta
 * @license MIT
 * @link    https://github.com/VolkanSah/MiniGreX
 *
 *  Public: Register
 * 
 * 
 */
// load init.php
require_once '../includes/init.php';
require_once '../includes/security.php';

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $csrf_token = $_POST['csrf_token'];
  if (!validate_csrf_token($csrf_token)) {
      die('Ungültiges CSRF-Token.');
  }

  $username = sanitizeInput($_POST['username']);
  $email = sanitizeInput($_POST['email']);
  $password = sanitizeInput($_POST['password']);

  // Überprüfen, ob Benutzername bereits existiert
  $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
  $stmt->execute();
  if ($stmt->rowCount() > 0) {
    $error = "Benutzername bereits vergeben";
  }

  // Überprüfen, ob E-Mail-Adresse bereits existiert
  $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  if ($stmt->rowCount() > 0) {
    $error = "E-Mail-Adresse bereits registriert";
  }

  // Benutzer anlegen, wenn Benutzername und E-Mail-Adresse noch nicht existieren
  if (!isset($error)) {
    $hash = hash_password($password);
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
    $stmt->execute();

    // Weiterleitung zur Login-Seite
    header("Location: login.php");
    exit();
  }
}

// HTML-Kopf ausgeben
$csrf_token = generate_csrf_token();
$html = "<!DOCTYPE html>
<html>
<head>
  <title>Registrierung</title>
</head>
<body>
  <h1>Registrierung</h1>";

// Fehlermeldung ausgeben, falls vorhanden
if (isset($error)) {
  $html .= "<p style='color: red;'>{$error}</p>";
}

// Registrierungsformular ausgeben
$html .= "<form method='post'>
    <input type='hidden' name='csrf_token' value='{$csrf_token}'>
    <label for='username'>Benutzername:</label>
    <input type='text' id='username' name='username' required>
    <br>
    <label for='email'>E-Mail-Adresse:</label>
    <input type='email' id='email' name='email' required>
    <br>
    <label for='password'>Passwort:</label>
    <input type='password' id='password' name='password' required>
    <br>
    <input type='submit' value='Registrieren'>
  </form>";

// HTML-Fuß ausgeben
$html .= "</body>
</html>";
print($html);
?>
