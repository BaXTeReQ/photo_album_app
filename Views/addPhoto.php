<?php require 'nav.php' ?>

<?php if (!isset($_SESSION['username'])) header("location: ../Views/index.php"); ?>

<main class="addPhoto noUsers__panel">
    <h2>Dodaj zdjęcie</h2>
    <section>
        <form action="" class="fileUpload">
            <input type="file" name="file" id="file" accept=".jpeg, .jpg, .png, image/jpeg, image/png">
            <label for="file"><i class="fa-solid fa-file-image"></i> Wybierz zdjęcie</label>
        </form>
    </section>
</main>

<?php require 'footer.php' ?>