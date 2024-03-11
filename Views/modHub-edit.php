<?php require 'nav.php';?>

<?php if (!isset($_SESSION) || $_SESSION['role'] == 3) {
    header("location: ../Views/");
}
?>

<?php
require_once '../Classes/ipfs_classes.php';
require_once '../Classes/post_classes.php';
require_once '../Classes/user_classes.php';
$ipfs = new IPFS();
$gateway = $ipfs->getGateway();

if (isset($_GET['postid'])):
    $post = Post::getPostByID($_GET['postid']);
    ?>
<main class="modHub modHub__edit noUsers__panel">
    <section>
        <form action="../Includes/modHub_includes.php" class="fileUpload" method="POST">
            <input type="hidden" name="id" value="<?php echo $post->getID(); ?>">
            <div class="img preview">
                <img src="<?php echo $gateway . $post->getCID(); ?>" alt="<?php echo $post->getDescription(); ?>"
                    loading="lazy">
            </div>
            <textarea name="desc" id="desc" cols="30" rows="10"><?php echo $post->getDescription(); ?></textarea>
            <button type="submit" name="submitChanges__post" id="submitChanges" class="btn-primary">Zapisz</button>
            <a href="../Views/modHub.php" class="btn-primary">Powrót</a>
        </form>
    </section>
</main>

<?php
else:
    $user = User::getUserDataByID($_GET['userid']);
    $userPassword = User::getUserPasswordByID($_GET['userid']);
    ?>

<main class="user noUsers__panel">
    <div class="user__img">
        <img src="<?php echo $gateway . $user->getProfilePhotoCID(); ?>" alt="User Image" class="profile__photo"
            loading="lazy">
    </div>
    <form class="user__data" method="post" action="../Includes/modHub_includes.php">
        <input type="hidden" value="<?php echo $user->getUserID(); ?>" name="id">
        <div class="row">
            <label>Username</label>
            <input type="text" value="<?php echo $user->getUsername(); ?>" name="username">
        </div>
        <div class="row">
            <label>Email</label>
            <input type="text" value="<?php echo $user->getEmail(); ?>" name="email">
        </div>
        <div class="row">
            <label>Password</label>
            <input type="text" value="<?php echo $userPassword; ?>" name="password">
        </div>
        <button class="save_changes_button btn-primary" type="submit" name="submitChanges__user">Save changes</button>
    </form>
</main>

<?php endif;?>

<?php require 'footer.php';?>