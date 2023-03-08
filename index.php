<?php
// load init.php
require_once "includes/init.php";
// Set up PDO connection
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
// Load template
require_once "/themes/theme_loader.php"; // general core functions
// Verbindung zur Datenbank schließen
$conn->close();
