'use strict';
$(document).ready(function() {
    $(window).on("load", function() {

        $('.preloader').fadeOut(1000);
    });
    new WOW().init();
    $('#login_validator').bootstrapValidator({
        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: 'The username is required'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Please provide a password'
                    }
                }
            }
        }
    });

});
