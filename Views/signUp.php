<?php require '../headerL.php' ?>

<main class="notLoggedIn">
    <section>
        <h1>App name</h1>
        <h2>App short description</h2>
    </section>
    <section>
        <h3>Sign up</h3>
        <form action="../Includes/signUp_includes.php" method="post">
            <label for="email">E-mail</label>
            <input name="email" id="email" type="email" required="" placeholder="email@example.com">

            <?php 
                if (isset($_GET['emailTakenError'])) {
                    echo "<label class='red' for='email'>";
                    echo "E-mail already taken"; 
                    echo "</label>";
                }
            ?>

            <label for="login">Login</label>
            <input name="login" id="login" type="text" required="" placeholder="User123#!">

            <?php 
                if (isset($_GET['usernameTakenError'])) {
                echo "<label class='red' for='login'>";
                echo "Login already taken"; 
                echo "</label>";
                }
            ?>

            <label for="password">Password</label>
            <input name="password" id="password" type="password" required="">

            <?php 
                if (isset($_GET['invalidpasswordError'])) {
                    echo "<label class='red' for='password'>";
                    echo "Password must be minimum 8 characters long and have uppercase letters, lowercase letters, numbers and symbols"; 
                    echo "</label>";
                }
            ?>

            <label for="confirm_password">Confirm Password</label>
            <input name="confirm_password" id="confirm_password" type="password" required="">

            <?php 
                if (isset($_GET['password!matchError'])) {
                    echo "<label class='red' for='confirm_password'>";
                    echo "Passwords don`t match";                  
                    echo "</label>";
                }
            ?>

            <button type="submit" name="register_submit">Register</button>
        </form>
        <a href="signIn.php">
            Already have an account? Log in!
            <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i>
        </a>
    </section>
</main>

<?php require '../footer.php' ?>