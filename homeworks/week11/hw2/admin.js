const container = document.querySelector('.container');

container.addEventListener('click', (e) => {
    if (e.target.className === 'admin-post__btn delete') {
        const confirmation = confirm('確定要刪除嗎？');
        if (!confirmation) {
            e.preventDefault();
        }
    }
});
