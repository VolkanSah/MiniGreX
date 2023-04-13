<?php
// Load template if its home
// careful! not finished... only for remember!
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
   
// load css
   
if( is_default_css() {
require_once "default/public/css/default.css"; // load css
  
  // do somework with it ! soon
  
  // print!
}
   
   // load css
   
if( is_default_js() {
require_once "default/public/js/default.js"; // load js
  
  // do somework with it ! soon
  
  // print!
}
   
   




