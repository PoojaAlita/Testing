$(function() {
    $(".forgot_password").validate({
        rules: {
            email:{required: true,
            },
            
        },
        messages: {
            email: {required:"Please Enter Email Address"},
        },
        highlight: function(element) {
            $(element).removeClass("error");
        },
    });

});