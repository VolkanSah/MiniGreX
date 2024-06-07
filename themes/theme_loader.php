<?php
/**
 *
 * MiniGreX - designed with security in mind!
 *
 * @file    theme_loader.php
 * @package MiniGreX
 * @copyright  Volkan Kücükbudak 
 * @version 0.9 Beta
 * @license MIT
 * @link    https://github.com/VolkanSah/MiniGreX
 *
 * This is a theme loader file do not edit it!
 */
function loadTheme($themeName, $page) {
    $themePath = __DIR__ . "/$themeName";

    // Sicherheitscheck: Überprüfen, ob das Theme existiert
    if (!is_dir($themePath)) {
        die('Theme nicht gefunden.');
    }

    // Sicherheitscheck: Überprüfen, ob die Seite existiert
    $pagePath = "$themePath/public/$page.php";
    if (!file_exists($pagePath)) {
        die('Seite nicht gefunden.');
    }

    // Laden der gemeinsamen Dateien (Header, Menü, Sidebar)
    require_once "$themePath/public/header.php";
    require_once "$themePath/public/menu.php";
    require_once "$themePath/public/sidebar.php";

    // Laden der spezifischen Seite
    require_once $pagePath;

    // Laden des Fußbereichs
    require_once "$themePath/public/footer.php";
}

// Beispiel: Laden des "default" Themes und der "home" Seite
loadTheme('default', 'home');
?>
