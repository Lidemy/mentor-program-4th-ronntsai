
const accept = 'application/vnd.twitchtv.v5.json';
const clientId = 'wh4jovyqqhn6k924jkbro91gs0s4yx';
const url = 'https://api.twitch.tv/kraken';
const ul = document.querySelector('.gamesList');
const box = document.querySelector('.stream-box');
const gameList = document.querySelector('.gamesList');
const mainTitle = document.querySelector('.game-title');
const streamCard = `<div class="stream">
                    <img src="$previewPic" />
                    <div class="stream__data">
                        <div class="stream__avatar">
                            <img src="$avatar">
                        </div>
                        <div class="stream__intro">
                            <div class="stream__title">$title</div>
                            <div class="stream__channel">$channel</div>
                        </div>
                    </div>
                    </div>`;

gameList.addEventListener('click', (e) => {
    if (e.target.tagName.toLowerCase() === 'li') {
        const txt = e.target.innerText;
        mainTitle.innerText = txt;
        box.innerHTML = '';
        getSteams(txt, (data) => {
            appendStreams(data);
            emptyStreamCard();
            emptyStreamCard();
            emptyStreamCard();
        });
    }
});

const getGames = (cb) => {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${url}/games/top?limit=5`, true);
    xhr.setRequestHeader('Accept', accept);
    xhr.setRequestHeader('Client-ID', clientId);

    xhr.onload = () => {
        if (xhr.status >= 200 && xhr.status < 400) {
            cb(JSON.parse(xhr.response));
        }
    };

    xhr.send();
};

const getSteams = (gameName, cb) => {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `${url}/streams/?game=${encodeURIComponent(gameName)}`, true);
    xhr.setRequestHeader('Accept', accept);
    xhr.setRequestHeader('Client-ID', clientId);

    xhr.onload = () => {
        if (xhr.status >= 200 && xhr.status < 400) {
            cb(JSON.parse(xhr.response).streams);
        }
    };

    xhr.send();
};

getGames((games) => {
    for (const game of games.top) {
        const item = document.createElement('li');
        item.innerHTML = game.game.name;
        ul.appendChild(item);
    }
    getSteams(games.top[0].game.name, (data) => {
        appendStreams(data);
        emptyStreamCard();
        emptyStreamCard();
        emptyStreamCard();
    });
});

const appendStreams = (data) => {
    for (const stream of data) {
        const item = document.createElement('div');
        const content = streamCard.replace('$preview', stream.preview.large)
                                .replace('$avatar', stream.channel.logo)
                                .replace('$title', stream.channel.status)
                                .replace('$channel', stream.channel.name);
        box.appendChild(item);
        item.outerHTML = content;
    }
};

const emptyStreamCard = () => {
    const item = document.createElement('div');
    item.classList.add('stream-empty');
    box.appendChild(item);
};
