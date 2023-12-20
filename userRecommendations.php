<aside class="userRecommendations">
    <section>
        <h2>App Name</h2>
        <ul>
            <?php for ($i = 0; $i < 5; $i++) : ?>
            <li><a href="#.php">Profile <?php echo $i + 1; ?> <i class="fa-solid fa-star"></i></a></li>
            <?php endfor; ?>
        </ul>
    </section>
</aside>