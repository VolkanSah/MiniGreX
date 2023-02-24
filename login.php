<?php

// Erforderliche Dateien einbinden
require_once "config.php";
require_once "functions.php";

// Verbindung zur Datenbank herstellen
$conn = get_connection();

// Formularabschicken überprüfen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Benutzer überprüfen
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = get_user_by_username($_POST['username']);
    if ($user !== NULL && password_verify($_POST['password'], $user['password'])) {
      // Benutzer anmelden
      session_start();
      $_SESSION['user_id'] = $user['id'];
      header('Location: index.php');
      exit();
    }
  }
}
echo "<!DOCTYPE html>
<html>
<head>
  <title>Anmeldung</title>
</head>
<body>
  <h1>Anmeldung</h1>
  <form method='post'>
    <label for='username'>Benutzername:</label>
    <input type='text' id='username' name='username'>
    <br>
    <label for='password'>Passwort:</label>
    <input type='password' id='password' name='password'>
    <br>
    <input type='submit' value='Anmelden'>
  </form>
</body>
</html>";

// Verbindung zur Datenbank schließen
$conn->close();