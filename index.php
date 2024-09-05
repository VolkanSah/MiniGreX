<?php 
// source https://github.com/VolkanSah/MiniGreX
// content management system
//  .-.   .-..-..-. .-..-. .---. .----. .----..-.  .-.
//  |  `.'  || ||  `| || |/   __}| {}  }| {_   \ \/ / 
//  | |\ /| || || |\  || |\  {_ }| .-. \| {__  / /\ \ 
//  `-' ` `-'`-'`-' `-'`-' `---' `-' `-'`----'`-'  `-'
//  Copyright @S. Volkan Kücükbudak
require_once __DIR__ . '/includes/loader.php';

// Initialize the CMS
$cms = new CMS($pdo);

// Start the user interface
$cms->run();
?>



