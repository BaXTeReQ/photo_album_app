<?php

if (isset($_POST["submit"])) {
    $username = (string) $_POST["login"];
    $password = (string) $_POST["password"];

    require_once "../Classes/dbh_classes.php";
    require_once "../Classes/signIn_classes.php";

    $signIn = new SignIn($username, $password);

    $signIn->signInUser();

    header("location: ../Views/index.php");
}
