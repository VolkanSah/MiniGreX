<?php
/**
 *
 * MiniGreX - designed with security in mind!
 *
 * @file    login.php
 * @package MiniGreX
 * @copyright  Volkan Kücükbudak 
 * @version 0.9 Beta
 * @license MIT
 * @link    https://github.com/VolkanSah/MiniGreX
 *
 *  Public: Login
 * 
 * 
 */
// load init.php
require_once '../includes/init.php';
require_once '../includes/security.php';

// Wenn bereits angemeldet, dann weiterleiten zur Index-Seite
if (is_logged_in()) {
  header('Location: index.php');
  exit();
}

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $csrf_token = $_POST['csrf_token'];
  if (!validate_csrf_token($csrf_token)) {
      die('Ungültiges CSRF-Token.');
  }

  $username = sanitizeInput($_POST['username']);
  $password = sanitizeInput($_POST['password']);

  // Benutzeranfrage mit vorbereiteten Anweisungen
  $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = :username");
  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  // Passwort überprüfen
  if ($row && password_verify($password, $row['password'])) {
    // Anmeldung erlaubt, Sitzung starten
    regenerate_session();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_role'] = 'user';

    // Weiterleitung zur Index-Seite
    header('Location: index.php');
    exit();
  } else {
    $error_message = "Falscher Benutzername oder Passwort.";
  }
}

// HTML-Kopf ausgeben
$csrf_token = generate_csrf_token();
$html = "
  <h1>Login</h1>";

// Fehlermeldung ausgeben, falls vorhanden
if (isset($error_message)) {
  $html .= "<p>{$error_message}</p>";
}

// Ausgabe des Login-Formulars
$html .= "<form method='post'>
    <input type='hidden' name='csrf_token' value='{$csrf_token}'>
    <label for='username'>Benutzername:</label>
    <input type='text' id='username' name='username' required>
    <br>
    <label for='password'>Passwort:</label>
    <input type='password' id='password' name='password' required>
    <br>
    <input type='submit' value='Login'>
  </form>";

// HTML-Output 
echo $html;
?>
