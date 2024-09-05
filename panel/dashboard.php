<?php
/**
 *
 * MiniGreX - designed with security in mind!
 *
 * @file    panel/dashboard.php
 * @package MiniGreX
 * @copyright  Volkan Kücükbudak 
 * @version 0.9 Beta
 * @license MIT
 * @link    https://github.com/VolkanSah/MiniGreX
 *
 *  Admin : Dashboard
 * 
 */

require_once __DIR__ . '/../includes/loader.php'; // Load the loader file

// Include the init files to initialize the system
require_once INIT_MGREX; // MiniGrex initialization
require_once SECURITY_MGREX; // Security initialization
require_once FUNCTION_MGREX; // Functions initialization
require_once UPLOAD_MGREX; // Upload system initialization
require_once IMAGES_MGREX; // Image handling initialization
require_once CMS_MGREX; // Core CMS initialization

// Cache system
require_once CACHE_MGREX; // Cache initialization

// Plugin and theme loaders
require_once PLUGIN_LOADER; // Plugin integration initialization
require_once THEME_LOADER; // Theme integration initialization

// Check login status and redirect if not logged in
if (!checkLoginStatus()) {
    header('Location: ' . MGREX_LOGIN); // Redirect to login page if not logged in
    exit;
}

// Dynamically load admin pages based on URL parameter
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; // Default to dashboard

switch ($page) {
    case 'admin':
        require_once ADMIN_PANEL; // Admin settings
        break;
    case 'user_settings':
        require_once ADMIN_USER_SETTINGS; // User settings
        break;
    case 'option_settings':
        require_once ADMIN_OPTION; // Option settings
        break;
    default:
        require_once ADMIN_DASH; // Default to the dashboard
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <?php require 'header.php'; ?> <!-- Header section -->
    <?php require 'navi.php'; ?> <!-- Navigation bar -->

    <div class="container">
        <!-- The content will be dynamically loaded based on the page parameter -->
    </div>

    <?php require 'footer.php'; ?> <!-- Footer section -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->
</body>
</html>
