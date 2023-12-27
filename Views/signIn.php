<?php require '../headerL.php' ?>

<main class="notLoggedIn">
    <section>
        <h1>App name</h1>
        <h2>App short description</h2>
    </section>
    <section>
        <?php if(isset($_GET['error'])): ?>
        <div id="fail">
            <p>Invalid login or password</p>
        </div>
        <?php endif; ?>

        <h3>Sign in</h3>
        <form action="../Includes/signIn_includes.php" method="post">
            <label for="login">Login</label>
            <input name="login" id="login" type="text" required="" placeholder="User123#!">
            <label for="password">Password</label>
            <input name="password" id="password" type="password" required="" placeholder="password">
            <button type="submit" name="submit">Login</button>
        </form>
        <a href="signUp.php">
            Don`t have any account? Sign up!
            <i class="fa-solid fa-arrow-right"></i>
        </a>
        <a href="passwordReset.php">
            Reset your password
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </section>
</main>

<?php require '../footer.php' ?>