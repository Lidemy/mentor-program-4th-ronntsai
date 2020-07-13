const request = require('request');

const para = process.argv[2];

if (para === 'list') {
    request('https://lidemy-book-store.herokuapp.com/books/?_limit=20',
    (error, response, body) => {
        const books = JSON.parse(body);
        for (let i = 0; i < books.length; i += 1) {
            console.log(`${books[i].id} ${books[i].name}`);
        }
    });
} else if (para === 'read') {
    const specifiedId = process.argv[3];
    request(`https://lidemy-book-store.herokuapp.com/books/${specifiedId}`,
    (error, response, body) => {
        const books = JSON.parse(body);
        console.log(`${books.id} ${books.name}`);
    });
} else if (para === 'delete') {
    const deleteId = process.argv[3];
    request.delete(
        { url: `https://lidemy-book-store.herokuapp.com/books/${deleteId}` },
        () => console.log(`刪除 id 為 ${deleteId} 的書籍`),
    );
} else if (para === 'create') {
    const bookName = process.argv[3];
    request.post(
        {
            url: 'https://lidemy-book-store.herokuapp.com/books',
            form: {
                name: bookName,
            },
        },
        () => console.log(`新增一本名為 ${bookName} 的書`),
    );
} else if (para === 'update') {
    const updateId = process.argv[3];
    const bookName = process.argv[4];
    request.patch(
        {
            url: `https://lidemy-book-store.herokuapp.com/books/${updateId}`,
            form: {
                name: bookName,
            },
        },
        () => console.log(`更新 id 為 ${updateId} 的書名為 ${bookName}`),
    );
}
