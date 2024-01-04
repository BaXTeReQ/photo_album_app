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
        let src = URL.createObjectURL(fileInput.files[0]);
        let alt = 'Selected Image';
        preview.innerHTML = '';
        preview.innerHTML += "<img src=" + src + " alt=" + alt + ">"
        photoSelectButton.style.display = 'block';
    }
})