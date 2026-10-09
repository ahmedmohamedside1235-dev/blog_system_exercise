import 'bootstrap';
import $ from 'jquery';


$(document).ready(function () {
    let elementMessage = $('.success-message');

    if (elementMessage.length > 0) {
        setTimeout(() => {
            elementMessage.fadeOut(800, function () {
                $(this).remove();
            });
        }, 3000);
    }
});