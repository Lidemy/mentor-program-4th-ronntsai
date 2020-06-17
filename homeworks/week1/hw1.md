## 交作業流程

1. 開啟新的 branch 並且切到 branch 上：git checkout -b week1 
2. 寫作業
3. 卡關
4. 克服 然後完成作業
5. 自我檢討跟檢查作業要求
6. 把更改好的作業加入版本控制且 commit：git commit -am 'week1: upload homework' (如果有新增的檔案，還是要先做 git add .)
7. 把作業拋上 GitHub: git push -u origin week1
8. 寄送 PR
9. 並將 PR 連結上傳到 Lidemy Learning 繳交
10. 作業被 merge 後，將本地 Git 切換到 master: git checkout master
11. 抓 github 上新的改動：git pull origin master
11. 刪除已被 merge 的 branch：git branch -d week1