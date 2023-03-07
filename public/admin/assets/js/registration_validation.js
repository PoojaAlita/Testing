$(function() {
    $("#registration").validate({
        rules: {
            user_name:"required",
            email:{required: true,
                    email:true,    
            },
            password: {
                required: true,
            },
            
        },
        highlight: function(element) {
            $(element).removeClass("error");
        },
        messages: {
            user_name:"Please Enter User Name",
            email: {required:"Please Enter Email Address"},
            password: {
                required: "Please Enter Password",
            },
        },
    });

    $.validator.addMethod(
        "email",
        function(value) {
            var email = 0;
            var id = $("#id").val();
            var email = $.ajax({
                url: aurl + "/validate-email",
                type: "POST",
                async: false,
                data: {
                    email: value,
                    id: id,
                },
            }).responseText;
            if (email != 0) {
                return false;
            } else return true;
        },
        "Email Already Exists"
    );

});