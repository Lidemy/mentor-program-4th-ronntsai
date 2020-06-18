read n
i=1
while [ $i -le $n ]
do
        touch $i.js
        (( i++ ))
done