let id = 1;
let count = {
    toDoCount: 0,
    doneCount: 0
}
const submitBtn = $('.todo-submit');
const deleteBtn = $('.btn-delete');
const list = $('.todo-list');

const renderCount = () => {
    $('#todo-count').text(count.toDoCount);
}

const encodeHTML = (s) => {
    return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/"/g, '&quot;');
}

const renderToDoItems = (idx, item, isCompleted) => {
    const template = `
        <div class="todo-item ${isCompleted ? 'completed' : ''}" id="todo-${idx}">
            <input type="text" class="todo-name ${isCompleted ? 'completed' : ''}" value="${item}"></input>
            <div class="todo-feature">
                <button class="btn btn-light btn-mark">${isCompleted ? '勾選未完成' : '勾選完成'}</button>
                <button class="btn btn-light btn-delete">刪除</button>
            </div>
        </div>`;
    list.append(template);
    isCompleted ? count.doneCount += 1 : count.doneCount;
    !isCompleted ? count.toDoCount += 1 : count.toDoCount;
    renderCount();
}

$(document).ready(() => {

    const searchParams = new URLSearchParams(window.location.search);
    const listId = searchParams.get('list_id');

    if (listId) {
        $.ajax({
            method: "GET",
            url: `http://mentor-program.co/mtr04group2/Ronn/week12/todolist/api_todo.php?list_id=${listId}`,
            success: data => {
                const toDoItems = JSON.parse(data.content);
                for (let [index, toDoItem] of toDoItems.entries()) {
                    renderToDoItems(index + 1, toDoItem.item, toDoItem.isCompleted);
                    id = index + 2;
                }
            },
            error: err => alert('error!')
        })
    }

    submitBtn.click((e) => {
        const todotext = $('.todo-text').val();
        $('.todo-text').val('');
        if (todotext.trim() === '') {
            alert('cannot be empty!')
        } else if (todotext.trim().length > 16) {
            alert('list content cannot more than 16 characters!')
        } else {
            list.append(`
                <div class="todo-item" id="todo-${id}">
                    <input type="text" class="todo-name" value="${encodeHTML(todotext.trim())}"></input>
                    <div class="todo-feature">
                        <button class="btn btn-light btn-mark">勾選完成</button>
                        <button class="btn btn-light btn-delete">刪除</button>
                    </div>
                </div>
            `);
            id += 1;
            count.toDoCount += 1;
            renderCount();
        }
    })
    
    list.on('click', '.btn-delete', (e) => {
        const item = $(e.target).parent().parent();
        const confirmation = confirm('確定要刪除嗎？');
        if (!confirmation) {
            e.preventDefault();
        } else {
            if (item.hasClass('completed')) {
                count.doneCount -= 1;
            } else {
                count.toDoCount -= 1;
            }
            renderCount();
            $(e.target).parent().parent().remove();
        }
    })

    list.on('click', '.btn-mark', (e) => {
        const item = $(e.target).parent().parent();
        if (item.hasClass('completed')) {
            $(e.target).text('勾選完成');
            item.removeClass('completed');
            item.find('input').css('text-decoration', 'none');
            item.find('.todo-name').removeClass('completed');
            count.toDoCount += 1;
            count.doneCount -= 1;
            renderCount();
        } else {
            $(e.target).text('勾選未完成');
            item.addClass('completed');
            item.find('input').css('text-decoration', 'line-through');
            item.find('.todo-name').addClass('completed');
            count.toDoCount -= 1;
            count.doneCount += 1;
            renderCount();
        }
    })
    list.on('focus', '.todo-name', (e) => {
        previousValue = $(e.target).val();
    }).change((e) => {
        if ($(e.target).val().trim() === '') {
            alert('cannot be empty!')
            $(e.target).val(previousValue);
        } else if ($(e.target).val().trim().length > 16) {
            alert('list content cannot more than 16 characters!')
            $(e.target).val(previousValue);
        }
    });

    $('.clear-all').click((e) => {
        const confirmation = confirm('確定要刪除嗎？');
        if (!confirmation) {
            e.preventDefault();
        } else {
            $('.todo-item.completed').each(function(i, el){
                el.remove();
                count.doneCount += 1;
            });
        }
    })

    $('.todo-option-item').click((e) => {
        $('.todo-option-item').each((i, el) => {
            $(el).removeClass('checked');
        });
        $(e.target).addClass('checked');
        $('.todo-item').each((i, el) => {
            if ($(e.target).text() === '已完成') {
                if ($(el).hasClass('completed')) {
                    $(el).show();
                } else {
                    $(el).hide();
                }
            } else if ($(e.target).text() === '未完成') {
                if ($(el).hasClass('completed')) {
                    $(el).hide();
                } else {
                    $(el).show();
                }
            } else {
                $(el).show();
            }
        });

    })

    $('.btn-save').click((e) => {
        const todolist = [];
        if($('.todo-item').length > 0) {
            $('.todo-item').each((i, el) => {
                todolist.push({
                    item: $(el).children('.todo-name').attr('value'),
                    isCompleted: $(el).hasClass('completed') ? 1 : 0
                })
            })
            const data = JSON.stringify(todolist);
            $.ajax({
                type: 'POST',
                url: 'http://mentor-program.co/mtr04group2/Ronn/week12/todolist/api_save_todo.php',
                data: {
                    content: data,
                }
            }).done(resp => {
                if(resp.code !== 0)
                    alert(resp.resp);
                else {
                    count.toDoCount = 0;
                    count.doneCount = 0;
                    window.location = `index.html?list_id=${resp.list_id}`;
                }
            })
        }
    })

})