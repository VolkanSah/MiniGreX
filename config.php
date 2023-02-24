<?php
/**
Die Zugangsdaten zur Datenbank werden hier als Konstanten definiert, um zu verhindern, dass sie aus Versehen überschrieben werden. 
Außerdem werden die session.cookie_httponly und session.cookie_secure Einstellungen gesetzt, um Cookies sicherer zu machen.
Zuletzt wird überprüft, ob die Seite über HTTPS aufgerufen wird, und gegebenenfalls eine Umleitung auf HTTPS durchgeführt.

**/

// Datenbank-Zugangsdaten
define('DB_HOST', 'localhost');
define('DB_NAME', 'meine_db');
define('DB_USER', 'mein_user');
define('DB_PASS', 'mein_sicheres_passwort');

// Sitzungsname
define('SESSION_NAME', 'meine_sitzung');

// Cookies sicherer machen
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);

// SSL erzwingen
if ($_SERVER['HTTPS'] !== 'on') {
    header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
}
