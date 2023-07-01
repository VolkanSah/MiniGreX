<?php // source https://github.com/VolkanSah/MiniGreX-CMS/
// content management system
//  .-.   .-..-..-. .-..-. .---. .----. .----..-.  .-.
//  |  `.'  || ||  `| || |/   __}| {}  }| {_   \ \/ / 
//  | |\ /| || || |\  || |\  {_ }| .-. \| {__  / /\ \ 
//  `-' ` `-'`-'`-' `-'`-' `---' `-' `-'`----'`-'  `-'
//  Copyright @S. Volkan Kücükbudak

// Include the init file
require_once 'includes/init.php';

// Initialize the CMS
$cms = new CMS();

// Start the user interface
$cms->run();

?>
