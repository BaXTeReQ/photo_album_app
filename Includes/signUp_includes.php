<?php

if (isset($_POST['register_submit'])) {
    $email = (string)$_POST["email"];
    $username = (string)$_POST["login"];
    $password = (string)$_POST["password"];
    $confirm_password = (string)$_POST["confirm_password"];

    require_once "../Classes/dbh_classes.php";
    require_once "../Classes/signUp_classes.php";

    $signUp = new SignUp($username, $email, $password, $confirm_password);
    $signUp->signUpUser();

    header("Location: ../Views/signUpSuccesfull.php");
}
