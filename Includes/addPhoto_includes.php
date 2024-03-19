<?php session_start();

require_once '../Classes/photoUpload_classes.php';

if (isset($_POST['submitPhoto'])) {
    $photoData = $_POST['croppedImage'];
    $userID = $_SESSION['userid'];
    $desc = $_POST['desc'];

    $upload = new PhotoUpload();
    $filePath = $upload->processPhoto($photoData);
    $upload->addPostPhoto($userID, $filePath, $desc);

    unlink($filePath);
    header('Location: ../Views/');
}