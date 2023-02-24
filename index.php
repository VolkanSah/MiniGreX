<?php

// Erforderliche Dateien einbinden
require_once "config.php";
require_once "functions.php";

// Verbindung zur Datenbank herstellen
$conn = get_connection();

// Seitentitel und Meta-Informationen laden
$site_info = get_site_info();

// HTML-Kopf ausgeben
echo "<!DOCTYPE html>
<html>
<head>
  <title>{$site_info['title']}</title>
  <meta name='description' content='{$site_info['description']}'>
</head>
<body>
  <h1>{$site_info['title']}</h1>";

// Alle Beiträge aus der Datenbank laden
$posts = get_all_posts();

// Alle Beiträge anzeigen
foreach ($posts as $post) {
  $comments = get_comments_for_post($post['id']);
  $username = get_username($post['benutzer_id']);
  echo "<h2>{$post['link']} von {$username}</h2>";
  foreach ($comments as $comment) {
    $username = get_username($comment['benutzer_id']);
    echo "<p>{$comment['text']} von {$username}</p>";
  }
  if (is_logged_in()) {
    echo "<form method='post' action='add_comment.php'>
      <input type='hidden' name='post_id' value='{$post['id']}'>
      <label for='text'>Kommentar hinzufügen:</label>
      <input type='text' id='text' name='text'>
      <br>
      <input type='submit' value='Absenden'>
    </form>";
  }
}

// Verbindung zur Datenbank schließen
$conn->close();

// HTML-Fuß ausgeben
echo "</body>
</html>";