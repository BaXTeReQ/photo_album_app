<?php require 'headerL.php';?>

<main class="notLoggedIn">
    <section>
        <h1>Album ze zdjęciami</h1>
    </section>
    <section>
        <?php if (isset($_GET['error'])): ?>
        <div id="fail">
            <p>Nieprawidłowy login lub hasło</p>
        </div>
        <?php endif;?>

        <h3>Zaloguj się</h3>
        <form action="../Includes/signIn_includes.php" method="post">
            <label for="login">Login</label>
            <input name="login" id="login" type="text" required="" placeholder="User123#!">
            <label for="password">Hasło</label>
            <input name="password" id="password" type="password" required="" placeholder="password">
            <button type="submit" name="submit">Login</button>
        </form>
        <a href="signUp.php">
            Nie masz konta? Zarejestruj się!
            <i class="fa-solid fa-arrow-right"></i>
        </a>
        <a href="passwordReset.php">
            Zresetuj swoje hasło
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </section>
</main>

<?php require 'footer.php';?>