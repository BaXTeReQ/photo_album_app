<?php

session_start();

if (isset($_POST['submitall'])) {
    $id = $_SESSION['userid'];
    $username = $_POST['usernamechange'];
    $email = $_POST['emailchange'];

    require_once("../Classes/user_classes.php");

    $user = new User($id, $username, $email);
    $user->updateUser();

    header("location: ../Views/user.php");
}

if (isset($_POST['changeProfilePhotoFormButton'])) {
    require_once('../Classes/photoUpload_classes.php');

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

    $upload = new PhotoUpload();
    $userID = $_SESSION['userid'];

    $upload->changeProfilePhoto($userID, $filePath);

    unlink($filePath);
    header('location: ../Views/user.php');
}