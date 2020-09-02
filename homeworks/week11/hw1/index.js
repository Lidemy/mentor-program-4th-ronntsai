const error = document.querySelector('.error');
const commentText = document.querySelector('.commenttext');
const usernameText = document.querySelector('.usernametext');
const board = document.querySelector('.board');
const editUserBox = document.querySelector('.editUserBox');

board.addEventListener('click', (e) => {
    if (e.target.className === 'username__submit btn' && usernameText.value === '') {
        e.preventDefault();
        error.classList.remove('hide');
        error.innerText = '尚未填寫更改暱稱';
    } else if (e.target.className === 'comment__submit btn' && commentText.value === '') {
        e.preventDefault();
        error.classList.remove('hide');
        error.innerText = '請填寫完整留言資訊！';
    } else {
        error.classList.add('hide');
    }

    if (e.target.className === 'btn toggleBtn') {
        editUserBox.classList.toggle('hide');
    }

    if (e.target.className === 'delete__comment') {
        const confirmation = confirm('確定要刪除嗎？');
        if (!confirmation) {
            e.preventDefault();
        }
    }
});
