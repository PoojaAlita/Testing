// Listing User Details
if ($("#health-policy_tbl").length) {
    $("#health-policy_tbl").DataTable({
        aLengthMenu: [
            [10, 30, 50, -1],
            [10, 30, 50, "All"],
        ],
        iDisplayLength: 10,
        language: {
            search: "",
        },

        ajax: {
            type: "POST",
            url: aurl + "/health-policy/listing",
        },
        columns: [
            { data: "0" },
            { data: "1" },
            { data: "2" },
            { data: "3" },
            { data: "4" },
            { data: "5" },
            { data: "6" },
        ],
    });
}

$(document).ready(function() {
    $("#filename_employee").change(function(events) {
        var tmppath = URL.createObjectURL(events.target.files[0]);
        $(".empimage")
            .fadeIn("fast")
            .attr("src", URL.createObjectURL(events.target.files[0]));
    });
    if ($("#health_policy_form").length) {
        jQuery.validator.addMethod("number_val", function(value, element) {
            return (
                this.optional(element) ||
                /^\-?([0-9]+(\.[0-9]+)?|Infinity)$/i.test(value)
            );
        });
        $("#health_policy_form").validate({
            rules: {
                product: {
                    required: true,
                },
                branch: {
                    required: true,
                },
                business_year: {
                    required: true,
                },
                customer: {
                    required: true,
                },
                agent_code: {
                    required: true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                },
                company: {
                    required: true,
                },
                company_branch_name: {
                    required: true,
                },
                branch_imd: {
                    required: true,
                },
                sub_product: {
                    required: true,
                },
                product_type: {
                    required: true,
                },
                policy_tenure: {
                    required: true,
                },

                sum_insured: {
                    required: true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                },
                od: {
                    required: true,
                    number_val: true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                },
                gst: {
                    required: true,
                    number_val: true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                },
                payment_type: {
                    required: true,
                },
                cash_amount: {
                    required: true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                },
                cheque_bank: {
                    required: true,
                },
                cheque_account_number: {
                    required: true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                },
                cheque_number: {
                    required: true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                },
                cheque_date: {
                    required: true,
                },
                cheque_amount: {
                    required: true,
                    number_val: true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                },
                dd_bank: {
                    required: true,
                },
                dd_account_number: {
                    required: true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                },
                dd_number: {
                    required: true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                },
                dd_date: {
                    required: true,
                },
                dd_amount: {
                    required: true,
                    number_val: true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                },
                transaction_bank: {
                    required: true,
                },
                transaction_number: {
                    required: true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                },
                transaction_date: {
                    required: true,
                },
                online_amount: {
                    required: true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                },
            },
            messages: {
                product: {
                    required: "Please Select Product",
                },
                branch: {
                    required: "Please Select Branch",
                },
                business_year: {
                    required: "Please Select Month",
                },
                customer: {
                    required: "Please Select Customer",
                },
                agent_code: {
                    required: "Please Enter Agent Code",
                },
                company: {
                    required: "Please Select Company",
                },
                company_branch_name: {
                    required: "Please Select Company Branch",
                },
                branch_imd: {
                    required: "Please Select Branch Imd Name",
                },
                sub_product: {
                    required: "Please Select Sub Product",
                },
                product_type: {
                    required: "Please Select Product Type",
                },
                policy_tenure: {
                    required: "Please Select Policy Tenure",
                },

                sum_insured: {
                    required: "Please Enter Sum Insured",
                },
                od: {
                    required: "Please Enter OD",
                    number_val: "Only Numbers and . value Allow",
                },
                gst: {
                    required: "Please Enter GST",
                    number_val: "Only Numbers and . value Allow",
                },
                payment_type: {
                    required: "Please Select Payment Type",
                },
                cash_amount: {
                    required: "Please Enter Amount",
                    number_val: "Only Numbers and . value Allow",
                },
                cheque_bank: {
                    required: "Please Select Bank Name",
                },
                cheque_account_number: {
                    required: "Please Enter Cheque Account Number",
                },
                cheque_number: {
                    required: "Please Enter Cheque Number",
                },
                cheque_date: {
                    required: "Please Select Cheque Date",
                },
                cheque_amount: {
                    required: "Please Enter Cheque Amount",
                },
                dd_bank: {
                    required: "Please Select Bank Name",
                },
                dd_account_number: {
                    required: "Please Enter Account Number",
                },
                dd_number: {
                    required: "Please Enter Number",
                },
                dd_date: {
                    required: "Please Select Date",
                },
                dd_amount: {
                    required: "Please Enter Amount",
                    number_val: "Only Numbers and . Value Allow",
                },
                transaction_bank: {
                    required: "Please Select Bank Name",
                },
                transaction_number: {
                    required: "Please Enter Transaction Number",
                },
                transaction_date: {
                    required: "Please Select Transaction Date",
                },
                online_amount: {
                    required: "Please Enter Amount",
                },
            },
            errorPlacement: function(error, element) {
                if (
                    element.parents("div").hasClass("has-feedback") ||
                    element.hasClass("select2-hidden-accessible")
                ) {
                    error.appendTo(element.parent());
                } else if (
                    element.parents("div").hasClass("uploader") ||
                    element.hasClass("datepicker")
                ) {
                    error.appendTo(element.parent().parent());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element) {
                $(element).removeClass("error");
            },
        });
        $.validator.addMethod("employeeEmailCheck", function(value) {
            var x = 0;
            var id = $(".employee_id").val();
            var x = $.ajax({
                url: aurl + "/health-policy/employee-check",
                type: "POST",
                async: false,
                data: { title: value, id: id },
            }).responseText;
            if (x != 0) {
                return false;
            } else return true;
        });
        $.validator.addMethod("pwcheck", function(value, element) {
            return (
                value.match(/[a-z]/) &&
                value.match(/[A-Z]/) &&
                value.match(/[0-9]/) &&
                value.match(/[_!#@$%^&*]/)
            );
        });
    }

    /* adding and updating employee data */
    $(".submit_policy").on("click", function(event) {
        event.preventDefault();
        var form = $("#health_policy_form")[0];
        var formData = new FormData(form);
        if ($("#health_policy_form").valid()) {
            $.ajax({
                url: aurl + "/health-policy",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#employee_modal").modal("hide");
                    toaster_message(data.message, data.icon, data.redirect_url);
                },
                error: function(request) {
                    toaster_message("Something Went Wrong! Please Try Again.", "error");
                },
            });
        }
    });

    /* display update employee modal */
    $("body").on("click", ".employee_edit", function(event) {
        var id = $(this).data("id");
        $(".employee_id").val(id);
        event.preventDefault();
        $.ajax({
            url: aurl + "/employee/{" + id + "}",
            type: "GET",
            data: { id: id },
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    $("#health_policy_form").validate().resetForm();
                    $("#health_policy_form").trigger("reset");
                    $("#title_employee_modal").text("Update employee");
                    $("#employee_modal").modal("show");
                    $(".submit_employee").text("Update employee");
                    $(".name").val(data.name);
                } else {
                    toaster_message(data.message, data.icon, data.redirect_url);
                }
            },
            error: function(request) {
                toaster_message("Something Went Wrong! Please Try Again.", "error");
            },
        });
    });
    $("body").on("change", "#od", function(event) {
        total_premium();
    });
    $("body").on("change", "#gst", function(event) {
        total_premium();
    });
});

function total_premium() {
    var od = parseInt($("#od").val());
    var gst = parseInt($("#gst").val());
    console.log(od, gst);
    if (!isNaN(od) && !isNaN(gst)) {
        value = $(".chkgstvalue").prop("checked") ? gst : (gst * od) / 100;
        $("#total_premium").val(od + value);
    } else {
        $("#total_premium").val("");
    }
}

function gstValueChange() {
    $("#gst").attr(
        "placeholder",
        $(".chkgstvalue").prop("checked") ? "Enter GST" : "Enter GST in %"
    );
}