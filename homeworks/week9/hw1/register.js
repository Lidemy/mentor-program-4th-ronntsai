const error = document.querySelector('.error');
const nicknameText = document.querySelector('.nickname__text');
const accountText = document.querySelector('.account__text');
const passwordText = document.querySelector('.password__text');
const submitBtn = document.querySelector('.register__submit');

submitBtn.addEventListener('click', (e) => {
    if (nicknameText.value === '' || accountText.value === '' || passwordText.value === '') {
        e.preventDefault();
        error.classList.remove('hide');
    } else {
        error.classList.add('hide');
    }
});
