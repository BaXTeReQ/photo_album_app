<?php

if (isset($_GET["search_button"])) {
    $search = $_GET['search_input'];

    header("location: ../Views/search.php?search=$search");
}
