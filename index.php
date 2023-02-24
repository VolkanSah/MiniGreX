<?php
/*
In diesem Beispiel wird das prepare()-Methode von PDO verwendet, um ein Prepared Statement zu erstellen. 
Das Statement mit den erforderlichen Parametern wird ausgeführt, indem execute()-Methode aufgerufen wird.

*/

// Erforderliche Dateien einbinden
require_once "config.php";
require_once "functions.php";

// Verbindung zur Datenbank herstellen
$conn = get_connection();

// Komplette Liste von Einträgen aus der Datenbank holen
$stmt = $conn->prepare("SELECT * FROM entries ORDER BY id DESC");
$stmt->execute();
$result = $stmt->get_result();

// HTML-Kopf ausgeben
echo "<!DOCTYPE html>
<html>
<head>
  <title>MiniGreX</title>
</head>
<body>
  <h1>MiniGreX</h1>
  <form method='post'>
    <input type='text' name='url' placeholder='URL eingeben'>
    <input type='submit' value='Teilen'>
  </form>
  <h2>Neueste Einträge</h2>
  <ul>";

// Neueste Einträge anzeigen
while ($row = $result->fetch_assoc()) {
  echo "<li><a href='" . htmlspecialchars($row['url']) . "' target='_blank'>" . htmlspecialchars($row['title']) . "</a></li>";
}

// HTML-Fuss ausgeben
echo "</ul>
</body>
</html>";

// Verbindung zur Datenbank schließen
$conn->close();
