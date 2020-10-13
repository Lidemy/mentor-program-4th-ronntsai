this 的值取決於它所在的函式是怎麼方式被呼叫的，因此
1. obj.inner.hello()
    由於 hello 使用時是被 inner 給呼叫的，因此可以往 inner 裡面去看，value = 2，因此為 2。
2. obj2.hello()
    由於 hello 使用時是被 obj2 給呼叫的，而 obj2 又被賦予 obj 下面的 inner，因此一樣為 2。
3. hello()
    由於 hello 使用時是在 Global 直接被呼叫，Global 並沒有 value，因此回 undefined。(這個我不確定理解的有沒有錯 XD)