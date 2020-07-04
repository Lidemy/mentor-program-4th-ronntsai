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
    const count = arrlines[0];
    for (let i = 1; i <= count; i += 1) {
        if (Number(arrlines[i]) === 1) {
            console.log('Composite');
        } else if (isPrime(arrlines[i])) {
            console.log('Prime');
        } else {
            console.log('Composite');
        }
    }
};

const isPrime = (n) => {
    const number = Number(n);
    let divisibleCount = 0;
    for (let i = 2; i < number; i += 1) {
        if (number % i === 0) {
            divisibleCount += 1;
        }
    }
    if (divisibleCount === 0) return true;
    return false;
};
