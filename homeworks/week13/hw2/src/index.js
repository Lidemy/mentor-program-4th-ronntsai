import { formTemplate, appendCommentDOM } from './utils';
import { getAPIMessage, addAPIMessage } from './api';

let siteKey = '';
let getAPIUrl = '';
let addAPIUrl = '';
let containerElement = null;

let pagination = {
    appendCount: 0,
    page: 1
}

export const init = (options) => {
    siteKey = options.siteKey;
    getAPIUrl = options.getAPIUrl;
    containerElement = $(options.containerSelector);
    containerElement.append(formTemplate);

    getMessage();
    $('.add-message-form').submit((e) => {
        e.preventDefault();
        addAPIUrl = 'http://mentor-program.co/mtr04group2/Ronn/week12/discussion/api_add_message.php';
        const data = {
            'site_key': siteKey,
            'user_name': $('input[name=username]').val(),
            'message': $('textarea[name=content-text]').val()
        }
        addAPIMessage(addAPIUrl, data, resp => {
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
}

const getMessage = () => {
    $('.btn-more').hide();
    let targetUrl = `${getAPIUrl}?site_key=${siteKey}&page=${pagination.page}`
    getAPIMessage(targetUrl, data => {
        const messages = data.messages;
        const count = data.total_count;
        pagination.appendCount += messages.length;
        pagination.page += 1;
        for(let message of messages) {
            appendCommentDOM($('.card-container'), message, false);
        }
        if (pagination.appendCount === count) {
            $('.btn-more').remove();
        } else {
            $('.btn-more').show();
        }        
    })
}
