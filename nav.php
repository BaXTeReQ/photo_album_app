<?php require '../header.php' ?>

<?php session_start(); ?>

<aside class="navigation">
    <h2>App Name</h2>
    <nav>
        <ul>
            <li><a href="index.php"><i class="fa-solid fa-house"></i><span>Strona główna</span></a></li>
            <li><a href="search.php"><i class="fa-solid fa-magnifying-glass"></i><span>Szukaj</span></a></li>
            <?php if (isset($_SESSION['username'])) : ?>
                <li><a href="favourites.php"><i class="fa-regular fa-heart"></i><span>Polubione</span></a></li>
                <li><a href="addPhoto.php"><i class="fa-solid fa-plus"></i><span>Dodaj</span></a></li>
                <li><a href="user.php"><i class="fa-solid fa-user"></i><span>Profil</span></a></li>
            <?php else : ?>
                <li><a href="signIn.php"><i class="fa-solid fa-user"></i><span>Profil</span></a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['username'])) : ?>
                <li class="last"><a href="../Includes/signOut_includes.php"><i class="fa-solid fa-right-from-bracket"></i>
                        <span>Wyloguj
                            się</span></a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</aside>