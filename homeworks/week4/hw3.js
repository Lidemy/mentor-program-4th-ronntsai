const request = require('request');

const fuzzyName = process.argv[2];

request(`https://restcountries.eu/rest/v2/name/${fuzzyName}`,
    (error, response, body) => {
        const data = JSON.parse(body);
        for (let i = 0; i < data.length; i += 1) {
            console.log(`============\n國家：${data[i].name}\n首都：${data[i].capital}\n貨幣：${data[i].currencies[0].code}\n國碼：${data[i].callingCodes[0]}`);
        }
});
