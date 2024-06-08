<?php
/**
 *
 * MiniGreX - designed with security in mind!
 *
 * @file    includes/init.php.php
 * @package MiniGreX
 * @copyright  Volkan Kücükbudak 
 * @version 0.9 Beta
 * @license MIT
 * @link    https://github.com/VolkanSah/MiniGreX
 *
 * The access data for the database is defined here as constants to prevent them from being accidentally overwritten.
 * In addition, the session.cookie_httponly and session.cookie_secure settings are set to make cookies more secure.
 * Finally, it is checked whether the page is being accessed via HTTPS and, if necessary, a redirection to HTTPS is performed.
 * 
 */
// #############################################
// Note! set chmod to this file to 0444 or 0666
// #############################################
// Please setup your database informations
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_db_name');
define('DB_USER', 'your_db_user');
define('DB_PASS', 'your_secret_pass');
// Session name - please setup your_name_of_session'
define('SESSION_NAME', 'your_name_of_session'); 

// Cookie security
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);

// Debug uncoment to debug
//define('DEBUG_CONSOLE', 'true');

// force SSL set to off for disable ssl force ! WARNING its not an good idea !
if ($_SERVER['HTTPS'] !== 'on') {
    header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
}

// Load required files
require_once "../plugins/plugin_loader.php"; // plugin init (intigration of plugins) // future init over security.php
require_once "../themes/theme_loader.php"; // theme init (intigration of plugins) // future init over security.php

/* EN: In this code, we use PDO and prepared statements to ensure that all SQL queries are secure. We also define some constants
for the names of our database tables and prepare commonly used queries to optimize the code and simplify maintenance. */
// Set up PDO connection
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Define constants for DB tables
define("USERS_TABLE", "users"); // developed !
define("POSTS_TABLE", "posts"); // developed !
define("SITES_TABLE", "sites");  // not finished !
define("COMMENTS_TABLE", "comments"); // developed !
define("ROLES_TABLE", "roles"); // developed !
define("USER_ROLES_TABLE", "user_roles"); // developed !
define("PERMISSIONS_TABLE", "permissions"); // developed !

// if exist define und uncoment

//define("IMAGE_TABLE", "imagedbs"); // not developed !
//define("VIDEO_TABLE", "videodbs"); // not developed !
//define("SEO_TABLE", "seo_managers"); // not developed !
//define("PROFILE_TABLE", "profile_managerr"); // not developed !
//define("SECURITY_TABLE", "security_manager"); // not developed !

/*

            Prepare statements for commonly used queries

*/

// User 
$stmt_select_all_users = $pdo->prepare("SELECT * FROM " . USERS_TABLE);
$stmt_select_user_by_id = $pdo->prepare("SELECT * FROM " . USERS_TABLE . " WHERE id = :id");
$stmt_insert_user = $pdo->prepare("INSERT INTO " . USERS_TABLE . " (username, password) VALUES (:username, :password)");

// Posts with category 
$stmt_select_all_posts = $pdo->prepare("SELECT * FROM " . POSTS_TABLE);
$stmt_select_post_by_id = $pdo->prepare("SELECT * FROM " . POSTS_TABLE . " WHERE id = :id");
$stmt_insert_post = $pdo->prepare("INSERT INTO " . POSTS_TABLE . " (user_id, link) VALUES (:user_id, :link)");

// Comments 
$stmt_select_comments_by_post_id = $pdo->prepare("SELECT * FROM " . COMMENTS_TABLE . " WHERE post_id = :post_id");
$stmt_insert_comment = $pdo->prepare("INSERT INTO " . COMMENTS_TABLE . " (post_id, text) VALUES (:post_id, :text)");

// Sites with category
$stmt_select_all_sites = $pdo->prepare("SELECT * FROM " . SITES_TABLE);
$stmt_select_sites_by_id = $pdo->prepare("SELECT * FROM " . SITES_TABLE . " WHERE id = :id");
$stmt_insert_sites = $pdo->prepare("INSERT INTO " . SITES_TABLE . " (user_id, link) VALUES (:user_id, :link)");

// image_db 
//$stmt_select_all_image_dbs = $pdo->prepare("SELECT * FROM " . IMAGE_TABLE);
//$stmt_select_image_dbs_by_id = $pdo->prepare("SELECT * FROM " . IMAGE_TABLE . " WHERE id = :id");
//$stmt_insert_image_dbs = $pdo->prepare("INSERT INTO " . IMAGE_TABLE . " (title, content, link, author_id, category) VALUES (:title, :content, :link, :author_id, :category)");

// video_db 
//$stmt_select_all_video_dbs = $pdo->prepare("SELECT * FROM " . VIDEO_TABLE);
//$stmt_select_video_dbs_by_id = $pdo->prepare("SELECT * FROM " . VIDEO_TABLE . " WHERE id = :id");
//$stmt_insert_video_dbs = $pdo->prepare("INSERT INTO " . VIDEO_TABLE . " (title, content, link, author_id, category) VALUES (:title, :content, :link, :author_id, :category)");

// Role Manager 
$stmt_select_all_roles = $pdo->prepare("SELECT * FROM " . ROLES_TABLE);
$stmt_select_role_by_id = $pdo->prepare("SELECT * FROM " . ROLES_TABLE . " WHERE id = :id");
$stmt_insert_role = $pdo->prepare("INSERT INTO " . ROLES_TABLE . " (name) VALUES (:name)");

$stmt_select_all_user_roles = $pdo->prepare("SELECT * FROM " . USER_ROLES_TABLE);
$stmt_select_user_role_by_user_id = $pdo->prepare("SELECT * FROM " . USER_ROLES_TABLE . " WHERE user_id = :user_id");
$stmt_insert_user_role = $pdo->prepare("INSERT INTO " . USER_ROLES_TABLE . " (user_id, role_id) VALUES (:user_id, :role_id)");

$stmt_select_all_permissions = $pdo->prepare("SELECT * FROM " . PERMISSIONS_TABLE);
$stmt_select_permission_by_role_id = $pdo->prepare("SELECT * FROM " . PERMISSIONS_TABLE . " WHERE role_id = :role_id");
$stmt_insert_permission = $pdo->prepare("INSERT INTO " . PERMISSIONS_TABLE . " (role_id, permission) VALUES (:role_id, :permission)");

// soon...
?>
