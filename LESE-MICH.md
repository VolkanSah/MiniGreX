# MiniGreX-CMS
MiniGreX-CMS ist ein einfaches Content-Management-System für die Verwaltung von Beiträgen und Kommentaren. 
Die Anwendung wurde in PHP geschrieben und nutzt eine MySQL-Datenbank für die Speicherung von Daten. Die Anwendung kann jedoch auch mit anderen Datenbanksystemen wie PostgreSQL und MariaDB verwendet werden.

Voraussetzungen
Um MiniGreX-CMS verwenden zu können, benötigen Sie:

Eine Webserver-Software wie Apache oder Nginx
PHP-Version 7.0 oder höher
Eine MySQL-, PostgreSQL- oder MariaDB-Datenbank
Installation
Um MiniGreX-CMS zu installieren, folgen Sie bitte diesen Schritten:

Laden Sie den Quellcode von GitHub herunter oder klonen Sie das Repository.
Kopieren Sie die Dateien auf Ihren Webserver.
Erstellen Sie eine neue Datenbank und importieren Sie das schema.sql-Skript, um die erforderlichen Tabellen zu erstellen.
Konfigurieren Sie die Verbindungsdaten zur Datenbank, indem Sie die config.php-Datei anpassen.
Passen Sie die Anwendung nach Ihren Wünschen an, indem Sie Änderungen am Code vornehmen.
Rufen Sie die Anwendung im Browser auf, um sie zu verwenden.
Funktionen
Anmeldung für Benutzer
Anmeldung für Admins
Hinzufügen von Beiträgen mit Links zu anderen Webseiten
Hinzufügen von Kommentaren zu Beiträgen
Administrationsbereich für die Verwaltung von Beiträgen, Kommentaren und Benutzern
Sicherheit
MiniGreX-CMS wurde mit Sicherheit im Hinterkopf entwickelt. Die Anwendung verwendet Prepared Statements, um SQL-Injektionen zu vermeiden. Die Passwörter werden gehasht, um sicherzustellen, dass sie nicht im Klartext in der Datenbank gespeichert werden. Das Anmeldeformular verfügt über einen CSRF-Schutz, um vor Cross-Site Request Forgery-Angriffen zu schützen.

Hilfe und Support
Wenn Sie Fragen oder Probleme mit MiniGreX-CMS haben, erstellen Sie bitte ein Issue auf GitHub oder wenden Sie sich an den Entwickler.

Lizenz
MiniGreX-CMS ist unter der MIT-Lizenz veröffentlicht. Sie können den Quellcode frei verwenden, ändern und weitergeben, solange Sie die Urheberrechts- und Lizenzinformationen beibehalten. Siehe die LICENSE-Datei für weitere Informationen.
