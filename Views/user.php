<?php require 'nav.php' ?>

<?php if (!isset($_SESSION['username']) && !isset($_GET['userid'])) header("location: ../Views/index.php"); ?>

<?php require_once '../Classes/user_classes.php'; ?>
<?php if (!isset($_GET['userid'])) :
    $profilePhotoPath = User::getProfilePictureCID($_SESSION['userid']);
?>
    <main class="user noUsers__panel">
        <h2>Witaj, <?php echo $_SESSION['username']; ?></h2>
        <div class="user__img">
            <img src="<?php echo $profilePhotoPath; ?>" alt="User Image" class="profile__photo">
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
    <form action="../Includes/user_includes.php" method="post" id="changeProfilePhotoForm" class="fileUpload" enctype="multipart/form-data">
        <h3>Zmień zdjęcie profilowe</h3>
        <input type="file" name="file" id="file" accept=".jpeg, .jpg, .png, image/jpeg, image/png">
        <label for="file"><i class="fa-solid fa-file-image"></i> Wybierz zdjęcie</label>
        <div class="preview profile__photo"></div>
        <button type="submit" class="btn-primary" name="changeProfilePhotoFormButton">Zapisz</button>
    </form>
    <script src="../src/js/profilePhotoUpdate.js"></script>
<?php else : ?>
    <?php
    $username = User::getUsernameById($_GET['userid']);
    $profilePhotoPath = User::getProfilePictureCID($_GET['userid']);
    ?>
    <main class="user noUsers__panel user-otherUser">
        <h2><?php echo $username; ?></h2>
        <div class="user__img">
            <img src="<?php echo $profilePhotoPath; ?>" alt="User Image" class="profile__photo">
        </div>
        <h3>Posty</h3>
        <section>
            <?php
            for ($i = 0; $i < 10; $i++) :
                include 'post.php';
            endfor;
            ?>
        </section>
    </main>
<?php endif; ?>

<?php require 'footer.php' ?>