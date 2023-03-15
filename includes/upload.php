<?php
/*
In this usage of the upload function, the upload_type is passed as a POST variable and then used to set the upload path and determine the allowed file types. 
The files are then saved in the appropriate folder and saved in the database
*/

// include "init.php"
require_once("init.php");

// upload folder
$upload_dir = "uploads/";

// check file extension
function get_file_extension($file_name) {
    return strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
}

// generate secure filename
function generate_safe_filename($file_name) {
    $file_name = preg_replace("/[^A-Za-z0-9 \.\-_]/", '', $file_name);
    $file_name = strtolower(str_replace(' ', '-', $file_name));
    $file_name = uniqid() . '_' . $file_name;
    return $file_name;
}

// audit user
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized");
}

// check if is 
if (!isset($_FILES['file']) || empty($_FILES['file']['name'])) {
    die("No file uploaded");
}

// Überprüfen, ob die hochgeladene Datei auf dem Server verarbeitet werden kann
if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
    die("File could not be processed");
}

// Überprüfen, ob die Dateiendung erlaubt ist
$extension = get_file_extension($_FILES['file']['name']);

// Je nach Typ des Uploads den Ordnerpfad setzen
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

// Generieren eines sicheren Dateinamens
$file_name = generate_safe_filename($_FILES['file']['name']);

// Dateipfad für den Upload
$file_path = $upload_path . $file_name;

// Verschieben der Datei in das Upload-Verzeichnis
if (!move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
    die("File could not be uploaded");
}

// Speichern des Uploads in der Datenbank
$stmt = $pdo->prepare("INSERT INTO uploads (file_name, file_path, user_id, upload_type) VALUES (:file_name, :file_path, :user_id, :upload_type)");
$stmt->bindParam(':file_name', $file_name, PDO::PARAM_STR);
$stmt->bindParam(':file_path', $file_path, PDO::PARAM_STR);
$stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->bindParam(':upload_type', $_POST['upload_type'], PDO::PARAM_STR);
$stmt->execute();

echo "File uploaded successfully";
