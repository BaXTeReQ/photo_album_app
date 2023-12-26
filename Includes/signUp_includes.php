<?php

if(isset($_POST['register_submit'])) {

    $email = (string)$_POST["email"];
    $username = (string)$_POST["login"];
    $password = (string)$_POST["password"];
    $confirm_password = (string)$_POST["confirm_password"];

    include "../Classes/dbh_classes.php";
    include "../Classes/signUp_classes.php";
    include "../Controllers/signUp_controller.php";

    $signUp = new SignUpController($username, $email, $password, $confirm_password);
    $signUp->signUpUser();

    header("Location: ../Views/signUpSuccesfull.php");
}

?>