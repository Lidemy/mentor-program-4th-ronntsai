const error = document.querySelector('.error');
const accountText = document.querySelector('.account__text');
const passwordText = document.querySelector('.password__text');
const submitBtn = document.querySelector('.register__submit');

submitBtn.addEventListener('click', (e) => {
    if (accountText.value === '' || passwordText.value === '') {
        e.preventDefault();
        error.classList.remove('hide');
    } else {
        error.classList.add('hide');
    }
});
