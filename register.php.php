<?php

// Erforderliche Dateien einbinden
require_once "config.php";
require_once "functions.php";

// Verbindung zur Datenbank herstellen
$conn = get_connection();

// Formularabschicken überprüfen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Benutzer hinzufügen
  if (isset($_POST['username']) && isset($_POST['password'])) {
    add_user($_POST['username'], $_POST['password']);
  }
}

// HTML-Kopf ausgeben
echo "<!DOCTYPE html>
<html>
<head>
  <title>Registrierung</title>
</head>
<body>
  <h1>Registrierung</h1>
  <form method='post'>
    <label for='username'>Benutzername:</label>
    <input type='text' id='username' name='username'>
    <br>
    <label for='password'>Passwort:</label>
    <input type='password' id='password' name='password'>
    <br>
    <input type='submit' value='Registrieren'>
  </form>
</body>
</html>";

// Verbindung zur Datenbank schließen
$conn->close();