<?php require '../nav.php' ?>
<?php require '../userRecommendations.php' ?>

<main class="mainPage">
    <h2>Odkrywaj</h2>
    <section>
        <?php for ($i = 0; $i < 10; $i++) : ?>
        <article class="post">
            <a href="#.php">
                <i class="fa-solid fa-user"></i>
                <span>User Login</span>
            </a>
            <div class="img"></div>
        </article>
        <?php endfor; ?>
    </section>
</main>

<?php require '../footer.php' ?>