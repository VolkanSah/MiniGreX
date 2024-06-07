<?php
require_once '../includes/init.php';

try {
    // Testabfrage
    $stmt = $pdo->query("SELECT 1");
    if ($stmt) {
        echo "Datenbankverbindung erfolgreich!";
    } else {
        echo "Fehler bei der Datenbankverbindung.";
    }
} catch (PDOException $e) {
    echo "Fehler bei der Datenbankverbindung: " . $e->getMessage();
}
?>
