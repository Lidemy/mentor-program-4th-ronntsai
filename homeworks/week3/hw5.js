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
        const match = arrlines[i].split(' ');
        console.log(Decisive(match));
    }
};
// eslint-disable-next-line consistent-return
const Decisive = (arr) => {
    let A = arr[0];
    let B = arr[1];
    const playType = arr[2];

    if (A === B) return 'DRAW';
    // eslint-disable-next-line eqeqeq
    if (playType == -1) {
        const temp = A;
        A = B;
        B = temp;
    }
    const lenA = A.length;
    const lenB = B.length;

    if (lenA !== lenB) {
        return lenA > lenB ? 'A' : 'B';
    }
    for (let i = 0; i < lenA; i += 1) {
        if (A[i] !== B[i]) {
            return A[i] > B[i] ? 'A' : 'B';
        }
    }
};
