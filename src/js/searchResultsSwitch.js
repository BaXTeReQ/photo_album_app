let usersButton = document.querySelector('.buttons .buttons__users');
let postsButton = document.querySelector('.buttons .buttons__posts');
let usersResults = document.querySelector('.search__results__users');
let postsResults = document.querySelector('.search__results__posts');

let buttons = [usersButton, postsButton];

buttons.forEach(button => {
    button.addEventListener('click', (event) => {
        const clickedButton = event.target;

        if (clickedButton === usersButton) {
            usersButton.classList.add('active');
            postsButton.classList.remove('active');
            usersResults.style.display = 'block';
            postsResults.style.display = 'none';
        } else {
            postsButton.classList.add('active');
            usersButton.classList.remove('active');
            postsResults.style.display = 'block';
            usersResults.style.display = 'none';
        }
    });
});