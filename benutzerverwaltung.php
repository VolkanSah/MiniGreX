<?php

// Erforderliche Dateien einbinden
require_once "config.php";
require_once "functions.php";

// Verbindung zur Datenbank herstellen
$conn = get_connection();

// Benutzer-ID aus der URL holen
$benutzer_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Formular zum Hinzufügen/Bearbeiten von Benutzern anzeigen
echo "<form method='post'>
  <input type='hidden' name='id' value='" . $benutzer_id . "'>
  <label for='username'>Benutzername:</label>
  <input type='text' id='username' name='username' value='" . ($benutzer_id > 0 ? get_user($benutzer_id)['username'] : '') . "'>
  <br>
  <label for='password'>Passwort:</label>
  <input type='password' id='password' name='password'>
  <br>
  <input type='submit' value='Speichern'>
</form>";
// Formular zum Löschen von Benutzern anzeigen
  if ($benutzer_id > 0) {
    echo "<form method='post'>
      <input type='hidden' name='action' value='delete'>
      <input type='hidden' name='id' value='" . $benutzer_id . "'>
      <input type='submit' value='Löschen'>
    </form>";
  }
// Formularabschicken überprüfen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Benutzer hinzufügen/bearbeiten
  if (isset($_POST['username']) && isset($_POST['password'])) {
    // Benutzer-ID aus dem Formular holen
    $benutzer_id = intval($_POST['id']);

    // Benutzer hinzufügen/bearbeiten
    if ($benutzer_id > 0) {
      update_user($benutzer_id, $_POST['username'], $_POST['password']);
    } else {
      add_user($_POST['username'], $_POST['password']);
    }
  }
  // Benutzer löschen
  if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    // Benutzer-ID aus dem Formular holen
    $benutzer_id = intval($_POST['id']);

    // Benutzer löschen
    delete_user($benutzer_id);
  }
}
// Alle Benutzer aus der Datenbank holen
$benutzer = get_users();

// HTML-Kopf ausgeben
echo "<!DOCTYPE html>
<html>
<head>
  <title>Benutzerverwaltung</title>
</head>
<body>
  <h1>Benutzerverwaltung</h1>
  <ul>";

// Alle Benutzer anzeigen
foreach ($benutzer as $user) {
  echo "<li>" . htmlspecialchars($user['username']) . " <a href='benutzerverwaltung.php?id=" . $user['id'] . "'>Bearbeiten</a></li>";
}

// HTML-Fuss ausgeben
echo "</ul>
</body>
</html>";

// Verbindung zur Datenbank schließen
$conn->close();