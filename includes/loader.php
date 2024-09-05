<?php

// definie root!

define('ROOT_PATH', __DIR__ . '/../');


// Include files
define('INIT_MGREX', ROOT_PATH . 'includes/init.php');
define('SECURITY_MGREX', ROOT_PATH . 'includes/security.php');
define('LOOP_MGREX', ROOT_PATH . 'includes/loop.php');
define('FUNCTION_MGREX', ROOT_PATH . 'includes/functions.php');
define('UPLOAD_MGREX', ROOT_PATH . 'includes/upload.php');
define('IMAGES_MGREX', ROOT_PATH . 'includes/images.php');
define('CMS_MGREX', ROOT_PATH . 'includes/cms.php');

// cache files
define('CACHE_MGREX', ROOT_PATH . 'cache/cache_db.php'); 
define('CACHE_PH_MGREX', ROOT_PATH . 'cache/index.php'); // Placeholder cache file
// plugin loader
define('PLUGIN_LOADER', ROOT_PATH . 'plugins/plugin_loader.php');
// theme loader
define('THEME_LOADER', ROOT_PATH . 'themes/theme_loader.php');


// admin panel files (you can rename "panel" folder to your nbeets, please define the new name here! 
define('ADMIN_PANEL, ROOT_PATH . 'panel/admin.php');
define('ADMIN_DASH, ROOT_PATH . 'panel/dashboard.php');
define('ADMIN_OPTION, ROOT_PATH . 'panel/option_settings.php');
define('ADMIN_OPTION, ROOT_PATH . 'panel/user_settings.php');

// public files
define('MGREX_INDEX, ROOT_PATH . 'index.php');
define('MGREX_LOGIN, ROOT_PATH . 'login.php');
define('MGREX_REGISTER, ROOT_PATH . 'register.php');












// Lade die Initialisierungsdateien

require_once INIT_MGREX;

require_once SECURITY_MGREX;

require_once LOOP_MGREX;

require_once FUNCTION_MGREX;

require_once UPLOAD_MGREX;

require_once IMAGES_MGREX;

require_once CMS_MGREX;

require_once CACHE_MGREX;

require_once PLUGIN_LOADER;

require_once THEME_LOADER;

?>

