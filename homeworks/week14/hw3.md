## 什麼是 DNS？Google 有提供的公開的 DNS，對 Google 的好處以及對一般大眾的好處是什麼？
DNS 簡單來說就是把 IP 換成一個名字的感覺，例如我們去 www.gooogle.com，我們不是用 google 的 IP 在網址列搜尋，我們一定是打 google 然後跳出 www.google.com，這串我們就可以稱為 Domain Name，而 DNS 的工作就是把使用者所輸入的 Domain name 轉成對應的 IP，再將該 IP 位址的內容傳回給使用者。

Google 所提供的 DNS Service 可以把使用者在網路上操作的行為給搜集清楚，在商業市場上是一個超級重要的核心，因為掌握了使用者的操作資料，也能掌握他們的消費行為模式，對 Google 來說這是他們一大商機。對大眾來說，使用 Google 的 DNS Server 上網時可以得到較快的速度去看到使用者所想看到的網路內容，Google 的 Server 遍佈世界各地，這是使用 Google DNS Server 一大優勢。

## 什麼是資料庫的 lock？為什麼我們需要 lock？
lock 在傳統資料庫中可說是超級核心的機制，資料庫的每一個寫入寫出都代表了一個交易，而交易可大可小，如果只是像留言板或是小型網站可能 lock 的感受度就沒那麼高，在電商平台或是一些大型博奕網站，lock 的機制就相對重要非常多，lock 的存在簡單來說就是維持交易的正確性，lock 可以是整張 table 的 lock，也可以是針對一筆資料的 lock，前面兩者的 lock 又可以分為 Shared lock 跟 execlusive lock，有些資料庫像 MSSQL 還會有 update lock，lock 本身其實蠻複雜的，牽涉了超級多種的 scenario，不同的 transaction 有不同種的 lock 機制，lock 又可以透過資料庫不同的 isolation level 去決定 lock 的行為，這邊就不細講，因為我也沒有很了解 XD。

為什麼需要 lock 可以從一個角度去切入，如果沒有 lock，那會變怎樣？今天上購物平台搶限量 100 盒口罩，當今天購物網站就會發生超賣的情形，因為在做口罩下訂的動作，本身就是對資料庫進行寫入的動作。如果沒有 lock，今天在網路上看到任何的資料可能都不能相信，因為沒有 lock 不能確保資料的正確性，也就是所謂的 dirty read。但有些商業實作上是會選擇將資料庫的行為設定 no lock 的，例如博奕網站，當買家要下某個盤的時候，如果用 lock 機制它可能 loading 會非常久，但因為賭盤其實賠率一出來，就大概是維持差不多的數值，所以在賭盤的賠率大部分是用 no lock 去設計的，寧願使用者拿到 dirty read 的資料，也不要加重 DB 的 lock 所給予的 loading。

## NoSQL 跟 SQL 的差別在哪裡？
NoSQL 光看字面之前我以為的意思是「不是 SQL」，去查才知道是「 Not only SQL」，比起傳統的 RDBMS 資料庫，NoSQL 做了更多彈性的設計，NoSQL 的資料是不須受到 Table Schema 的限制，可以用 JSON Format 存取資料，這邊指的是整筆資料都是 JSON Format，會這樣說是因為 MySQL 其實也可以存 JSON 型態的欄位資料，但還是維持 RDBMS 的風格。

參考資料：https://ithelp.ithome.com.tw/articles/10187443 (看完拉上去看作者才發現是 Huli XD)

## 資料庫的 ACID 是什麼？

1. Atomicity：原子性，或稱不可分割性，資料庫的操作一定是全部完成，或者全部不完成，不會結束在中間某個環節。事務在執行過程中發生錯誤，會被回滾（Rollback）到事務開始前的狀態，就像這個事務從來沒有執行過一樣。
2. Consistency：一致性，在事務開始之前和事務結束以後，資料庫的完整性沒有被破壞。這表示寫入的資料必須完全符合所有的預設約束、觸發器、級聯回滾等。
3. Isolation：資料庫允許多個並發事務同時對其數據進行讀寫和修改的能力，隔離性可以防止多個事務並發執行時由於交叉執行而導致數據的不一致。事務隔離分為不同級別，包括未提交讀（Read uncommitted）、提交讀（read committed）、可重複讀（repeatable read）和串行化（Serializable），這個跟 Lock 息息相關。
4. Durability：事務處理結束後，對數據的修改就是永久的，即便系統故障也不會丟失。

老實說我覺得第一個特性我蠻困惑的，我覺得資料庫的某些行為並不能完全遵守這個特性的，以 Store Procedure 來說，SQL 語法可以分為 DDL、DML、DCL 及 TCL，就先說 DDL 好了，DDL 的語法像是 Create table，DROP table 等等，但 DDL 的語法是不能 Rollback 的，至少在 Store Procedure 來說是這樣，舉例來說，今天 Store Procedure 如果做了以下兩件事情，且這兩件事情外面包了 Start Transaction，簡單來說就是如果裡面有任何一個失敗，就會 rollback 所有行為：
1. Create table user ...;
2. Insert into message (...) Values ...;
假設今天 1 做完，但在 2 失敗，Create 的 table 是不會在 rollback 中做 Drop 掉的動作，那就沒有符合 Atomicity 了吧？其實我也是查資料才知道這四個分別代表什麼意義，對我來說這四個就是把資料庫的大部分的特性用這四個單字包裝起來，感覺有點像是什麼精神口號的感覺。