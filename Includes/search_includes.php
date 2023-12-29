<?php

if (isset($_GET["search_button"])) {
    $search = $_GET['search_input'];

    include "../Classes/dbh_classes.php";
    include "../Classes/search_classes.php";
    include "../Controllers/search_controller.php";

    header("location: ../Views/search.php?search=$search");
}
