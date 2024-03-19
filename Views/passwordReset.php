<?php require 'headerL.php';?>

<main class="notLoggedIn">
    <section>
        <h1>Album ze zdjęciami</h1>
    </section>
    <section>
        <h3>Zresetuj swoje hasło</h3>
        <form action="../Includes/passwordReset_includes.php" method="post">
            <?php if (!isset($_GET['username'])): ?>
            <label for="login">Login</label>
            <input name="login" id="login" type="text" required placeholder="User123!">
            <label for="email">E-mail</label>
            <input name="email" id="email" type="email" required placeholder="email@example.com">
            <?php if (isset($_GET['error'])): ?>
            <label class='red' for='password'>Nieprawidłowy użytkownik</label>
            <?php endif;?>
            <button type="submit" name="reset-submit">Reset</button>
            <?php else: ?>
            <input type="hidden" name="login" value="<?php echo $_GET['username']; ?>">
            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
            <label for="password">Password</label>
            <input name="password" id="password" type="password" required="">
            <?php if (isset($_GET['invalidpasswordError'])): ?>
            <label class='red' for='password'>Hasło musi mieć co najmniej 8 znaków i zawierać wielkie litery, małe
                litery, cyfry i symbol</label>
            <?php endif;?>
            <button type="submit" name="reset-submit2">Reset</button>
            <?php endif;?>
        </form>
    </section>
</main>

<?php require 'footer.php';?>