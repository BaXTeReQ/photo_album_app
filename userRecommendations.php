<aside class="userRecommendations">
    <h2>Możesz ich znać</h2>
    <section>
        <ul>
            <?php
            require_once '../Classes/user_classes.php';
            $users = User::getRecommendedUsers(5);

            foreach ($users as $user) :
            ?>
                <li><a href="#.php"><i class="fa-solid fa-user"></i><?php echo $user->getUsername(); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </section>
</aside>