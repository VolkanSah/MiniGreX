<?php
require_once "config.php";
require_once "functions.php";

// Wenn bereits angemeldet, dann weiterleiten zur Index-Seite
if (is_logged_in()) {
  header('Location: index.php');
  exit();
}

// Verbindung zur Datenbank herstellen
$conn = get_connection();

// Formularabschicken überprüfen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // Benutzerdaten abrufen
  $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  // Passwort überprüfen
  if ($row && password_verify($password, $row['password'])) {
    // Anmeldung erfolgreich, Session starten
    session_start();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_role'] = 'user';

    // Weiterleiten zur Index-Seite
    header('Location: index.php');
    exit();
  } else {
    $error_message = "Falscher Benutzername oder Passwort.";
  }
}

// HTML-Kopf ausgeben
$html = "<!DOCTYPE html>
<html>
<head>
  <title>Anmeldung</title>
</head>
<body>
  <h1>Anmeldung</h1>";

// Fehlermeldung ausgeben, falls vorhanden
if (isset($error_message)) {
  $html .= "<p>{$error_message}</p>";
}

// Anmeldeformular ausgeben
$html .= "<form method='post'>
    <label for='username'>Benutzername:</label>
    <input type='text' id='username' name='username'>
    <br>
    <label for='password'>Passwort:</label>
    <input type='password' id='password' name='password'>
    <br>
    <input type='submit' value='Anmelden'>
  </form>";

// HTML-Fuß ausgeben
$html .= "</body>
</html>";

// HTML-Output ausgeben
echo $html;

// Verbindung zur Datenbank schließen
$conn->close();
