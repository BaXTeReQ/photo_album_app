<?php

session_start();

if (!isset($_SESSION) && $_SESSION['role'] == 3) {
    header("location: ../Views/");
}

require_once '../Classes/post_classes.php';
require_once '../Classes/user_classes.php';

if (isset($_GET['postid'])) {
    $id = $_GET['postid'];

    Post::deletePost($id);
} else {
    $id = $_GET['userid'];

    User::deleteUser($id);
}
header('Location: ../Views/modHub.php');