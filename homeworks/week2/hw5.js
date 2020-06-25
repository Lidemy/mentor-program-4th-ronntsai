function join(arr, concatStr) {
    let ans = '';
    for(let i = 0; i < arr.length; i++) {
        ans += arr[i] + (i == arr.length - 1 ? '' : concatStr);
    }
    return ans;
}

function repeat(str, times) {
    let sum = '';
    for(let i = 0; i < times; i++) {
        sum += str;
    }
    return sum;
}

console.log(join(["a", 1, "b", 2, "c", 3], ','));
console.log(repeat('yoyo', 2));
