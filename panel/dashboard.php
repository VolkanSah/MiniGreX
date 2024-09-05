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
# require_once LOOP_MGREX; // Loop system initialization
require_once FUNCTION_MGREX; // Functions initialization
require_once UPLOAD_MGREX; // Upload system initialization
require_once IMAGES_MGREX; // Image handling initialization
require_once CMS_MGREX; // Core CMS initialization

// Cache system
require_once CACHE_MGREX; // Cache initialization

// Plugin and theme loaders
require_once PLUGIN_LOADER; // Plugin integration initialization
require_once THEME_LOADER; // Theme integration initialization

// Admin panel files
require_once ADMIN_PANEL; // Admin panel initialization
require_once ADMIN_DASH; // Admin dashboard initialization
require_once ADMIN_OPTION; // Admin option settings initialization
require_once ADMIN_USER_SETTINGS; // Admin user settings initialization

// Public-facing files
require_once MGREX_LOGIN; // Load login file

// Check login status and redirect if not logged in
if (!checkLoginStatus()) {
    header('Location: ' . MGREX_LOGIN); // Redirect to login page if not logged in
    exit;
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
        <h1>Welcome to the Admin Dashboard</h1>
        <!-- Dashboard content goes here -->
    </div>

    <?php require 'footer.php'; ?> <!-- Footer section -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->
</body>
</html>
