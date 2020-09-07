## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫
雜湊：多對一，防禦性更強，從雜湊的值是無法反推原來的值。
加密：一對一，會有一個固定的公式可以反推原來的值，因此防禦性沒那麼強。

## `include`、`require`、`include_once`、`require_once` 的差別
include：把其他的 php file 引入在某一段檔案，可以 include 有迴圈類型的檔案。
require：通常使用 require 會在檔案的開頭，把某個 reuse 高的 function 或是 method 放在某個 php file，可以透過 require 來引用 function，但不能使用迴圈。
include_once：跟 include 一樣，差別在於在引入檔案前，會先檢查檔案是否已經在其他地方被引入過了，若有，就不會再重複引入。
require_once：跟 require 一樣，差別在於在引入檔案前，會先檢查檔案是否已經在其他地方被引入過了，若有，就不會再重複引入。
## 請說明 SQL Injection 的攻擊原理以及防範方法
DELETE FROM table WHERE id = 1 (OR 1 = 1);
括號裡就是常見的 SQL Injection 其中一的攻擊，破壞你資料庫的資料為目的，防範方式在 php 就是使用 prepare 的方式，如果是在 MySQL 的 store procedure，使用 dynamic sql 時也要防範 SQL Injection，也剛好是 prepare：

```    
SET @sql = CONCAT('DELETE id, name FROM table WHERE id = ', in_id);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
```

##  請說明 XSS 的攻擊原理以及防範方法
在使用者可以輸入的地方下 HTML tag 可以改變網站結構，透過 htmlspecialchars function 包住使用者任何輸入的文字可以保護及防範。

## 請說明 CSRF 的攻擊原理以及防範方法
偽造對目標網站的 request 在某個網站內，讓你以為沒事但其實是使用者的瀏覽器自帶目標網站身分用的 cookie，讓使用者在不知情的狀況發送 request 到目標網站，透過 Double Submit Cookie，存一個 token 在 client 端的 cookie 裡，不論從哪裡觸發了送出 request 時，檢查 request 裡面的 POST/GET 是否也帶有這個 token，即可防範 CSRF 攻擊。