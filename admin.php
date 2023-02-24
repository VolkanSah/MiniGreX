<?php

/*
Hier wird eine sichere Verbindung zur Datenbank über Prepared Statements hergestellt, indem mysqli anstelle von PDO verwendet wurde. Zuerst wurde eine Verbindung zur Datenbank hergestellt und überprüft, ob die Verbindung erfolgreich war. Dann wurden die SQL-Statements in Prepared Statements umgewandelt und vorbereitet. Ansch


*/

// Erforderliche Dateien einbinden
require_once "config.php";
require_once "functions.php";

// Verbindung zur Datenbank herstellen
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Verbindung überprüfen
if ($conn->connect_error) {
  die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
}

// Prepared Statements vorbereiten
$updateSiteInfoStmt = $conn->prepare("UPDATE site_info SET title = ?, description = ?");
$updateAdminPasswordStmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");

// Admin überprüfen
if (!is_admin()) {
  header('Location: index.php');
  exit();
}

// Formularabschicken überprüfen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Seitentitel und Meta-Informationen speichern
  if (isset($_POST['title']) && isset($_POST['description'])) {
    $updateSiteInfoStmt->bind_param("ss", $_POST['title'], $_POST['description']);
    $updateSiteInfoStmt->execute();
  }

  // Admin-Passwort ändern
  if (isset($_POST['old_password']) && isset($_POST['new_password'])) {
    $hashedPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $updateAdminPasswordStmt->bind_param("si", $hashedPassword, get_current_user_id());
    $updateAdminPasswordStmt->execute();
  }
}

// Seitentitel und Meta-Informationen laden
$site_info = get_site_info($conn);

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

// Prepared Statements schließen
$updateSiteInfoStmt->close();
$updateAdminPasswordStmt->close();

// Verbindung zur Datenbank schließen
$conn->close();
