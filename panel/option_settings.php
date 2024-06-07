<?php
require_once '../includes/init.php';
require_once '../includes/functions.php';

if (!checkLoginStatus()) {
    header('Location: ../login.php');
    exit;
}

// Option Settings-spezifische Logik
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
