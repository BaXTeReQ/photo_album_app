var changeProfilePictureButton = document.querySelector('#changeProfilePictureButton');
let overlay = document.querySelector('#overlay');
let changeProfilePhotoForm = document.querySelector('#changeProfilePhotoForm');
let photoSelectInput = document.querySelector('#changeProfilePhotoForm input');
let photoSelectButton = document.querySelector('#changeProfilePhotoForm button');

changeProfilePictureButton.addEventListener('click', () => {
    if (overlay.style.display === 'none' || overlay.style.display === '') {
        overlay.style.display = 'block';
        changeProfilePhotoForm.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
})

overlay.addEventListener('click', () => {
    if (overlay.style.display === 'block') {
        overlay.style.display = 'none';
        changeProfilePhotoForm.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
})

photoSelectInput.addEventListener('change', () => {
    var fileInput = document.getElementById('file');
    let preview = document.querySelector('.preview');

    if (fileInput.files.length > 0) {
        let file = fileInput.files[0];
        let reader = new FileReader();

        reader.onload = function (e) {
            let img = new Image();
            img.src = e.target.result;

            img.onload = function () {
                let targetSize = 500;
                let originalWidth = img.width;
                let originalHeight = img.height;
                let newWidth, newHeight, resizeRatioHeight, resizeRatioWidth;

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

                let cropValue = Math.abs(originalHeight - originalWidth) / 2;

                console.log(cropValue);

                // Create a canvas element
                let canvas = document.createElement('canvas');
                canvas.width = targetSize;
                canvas.height = targetSize;
                let ctx = canvas.getContext('2d');

                if (originalHeight < originalWidth) {
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

                // Optionally, you can set the display style for the button
                photoSelectButton.style.display = 'block';
            };
        };

        reader.readAsDataURL(file);
    }
});