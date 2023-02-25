<?php
/* MiniGreX 1.0 menu.php */
// load required files
require_once "config.php";
require_once "functions.php";
// get database connection
$conn = get_connection();
// Load some stuff
$site_info = get_site_info($conn);
// HTML in variable
$html = "<nav class="navbar navbar-expand-lg navbar-light bg-light">";
$html = "<div class="container-fluid">";
$html = "<a class="navbar-brand" href="#">MiniGreX-CMS</a>";
$html = "<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">";
$html = " <span class="navbar-toggler-icon"></span>";
$html = "</button>";
$html = "<div class="collapse navbar-collapse" id="navbarNav">";
$html = "<ul class="navbar-nav">";
$html = "<li class="nav-item">";
$html = "<a class="nav-link active" aria-current="page" href="#">Home</a>";
$html = "</li>";
$html = "<li class="nav-item">";
$html = "<a class="nav-link" href="#">Features</a>";
$html = "</li>";
$html = "<li class="nav-item">";
$html = "<a class="nav-link" href="#">Pricing</a>";
$html = "</li>";
$html = "<li class="nav-item">";
$html = "<a class="nav-link disabled">Disabled</a>";
$html = "</li>";
$html = "</ul>";
$html = "</div>";
$html = "</div>";
$html = "</nav>";
// HTML-Output 
print($html);
// close databse connection
$conn->close();
// end
