$(document).ready(function () {
    $(".like--button").on("click", function () {
        var button = $(this);
        var post_ID = $(this).data("post-id");
        var post_liked = $(this).data("post-liked");
        var icon = $(this).find('i');
        var counter = $('#likeCounter-' + post_ID);

        console.log(post_ID);

        $.ajax({
            type: "POST",
            url: "../Includes/like_includes.php",
            data: {
                post_ID: post_ID,
                post_liked: post_liked
            },
            success: function (response) {
                var postLikedNewValue = (post_liked) ? 0 : 1;
                button.attr("data-post-liked", postLikedNewValue);
                button.data("post-liked", postLikedNewValue);

                icon.toggleClass('fa-solid fa-heart');
                icon.toggleClass('fa-regular fa-heart');

                counter.text(response.likeCount);
            },
            dataType: 'json',
        });
    });
});
