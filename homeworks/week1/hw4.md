## 跟你朋友介紹 Git

嗨菜哥，我建議你可以先開一個資料夾，放你的笑話 txt 檔，透過 command line 來版本控制你的紀錄吧！

1. git init : 將你目錄下的資料夾加入版本控制。
2. touch joke.txt : 建立你的笑話文檔。
3. 編寫你的笑話吧，隨便寫一個！然後存檔。
4. git status : 看看檔案的狀態，是否有加入版本控制，這時候應該會看到尚未加入版本控制。
5. git add joke.txt : 把你的笑話文檔加入版本控制。
6. git commit -m '第一次寫笑話在 git' : 提交笑話到版本紀錄中。
7. git log : 可以看到你這次笑話提交紀錄，有一串很長的英數字碼，之後可以透過這個碼回到現在的笑話版本。

如果你有笑話寫手，需要跟人一起共同編輯笑話，可以使用 github 喔！
剛剛的操作都是在你自己電腦，稱為本地數據庫，如果要跟人共用，需要把檔案丟到網路上，而 github 就是網路的數據庫。

1. 辦好 github 帳號，新建 repository。
2. git remote add origin http://github.com/tsaike/joke.git: 將本地數據庫的目錄添加 github repository 的目標。
3. git push origin master : 把笑話文檔提交到 github。

但同時跟其它寫手一起共用同個檔案，會常常有版本不同步的問題，可以請寫手這樣做。

1. git checkout -b joke-001 : 建立寫手的 branch，就可以先保留笑話主檔目前的版本
2. 編輯笑話
3. git commit -am 'joke-001' : 直接結合 add + commit的動作，但新的檔案還是要把 add 和 commit 拆開。
4. git push orgin joke-001 : 把寫手 branch 的版本，推到遠端的 bramch。
5. 在 github 發布 pull request，讓蔡哥看看沒問題就 merge 到主檔。