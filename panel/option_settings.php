<?php
// load init.php
require_once INIT_MGREX;

// Verbindung zur Datenbank herstellen
function get_connection() {
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 if ($conn->connect_error) {
  die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
 }
 return $conn;
}
