<aside class="userRecommendations">
    <h2>Możesz ich znać</h2>
    <section>
        <ul>
            <?php
            include('../Classes/user_classes.php');
            include('../Classes/ipfs_classes.php');

            $user = new User();
            $users = (isset($_SESSION['userid'])) ? $user->getRecommendedUsers($_SESSION['userid']) : $user->getRecommendedUsers();
            foreach ($users as $user) :
                $CID = $user->getProfilePictureCID($user->getUserID());
                $ipfs = new IPFS();
                $gateway = $ipfs->getGateway();
            ?>
                <li>
                    <a href="user.php?userid=<?php echo $user->getUserID(); ?>">
                        <img src="<?php echo $gateway . $CID; ?>" alt="User Image" class="profile__photo"><?php echo $user->getUsername(); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</aside>