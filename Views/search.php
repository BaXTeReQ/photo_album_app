<?php require 'nav.php' ?>
<?php require 'userRecommendations.php' ?>

<main class="search">
    <form action="../Includes/search_includes.php" method="GET">
        <input type="search" placeholder="<?php echo (isset($_GET['search'])) ? $_GET['search'] : 'Szukaj...'; ?>"
            name="search_input">
        <button type="submit" name="search_button"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>

    <section class="search__results">
        <div class="buttons">
            <button type="button" class="buttons__users active">Użytkownicy</button>
            <button type="button" class="buttons__posts">Posty</button>
        </div>

        <?php
        if (isset($_GET['search'])) :
            require_once('../Classes/search_classes.php');
            require_once('../Classes/ipfs_classes.php');

            $search = new Search();
            $users = $search->getUsersBySearch($_GET['search']);
            $posts = $search->getPostsBySearch($_GET['search']);
        ?>
        <div class="search__results__users">
            <?php
                if (empty($users)) :
                ?>
            <h2>Nie znaleziono użytkowników</h2>
            <?php else : ?>
            <h2>Użytkownicy</h2>
            <?php
                    foreach ($users as $user) :
                        $CID = $user->getProfilePhotoCID();
                        $ipfs = new IPFS();
                        $gateway = $ipfs->getGateway();
                    ?>
            <article class="user">
                <a href="user.php?userid=<?php echo $user->getUserID(); ?>">
                    <img src="<?php echo $gateway . $CID; ?>" alt="User Image" class="profile__photo">
                    <span><?php echo $user->getUsername(); ?></span>
                </a>
            </article>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="search__results__posts">
            <?php
                if (empty($posts)) :
                ?>
            <h2>Nie znaleziono postów</h2>
            <?php else : ?>
            <h2>Posty</h2>
            <?php
                    foreach ($posts as $post) {
                        $user = new User($post->getUserID());
                        $profilePictureCID = $user->getProfilePhotoCIDById($post->getUserID());

                        include '../Views/post.php';
                    }
                    ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </section>
</main>

<script src="../src/js/searchResultsSwitch.js"></script>

<?php require 'footer.php' ?>