<?php
/* 
MiniGreX 1.0
*/

// load required files
require_once "config.php";
require_once "functions.php";

// get database connection
$conn = get_connection();

// Load some stuff
$seo_manager = get_site_seo_plugin($conn);
$image_db = get_site_image_plugin($conn);
$video_db = get_site_video_plugin($conn);
$auto_cache = get_site_cache_plugin($conn);
$role_manager = get_site_role_plugin($conn);
$profile_manager = get_site_profile_plugin($conn);
$get_local_settings = get_site_local_plugin($conn);
$get_gateway_manager = get_site_gateway_plugin($conn);
// Load sitetitel and Meta-informationen
$site_info = get_site_info($conn);






// HTML-Kopf in Variable 
$html = "<!DOCTYPE html>
<html>
<head>
  <title>" . htmlspecialchars($site_info['title'], ENT_QUOTES) . "</title>
  <meta name='description' content='" . htmlspecialchars($site_info['description'], ENT_QUOTES) . "'>
</head>
<body>
  <h1>" . htmlspecialchars($site_info['title'], ENT_QUOTES) . "</h1>";

// Alle Beiträge aus der Datenbank laden
$posts = get_all_posts($conn);

// Alle Beiträge anzeigen
foreach ($posts as $post) {
  $comments = get_comments_for_post($conn, $post['id']);
  $username = get_username($conn, $post['benutzer_id']);
  $html .= "<h2>" . htmlspecialchars($post['link'], ENT_QUOTES) . " von " . htmlspecialchars($username, ENT_QUOTES) . "</h2>";
  foreach ($comments as $comment) {
    $username = get_username($conn, $comment['benutzer_id']);
    $html .= "<p>" . htmlspecialchars($comment['text'], ENT_QUOTES) . " von " . htmlspecialchars($username, ENT_QUOTES) . "</p>";
  }
  if (is_logged_in()) {
    $html .= "<form method='post' action='add_comment.php'>
      <input type='hidden' name='post_id' value='" . htmlspecialchars($post['id'], ENT_QUOTES) . "'>
      <label for='text'>Kommentar hinzufügen:</label>
      <input type='text' id='text' name='text'>
      <br>
      <input type='submit' value='Absenden'>
    </form>";
  }
}

// HTML-Fuß in Variable schreiben
$html .= "</body>
</html>";

// HTML-Output ausgeben
print($html);

// Verbindung zur Datenbank schließen
$conn->close();
