<?php /**
 * This is the loop file, so it is more simple to edit it or call 
 * This file is used to markup the loop aspects of the MiniGreX.
 *
 * @link       includes/loop.php
 * @since      1.0.0
 *
 * @package    core
 */
// load init.php
require_once "init.php";
// get database connection
$conn = get_connection();
// Load sitetitel and Meta-informationen
$site_info = get_site_info($conn);
// Start Loop
// load all pots from database
$posts = get_all_posts($conn);
// show all posts
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
      <label for='text'>Comment:</label>
      <input type='text' id='text' name='text'>
      <br>
      <input type='submit' value='Submit'>
    </form>";
  }
}

// to doo loop  pagination comments and posts, set minmaximum for both not finished
// end loop

// HTML-Output
print($html);

// disable connection to database
$conn->close();
