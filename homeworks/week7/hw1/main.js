const form = document.querySelector('.formApplication');
form.addEventListener('submit', (e) => {
    e.preventDefault();
    const itemList = [];
    const radioInputs = document.querySelector('.required input[type=radio]');
    const textInputs = document.querySelectorAll('.required input[type=text]');
    const radioText = document.querySelector('input[type="radio"]:checked');
    let hasError = false;
    if (!radioText) {
        hasError = true;
        radioInputs.parentNode.parentNode.classList.remove('hide');
    } else radioInputs.parentNode.parentNode.classList.add('hide');

    itemList.push(radioInputs.value);

    for (const input of textInputs) {
        if (!input.value) {
            input.parentNode.classList.remove('hide');
            hasError = true;
        } else input.parentNode.classList.add('hide');
        itemList.push(input.value);
    }
    if (!hasError) alert(`submit sucessful!\n暱稱:${itemList[1]}\n電子郵件:${itemList[2]}\n手機號碼:${itemList[3]}\n報名類型:${itemList[0]}\n你如何知道這活動:${itemList[4]}`);
});
