const container = document.querySelector('.container');
const title = document.querySelector('.edit-post__input');
const article = document.querySelector('.edit-post__content');
const error = document.querySelector('.error');
container.addEventListener('click', (e) => {
    if (e.target.className === 'post__btn' && (title.value === '' || article.value === '')) {
        e.preventDefault();
        error.classList.remove('hide');
    } else {
        error.classList.add('hide');
    }
});
