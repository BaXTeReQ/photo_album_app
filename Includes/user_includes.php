<?php

session_start();

if (isset($_POST['submitall'])) {
    $id = $_SESSION['userid'];
    $username = $_POST['usernamechange'];
    $email = $_POST['emailchange'];

    include "../Classes/dbh_classes.php";
    include "../Classes/user_classes.php";
    include "../Controllers/user_controller.php";

    $userUpdate = new UserController($id, $username, $email);
    $userUpdate->updateUser();

    header("location: ../Views/user.php");
}
