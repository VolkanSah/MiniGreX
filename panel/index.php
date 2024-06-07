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
require_once '../includes/init.php';
require_once '../includes/functions.php';

if (!checkLoginStatus()) {
    header('Location: ../login.php');
    exit;
}

// Weiterleitung zum Dashboard
header('Location: dashboard.php');
exit;
?>
