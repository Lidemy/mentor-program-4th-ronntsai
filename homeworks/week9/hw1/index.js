const error = document.querySelector('.error');
const nameText = document.querySelector('.nametext');
const commentText = document.querySelector('.commenttext');
const submitBtn = document.querySelector('.comment__submit');

submitBtn.addEventListener('click', (e) => {
    if (nameText.value === '' || commentText.value === '') {
        e.preventDefault();
        error.classList.remove('hide');
    } else {
        error.classList.add('hide');
    }
});
