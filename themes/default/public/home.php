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
$site_info = get_site_info($conn);
// site infos usedin this file
// title, hero, homelink_title
$posts = get_all_posts($conn);

// HTML- in variable 
// Hero Conatiner- in admin settings
$html = "<main>;
$html = "<h1>" . htmlspecialchars($site_info['title'], ENT_QUOTES) . "</h1>"; 
$html = "<p class="fs-5 col-md-8">" . htmlspecialchars($site_info['hero'], ENT_QUOTES) . "</p>";
$html = "<div class="mb-5"><a href="hero-promo-home.php." class="btn btn-primary btn-lg px-4">Get involved</a></div>":
$html = "<hr class="col-3 col-md-2 mb-5">";
$html = "<div class="row g-5">";
$html = "<div class="col-md-6">";
$html = "<h2>Starter projects</h2>";
// start loop
foreach ($posts as $post) {
  $comments = get_comments_for_post($conn, $post['id']);
  $username = get_username($conn, $post['benutzer_id']);
  $html .= "<h2>" . htmlspecialchars($post['link'], ENT_QUOTES) . " von " . htmlspecialchars($username, ENT_QUOTES) . "</h2>";
  foreach ($comments as $comment) {
    $username = get_username($conn, $comment['benutzer_id']);
    $html .= "<p>" . htmlspecialchars($comment['text'], ENT_QUOTES) . " von " . htmlspecialchars($username, ENT_QUOTES) . "</p>";
  }
  //end loop
  // if logged in show comments
  if (is_logged_in()) {
    $html .= "<form method='post' action='add_comment.php'>
      <input type='hidden' name='post_id' value='" . htmlspecialchars($post['id'], ENT_QUOTES) . "'>
      <label for='text'>Kommentar hinzufügen:</label>
      <input type='text' id='text' name='text'>
      <br>
      <input type='submit' value='Absenden'>
    </form>";
  } // end show comment
}
$html = "    </div>  
$html = "</div>";
$html = "<div class="col-md-6">";
$html = "<h2>" . htmlspecialchars($site_info['homelink_title'], ENT_QUOTES) . "</h2>";
$html = "<p>Read more detailed instructions and documentation on using or contributing to Bootstrap.</p>";
$html = "<ul class="icon-list ps-0">";
$html = "<li class="d-flex align-items-start mb-1"><a href="../getting-started/introduction/">Privacy & Inprint</a></li>";
$html = "<li class="d-flex align-items-start mb-1"><a href="../getting-started/webpack/">Donate for MiniGgreX</a></li>";
$html = "<li class="d-flex align-items-start mb-1"><a href="../getting-started/parcel/">MiniGreX on Github</a></li>";
$html = "<li class="d-flex align-items-start mb-1"><a href="../getting-started/vite/">Documantation of MiniGreX</a></li>";
$html = " <li class="d-flex align-items-start mb-1"><a href="../getting-started/contribute/">Contributing to MiniGreX</a></li>";
$html = "</ul>";
$html = "</div>";
$html = "</div>";
$html = "</main>";
  
  
  
  // HTML-Output 
print($html);

// close databse connection
$conn->close();

