<?php
/*  MiniGreX 1.0 Plugin Loader with stmt & pod not finished !*/
// load init.php
require_once "init.php";

// Verbindung zur Datenbank herstellen
function get_connection() {
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 if ($conn->connect_error) {
  die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
 }
 return $conn;
}

// load your plugin_core here for init
require_once "role_manager/core.php";
require_once "gateway_manager/core.php";
require_once "get_local_settings/core.php";
require_once "image_db/core.php";
require_once "profile_manager/core.php";
require_once "video_db/core.php";
require_once "role_manager/core.php";


// Load plugins 
$seo_manager = get_site_seo_plugin($conn);
$image_db = get_site_image_plugin($conn);
$video_db = get_site_video_plugin($conn);
$role_manager = get_site_role_plugin($conn);
$profile_manager = get_site_profile_plugin($conn);
$get_local_settings = get_site_local_plugin($conn);
$get_gateway_manager = get_site_gateway_plugin($conn);



