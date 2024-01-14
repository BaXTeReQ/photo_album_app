<?php session_start() ?>

<?php

require_once('../Classes/photoUpload_classes.php');

if (isset($_POST['submitPhoto'])) {
    $file = $_FILES['file'];
    $userID = $_SESSION['userid'];
    $desc = $_POST['desc'];

    // echo "<pre>" . var_dump($file) . "</pre>";
    // echo $file["name"];
    // echo $userID;
    // echo $desc;

    $upload = new PhotoUpload();
    $upload->addPostPhoto($userID, $file, $desc);
}
