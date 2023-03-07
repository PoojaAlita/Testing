$(function() {
    /* ajax set up */
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
        },
    });
    $(".admin_login_form").validate({
        rules: {
            email: "required",
            password: {
                required: true,
            },
        },
      
        messages: {
            email: "Please Enter Email Address",
            password: {
                required: "Please Enter Password",
            },
        },
        highlight: function(element) {
            $(element).removeClass("error");
        },
    });

});