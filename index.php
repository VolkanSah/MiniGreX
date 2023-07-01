<?php // source https://github.com/VolkanSah/MiniGreX-CMS/
// content management system
//  .-.   .-..-..-. .-..-. .---. .----. .----..-.  .-.
//  |  `.'  || ||  `| || |/   __}| {}  }| {_   \ \/ / 
//  | |\ /| || || |\  || |\  {_ }| .-. \| {__  / /\ \ 
//  `-' ` `-'`-'`-' `-'`-' `---' `-' `-'`----'`-'  `-'
//  Copyright @S. Volkan Kücükbudak

// Define the init file
define('INIT_MGREX', "includes/init.php");
// Define core files
// Define the security file
define('SECURITY_MGREX', "includes/security.php");
// Define the loop file
define('LOOP_MGREX', "includes/loop.php");
// Define the core_function file
define('FUNCTION_MGREX', "includes/functions.php");
// Define the upload_handel file
define('UPLOAD_MGREX', "includes/upload.php");
// Define the image_handel file
define('IMAGES_MGREX', "includes/images.php");

// Include the init file
require_once INIT_MGREX;
require_once SECURITY_MGREX;
require_once LOOP_MGREX;
require_once FUNCTION_MGREX;
require_once UPLOAD_MGREX;
require_once IMAGES_MGREX;

// Initialize the CMS
$cms = new CMS();

// Start the user interface
$cms->run();

?>
