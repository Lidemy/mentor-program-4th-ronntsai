const btn = document.querySelector('.btn');
const background = document.querySelector('main');
const activity = document.querySelector('.activity');
const result = document.querySelector('.result');
const resultTitle = document.querySelector('.result h2');
const errorMessage = '系統不穩定，請再試一次！';
const apiUrl = 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery';

const draw = (cb) => {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', apiUrl, true);
    xhr.onload = () => {
        if (xhr.status >= 200 && xhr.status < 400) {
            let data;
            try {
                data = JSON.parse(xhr.responseText);
            } catch (err) {
                cb(errorMessage);
            }
            cb(null, data);
        } else {
            cb(errorMessage);
        }
    };
    xhr.onerror = () => {
        cb(errorMessage);
    };
    xhr.send();
};

btn.addEventListener('click', () => {
    draw((err, data) => {
        if (err) {
            alert(err);
            return;
        }
        switch (data.prize) {
            case 'FIRST':
                addClassList('first', '恭喜你中頭獎了！日本東京來回雙人遊！');
                break;
            case 'SECOND':
                addClassList('second', '二獎！90 吋電視一台！');
                break;
            case 'THIRD':
                addClassList('third', '恭喜你抽中三獎：知名 YouTuber 簽名握手會入場券一張，bang！');
                break;
            case 'NONE':
                addClassList('none', '銘謝惠顧');
                break;
            default:
        }
    });
});

const addClassList = (addClass, txt) => {
    background.classList.add(addClass);
    resultTitle.innerText = txt;
    activity.classList.add('hide');
    result.classList.remove('hide');
};
