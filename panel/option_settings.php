<?php
/**
 *
 * MiniGreX - designed with security in mind!
 *
 * @file    panel/option_settings.php
 * @package MiniGreX
 * @copyright  Volkan Kücükbudak 
 * @version 0.9 Beta
 * @license MIT
 * @link    https://github.com/VolkanSah/MiniGreX
 *
 *  Admin : Option Settings
 * 
 * 
 */
require_once __DIR__ . '/../includes/loader.php'; // Load the loader file

// Start the session
session_start();

// Check if the page is accessed through the dashboard
if (!isset($_SESSION['dashboard_access']) || $_SESSION['dashboard_access'] !== true) {
    // Redirect to the dashboard using the defined constant
    header('Location: ' . ADMIN_DASH);
    exit;
}

// Clear the session variable after the check to prevent unauthorized future access
unset($_SESSION['dashboard_access']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Option Settings</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <?php require 'header.php'; ?>
    <?php require 'navi.php'; ?>

    <div class="container">
        <h1>Option Settings</h1>
        <!-- Option Settings-Inhalte -->
    </div>

    <?php require 'footer.php'; ?>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
