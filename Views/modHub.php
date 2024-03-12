<?php require 'nav.php';?>

<?php if (!isset($_SESSION) || $_SESSION['role'] == 3) {
    header("location: ../Views/");
}
?>

<main class="modHub noUsers__panel">
    <section class="search-form">
        <form action="../Includes/search_includes.php" method="GET">
            <input type="search" placeholder="<?php echo (isset($_GET['search'])) ? $_GET['search'] : 'Szukaj...'; ?>"
                name="search_input">
            <button type="submit" name="search_button-mod"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </section>

    <div class="switch-buttons buttons">
        <button type="button" class="buttons__users active">Użytkownicy</button>
        <button type="button" class="buttons__posts">Posty</button>
    </div>

    <?php
if (isset($_GET['search'])):
    require_once '../Classes/search_classes.php';
    require_once '../Classes/ipfs_classes.php';

    $search = new Search();
    $users = $search->getUsersBySearch($_GET['search']);
    $posts = $search->getPostsBySearch($_GET['search']);
    $ipfs = new IPFS();
    $gateway = $ipfs->getGateway();
    ?>
    <section class="modHub__users search__results__users">
        <?php
    if (empty($users)):
    ?>
        <h2>Nie znaleziono użytkowników</h2>
        <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php
foreach ($users as $user):

?>
                <tr>
                    <td><?php echo $user->getUserID(); ?></td>
                    <td><?php echo $user->getUsername(); ?></td>
                    <td class="btn-container">
                        <a href="modHub-edit.php?userid=<?php echo $user->getUserID(); ?>"
                            class="btn-primary">Edytuj</a>
                        <?php if ($_SESSION['role'] == 1): ?>
                        <a href="modHub-delete.php?userid=<?php echo $user->getUserID(); ?>" class="btn-primary
                            btn-red">Usuń</a>
                        <?php endif;?>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <?php endif;?>
    </section>
    <section class="modHub__posts search__results__posts">
        <?php if (empty($posts)): ?>
        <h2>Nie znaleziono postów</h2>
        <?php else: ?>
        <?php foreach ($posts as $post):
    $ipfs = new IPFS();
    $gateway = $ipfs->getGateway();
    $user = new User($post->getUserID());
    $profilePictureCID = $user->getProfilePhotoCIDById($post->getUserID());

    include '../Views/post.php';
endforeach;
endif;
?>
    </section>
    <?php endif;?>
</main>

<script src="../src/js/searchResultsSwitch.js"></script>

<?php require 'footer.php';?>