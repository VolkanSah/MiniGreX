<?php
// Dynamischer Pfad zum Root-Verzeichnis
define('ROOT_PATH', __DIR__ . '/../');

// Pfade zu den wichtigen Dateien
define('INIT_MGREX', ROOT_PATH . 'includes/init.php');
define('SECURITY_MGREX', ROOT_PATH . 'includes/security.php');
define('LOOP_MGREX', ROOT_PATH . 'includes/loop.php');
define('FUNCTION_MGREX', ROOT_PATH . 'includes/functions.php');
define('UPLOAD_MGREX', ROOT_PATH . 'includes/upload.php');
define('IMAGES_MGREX', ROOT_PATH . 'includes/images.php');
define('CMS_MGREX', ROOT_PATH . 'includes/cms.php');
define('CACHE_MGREX', ROOT_PATH . 'includes/cache.php');
define('PLUGIN_LOADER', ROOT_PATH . 'plugins/plugin_loader.php');
define('THEME_LOADER', ROOT_PATH . 'themes/theme_loader.php');

// Lade die Initialisierungsdateien
require_once INIT_MGREX;
require_once SECURITY_MGREX;
require_once PLUGIN_LOADER;
require_once THEME_LOADER;
?>
