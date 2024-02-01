<?php session_start() ?>

<?php

require_once('../Classes/photoUpload_classes.php');

if (isset($_POST['submitPhoto'])) {
    $base64data = $_POST['croppedImage'];

    list($type, $data) = explode(';', $base64data);
    list(, $data)      = explode(',', $data);

    $binaryData = base64_decode($data);

    if (preg_match("/^data:image\/(\w+);base64,/", $base64data, $matches)) {
        $fileExtension = '.' . $matches[1];
    }

    $filename = 'image_' . uniqid() . $fileExtension;

    $uploadPath = '../Images/';

    $success = file_put_contents($uploadPath . $filename, $binaryData);

    $filePath = $uploadPath . $filename;
    $userID = $_SESSION['userid'];
    $desc = $_POST['desc'];

    $upload = new PhotoUpload();
    $upload->addPostPhoto($userID, $filePath, $desc);

    unlink($filePath);
}