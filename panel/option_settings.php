<?php
// check if is admin
if (!is_admin()) {
  header('Location: index.php');
  exit();
}
// load init.php
require_once "init.php";

// Verbindung zur Datenbank herstellen
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verbindung prüfen
if ($conn->connect_error) {
 die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
}
