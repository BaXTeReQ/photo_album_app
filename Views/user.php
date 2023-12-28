<?php require '../nav.php' ?>

<?php if (!isset($_SESSION['username'])) header("location: ../Views/index.php"); ?>

<main class="user noUsers__panel">
    <h2>Witaj, <?php echo $_SESSION['username']; ?></h2>
    <div class="user__img">
        <div class="img"></div>
        <button class="user__img_button" type="button">
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

<?php require '../footer.php' ?>