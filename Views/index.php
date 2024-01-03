<?php require 'nav.php' ?>
<?php require 'userRecommendations.php' ?>

<main class="mainPage">
    <h2>Odkrywaj</h2>
    <section>
        <?php
        for ($i = 0; $i < 10; $i++) :
            include 'post.php';
        endfor;
        ?>
    </section>
</main>

<?php require 'footer.php' ?>