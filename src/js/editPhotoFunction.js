function editPhotoFunction(photoType) {
    var fileInput = document.getElementById('file');
    let preview = document.querySelector('.preview');
    let newImageInput = document.querySelector('form #croppedImage');

    if (fileInput.files.length > 0) {
        let file = fileInput.files[0];
        let reader = new FileReader();

        reader.onload = function (e) {
            let img = new Image();
            img.src = e.target.result;

            img.onload = function () {
                let originalWidth = img.width;
                let originalHeight = img.height;
                let newWidth, newHeight, imageRatio, cropWidthValue, cropHeightValue, targetSize, valueToCalcRatio;
                let canvas = document.createElement('canvas');
                let ctx = canvas.getContext('2d');

                targetSize = (photoType === "profile") ? 500 : 1080;
                valueToCalcRatio = (originalHeight < originalWidth) ? originalHeight : originalWidth;
                imageRatio = valueToCalcRatio / targetSize;

                if (imageRatio == 1 || (imageRatio < 1 && photoType === "post")) {
                    newWidth = originalWidth;
                    newHeight = originalHeight;
                }
                else {
                    newWidth = originalWidth / imageRatio;
                    newHeight = originalHeight / imageRatio;
                }

                if (photoType === "profile") canvas.width = canvas.height = targetSize;
                else {
                    canvas.width = newWidth;
                    canvas.height = newHeight;
                }

                cropWidthValue = cropHeightValue = 0;

                if (photoType === "profile" && imageRatio != 1) {
                    let cropValue = Math.abs(originalHeight - originalWidth) / 2;
                    if (originalHeight > originalWidth) cropHeightValue = cropValue;
                    if (originalWidth > originalHeight) cropWidthValue = cropValue;
                }

                ctx.clearRect(0, 0, newWidth, newHeight);
                ctx.drawImage(img, cropWidthValue, cropHeightValue, originalWidth, originalHeight, 0, 0, newWidth, newHeight);

                let croppedSrc = canvas.toDataURL();

                preview.innerHTML = '';
                preview.innerHTML += "<img src=" + croppedSrc + " alt='Selected Image'>";

                newImageInput.value = croppedSrc;
            };
        };

        reader.readAsDataURL(file);
    }
}