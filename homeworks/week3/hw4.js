const readline = require('readline');

const rl = readline.createInterface({
  input: process.stdin,
});

const lines = [];

rl.on('line', (line) => {
  lines.push(line);
});

rl.on('close', () => {
  solve(lines);
});

const solve = (arrlines) => {
    const str = arrlines[0];
    const reverseStr = reverseString(str);
    if (str === reverseStr) {
        console.log('True');
    } else {
        console.log('False');
    }
};

const reverseString = (s) => {
    const str = s;
    let result = '';
    for (let i = str.length - 1; i >= 0; i -= 1) {
        result += str[i];
    }
    return result;
};
