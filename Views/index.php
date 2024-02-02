<?php require 'nav.php' ?>
<?php require 'userRecommendations.php' ?>

<main class="mainPage">
    <h2>Odkrywaj</h2>
    <section>
        <?php
        require_once('../Classes/post_classes.php');
        require_once('../Classes/ipfs_classes.php');

        $posts = Post::getPosts();
        $ipfs = new IPFS();
        $gateway = $ipfs->getGateway();

        foreach ($posts as $post) :
            $user = new User($post->getUserID());
            $profilePictureCID = $user->getProfilePhotoCIDById($post->getUserID());
        ?>
        <article class="post">
            <a href="user.php?userid=<?php echo $post->getUserID(); ?>">
                <img src="<?php echo $gateway . $profilePictureCID; ?>" alt="User Image" class="profile__photo">
                <span><?php echo $user->getUsernameById($post->getUserID()); ?></span>
            </a>
            <div class="img">
                <img src="<?php echo $gateway . $post->getCID(); ?>" alt="<?php echo $post->getDescription(); ?>">
            </div>
            <button type="button" class="like--button" data-post-cid="<?php echo $post->getCID(); ?>"
                data-post-liked="<?php echo ($post->checkIfPostIsLiked($_SESSION['userid'], $post->getCID())) ? 1 : 0; ?>">
                <i class='<?php echo ($post->checkIfPostIsLiked($_SESSION['userid'], $post->getCID())) ? "fa-solid fa-heart" : "fa-regular fa-heart";
                                ?>'></i>
            </button>
            <p><?php echo $post->getDescription(); ?></p>
        </article>
        <?php endforeach; ?>
    </section>
</main>

<?php require 'footer.php' ?>