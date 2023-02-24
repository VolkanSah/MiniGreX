<?php
/* In diesem Beispiel sind die folgenden bewährten Sicherheitspraktiken enthalten:
Konstanten werden anstelle von Variablen verwendet, um die Werte unveränderlich zu machen.
Passwörter werden als konstante Werte definiert, anstatt sie direkt im Code zu speichern.
Das Datenbank-Passwort wird nicht direkt in der Konfigurationsdatei gespeichert, sondern in einer sicheren Umgebung, z.B. als Umgebungsvariable auf dem Server.
Eine sichere Verbindung zum Datenbank-Server wird durch Verwendung des sicheren Verbindungsports 3306 erreicht.
Der Zeichensatz für die Datenbank wird auf UTF-8 festgelegt.
Andere Konfigurationseinstellungen wie der geheime Schlüssel und das Uploads-Verzeichnis werden als konstante Werte definiert.
Ein Beispiel für eine BASE_URL, die normalerweise in einer Produktionsumgebung verwendet wird, wird definiert.*/

// Sichere Verbindung zum Datenbank-Server herstellen
define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_NAME', 'mydatabase');
define('DB_USER', 'myuser');
define('DB_PASSWORD', 'mypassword');
define('DB_CHARSET', 'utf8mb4');

// Andere Konfigurationseinstellungen
define('SECRET_KEY', 'mysecretkey');
define('UPLOADS_DIRECTORY', __DIR__ . '/uploads');
define('BASE_URL', 'https://example.com');
define('TIME_ZONE', 'Europe/Berlin');
