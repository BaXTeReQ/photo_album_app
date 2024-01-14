<?php

if (isset($_POST['reset-submit'])) {
    $username = (string)$_POST['login'];
    $email = (string)$_POST['email'];
    $password = (string)"";

    require_once "../Classes/dbh_classes.php";
    require_once "../Classes/passwordReset_classes.php";

    $passwordReset = new PasswordReset($username, $email, $password);

    $passwordReset->checkUser();

    header("location: ../Views/passwordReset.php?username=$username&email=$email");
} else if (isset($_POST['reset-submit2'])) {
    $username = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once "../Classes/dbh_classes.php";
    require_once "../Classes/passwordReset_classes.php";

    $passwordReset = new PasswordReset($username, $email, $password);

    $passwordReset->setNewPassword();

    header("location: ../Views/passwordResetSuccess.php");
} else header("location: ../Views/passwordReset.php");
