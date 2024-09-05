<?php
if (!defined('SECURE_ACCESS')) {
    die('Direct access not permitted');
}
// Plugin Loader

// Array mit allen Plugins, die geladen werden sollen
$plugins = ['role_manager'];
// $plugins = ['profile_manager'];
// $plugins = ['video_db'];
// $plugins = ['image_db'];
// $plugins = ['gateway_manager'];


foreach ($plugins as $plugin) {
    $plugin_path = __DIR__ . "/$plugin/core.php";
    if (file_exists($plugin_path)) {
        require_once $plugin_path;
    } else {
        die("Plugin $plugin konnte nicht geladen werden.");
    }
}
?>
