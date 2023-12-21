<aside class="userRecommendations">
    <h2>Możesz ich znać</h2>
    <section>
        <ul>
            <?php for ($i = 0; $i < 5; $i++) : ?>
            <li><a href="#.php"><i class="fa-solid fa-star"></i> Profile <?php echo $i + 1; ?></a></li>
            <?php endfor; ?>
        </ul>
    </section>
</aside>