<?php
/* 
MiniGreX 1.0
*/

// load required files
require_once "config.php";
require_once "functions.php";

// get database connection
$conn = get_connection();

// Load plugins 
$seo_manager = get_site_seo_plugin($conn);
$image_db = get_site_image_plugin($conn);
$video_db = get_site_video_plugin($conn);
$auto_cache = get_site_cache_plugin($conn);
$role_manager = get_site_role_plugin($conn);
$profile_manager = get_site_profile_plugin($conn);
$get_local_settings = get_site_local_plugin($conn);
$get_gateway_manager = get_site_gateway_plugin($conn);
