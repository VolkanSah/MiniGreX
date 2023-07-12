<?php
// load init.php
require_once INIT_MGREX;
// Formularabschicken überprüfen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  // Überprüfen, ob Benutzername bereits existiert
  $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    $error = "Benutzername bereits vergeben";
  }

  // Überprüfen, ob E-Mail-Adresse bereits existiert
  $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    $error = "E-Mail-Adresse bereits registriert";
  }

  // Benutzer anlegen, wenn Benutzername und E-Mail-Adresse noch nicht existieren
  if (!isset($error)) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hash);
    $stmt->execute();

    // Weiterleitung zur Login-Seite
    header("Location: login.php");
    exit();
  }
}

// HTML-Kopf ausgeben
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
$html .= <<<HTML
  <form method='post'>
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
  </form>
HTML;

// HTML-Fuß ausgeben
$html .= "</body>
</html>";
print($html);
// Verbindung zur Datenbank schließen
$conn->close();
