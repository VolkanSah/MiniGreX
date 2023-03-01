<?php
// load init.php
require_once "init.php";
// Verbindung zur Datenbank herstellen
function get_connection() {
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 if ($conn->connect_error) {
  die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
 }
 return $conn;
}

// Benutzer-ID aus der URL holen
$benutzer_id = isset($_GET['id']) ? intval($_GET['id']) : 0;


// HTML-Kopf in Variable schreiben
$html = "<!DOCTYPE html>
<html>
<head>
    <title>Benutzerverwaltung</title>
</head>
<body>
<h1>Benutzerverwaltung</h1>";

// Formularabschicken überprüfen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Benutzer hinzufügen/bearbeiten
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Benutzer-ID aus dem Formular holen
        $benutzer_id = intval($_POST['id']);

        // Benutzer hinzufügen/bearbeiten
        if ($benutzer_id > 0) {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
            $stmt->bind_param("ssi", $username, $password, $benutzer_id);
            $stmt->execute();
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
        }
    }

    // Benutzer löschen
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        // Benutzer-ID aus dem Formular holen
        $benutzer_id = intval($_POST['id']);

        // Benutzer löschen
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $benutzer_id);
        $stmt->execute();
    }
}

// Alle Benutzer aus der Datenbank holen
$stmt = $conn->prepare("SELECT id, username FROM users");
$stmt->execute();
$result = $stmt->get_result();
$benutzer = $result->fetch_all(MYSQLI_ASSOC);

// Formular zum Hinzufügen/Bearbeiten von Benutzern anzeigen
$html .= "<form method='post'>
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
$html .= "<form method='post'>
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
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
  $stmt->bind_param("ssi", $username, $password, $benutzer_id);
  $stmt->execute();
} else {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
}
  
  }
// Benutzer löschen
if (isset($_POST['action']) && $_POST['action'] === 'delete') {
// Benutzer-ID aus dem Formular holen
$benutzer_id = intval($_POST['id']);
  // Benutzer löschen
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $benutzer_id);
$stmt->execute();
  }
}

// Alle Benutzer aus der Datenbank holen
$stmt = $conn->prepare("SELECT id, username FROM users");
$stmt->execute();
$result = $stmt->get_result();
$benutzer = $result->fetch_all(MYSQLI_ASSOC);

// HTML-Kopf in Variable schreiben
$html = "
  <h1>Benutzerverwaltung</h1>
  <ul>";
// Alle Benutzer anzeigen
foreach ($benutzer as $user) {
$html .= "<li>" . htmlspecialchars($user['username']) . " <a href='benutzerverwaltung.php?id=" . $user['id'] . "'>Bearbeiten</a></li>";
}


// HTML-Output ausgeben
print($html);

// Verbindung zur Datenbank schließen
$conn->close();
