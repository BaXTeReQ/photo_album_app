<?php require '../nav.php' ?>

<main class="userSettings noUsers__panel">
    <h2>Witaj, User Name</h2>
    <div class="userSettings__img">
        <div class="img"></div>
        <button class="userSettings__img_button" type="button">
            <i class="fa-solid fa-pen"></i>
        </button>
    </div>
    <form class="userSettings__data" method="post" action="">
        <div class="row">
            <label>Username</label>
            <input type="text" value="" name="usernamechange">
            <label class="red" for="usernamechange"></label>
        </div>
        <div class="row">
            <label>Email</label>
            <input type="email" value="" name="emailchange">
            <label class="red" for="emailchange"></label>
        </div>
        <button type="button" class="password_change_button btn-primary">Change password</button>
        <button class="save_changes_button btn-primary" type="submit" name="submitall">Save changes</button>
    </form>
</main>



<?php require '../footer.php' ?>