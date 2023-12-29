<?php require '../nav.php' ?>
<?php require '../userRecommendations.php' ?>

<main class="search">
    <form action="../Includes/search_includes.php" method="GET">
        <input type="search" placeholder="<?php echo (isset($_GET['search'])) ? $_GET['search'] : 'Szukaj...'; ?>" name="search_input">
        <button type="submit" name="search_button"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>

    <section class="search__results">
        <?php
        if (isset($_GET['search'])) :
            require_once('../Classes/search_classes.php');
            $users = Search::getUsersBySearch((string)$_GET['search']);
            if (!empty($users)) :
        ?>
                <div class="search__results__users">
                    <h2>Użytkownicy</h2>
                    <?php foreach ($users as $user) : ?>
                        <article class="user">
                            <a href="#.php">
                                <i class="fa-solid fa-user"></i>
                                <span><?php echo $user->getUsername(); ?></span>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="search__results__posts">
            <h2>Posty</h2>
            <?php for ($i = 0; $i < 10; $i++) : ?>
                <article class="post">
                    <a href="#.php">
                        <i class="fa-solid fa-user"></i>
                        <span>User Login</span>
                    </a>
                    <div class="img"></div>
                </article>
            <?php endfor; ?>
        </div>
    </section>
</main>

<?php require '../footer.php' ?>