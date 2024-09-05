<?php

// Define the root directory path
define('ROOT_PATH', __DIR__ . '/../');

// Include core CMS files
define('INIT_MGREX', ROOT_PATH . 'includes/init.php'); // Initialization script
define('SECURITY_MGREX', ROOT_PATH . 'includes/security.php'); // Security configurations
define('LOOP_MGREX', ROOT_PATH . 'includes/loop.php'); // Loop logic for dynamic content
define('FUNCTION_MGREX', ROOT_PATH . 'includes/functions.php'); // General functions
define('UPLOAD_MGREX', ROOT_PATH . 'includes/upload.php'); // File upload handling
define('IMAGES_MGREX', ROOT_PATH . 'includes/images.php'); // Image processing logic
define('CMS_MGREX', ROOT_PATH . 'includes/cms.php'); // Core CMS functionality

// Cache files
define('CACHE_MGREX', ROOT_PATH . 'cache/cache_db.php'); // Cache management
# define('CACHE_PH_MGREX', ROOT_PATH . 'cache/index.php'); // Placeholder for cache

// Plugin loader
define('PLUGIN_LOADER', ROOT_PATH . 'plugins/plugin_loader.php'); // Plugin integration

// Theme loader
define('THEME_LOADER', ROOT_PATH . 'themes/theme_loader.php'); // Theme integration

// Admin panel files (You can rename the "panel" folder, define the new name here if changed)
define('ADMIN_PANEL', ROOT_PATH . 'panel/admin.php'); // Admin panel main file
define('ADMIN_DASH', ROOT_PATH . 'panel/dashboard.php'); // Admin dashboard
define('ADMIN_OPTION', ROOT_PATH . 'panel/option_settings.php'); // Admin option settings
define('ADMIN_USER_SETTINGS', ROOT_PATH . 'panel/user_settings.php'); // Admin user settings

// Public-facing files
define('MGREX_INDEX', ROOT_PATH . 'index.php'); // Main public index file
define('MGREX_LOGIN', ROOT_PATH . 'login.php'); // Login page
define('MGREX_REGISTER', ROOT_PATH . 'register.php'); // Registration page

// Include the init files to initialize the system
require_once INIT_MGREX; // MiniGrex initialization
require_once SECURITY_MGREX; // Security initialization
#require_once LOOP_MGREX; // Loop system initialization
require_once FUNCTION_MGREX; // Functions initialization
#require_once UPLOAD_MGREX; // Upload system initialization
#require_once IMAGES_MGREX; // Image handling initialization
require_once CMS_MGREX; // Core CMS initialization

// Cache system
#require_once CACHE_MGREX; // Cache initialization

// Plugin and theme loaders
#require_once PLUGIN_LOADER; // Plugin integration initialization
#require_once THEME_LOADER; // Theme integration initialization

// Admin panel files
#require_once ADMIN_PANEL; // Admin panel initialization
#require_once ADMIN_DASH; // Admin dashboard initialization
#require_once ADMIN_OPTION; // Admin option settings initialization
#require_once ADMIN_USER_SETTINGS; // Admin user settings initialization

// Public-facing files
#require_once MGREX_INDEX; // Load main index file
#require_once MGREX_LOGIN; // Load login file
#require_once MGREX_REGISTER; // Load registration file

?>
