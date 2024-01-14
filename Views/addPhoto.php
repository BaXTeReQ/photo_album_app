<?php require 'nav.php' ?>

<?php if (!isset($_SESSION['username'])) header("location: ../Views/index.php"); ?>

<main class="addPhoto noUsers__panel">
    <h2>Dodaj zdjęcie</h2>
    <section>
        <form action="../Includes/addPhoto_includes.php" class="fileUpload" method="POST" enctype="multipart/form-data">
            <input type="file" name="file" id="file" accept=".jpeg, .jpg, .png, image/jpeg, image/png">
            <label for="file"><i class="fa-solid fa-file-image"></i> Wybierz zdjęcie</label>
            <div class="preview"></div>
            <textarea name="desc" id="" cols="30" rows="10" placeholder="Twój opis zdjęcia..."></textarea>
            <button type="submit" name="submitPhoto" id="submitPhoto" class="btn-primary">Dodaj zdjęcie</button>
        </form>
    </section>
</main>

<script src="../src/js/makePreviewFunction.js"></script>
<script src="../src/js/postPhotoPreview.js"></script>

<?php require 'footer.php' ?>