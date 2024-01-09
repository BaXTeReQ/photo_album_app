$(document).ready(function () {
    $(".like--button").on("click", function () {
        var photo_id = $(this).data("photo-id");
        var user_id = $(this).data("user-id");

        // Send AJAX request to your PHP script
        $.ajax({
            type: "POST",
            url: "../Includes/like_includes.php", // Update with your PHP script path
            data: {
                user_id: user_id,
                photo_id: photo_id
            },
            success: function (response) {
                // console.log("Wpisano"); // Log the server response (for debugging)
            }
        });
    });
});