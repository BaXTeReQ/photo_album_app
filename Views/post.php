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
        echo "<button type='button' class='like--button' data-post-id='";
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
</article>