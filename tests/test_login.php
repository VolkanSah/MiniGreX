<?php
require_once '../includes/init.php';
require_once '../includes/functions.php';

$username = 'testuser';
$password = 'testpassword';

// Testbenutzer registrieren
registerUser($pdo, $username, $password, 'testuser@example.com');
echo "Testbenutzer wurde registriert.<br>";

// Testbenutzer anmelden
if (loginUser($pdo, $username, $password)) {
    echo "Benutzeranmeldung erfolgreich!";
} else {
    echo "Benutzeranmeldung fehlgeschlagen.";
}
?>
