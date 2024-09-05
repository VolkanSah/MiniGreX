<?php

// Definiere Root-Verzeichnis
define('ROOT_PATH', __DIR__ . '/../');

// Include files
define('INIT_MGREX', ROOT_PATH . 'includes/init.php');
define('SECURITY_MGREX', ROOT_PATH . 'includes/security.php');
define('LOOP_MGREX', ROOT_PATH . 'includes/loop.php');
define('FUNCTION_MGREX', ROOT_PATH . 'includes/functions.php');
define('UPLOAD_MGREX', ROOT_PATH . 'includes/upload.php');
define('IMAGES_MGREX', ROOT_PATH . 'includes/images.php');
define('CMS_MGREX', ROOT_PATH . 'includes/cms.php');

// Cache files
define('CACHE_MGREX', ROOT_PATH . 'cache/cache_db.php'); 
define('CACHE_PH_MGREX', ROOT_PATH . 'cache/index.php'); // Placeholder cache file

// Plugin loader
define('PLUGIN_LOADER', ROOT_PATH . 'plugins/plugin_loader.php');

// Theme loader
define('THEME_LOADER', ROOT_PATH . 'themes/theme_loader.php');

// Admin panel files (Du kannst den "panel"-Ordner umbenennen und hier den neuen Namen definieren)
define('ADMIN_PANEL', ROOT_PATH . 'panel/admin.php');
define('ADMIN_DASH', ROOT_PATH . 'panel/dashboard.php');
define('ADMIN_OPTION', ROOT_PATH . 'panel/option_settings.php');
define('ADMIN_USER_SETTINGS', ROOT_PATH . 'panel/user_settings.php'); // Geändert von ADMIN_OPTION

// Public files
define('MGREX_INDEX', ROOT_PATH . 'index.php');
define('MGREX_LOGIN', ROOT_PATH . 'login.php');
define('MGREX_REGISTER', ROOT_PATH . 'register.php');

?>
