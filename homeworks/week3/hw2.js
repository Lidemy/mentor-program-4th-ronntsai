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
    const temp = arrlines[0].split(' ');
    const fromNumber = Number(temp[0]);
    const toNumber = Number(temp[1]);

    for (let i = fromNumber; i <= toNumber; i += 1) {
      if (isNarcissistic(i)) {
        console.log(i);
      }
    }
};

// how many digits
const digitCount = (n) => {
    let result = 0;
    let number = n;
    while (number !== 0) {
      number = Math.floor(number / 10);
      result += 1;
    }
    return result;
};

// Narcissistic judgement
const isNarcissistic = (n) => {
    const digits = digitCount(n);
    const originalNumber = n;
    let calNumber;
    let number = n;
    let sum = 0;
    while (number !== 0) {
      calNumber = number % 10;
      sum += calNumber ** digits;
      number = Math.floor(number / 10);
    }
    if (sum === originalNumber) return true;
    return false;
};
