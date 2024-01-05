<aside class="userRecommendations">
    <h2>Możesz ich znać</h2>
    <section>
        <ul>
            <?php
            require_once('../Classes/user_classes.php');
            require_once('../Classes/ipfs_classes.php');

            $users = (isset($_SESSION['userid'])) ? User::getRecommendedUsers($_SESSION['userid']) : User::getRecommendedUsers();
            foreach ($users as $user) :
                $CID = User::getProfilePictureCID($user->getUserID());
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