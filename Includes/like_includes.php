<?php session_start(); ?>
<?php
// Check if it's an AJAX request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

    require_once('../Classes/user_classes.php');

    $user = User::likePhoto($_SESSION['userid'], $_POST['photo_id']);
} else {
    // Not an AJAX request, handle accordingly (e.g., redirect or show an error)
    echo "Invalid request.";
}