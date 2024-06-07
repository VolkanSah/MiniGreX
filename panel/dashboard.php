<?php
require_once '../includes/init.php';
require_once '../includes/functions.php';

if (!checkLoginStatus()) {
    header('Location: ../login.php');
    exit;
}

// Dashboard-spezifische Logik
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
    <?php require 'header.php'; ?>
    <?php require 'navi.php'; ?>

    <div class="container">
        <h1>Welcome to the Admin Dashboard</h1>
        <!-- Dashboard-Inhalte -->
    </div>

    <?php require 'footer.php'; ?>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
