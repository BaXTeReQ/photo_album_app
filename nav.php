<?php require '../header.php' ?>

<aside class="navigation">
    <nav>
        <h2>App Name</h2>
        <ul>
            <?php for ($i = 0; $i < 5; $i++) : ?>
            <li><a href="#.php">Menu Item <?php echo $i + 1; ?> <i class="fa-solid fa-star"></i></a></li>
            <?php endfor; ?>
        </ul>
    </nav>
</aside>