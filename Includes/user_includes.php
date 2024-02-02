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

    $photoData = $_POST['croppedImage'];
    $userID = $_SESSION['userid'];

    $upload = new PhotoUpload();
    $filePath = $upload->processPhoto($photoData);
    $upload->changeProfilePhoto($userID, $filePath);

    unlink($filePath);
    header('location: ../Views/user.php');
}