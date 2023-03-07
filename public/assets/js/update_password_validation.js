$(document).ready(function() {
    $(".password_update").validate({
        rules: {
            current_password:{
                required: true,current_password:true
            },
            password:{
                required: true,pwd:true
            },
            password_confirmation:{
                required: true,pwd_con:true
            },
        },
       
        messages: {
            current_password:{
                required:"Please Enter Current Password",
            },
            password:{required:"Please Enter New Password"},
            password_confirmation:{required:"Please Enter Password Confirmation"},
        },
        highlight: function(element) {
            $(element).removeClass("error");
        },
    });
  
});

$.validator.addMethod(
    "current_password",
    function(value) {
        var current_password = 0;
        var id = $("#id").val();
        var current_password = $.ajax({
            url: aurl + "/current-password-validate",
            type: "POST",
            async: false,
            data: {
                current_password: value,
                id: id,
            },
        }).responseText;
        if (current_password != 0) {
            return false;
        } else return true;
    },
    "Your Old Password Does Not Matches With The Password You Provided. Please Try Again."
);

$.validator.addMethod(
    "pwd",
    function(value) {
        var pwd = 0;
        var id = $("#id").val();
        var old_password = $("#current_password").val();
        var pwd = $.ajax({
            url: aurl + "/password-validate",
            type: "POST",
            async: false,
            data: {
                password: value,
                old_password:old_password,
                id: id,
            },
        }).responseText;
        if (pwd != 0) {
            return false;
        } else return true;
    },
    "New Password Cannot Be Same As Your Current Password. Please Choose A Different Password."
);

$.validator.addMethod(
    "pwd_con",
    function(value) {
        var pwd_con = 0;
        var id = $("#id").val();
        var password = $("#password").val();
        var pwd_con = $.ajax({
            url: aurl + "/password-confirmation-validate",
            type: "POST",
            async: false,
            data: {
                pwd_con: value,
                password:password,
                id: id,
            },
        }).responseText;
        if (pwd_con != 0) {
            return false;
        } else return true;
    },
    "Confirm Password Same As Your New Password. Please Enter Same Password."
);