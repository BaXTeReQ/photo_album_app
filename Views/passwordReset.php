<?php require '../headerL.php' ?>

<main class="notLoggedIn">
    <section>
        <h1 style='color: black;'>App name</h1>
        <h2 style='color: black;'>App short description</h2>
    </section>
    <section>

        <h3>Reset your password</h3>
        <form action="../Includes/reset_request_includes.php" method="post">


            <label for="email">E-mail</label>
            <input name="email" id="email" type="email" required="" placeholder="email@example.com">

            <label class="green" for="email"></label>

            <button type="submit" name="reset-submit">Reset</button>

        </form>
    </section>
</main>

<?php require '../footer.php' ?>