<?php
// load init.php
require_once INIT_MGREX;

// Wenn bereits angemeldet, dann weiterleiten zur Index-Seite
if (is_logged_in()) {
  header('Location: index.php');
  exit();
}
// check formular sending
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // call userdata with stmt only
  $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  // check password
  if ($row && password_verify($password, $row['password'])) {
    // login allowed, Session start
    session_start();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_role'] = 'user';

    // redirekct to Index
    header('Location: index.php');
    exit();
  } else {
    $error_message = "Falscher Benutzername oder Passwort.";
  }
}

// HTML-Kopf ausgeben
$html = "
  <h1>Login</h1>";

// Fehlermeldung ausgeben, falls vorhanden
if (isset($error_message)) {
  $html .= "<p>{$error_message}</p>";
}

// output login formular
$html .= "<form method='post'>
    <label for='username'>Username:</label>
    <input type='text' id='username' name='username'>
    <br>
    <label for='password'>Password:</label>
    <input type='password' id='password' name='password'>
    <br>
    <input type='submit' value='Login'>
  </form>";

// HTML-Output 
echo $html;

// Verbindung zur Datenbank schließen
$conn->close();
