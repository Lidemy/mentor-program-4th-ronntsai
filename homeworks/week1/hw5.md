## 請解釋後端與前端的差異。
以去麥當勞點餐為例好了，最近台北很多麥當勞都有點餐機器了，你所看到的點餐畫面就是前端，點餐、結帳到送出菜單的畫面都是由前端去帶動畫面的，而你所選的餐點跟你的付款資訊，這些資訊會由前端幫你把你的資料帶給後端，後端會確認你是否結帳成功，如果你是刷卡，還會跑驗證卡片的流程，若沒問題，後端就會告訴前端，你就告訴點餐的人點餐成功吧！

## 假設我今天去 Google 首頁搜尋框打上：JavaScript 並且按下 Enter，請說出從這一刻開始到我看到搜尋結果為止發生在背後的事情。
瀏覽器會把 javascript 的資訊 request 給後端，後端會透過這個資料去找尋現有的網頁有提到 javascript 的，再將這些搜尋結果的資訊 response 回去給瀏覽器，讓使用者看到搜尋結果。

## 請列舉出 3 個「課程沒有提到」的 command line 指令並且說明功用
1. uniq：可以將檔案中完全重複的行刪除，留下獨一無二的一行，這也是 unique 的縮寫。
2. alias: 將 command line 指令設定別名。
3. nano: 也是 command line 的編輯器之一，就像 vim 一樣。