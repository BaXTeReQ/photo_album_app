<?php

if (isset($_POST["submit"])) {
    $username = (string)$_POST["login"];
    $password = (string)$_POST["password"];

    include "../Classes/dbh_classes.php";
    include "../Classes/signIn_classes.php";
    include "../Controllers/signIn_controller.php";

    $login = new SignInController($username, $password);

    $login->signInUser();

    header("location: ../Views/index.php");
}

?>