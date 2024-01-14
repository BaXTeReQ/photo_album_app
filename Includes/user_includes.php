<?php

session_start();

if (isset($_POST['submitall'])) {
    $id = $_SESSION['userid'];
    $username = $_POST['usernamechange'];
    $email = $_POST['emailchange'];

    include "../Classes/user_classes.php";

    $user = new User($id, $username, $email);
    $user->updateUser();

    header("location: ../Views/user.php");
}

if (isset($_POST['changeProfilePhotoFormButton'])) {
    require_once('../Classes/photoUpload_classes.php');

    $upload = new PhotoUpload();
    $userID = $_SESSION['userid'];

    $upload->changeProfilePhoto($userID, $_FILES['file']);
    header('location: ../Views/user.php');
}
