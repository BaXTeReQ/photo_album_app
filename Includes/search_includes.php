<?php

if (isset($_GET["search_button"])) {
    $search = $_GET['search_input'];

    header("location: ../Views/search.php?search=$search");
}
if (isset($_GET["search_button-mod"])) {
    $search = $_GET['search_input'];

    header("location: ../Views/modHub.php?search=$search");
}