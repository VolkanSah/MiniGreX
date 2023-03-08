<?php
/*  MiniGreX 1.0 /themes/theme_loader.php */
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
// Load template if its home
if( is_front_page() {
require_once "default/public/header.php"; // load header.php
require_once "default/public/menu.php"; // load menu.php
require_once "default/public/home.php"; // load menu.php
require_once "default/public/footer.php"; // load footer.php
}
// Load template if its post
if( is_post_page() {
require_once "default/public/header.php"; // load header.php
require_once "default/public/menu.php"; // load menu.php
require_once "default/public/sidebar_post.php"; // load menu.php
require_once "default/public/post.php"; // load menu.php
require_once "default/public/footer.php"; // load footer.php
}
// Load template if its site
if( is_site_page() {
require_once "default/public/header.php"; // load header.php
require_once "default/public/menu.php"; // load menu.php
require_once "default/public/sidebar_site.php"; // load menu.php
require_once "default/public/site.php"; // load menu.php
require_once "default/public/footer.php"; // load footer.php
}
// close connection to database
$conn->close();





