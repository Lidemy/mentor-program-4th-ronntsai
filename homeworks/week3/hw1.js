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

const solve = (arglines) => {
    const count = arglines[0];
    for (let x = 1; x <= count; x += 1) {
      console.log(printStar(x));
    }
};

const printStar = (num) => {
    let result = '';
    for (let i = 1; i <= num; i += 1) {
      result += '*';
    }
    return result;
};
