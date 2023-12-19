<?php require '../headerL.php' ?>

<main class="notLoggedIn">
    <section>
        <h1 style='color: black;'>App name</h1>
        <h2 style='color: black;'>App short description</h2>
    </section>
    <section>
        <h3>Sign in</h3>
        <form action="" method="post">
            <label for="login">Login</label>
            <input name="login" id="login" type="text" required="" placeholder="User123#!">
            <label for="password">Password</label>
            <input name="password" id="password" type="password" required="" placeholder="password">
            <!-- <button type="submit" name="submit">Login</button> -->
            <a href="index.php">Sign In</a>
        </form>
        <a href="#.php">
            Don`t have any account? Sign up!
            <i class="fa-solid fa-arrow-right"></i>
        </a>
        <a href="#.php">
            Reset your password
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </section>
</main>

<?php require '../footer.php' ?>