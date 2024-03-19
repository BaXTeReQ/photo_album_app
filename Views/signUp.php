<?php require 'headerL.php';?>

<main class="notLoggedIn">
    <section>
        <h1>Album ze zdjęciami</h1>
    </section>
    <section>
        <h3>Zarejestruj się</h3>
        <form action="../Includes/signUp_includes.php" method="post">
            <label for="email">E-mail</label>
            <input name="email" id="email" type="email" required="" placeholder="email@example.com">

            <?php if (isset($_GET['emailTakenError'])): ?>
            <label class='red' for='email'>Adres e-mail jest już zajęty</label>
            <?php endif;?>

            <label for="login">Login</label>
            <input name="login" id="login" type="text" required="" placeholder="User123#!">

            <?php if (isset($_GET['usernameTakenError'])): ?>
            <label class='red' for='login'>Nazwa użytkownika jest już zajęta</label>
            <?php endif;?>

            <label for="password">Hasło</label>
            <input name="password" id="password" type="password" required="">

            <?php if (isset($_GET['invalidpasswordError'])): ?>
            <label class='red' for='password'>Hasło musi mieć co najmniej 8 znaków i zawierać wielkie litery, małe
                litery, cyfry i symbol</label>
            <?php endif;?>

            <label for="confirm_password">Potwierdź hasło</label>
            <input name="confirm_password" id="confirm_password" type="password" required="">

            <?php if (isset($_GET['password!matchError'])): ?>
            <label class='red' for='confirm_password'>Podane hasła nie są takie same</label>
            <?php endif;?>

            <button type="submit" name="register_submit">Zarejestruj</button>
        </form>
        <a href="signIn.php">
            Masz już konto? Zaloguj się!
            <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i>
        </a>
    </section>
</main>

<?php require 'footer.php';?>