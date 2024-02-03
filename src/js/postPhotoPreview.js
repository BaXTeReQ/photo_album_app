let photoSelectInput = document.querySelector('#file');
let photoSubmitButton = document.querySelector('#submitPhoto');

photoSelectInput.addEventListener('change', () => {
    editPhotoFunction("post");
    photoSubmitButton.style.display = 'block';
});