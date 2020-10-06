$(document).ready( () => {
    messagePlugin.init({
        siteKey: 'ronn',
        getAPIUrl: 'http://mentor-program.co/mtr04group2/Ronn/week12/discussion/api_message.php',
        containerSelector: '.comment-area',
    });
})