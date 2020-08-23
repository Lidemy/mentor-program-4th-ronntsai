## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼
VARCHAR 是可以自訂長度的，例如 VARCHAR(64)，就是字串可以寫到 64 個字，另外 VARCHAR 有個更類似的，叫做 NVARCHAR，兩者最多就是存 8000 個字，但這兩者的差別是 VARCHAR 儲存 1 個字佔了 1 個長度，而 NVARCHAR佔了 2 個長度，因此大部分都是使用 VARCHAR 而不是 NVARCHAR，NVARCHAR 大多拿來處理非英文的字元，因為它儲存的是 Unicode 字元。

TEXT 與 VARCHAR 的差別就在與 TEXT 沒辦法設字串，可以有比較大的長度可以放，當然也不是因為這特性所有欄位都填 TEXT，如果今天有個欄位是性別，只會填男或者女，當然是用 VARCHAR 就好，舉例來說，我們在裝水的時候不會拿大水桶裝水喝吧？因為我們不需要那麼大的容器，頂多就是保溫瓶之類的，在定義欄位也是如此。另外像是在作業中留言的欄位使用 TEXT 外，其他機會使用到的我自身經驗是在 Store procedure 很常使用到，Store procedure 其實就是資料庫的 Function，你會有 input parameter，也會有 output parameter，通常在 input parameter 會定義參數型別，通常會有一種設計叫做 id_list，簡單來說就是後端會丟一串 id 進來來給資料庫驗證，例如 user_id_list = '1,2,3,4,5,6,7,8'，如果這時候使用 VARCHAR 可能就會碰到超出長度的問題，使用 TEXT 會是很好的選擇。

## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又是怎麼把 Cookie 帶去 Server 的？
Cookie 是網站開發者為了能辨認使用者身份而存在的一種技術，而 Server 會要求瀏覽器在 Cookie 放入 Session ID(通常會加密)，瀏覽器發出 Request 時會帶著 Cookie 送給 Server。



## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？
資料庫的密碼可以直接給資料庫操作者看到，通常會加密或是以亂碼的方式存在資料庫，因為如果密碼可以直接下 SQL Command 看到，這樣那些電商或是大型平台的資料庫工程師可以直接看到每個人的密碼，但通常好像 Production 環境應該一般工程師是沒權限看到啦，但資料庫應該不能直接攤開密碼內容。

