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
// Start the session
session_start();

// Check if the page is accessed through the dashboard
if (!isset($_SESSION['dashboard_access']) || $_SESSION['dashboard_access'] !== true) {
    // If not, redirect to the dashboard or an error page
    header('Location: dashboard.php');
    exit;
}

// Clear the session variable to prevent future access without dashboard
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
