<?php
/* 
MiniGreX 1.0
*/

// load required files
require_once "config.php";
require_once "functions.php";
// get database connection
$conn = get_connection();

// Load sitetitel and Meta-informationen
$site_info = get_site_info($conn);

// HTML- in Variable 
$html = "<main><h1>" . htmlspecialchars($site_info['title'], ENT_QUOTES) . "</h1>"; 
$html = "<p class="fs-5 col-md-8">MiniGreX-CMS has been designed with security in mind, and the code has been written to minimize the risk of SQL 
injection attacks and other security vulnerabilities. </p>";
$html = "<div class="mb-5"><a href="hero-promo-home.php." class="btn btn-primary btn-lg px-4">Get involved</a></div>":
$html = "  <hr class="col-3 col-md-2 mb-5">";
$html = " <div class="row g-5">";
$html = "  <div class="col-md-6">";
$html = "  <h2>Starter projects</h2>";
$posts = get_all_posts($conn);
// start loop
foreach ($posts as $post) {
  $comments = get_comments_for_post($conn, $post['id']);
  $username = get_username($conn, $post['benutzer_id']);
  $html .= "<h2>" . htmlspecialchars($post['link'], ENT_QUOTES) . " von " . htmlspecialchars($username, ENT_QUOTES) . "</h2>";
  foreach ($comments as $comment) {
    $username = get_username($conn, $comment['benutzer_id']);
    $html .= "<p>" . htmlspecialchars($comment['text'], ENT_QUOTES) . " von " . htmlspecialchars($username, ENT_QUOTES) . "</p>";
  }
  // if logged in sgow comments
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

$html = "    </div>  </div>";
$html = "";
$html = "";
$html = "";

  

      <div class="col-md-6">
        <h2>Guides</h2>
        <p>Read more detailed instructions and documentation on using or contributing to Bootstrap.</p>
        <ul class="icon-list ps-0">
          <li class="d-flex align-items-start mb-1"><a href="#">link</a></li>
           <li class="d-flex align-items-start mb-1"><a href="#">link</a></li>
           <li class="d-flex align-items-start mb-1"><a href="#">link</a></li>
           <li class="d-flex align-items-start mb-1"><a href="#">link</a></li>
           <li class="d-flex align-items-start mb-1"><a href="#">link</a></li>
          
     
        </ul>
      </div>
      <!-- end section for Edit to your needs -->

    </div>
  </main> "; 

