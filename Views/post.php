<?php
$url = $_SERVER['PHP_SELF'];
$check = strrpos($url, "modHub.php");
?>

<article class="post">
    <a href="user.php?userid=<?php echo $post->getUserID(); ?>">
        <img src="<?php echo $gateway . $profilePictureCID; ?>" alt="User Image" class="profile__photo">
        <span><?php echo $user->getUsernameById($post->getUserID()); ?></span>
    </a>
    <div class="img">
        <img src="<?php echo $gateway . $post->getCID(); ?>" alt="<?php echo $post->getDescription(); ?>"
            loading="lazy">
    </div>
    <div class="likes">
        <?php
echo "<button type='button' class='like--button'";

if ($check) {
    echo " disabled ";
}

echo "data-post-id='";
echo $post->getID();
echo "' data-post-liked='";
if (isset($_SESSION['userid'])) {
    echo ($post->checkIfPostIsLiked($_SESSION['userid'], $post->getID())) ? 1 : 0;
    echo "'>";
    echo "<i class='";
    echo ($post->checkIfPostIsLiked($_SESSION['userid'], $post->getID())) ? "fa-solid fa-heart" : "fa-regular fa-heart";
    echo "'></i>";
} else {
    echo "0' disabled>";
    echo "<i class='fa-regular fa-heart'></i>";
}
echo "</button>";
?>
        <p id='likeCounter-<?php echo $post->getID(); ?>'><?php echo Post::countLikes($post->getID()); ?></p>
    </div>
    <p><?php echo $post->getDescription(); ?></p>
    <?php
if ($check): ?>
    <div class="btn-container">
        <a href="modHub-edit.php?postid=<?php echo $post->getID(); ?>" class="btn-primary">Edytuj</a>
        <?php if ($_SESSION['role'] == 1): ?>
        <a href="modHub-delete.php?postid=<?php echo $post->getID(); ?>" class="btn-primary btn-red">Usuń</a>
        <?php endif;?>
    </div>
    <?php endif;?>
</article>