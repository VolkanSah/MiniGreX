<?php

// Erforderliche Dateien einbinden
require_once "config.php";
require_once "functions.php";

// Verbindung zur Datenbank herstellen
$conn = get_connection();

// Admin überprüfen
if (!is_admin()) {
  header('Location: index.php');
  exit();
}

// Formularabschicken überprüfen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Seitentitel und Meta-Informationen speichern
  if (isset($_POST['title']) && isset($_POST['description'])) {
    set_site_info($_POST['title'], $_POST['description']);
  }

  // Admin-Passwort ändern
  if (isset($_POST['old_password']) && isset($_POST['new_password'])) {
    change_admin_password($_POST['old_password'], $_POST['new_password']);
  }
}

// Seitentitel und Meta-Informationen laden
$site_info = get_site_info();

// HTML-Kopf ausgeben
echo "<!DOCTYPE html>
<html>
<head>
  <title>Administration</title>
</head>
<body>
  <h1>Administration</h1>
  <form method='post'>
    <h2>Seitentitel und Meta-Informationen</h2>
    <label for='title'>Seitentitel:</label>
    <input type='text' id='title' name='title' value='{$site_info['title']}'>
    <br>
    <label for='description'>Meta-Beschreibung:</label>
    <input type='text' id='description' name='description' value='{$site_info['description']}'>
    <br>
    <input type='submit' value='Speichern'>
  </form>
  <form method='post'>
    <h2>Admin-Passwort ändern</h2>
    <label for='old_password'>Altes Passwort:</label>
    <input type='password' id='old_password' name='old_password'>
    <br>
    <label for='new_password'>Neues Passwort:</label>
    <input type='password' id='new_password' name='new_password'>
    <br>
    <input type='submit' value='Ändern'>
  </form>
    </form>
</body>
</html>";

// Verbindung zur Datenbank schließen
$conn->close();