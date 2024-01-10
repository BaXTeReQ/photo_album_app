let changeProfilePhotoForm = document.querySelector('#changeProfilePhotoForm');
var changeProfilePictureButton = document.querySelector('#changeProfilePictureButton');
let overlay = document.querySelector('#overlay');

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