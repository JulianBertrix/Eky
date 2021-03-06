/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
require('bootstrap');

$(document).ready(function(){
    var scrollTop = 0;
    $(window).scroll(function(){
        scrollTop = $(window).scrollTop();
        if(scrollTop > 100){
            $('.my-nav').addClass('bg-light');
            $('.my-img').addClass('my-img-redux');
        } else if (scrollTop < 100){
            $('.my-nav').removeClass('bg-light');
            $('.my-img').removeClass('my-img-redux');
        }
    });

});
