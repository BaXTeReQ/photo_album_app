let photoSelectInput = document.querySelector('#file');
let photoSubmitButton = document.querySelector('#submitPhoto');
let photoDescription = document.querySelector('#desc');

photoSelectInput.addEventListener('change', () => {
    editPhotoFunction("post");
});

photoDescription.addEventListener('input', () => {
    if (photoSelectInput.files.length > 0) {
        if (photoDescription.value !== '') {
            photoSubmitButton.disabled = false;
        } else {
            photoSubmitButton.disabled = true;
        }
    }
});