<?php require '../headerL.php' ?>

<main class="notLoggedIn">
    <section>
        <h1>App name</h1>
        <h2>App short description</h2>
    </section>
    <section>
        <h3>Sign up</h3>
        <form action="" method="post">
            <label for="email">E-mail</label>
            <input name="email" id="email" type="email" required="" placeholder="email@example.com">
            <label class="red" for="email"></label>

            <label for="login">Login</label>
            <input name="login" id="login" type="text" required="" placeholder="User123#!">
            <label class="red" for="login"></label>

            <label for="password">Password</label>
            <input name="password" id="password" type="password" required="">
            <label class="red" for="password"></label>

            <label for="confirm_password">Confirm Password</label>
            <input name="confirm_password" id="confirm_password" type="password" required="">
            <label class="red" for="confirm_password"></label>

            <button type="submit" name="submit">Register</button>
        </form>
        <a href="signIn.php">
            Already have an account? Log in!
            <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i>
        </a>
    </section>
</main>

<?php require '../footer.php' ?>