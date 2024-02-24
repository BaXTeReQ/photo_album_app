<?php require 'nav.php' ?>

<?php if (!isset($_SESSION['username']) && !isset($_GET['userid'])) header("location: ../Views/index.php"); ?>

<?php
require_once '../Classes/user_classes.php';
require_once '../Classes/ipfs_classes.php';

if (!isset($_GET['userid'])) :
    $user = new User($_SESSION['userid'], $_SESSION['username'], $_SESSION['email']);
    $CID = $user->getProfilePhotoCIDByID($_SESSION['userid']);
    $ipfs = new IPFS();
    $gateway = $ipfs->getGateway();
?>
<main class="user noUsers__panel">
    <h2>Witaj, <?php echo $_SESSION['username']; ?></h2>
    <div class="user__img">
        <img src="<?php echo $gateway . $CID; ?>" alt="User Image" class="profile__photo">
        <button class="user__img_button" type="button" id="changeProfilePictureButton">
            <i class="fa-solid fa-pen"></i>
        </button>
    </div>
    <form class="user__data" method="post" action="../Includes/user_includes.php">
        <div class="row">
            <label>Username</label>
            <input type="text" value="<?php echo $_SESSION['username']; ?>" name="usernamechange">
            <label class="red" for="usernamechange"></label>
        </div>
        <div class="row">
            <label>Email</label>
            <input type="email" value="<?php echo $_SESSION['email']; ?>" name="emailchange">
            <label class="red" for="emailchange"></label>
        </div>
        <!-- <button type="button" class="password_change_button btn-primary">Change password</button> -->
        <button class="save_changes_button btn-primary" type="submit" name="submitall">Save changes</button>
    </form>
</main>
<div id="overlay"></div>
<form action="../Includes/user_includes.php" method="post" id="changeProfilePhotoForm" class="fileUpload"
    enctype="multipart/form-data">
    <h3>Zmień zdjęcie profilowe</h3>
    <input type="file" name="file" id="file" accept=".jpeg, .jpg, .png, image/jpeg, image/png">
    <label for="file"><i class="fa-solid fa-file-image"></i> Wybierz zdjęcie</label>
    <div class="preview profile__photo"></div>
    <button type="submit" class="btn-primary" name="changeProfilePhotoFormButton">Zapisz</button>
    <input type="hidden" name="croppedImage" id="croppedImage">
</form>
<?php else : ?>
<?php
    $userID = $_GET['userid'];
    $user = new User($userID);
    $username = $user->getUsernameById($userID);
    $CID = $user->getProfilePhotoCIDByID($userID);
    $ipfs = new IPFS();
    $gateway = $ipfs->getGateway();
    ?>
<main class="user noUsers__panel user-otherUser">
    <h2><?php echo $username; ?></h2>
    <div class="user__img">
        <img src="<?php echo $gateway . $CID; ?>" alt="User Image" class="profile__photo">
    </div>
    <h3>Posty</h3>
    <section>
        <?php
            require_once('../Classes/post_classes.php');

            $posts = Post::getUserPosts($userID);
            $ipfs = new IPFS();
            $gateway = $ipfs->getGateway();

            foreach ($posts as $post) {
                $user = new User($post->getUserID());
                $profilePictureCID = $user->getProfilePhotoCIDById($post->getUserID());

                include '../Views/post.php';
            }
            ?>
    </section>
</main>
<?php endif; ?>

<script src="../src/js/profilePhotoForm.js"></script>
<script src="../src/js/editPhotoFunction.js"></script>
<script src="../src/js/profilePhotoPreview.js"></script>

<?php require 'footer.php' ?>