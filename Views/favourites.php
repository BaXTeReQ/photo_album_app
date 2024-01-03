<?php require 'nav.php' ?>

<?php if (!isset($_SESSION['username'])) header("location: ../Views/index.php"); ?>

<main class="favourites noUsers__panel">
    <h2>Twoje ulubione</h2>
    <section>
        <?php
        for ($i = 0; $i < 10; $i++) :
            include 'post.php';
        endfor;
        ?>
    </section>
</main>

<?php require 'footer.php' ?>