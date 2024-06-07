<?php
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
