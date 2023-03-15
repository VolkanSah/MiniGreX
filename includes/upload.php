<?php
/*
In this usage of the upload function, the upload_type is passed as a POST variable and then used to set the upload path and determine the allowed file types. 
The files are then saved in the appropriate folder and saved in the database
*/
// include "init.php"
require_once("init.php");
// Directory for uploads
$upload_dir = "uploads/";
// Funktion zum Überprüfen der Dateiendung
function get_file_extension($file_name) {
    return strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
}
// Function to generate a secure filename
function generate_safe_filename($file_name) {
    $file_name = preg_replace("/[^A-Za-z0-9 \.\-_]/", '', $file_name);
    $file_name = strtolower(str_replace(' ', '-', $file_name));
    $file_name = uniqid() . '_' . $file_name;
    return $file_name;
}
// Check if a user is authenticated
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized");
}
// Check if a file has been uploaded
if (!isset($_FILES['file']) || empty($_FILES['file']['name'])) {
    die("No file uploaded");
}
// Check if the uploaded file can be processed on the server
if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
    die("File could not be processed");
}
// Check if the file extension is allowed
$extension = get_file_extension($_FILES['file']['name']);
// Set the folder path depending on the type of upload
if ($_POST['upload_type'] == 'image') {
    $upload_path = $upload_dir . 'image/';
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
} elseif ($_POST['upload_type'] == 'video') {
    $upload_path = $upload_dir . 'video/';
    $allowed_types = array('mp4', 'avi', 'mov');
} else {
    die("Invalid upload type");
}

if (!in_array($extension, $allowed_types)) {
    die("Invalid file type");
}
// Generate a secure filename
$file_name = generate_safe_filename($_FILES['file']['name']);
// File path for upload
$file_path = $upload_path . $file_name;
// move the file to the uploads directory
if (!move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
    die("File could not be uploaded");
}
// save the upload to the database
$stmt = $pdo->prepare("INSERT INTO uploads (file_name, file_path, user_id, upload_type) VALUES (:file_name, :file_path, :user_id, :upload_type)");
$stmt->bindParam(':file_name', $file_name, PDO::PARAM_STR);
$stmt->bindParam(':file_path', $file_path, PDO::PARAM_STR);
$stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->bindParam(':upload_type', $_POST['upload_type'], PDO::PARAM_STR);
$stmt->execute();
echo "File uploaded successfully";
// end security.php
