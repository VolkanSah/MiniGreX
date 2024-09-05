<?php
/**
 *
 * MiniGreX - designed with security in mind!
 *
 * @file   panel/index.php
 * @package MiniGreX
 * @copyright  Volkan Kücükbudak 
 * @version 0.9 Beta
 * @license MIT
 * @link    https://github.com/VolkanSah/MiniGreX
 *
 *  Admin : Panel_index
 * 
 * 
 */

require_once __DIR__ . '/../includes/loader.php'; // Adjusted the path

// Include the init files to initialize the system
require_once INIT_MGREX; // MiniGrex initialization
require_once SECURITY_MGREX; // Security initialization
require_once FUNCTION_MGREX; // Functions initialization
require_once CMS_MGREX; // Core CMS initialization

// Admin panel files
require_once ADMIN_DASH; // Admin dashboard initialization

// Public-facing files
require_once MGREX_LOGIN; // Load login file

// Check login status and redirect if not logged in
if (!checkLoginStatus()) {
    header('Location: ' . MGREX_LOGIN); 
    exit;
}

// Redirect to the dashboard
header('Location: ' . ADMIN_DASH); 
exit;
?>
