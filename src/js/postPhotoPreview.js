let photoSelectInput = document.querySelector('#file');
let photoSubmitButton = document.querySelector('#submitPhoto');

console.log(photoSelectInput);
console.log(photoSubmitButton);

photoSelectInput.addEventListener('change', () => {
    makePreview(1080, "post");
    photoSubmitButton.style.display = 'block';
});