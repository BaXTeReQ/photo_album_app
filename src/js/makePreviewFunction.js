function makePreview(targetSize, photoType = "profile") {
    var fileInput = document.getElementById('file');
    let preview = document.querySelector('.preview');
    let newImageInput = document.querySelector('form #croppedImage');

    console.log(newImageInput);

    if (fileInput.files.length > 0) {
        let file = fileInput.files[0];
        let reader = new FileReader();

        reader.onload = function (e) {
            let img = new Image();
            img.src = e.target.result;

            img.onload = function () {
                let originalWidth = img.width;
                let originalHeight = img.height;
                let newWidth, newHeight, resizeRatioHeight, resizeRatioWidth, cropValue;
                let canvas = document.createElement('canvas');
                let ctx = canvas.getContext('2d');

                if (photoType === "profile") {
                    if (originalHeight < originalWidth) {
                        resizeRatioHeight = originalHeight / targetSize;
                        newHeight = targetSize;
                        newWidth = originalWidth / resizeRatioHeight;
                    } else if (originalHeight > originalWidth) {
                        resizeRatioWidth = originalWidth / targetSize;
                        newWidth = targetSize;
                        newHeight = originalHeight / resizeRatioWidth;
                    } else {
                        newWidth = targetSize;
                        newHeight = targetSize;
                    }

                    canvas.width = targetSize;
                    canvas.height = targetSize;
                    cropValue = Math.abs(originalHeight - originalWidth) / 2;
                } else {
                    console.log("doopa");
                    if (originalHeight < originalWidth) {
                        resizeRatioHeight = originalHeight / targetSize;
                        newHeight = targetSize;
                        newWidth = originalWidth / resizeRatioHeight;
                    } else if (originalHeight > originalWidth) {
                        resizeRatioWidth = originalWidth / targetSize;
                        newWidth = targetSize;
                        newHeight = originalHeight / resizeRatioWidth;
                    } else {
                        newWidth = targetSize;
                        newHeight = targetSize;
                    }

                    canvas.width = newWidth;
                    canvas.height = newHeight;
                    cropValue = 0;
                }
                // Create a canvas element

                if (originalHeight < originalWidth) {
                    console.log("dupa");
                    ctx.clearRect(0, 0, newWidth, targetSize);
                    ctx.drawImage(img, cropValue, 0, originalWidth, originalHeight, 0, 0, newWidth, targetSize);
                }
                else if (originalHeight > originalWidth) {
                    ctx.clearRect(0, 0, targetSize, newHeight);
                    ctx.drawImage(img, 0, cropValue, originalWidth, originalHeight, 0, 0, targetSize, newHeight);
                }
                else {
                    ctx.clearRect(0, 0, targetSize, targetSize);
                    ctx.drawImage(img, 0, 0, originalWidth, originalHeight, 0, 0, targetSize, targetSize);
                }

                let croppedSrc = canvas.toDataURL();

                // Update the preview with the cropped image
                preview.innerHTML = '';
                preview.innerHTML += "<img src=" + croppedSrc + " alt='Selected Image'>";

                newImageInput.value = croppedSrc;

                // Optionally, you can set the display style for the button
            };
        };

        reader.readAsDataURL(file);
    }
}