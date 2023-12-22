<?php require '../nav.php' ?>
<?php require '../userRecommendations.php' ?>

<main class="search">
    <form action="" method="GET">
        <input type="search" placeholder="Szukaj..." name="searchresults">
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>

    <section class="search__results">
        <div class="search__results__users">
            <h2>Użytkownicy</h2>
            <?php for ($i = 0; $i < 5; $i++) : ?>
            <article class="user">
                <a href="#.php">
                    <i class="fa-solid fa-user"></i>
                    <span>User Login</span>
                </a>
            </article>
            <?php endfor; ?>
        </div>
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