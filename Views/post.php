<?php
require_once('../Classes/post_classes.php');
require_once('../Classes/ipfs_classes.php');
?>

<?php
$posts = Post::getPosts();
$ipfs = new IPFS();
$gateway = $ipfs->getGateway();

foreach ($posts as $post) :
?>

<article class="post">
    <a href="user.php?userid=<?php echo $post->getUserID(); ?>">
        <img src="<?php echo User::getProfilePictureCID($userID); ?>" alt="User Image" class="profile__photo">
        <span><?php echo $post->getUsername(); ?></span>
    </a>
    <div class="img">
        <img src="<?php echo $gateway . $CID; ?>" alt="<?php echo $post->getDescription(); ?>">
    </div>
    <button type="button" class="like--button" data-user-id="<?php echo $post->getUserID(); ?>" data-photo-id="1">
        <i class="fa-regular fa-heart"></i>
    </button>
    <p><?php echo $post->getDescription(); ?></p>
</article>

<?php endforeach; ?>