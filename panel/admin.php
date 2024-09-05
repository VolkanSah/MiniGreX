<?php
/**
 *
 * MiniGreX - designed with security in mind!
 *
 * @file    panel/admin.php
 * @package MiniGreX
 * @copyright  Volkan Kücükbudak 
 * @version 0.9 Beta
 * @license MIT
 * @link    https://github.com/VolkanSah/MiniGreX
 *
 *  admin stuff, what else?
 * 
 * 
 */
require_once __DIR__ . '/../includes/loader.php'; // Load the loader file

// Start the session
session_start();

// Check if the page is accessed through the dashboard
if (!isset($_SESSION['dashboard_access']) || $_SESSION['dashboard_access'] !== true) {
    // Redirect to the dashboard using the defined constant
    header('Location: ' . ADMIN_DASH);
    exit;
}

// Clear the session variable after the check to prevent unauthorized future access
unset($_SESSION['dashboard_access']);

// Check befor sending formular
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Seitentitel und Meta-Informationen speichern
  if (isset($_POST['title']) && isset($_POST['description'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $stmt = $conn->prepare("UPDATE site_info SET title = ?, description = ?");
    $stmt->bind_param("ss", $title, $description);
    $stmt->execute();
    
    // weiter funktionen
  }

  // Change Admin-Password
  if (isset($_POST['old_password']) && isset($_POST['new_password'])) {
    $old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $admin_id = get_admin_id();
    $hash = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("SELECT password FROM admins WHERE id = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if (password_verify($old_password, $row['password'])) {
      $stmt = $conn->prepare("UPDATE admins SET password = ? WHERE id = ?");
      $stmt->bind_param("si", $hash, $admin_id);
      $stmt->execute();
    }
  }
}

// Seitentitel und Meta-Informationen laden
$stmt = $conn->prepare("SELECT title, description FROM site_info");
$stmt->execute();
$result = $stmt->get_result();
$site_info = $result->fetch_assoc();

// HTML-Kopf in Variable schreiben
$html = <<<HTML
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
</html>
HTML;

// HTML-Output ausgeben
print($html);

// Verbindung zur Datenbank schließen
$conn->close();
