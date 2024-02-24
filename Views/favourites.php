<?php require 'nav.php' ?>

<?php if (!isset($_SESSION['username'])) header("location: ../Views/index.php"); ?>

<main class="favourites noUsers__panel">
    <h2>Twoje ulubione</h2>
    <section>
        <?php
        require_once('../Classes/post_classes.php');
        require_once('../Classes/user_classes.php');
        require_once('../Classes/ipfs_classes.php');

        $posts = Post::getLikedPosts($_SESSION['userid']);
        $ipfs = new IPFS();
        $gateway = $ipfs->getGateway();

        foreach ($posts as $post) {
            $user = new User($post->getUserID());
            $profilePictureCID = $user->getProfilePhotoCIDById($post->getUserID());

            include '../Views/post.php';
        }
        ?>
    </section>
</main>

<?php require 'footer.php' ?>