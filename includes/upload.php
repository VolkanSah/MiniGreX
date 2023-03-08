
<!-- form tu use for upload .php
<form action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*" />
    <button type="submit">Upload</button>
</form>
-->

<?php
// load init.php
require_once "init.php";
// get database connection
function get_connection() {
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 if ($conn->connect_error) {
  die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
 }
 return $conn;
}

// Get reference to uploaded image
$image_file = $_FILES["image"];
// Get reference to uploaded video
$video_file = $_FILES["video"];

// Exit if no file uploaded
if (!isset($image_file)) {
    die('No file uploaded.');
}
// Exit if no file uploaded
if (!isset($video_file)) {
    die('No file uploaded.');
}

// Exit if image file is zero bytes
if (filesize($image_file["tmp_name"]) <= 0) {
    die('Uploaded file has no contents.');
}
// Exit if image file is zero bytes
if (filesize($video_file["tmp_name"]) <= 0) {
    die('Uploaded file has no contents.');
}

// Exit if is not a valid image file
$image_type = exif_imagetype($image_file["tmp_name"]);
if (!$image_type) {
    die('Uploaded file is not an image.');
}
// Exit if is not a valid image file
$video_type = exif_videotype($video_file["tmp_name"]);
if (!$image_type) {
    die('Uploaded file is not an video.');
}

// Get file extension based on file type, to prepend a dot we pass true as the second parameter
$image_extension = image_type_to_extension($image_type, true);
$video_extension = video_type_to_extension($video_type, true);

// Create a unique name
$image_name = bin2hex(random_bytes(16)) . $image_extension;
$video_name = bin2hex(random_bytes(16)) . $video_extension;


// Move the temp image file to the images directory
move_uploaded_file(
    // Temp image location
    $image_file["tmp_name"],

    // New image location
    __DIR__ . "./uploads/image/" . $image_name
);
// Move the temp video file to the images directory
move_uploaded_file(
    // Temp image location
    $video_file["tmp_name"],

    // New image location
    __DIR__ . "./uploads/video/" . $image_name
);

// Redirect back to the page where the form was submitted from
header('Location: ' . $_SERVER['HTTP_REFERER']);
