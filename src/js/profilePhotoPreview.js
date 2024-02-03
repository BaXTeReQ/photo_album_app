let photoSelectInput = changeProfilePhotoForm.querySelector('#changeProfilePhotoForm input');
let photoSelectButton = changeProfilePhotoForm.querySelector('#changeProfilePhotoForm button');

photoSelectInput.addEventListener('change', () => {
    editPhotoFunction("profile");
    photoSelectButton.style.display = 'block';
});