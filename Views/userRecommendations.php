<aside class="userRecommendations">
    <h2>Możesz ich znać</h2>
    <section>
        <ul>
            <?php
            require_once '../Classes/user_classes.php';
            if (isset($_SESSION['userid'])) $users = User::getRecommendedUsers($_SESSION['userid']);
            else $users = User::getRecommendedUsers();

            foreach ($users as $user) :
            ?>
                <li>
                    <a href="/user.php?userid=<?php echo $user->getUserID(); ?>">
                        <img src="../pictures/default_user_profile.png" alt="User Image" class="profile__photo"><?php echo $user->getUsername(); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</aside>