<?php
/**
 *
 * MiniGreX - designed with security in mind!
 *
 * @file    index.php
 * @package MiniGreX
 * @copyright  Volkan Kücükbudak 
 * @version 0.9 Beta
 * @license MIT
 * @link    https://github.com/VolkanSah/MiniGreX
 *
 * Main Index-File of MiniGreX CMS
 */
//  Copyright @S. Volkan Kücükbudak
require_once __DIR__ . '/includes/loader.php';
require_once LOOP_MGREX; // Loop system initialization
require_once UPLOAD_MGREX; // Upload system initialization
require_once IMAGES_MGREX; // Image handling initialization
require_once CMS_MGREX; // Core CMS initialization
// Cache system
require_once CACHE_MGREX; // Cache initialization
// Plugin and theme loaders
require_once PLUGIN_LOADER; // Plugin integration initialization
require_once THEME_LOADER; // Theme integration initialization
// Public-facing files
// require_once MGREX_INDEX; // This file!
require_once MGREX_LOGIN; // Load login file
require_once MGREX_REGISTER; // Load registration file

// Initialize the CMS
$cms = new CMS($pdo);

// Start the user interface
$cms->run();
?>



