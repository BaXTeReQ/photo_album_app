$(document).ready(function () {
    $(".like--button").on("click", function () {
        var photo_id = $(this).data("photo-id");
        var user_id = $(this).data("user-id");
        var icon = $(this).find('i');

        // Send AJAX request to your PHP script
        $.ajax({
            type: "POST",
            url: "../Includes/like_includes.php",
            data: {
                user_id: user_id,
                photo_id: photo_id
            },
            success: function (response) {
                icon.toggleClass('fa-solid fa-heart');
                icon.toggleClass('fa-regular fa-heart');
            }
        });
    });
});