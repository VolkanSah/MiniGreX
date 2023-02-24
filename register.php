<?php
/*
Hier wird das eingegebene Passwort mit password_hash() gehasht und dann mit einem Prepared Statement in die Datenbank eingefügt.
Auch hier wird get_connection() verwendet, um eine sichere Verbindung zur Datenbank herzustellen.
*/

// Erforderliche Dateien einbinden
require_once "config.php";
require_once "functions.php";

// Verbindung zur Datenbank herstellen
$conn = get_connection();

// Formularabschicken überprüfen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Benutzer registrieren
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepared Statement ausführen
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
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
