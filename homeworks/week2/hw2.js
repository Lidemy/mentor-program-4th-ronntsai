function capitalize(str) {
    let ans = '';
    let asciiCode = str.charCodeAt(0);
    if(asciiCode >= 97 && asciiCode <= 122) {
        for(let i = 0; i < str.length; i ++) {
            ans += (i == 0 ? String.fromCharCode(asciiCode - 32) : str[i]);
        }
        return ans;
    }
    else
        return str;
}

console.log(capitalize('hello'));
