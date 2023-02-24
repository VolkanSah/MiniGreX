<?php
/* 
MiniGreX 1.0 /themes/default/public/header.php
*/
// load required files
require_once "config.php";
require_once "functions.php";

// get database connection
$conn = get_connection();

// Load sitetitel and Meta-informationen
$site_info = get_site_info($conn);

// HTML-header in variable 
$html = "<!DOCTYPE html>
<html>
<head>
  <title>" . htmlspecialchars($site_info['title'], ENT_QUOTES) . "</title>
  <meta name='description' content='" . htmlspecialchars($site_info['description'], ENT_QUOTES) . "'>
</head>
<body>";
