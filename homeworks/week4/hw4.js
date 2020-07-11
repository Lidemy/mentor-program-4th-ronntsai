const request = require('request');

const CLIENT_ID = 'wh4jovyqqhn6k924jkbro91gs0s4yx';
const URL = 'https://api.twitch.tv/kraken/games/top';
const ACCEPT = 'application/vnd.twitchtv.v5.json';

request({
    method: 'GET',
    url: URL,
    headers: {
        'Client-ID': CLIENT_ID,
        Accept: ACCEPT,
    },
}, (error, response, body) => {
        const data = JSON.parse(body);
        for (let i = 0; i < data.top.length; i += 1) {
            console.log(`${data.top[i].viewers} ${data.top[i].game.name}`);
        }
});
