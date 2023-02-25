<?php
/*
EN: In this code, we use PDO and prepared statements to ensure that all SQL queries are secure. We also define some constants
for the names of our database tables and prepare commonly used queries to optimize the code and simplify maintenance.
DE: In diesem Code verwenden wir PDO und Prepared Statements, um sicherzustellen, dass alle SQL-Abfragen sicher sind. 
Wir definieren auch einige Konstanten für die Namen unserer Datenbanktabellen und bereiten häufig verwendete Abfragen
vor, um den Code zu optimieren und die Wartung zu vereinfachen.*/

// Load required files
require_once "includes/config.php"; // chmod 444?
require_once "includes/functions.php"; // general core functions
require_once "plugins/plugin-loader.php"; // plugin init (intigration of plugins)
require_once "includes/security.php"; // security core-  security plugins must use plugin_loader for init plugins

// Set up PDO connection
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Define constants for DB tables
define("USERS_TABLE", "users");
define("POSTS_TABLE", "posts");
define("POSTS_TABLE", "sites");
define("COMMENTS_TABLE", "comments");

// if exist define
//define("POSTS_TABLE", "imagedbs");
//define("POSTS_TABLE", "videodbs");
//define("POSTS_TABLE", "role_managers");
//define("POSTS_TABLE", "seo_managers");
//define("POSTS_TABLE", "profile_managerr");
//define("POSTS_TABLE", "security_manager");


// Prepare statements for commonly used queries
// User prepared statements
$stmt_select_all_users = $pdo->prepare("SELECT * FROM " . USERS_TABLE);
$stmt_select_user_by_id = $pdo->prepare("SELECT * FROM " . USERS_TABLE . " WHERE id = :id");
$stmt_insert_user = $pdo->prepare("INSERT INTO " . USERS_TABLE . " (username, password, email) VALUES (:username, :password, :email)");
// Posts prepared statements
$stmt_select_all_posts = $pdo->prepare("SELECT * FROM " . POSTS_TABLE);
$stmt_select_post_by_id = $pdo->prepare("SELECT * FROM " . POSTS_TABLE . " WHERE id = :id");
$stmt_insert_post = $pdo->prepare("INSERT INTO " . POSTS_TABLE . " (title, content, author_id, category) VALUES (:title, :content, :author_id, :category)");
// Comments prepared statements
$stmt_select_comments_by_post_id = $pdo->prepare("SELECT * FROM " . COMMENTS_TABLE . " WHERE post_id = :post_id");
$stmt_insert_comment = $pdo->prepare("INSERT INTO " . COMMENTS_TABLE . " (post_id, author_name, content) VALUES (:post_id, :author_name, :content)");
// Sites with category and  prepared statements
$stmt_select_all_sites = $pdo->prepare("SELECT * FROM " . SITES_TABLE);
$stmt_select_sites_by_id = $pdo->prepare("SELECT * FROM " . SITES_TABLE . " WHERE id = :id");
$stmt_insert_sites = $pdo->prepare("INSERT INTO " . SITES_TABLE . " (title, content, author_id, category) VALUES (:title, :content, :author_id, :category)");
// DEMO Dummy for optional Plugins like image_db (image Database & Hosting)
$stmt_select_all_image_dbs = $pdo->prepare("SELECT * FROM " . IMAGE_DB_TABLE);
$stmt_select_image_dbs_by_id = $pdo->prepare("SELECT * FROM " . IMAGE_DB_TABLE . " WHERE id = :id");
$stmt_insert_image_dbs = $pdo->prepare("INSERT INTO " . IMAGE_DB_TABLE . " (title, content, link, author_id, category) VALUES (:title, :content, :link, :author_id, :category)");

