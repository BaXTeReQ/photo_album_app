$(document).ready(function () {
    $(".like--button").on("click", function () {
        var button = $(this);
        var photo_id = $(this).data("photo-id");
        var user_id = $(this).data("user-id");
        var photo_liked = $(this).data("photo-liked");
        var icon = $(this).find('i');

        // Send AJAX request to your PHP script
        $.ajax({
            type: "POST",
            url: "../Includes/like_includes.php",
            data: {
                user_id: user_id,
                photo_id: photo_id,
                photo_liked: photo_liked
            },
            success: function (response) {
                var photoLikedNewValue = (photo_liked) ? 0 : 1;
                button.attr("data-photo-liked", photoLikedNewValue);
                button.data("photo-liked", photoLikedNewValue);

                icon.toggleClass('fa-solid fa-heart');
                icon.toggleClass('fa-regular fa-heart');
            },
        });
    });
});