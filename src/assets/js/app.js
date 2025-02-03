import $ from 'jquery';
import whatInput from 'what-input';

window.$ = $;

AOS.init();

import Foundation from 'foundation-sites';
// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';

$(document).foundation();

$(function(){
    var fullWidth = $(window).width();
    $('body').addClass('loaded');
    $('.svg-container').width( fullWidth );
});

$(window).resize(function(){
    var fullWidth = $(window).width();
    $('.svg-container').width( fullWidth );

    if( fullWidth < 992 ){
        $('.navbar.collapse').removeClass('show');
        $('.animated-icon1').removeClass('open');
        $('.first-button').removeClass('collapsed');
    }
});

$(window).scroll(function(){
    // console.log($(window).scrollTop());
    if( $(window).scrollTop() > 20){
        if( !$('.site-header').hasClass('active-header') ){
            $('.site-header').addClass('active-header');
        }
    } else{
        $('.site-header').removeClass('active-header');
    }
});


$(document).ready(function () {

    $('.first-button').on('click', function () {
    
      $('.animated-icon1').toggleClass('open');
    });
});