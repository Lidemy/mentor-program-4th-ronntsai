const box = document.querySelector('.container');
const addBtn = document.querySelector('.addBtn');
const addText = document.querySelector('.addText');
const unDoneArea = document.querySelector('.unDone');
const doneArea = document.querySelector('.done');

const addTask = () => {
    if (addText) {
        const item = createNewItem(addText.value);
        bindEvents(item, taskDone);
        unDoneArea.appendChild(item);
        addText.value = '';
    }
};

const createNewItem = (newTask) => {
    const liItem = document.createElement('li');
    const checkBox = document.createElement('input');
    const label = document.createElement('label');
    const deleteButton = document.createElement('button');

    checkBox.type = 'checkbox';
    deleteButton.innerText = 'Delete';
    deleteButton.className = 'delete';
    label.innerText = `${newTask} `;

    liItem.appendChild(checkBox);
    liItem.appendChild(label);
    liItem.appendChild(deleteButton);
    return liItem;
};

addBtn.addEventListener('click', addTask);
box.addEventListener('click', (e) => {
    if (e.target.className === 'delete') {
        const delItem = e.target.parentNode;
        delItem.parentNode.removeChild(delItem);
    }
});

const taskDone = (e) => {
    const listItem = e.currentTarget.parentNode;
    doneArea.appendChild(listItem);
    bindEvents(listItem, taskUnDone);
};

const taskUnDone = (e) => {
    const listItem = e.currentTarget.parentNode;
    unDoneArea.appendChild(listItem);
    bindEvents(listItem, taskDone);
};


const bindEvents = (taskListItem, checkBoxEventHandler) => {
    const checkBox = taskListItem.querySelector('input[type="checkbox"]');
    checkBox.onchange = checkBoxEventHandler;
};

for (let i = 0; i < unDoneArea.children.length; i += 1) {
    bindEvents(unDoneArea.children[i], taskDone);
}

for (let i = 0; i < doneArea.children.length; i += 1) {
    bindEvents(doneArea.children[i], taskUnDone);
}
