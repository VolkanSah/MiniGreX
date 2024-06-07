<?php
// Initialisierung des CMS

// Sitzung starten
session_start();

// Datenbankverbindung herstellen
try {
    $pdo = new PDO('mysql:host=localhost;dbname=minigrex', 'username', 'password');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Datenbankverbindung fehlgeschlagen: ' . $e->getMessage());
}

// Weitere Initialisierungen (Konstanten, Einstellungen, etc.)

?>
