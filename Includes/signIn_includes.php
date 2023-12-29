<?php

if (isset($_POST["submit"])) {
    $username = (string)$_POST["login"];
    $password = (string)$_POST["password"];

    include "../Classes/dbh_classes.php";
    include "../Classes/signIn_classes.php";
    include "../Controllers/signIn_controller.php";

    $signIn = new SignInController($username, $password);

    $signIn->signInUser();

    header("location: ../Views/index.php");
}
