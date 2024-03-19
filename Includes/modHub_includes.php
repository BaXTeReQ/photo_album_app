<?php

session_start();

if ($_SESSION['role'] == 3) {
    header('location: ../Views/');
}

require_once '../Classes/post_classes.php';
require_once '../Classes/user_classes.php';
require_once '../Classes/ipfs_classes.php';

if (isset($_POST['submitChanges__post'])) {
    $id = $_POST['id'];
    $desc = $_POST['desc'];

    Post::editPost($id, $desc);
}

if (isset($_POST['submitChanges__user'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    User::editUser($id, $username, $email, $password);
}

if (isset($_POST['gatewayChange'])) {
    $gateway = (string) $_POST['gateway'];

    echo $gateway;

    IPFS::changeGateway($gateway);
}

header('Location: ../Views/modHub.php');