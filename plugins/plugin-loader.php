<?php
/* 
MiniGreX 1.0 Plugin Loader with stmt & pod
*/
<?php

// load init.php
require_once "init.php";

// load your plugin_core here
require_once "role_manager/core.php";
require_once "auto_cache/core.php";
require_once "gateway_manager/core.php";
require_once "get_local_settings/core.php";
require_once "image_db/core.php";
require_once "profile_manager/core.php";
require_once "seo_manager/core.php";
require_once "video_db/core.php";
require_once "role_manager/core.php";
require_once "role_manager/core.php";



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
