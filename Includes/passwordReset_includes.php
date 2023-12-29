<?php

if (isset($_POST['reset-submit'])) {
    $username = (string)$_POST['login'];
    $email = (string)$_POST['email'];
    $password = (string)"";

    include "../Classes/dbh_classes.php";
    include "../Classes/passwordReset_classes.php";
    include "../Controllers/passwordReset_controller.php";

    $passwordReset = new PasswordResetController($username, $email, $password);

    $passwordReset->checkUser();

    header("location: ../Views/passwordReset.php?username=$username&email=$email");
} else if (isset($_POST['reset-submit2'])) {
    $username = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    include "../Classes/dbh_classes.php";
    include "../Classes/passwordReset_classes.php";
    include "../Controllers/passwordReset_controller.php";

    $passwordReset = new PasswordResetController($username, $email, $password);

    $passwordReset->setNewPassword();
} else header("Location: ../Views/passwordReset.php");
