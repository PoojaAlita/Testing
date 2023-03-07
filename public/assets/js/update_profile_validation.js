$(document).ready(function() {
   
    $(".profile_update").validate({
        rules: {
            name:"required",
            email:{required: true,email:true},
        },
        messages: {
            name:"Please Enter User Name",
            email: {required:"Please Enter Email Address"},
            
        },
        highlight: function(element) {
            $(element).removeClass("error");
        },
    });
  
});

$.validator.addMethod(
    "email",
    function(value) {
        var email = 0;
        var id = $("#id").val();
        var email = $.ajax({
            url: aurl + "/email-validate",
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