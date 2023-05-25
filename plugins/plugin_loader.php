<?php
/*  MiniGreX 1.0 Plugin Loader for stmt & pod not finished !*/

// needed! DOM_load wait
// needed! check_errors_ >if>else>stop!
// load your plugin_core here for init

define('PLUGIN_PATH', "plugins/");
define('ROLE_MANAGER', PLUGIN_PATH . "role_manager/core.php");
define('GATEWAY_MANAGER', PLUGIN_PATH . "gateway_manager/core.php");
define('LOCAL_MANAGER', PLUGIN_PATH . "get_local/core.php");
define('IMAGE_MANAGER', PLUGIN_PATH . "image_db/core.php");
define('VIDEO_MANAGER', PLUGIN_PATH . "video_db/core.php");
define('PROFILE_MANAGER', PLUGIN_PATH . "profile_manager/core.php");

// Load /init
$seo_manager = get_site_seo_plugin($conn);
$image_db = get_site_image_plugin($conn);
$video_db = get_site_video_plugin($conn);
$role_manager = get_site_role_plugin($conn);
$profile_manager = get_site_profile_plugin($conn);
$get_local_settings = get_site_local_plugin($conn);
$get_gateway_manager = get_site_gateway_plugin($conn);




