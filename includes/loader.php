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
# define('CACHE_PH_MGREX', ROOT_PATH . 'cache/index.php'); // Placeholder cache file

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

// Include the init file
require_once INIT_MGREX; // MiniGrex init
require_once SECURITY_MGREX; // Security init
require_once LOOP_MGREX; // Loop init
require_once FUNCTION_MGREX; // Functions init
require_once UPLOAD_MGREX; // Uploads init
require_once IMAGES_MGREX; // Images init
require_once CMS_MGREX; // CMS init

// Cache files
require_once CACHE_MGREX; // Cache init

// Plugin and theme loaders
require_once PLUGIN_LOADER; // Plugin init (integration of plugins)
require_once THEME_LOADER; // Theme init (integration of themes)

// Admin panel files
require_once ADMIN_PANEL; // Admin panel init
require_once ADMIN_DASH; // Dashboard init
require_once ADMIN_OPTION; // Option settings init
require_once ADMIN_USER_SETTINGS; // User settings init

// Public files
require_once MGREX_INDEX; // Main index file
require_once MGREX_LOGIN; // Login file
require_once MGREX_REGISTER; // Register file


?>
