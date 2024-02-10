<aside class="userRecommendations">
    <h2>Możesz ich znać</h2>
    <section>
        <ul>
            <?php
            require_once('../Classes/user_classes.php');
            require_once('../Classes/ipfs_classes.php');

            $users = (isset($_SESSION['userid'])) ? User::getRecommendedUsers($_SESSION['userid']) : User::getRecommendedUsers();
            foreach ($users as $user) :
                $CID = $user->getProfilePhotoCID();
                $ipfs = new IPFS();
                $gateway = $ipfs->getGateway();
            ?>
            <li>
                <a href="user.php?userid=<?php echo $user->getUserID(); ?>">
                    <img src="<?php echo $gateway . $CID; ?>" alt="User Image" class="profile__photo">
                    <?php echo (strlen($user->getUsername()) > 15) ? substr($user->getUsername(), 0, 12) . "..." : $user->getUsername(); ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
</aside>