var changeProfilePictureButton = document.querySelector('#changeProfilePictureButton');
let overlay = document.querySelector('#overlay');
let changeProfilePhotoForm = document.querySelector('#changeProfilePhotoForm');

let photoSelectLabel = document.querySelector('#changeProfilePhotoForm label');

console.log(photoSelectLabel);

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

function handleFileSelect() {
    var fileInput = document.getElementById('file');
    let preview = document.querySelector('.preview');
    // var preview = document.getElementsByClassName('preview');

    // Check if files are selected
    if (fileInput.files.length > 0) {
        // Access the selected file(s)
        var selectedFile = fileInput.files[0];
        var imgElement = document.createElement('img');

        // Set the src attribute to the selected image
        imgElement.src = URL.createObjectURL(fileInput.files[0]);
        imgElement.alt = 'Selected Image';

        preview.innerHTML = '';
        preview.appendChild(imgElement);

        // Display information about the selected file
        console.log('File name:', selectedFile.name);
        console.log('File size:', selectedFile.size, 'bytes');
        console.log('File type:', selectedFile.type);
        console.log(preview);
    } else {
        console.log('No file selected');
    }
}

photoSelectLabel.addEventListener('onchange', () => {
    let preview = document.querySelector('.preview');
    let input = document.querySelector('#file');
    preview.innerHTML = '';
    console.log("doopa");
    console.log(preview.style.width);
    console.log(input.style.opacity);

    // Check if a file is selected
    if (input.files.length > 0) {
        console.log("doopa");
        var reader = new FileReader();

        reader.onload = function (e) {
            var img = document.createElement('img');
            img.src = e.target.result;
            img.alt = 'Preview';

            // Append the image to the preview div
            imagePreviewDiv.appendChild(img);
        };

        // Read the image file as a data URL
        reader.readAsDataURL(input.files[0]);
    } else {
        console.log("No file selected");
    }
});