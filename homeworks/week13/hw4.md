## Webpack 是做什麼用的？可以不用它嗎？
Webpack 是一個 JavaScript 的靜態模組打包工具，將各個功能的模組建立關聯，最後輸出成一或多個檔案。
可以，但就要手動解決各個的編譯問題，例如 ES6+ 就要自己透過 Babel 轉譯成瀏覽器可讀取的內容，但通常不會只有做一件事，可能一個專案會有很多不同類型檔案需要轉譯，如果不用可以，只是很不方便。
## gulp 跟 webpack 有什麼不一樣？
gulp 是個 task manager，每一個支線的 task 各自都是獨立的，而 webpack 與 gulp 最大的差別就是 webpack 可以 bundle，可以將不同的轉譯任務打包成同一個 file。

## CSS Selector 權重的計算方式為何？
依照順序可排：
1. !important 記得權限是超級無敵大，99999999..?
2. css style in HTML element tag
3. ID
4. Class
5. Elements
