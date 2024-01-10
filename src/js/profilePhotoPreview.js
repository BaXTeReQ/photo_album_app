let photoSelectInput = changeProfilePhotoForm.querySelector('#changeProfilePhotoForm input');
let photoSelectButton = changeProfilePhotoForm.querySelector('#changeProfilePhotoForm button');

photoSelectInput.addEventListener('change', () => {
    makePreview(500, "profile");
    photoSelectButton.style.display = 'block';
});