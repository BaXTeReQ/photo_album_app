<?php session_start(); ?>
<?php
// Check if it's an AJAX request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

    require_once('../Classes/post_classes.php');

    if (!$_POST['post_liked']) Post::insertLike($_SESSION['userid'], $_POST['post_CID']);
    else Post::deleteLike($_SESSION['userid'], $_POST['post_CID']);
} else {
    // Not an AJAX request, handle accordingly (e.g., redirect or show an error)
    echo "Invalid request.";
}