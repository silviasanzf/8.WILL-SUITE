/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');


// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
var $ = require('jquery');
require('bootstrap');
require('select2');
require('gijgo');
//import('gijgo/js/messages/messages.fr-fr.js');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

$(document).ready(function () {
    //Initialise tous les élèments de type DATEPICKER
    $('.datepicker').each(function () {
        $(this).datepicker({
            //locale: 'fr-fr',
            format: 'dd/mm/yyyy'
        });
    });

    // show the alert
    setTimeout(function () {
        $(".alert-success").alert('close');
    }, 10000);

    $('.custom-file-input').on('change', function () {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
        if($(this).parent().parent().hasClass('vich-image')){
            readURL(this);
        }
    });
});


function readURL(input) {

    if (input.files && input.files[0]) {

        let reader = new FileReader();
        let container = $(input).parent('.custom-file');
        let captions = container.siblings('a');

        reader.onload = function (e) {
            if (captions.length > 0) {
                $(captions)
                    .attr('href', 'javascript:return false;');
                $(captions).find('img').attr('src', e.target.result);
            }else{
                container.siblings('img').remove();
                container.after('<img class="caption" src="' + e.target.result + '" />');
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}


$(document).ready(function () {
    $('.artistProject').select2();
});
