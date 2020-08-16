## 什麼是 Ajax？
Ajax 全名 Asynchronous JavaScript and XML，簡單來說，如果在網頁上做一件事情，就需要重整畫面，會變得很沒有效率，且使用者體驗應該是非常差的，而 Ajax 就是解決這樣的問題，Asynchronous 也就是這個技術的關鍵，非同步，我不需要等到 server 傳回資料，才能做其他網頁元素的事情，我們不應該去等某些事情才可以做下一件事，我很喜歡的舉例就是點餐，你不會點完餐等餐時，不能做別的事情，你可以滑手機、跟朋友聊天，不需要等到餐點到了才能做別的行為。

## 用 Ajax 與我們用表單送出資料的差別在哪？
當用表單送出資料時，收到 Response 時會將整個網頁重新 render；當使用 Ajax 時，可以在將 Response 的資料存於 JS，也就是說可以透過 JS 來控制要 render 特定的區塊，不會讓全部網頁重新 render。

## JSONP 是什麼？
JSONP 是在做跨網域時，可以不受同源政策的限制，透過 script tag 發送 Request 到 Server 端。

## 要如何存取跨網域的 API？
set Access-Control-Allow-Origin = *

## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？
因為第四週的 runtime 是 node.js，是 local 的，並不會有網域的問題，瀏覽器才會有這類型的問題。
