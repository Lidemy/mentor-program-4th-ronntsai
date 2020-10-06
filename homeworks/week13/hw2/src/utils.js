const encodeHTML = (s) => {
    return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/"/g, '&quot;');
}

export const formTemplate = `
    <div>
        <form class="add-message-form">
            <div class="form-group">
                <label for="username-text">Name</label>
                <input name="username" class="form-control" id="username-text" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="content-text">Content</label>
                <textarea name="content-text" class="form-control" id="content-text" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div class="card-container">
        </div>
        <button type="button" style="display: none;" class="btn btn-primary btn-more">載入更多</button>
    </div>
`;

export const appendCommentDOM = (container, message, isPrepend) => {
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