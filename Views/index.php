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

        foreach ($posts as $post) {
            $user = new User($post->getUserID());
            $profilePictureCID = $user->getProfilePhotoCIDById($post->getUserID());

            include '../Views/post.php';
        }
        ?>
    </section>
</main>

<?php require 'footer.php' ?>