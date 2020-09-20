let pagination = {
    appendCount: 0,
    page: 1
}

const encodeHTML = (s) => {
    return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/"/g, '&quot;');
}

const appendCommentDOM = (container, message, isPrepend) => {
    const card = `
        <div class="card">
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                <p>${encodeHTML(message.message)}</p>
                <footer class="blockquote-footer">${encodeHTML(message.user_name)}</footer>
                </blockquote>
            </div>
        </div>
    `
    if(isPrepend) {
        container.prepend(card);
    } else {
        container.append(card);
    }
}

const getMessage = () => {
    $.ajax({
        method: "GET",
        url: `http://mentor-program.co/mtr04group2/Ronn/week12/discussion/api_message.php?site_key=ronn&page=${pagination.page}`,
        success: data => {
            const messages = data.messages;
            const count = data.total_count;
            pagination.appendCount += messages.length;
            pagination.page += 1;
            for(message of messages) {
                appendCommentDOM($('.card-container'), message, false);
            }
            if (pagination.appendCount === count) {
                $('.btn-more').remove();
            } else {
                $('.btn-more').show();
            }
        },
        error: err => alert('error!')
    })
}

$(document).ready( () => {
    getMessage();
    $('.add-message-form').submit((e) => {
        e.preventDefault();
        const data = {
            'site_key': 'ronn',
            'user_name': $('input[name=username]').val(),
            'message': $('textarea[name=content-text]').val()
        }
        $.ajax({
            type: 'POST',
            url: 'http://mentor-program.co/mtr04group2/Ronn/week12/discussion/api_add_message.php',
            data: data
        }).done(resp => {
            $('input[name=username]').val('');
            $('textarea[name=content-text]').val('');
            if(resp.code !== 0)
                alert('fail');
            else
                appendCommentDOM($('.card-container'), data, true);
        })
    })

    $('.btn-more').click((e) => {
        getMessage();
    })

})
