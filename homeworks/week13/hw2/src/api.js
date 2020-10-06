export const getAPIMessage = (apiUrl, cb) => {
    $.ajax({
        method: "GET",
        url: apiUrl,
        success: data => {
            cb(data);
        },
        error: err => {
            alert('error!')
        }
    })
}

export const addAPIMessage = (apiUrl, data, cb) => {
    $.ajax({
        type: 'POST',
        url: apiUrl,
        data: data
    }).done(resp => {
        cb(resp);
    })
}