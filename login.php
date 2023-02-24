<?php
/*
Hier werden die Benutzereingaben validiert und die Anmeldung über ein Prepared Statement und die Verwendung von password_verify durchgeführt, 
um SQL-Injektionen und Passwort-Hash-Angriffe zu vermeiden. Auch hier werden Fehlermeldungen sicher ausgegeben, um XSS-Angriffe zu vermeiden.
*/

// Erforderliche Dateien einbinden
require_once "config.php";
require_once "functions.php";

// Verbindung zur Datenbank herstellen
$conn = get_connection();

// Formularabschicken überprüfen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Eingabe validieren
  $errors = [];

  if (empty($_POST['username'])) {
    $errors[] = "Bitte geben Sie einen Benutzernamen ein.";
  }

  if (empty($_POST['password'])) {
    $errors[] = "Bitte geben Sie ein Passwort ein.";
  }

  if (empty($errors)) {
    // Benutzer authentifizieren
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
      $user = $result->fetch_assoc();

      if (password_verify($password, $user['password'])) {
        // Login erfolgreich
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header('Location: index.php');
        exit();
      } else {
        $errors[] = "Benutzername oder Passwort sind falsch.";
      }
    } else {
      $errors[] = "Benutzername oder Passwort sind falsch.";
    }
  }
}

// HTML-Kopf ausgeben
echo "<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>";

// Fehlermeldungen ausgeben
if (!empty($errors)) {
  foreach ($errors as $error) {
    echo "<p style='color: red;'>" . htmlspecialchars($error) . "</p>";
  }
}

// Login-Formular ausgeben
echo "<form method='post'>
  <label for='username'>Benutzername:</label>
  <input type='text' id='username' name='username'>
  <br>
  <label for='password'>Passwort:</label>
  <input type='password' id='password' name='password'>
  <br>
  <input type='submit' value='Login'>
</form>";

// HTML-Fuß ausgeben
echo "</body>
</html>";

// Verbindung zur Datenbank schließen
$conn->close();
