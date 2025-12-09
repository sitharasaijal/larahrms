$(document).ready(function () { 
    
    $("#submit_forgot_password").click(function () {
        if ($("#email").val() == "") {
            $("#email").css("border-color", "red");
            $("#email").focus();
            if (language == "en") {
                alert_message("alert-danger", "Email required");
            } else {
                alert_message("alert-danger", "البريد الإلكتروني (مطلوب");
            }
            return false;
        } else {
            $("#email").css("border-color", "");
        }
        var data = {};
        data["email"] = $("#email").val();
        $.ajax({
            url: base_url + "Login/check_forgot_password",
            async: false,
            type: "POST",
            data: data,
            success: function (data) {
                try {
                    var json = jQuery.parseJSON(data);
                    if (language == "en") {
                        var message = json.message;
                    } else {
                        var message = json.message_ar;
                    }
                    if (json.status == true) {
                        alert_message("alert-success", message);
                        setTimeout(function () {
                            window.location = json.redirect_url;
                        }, 2000);
                    } else {
                        alert_message("alert-danger", message);
                    }
                } catch (e) {
                    alert(e);
                }
            },
        });
    });
    $("#submit_reset_password").click(function () {
        if ($("#password").val() == "") {
            $("#password").focus();
            $("#password").css("border-color", "red");
            if (language == "en") {
                alert_message("alert-danger", "Password required");
            } else {
                alert_message("alert-danger", "كلمة المرور مطلوبة");
            }
            return false;
        } else {
            $("#password").css("border-color", "");
        }
        if ($("#confirm_password").val() == "") {
            $("#confirm_password").focus();
            $("#confirm_password").css("border-color", "red");
            if (language == "en") {
                alert_message("alert-danger", "Confirm Password required");
            } else {
                alert_message("alert-danger", "مطلوب تأكيد كلمة المرور");
            }
            return false;
        } else {
            $("#confirm_password").css("border-color", "");
        }
        if ($("#password").val() != $("#confirm_password").val()) {
            $("#confirm_password").focus();
            if (language == "en") {
                alert_message("alert-danger", "Both fields must match");
            } else {
                alert_message("alert-danger", "يجب أن يتطابق كلا الحقلين");
            }
            return false;
        }
        var data = {};
        data["password"] = $("#password").val();
        data["id"] = $("#employee_id").val();
        $.ajax({
            url: base_url + "Login/check_reset_password",
            async: false,
            type: "POST",
            data: data,
            success: function (data) {
                try {
                    var json = jQuery.parseJSON(data);
                    if (language == "en") {
                        var message = json.message;
                    } else {
                        var message = json.message_ar;
                    }
                    if (json.status == true) {
                        alert_message("alert-success", message);
                        setTimeout(function () {
                            window.location = json.redirect_url;
                        }, 2000);
                    } else {
                        alert_message("alert-danger", message);
                    }
                } catch (e) {
                    alert(e);
                }
            },
        });
    });
});

$(document).keypress(function (e) {
    if (e.which == 13) {
        $("#submitlogin").click();
    }
});


$(document).ready(function() {
    // Check if there is an error message
    if ($('#error-text-message').length) {
        // Set a timeout to hide the message after 5 seconds (5000 milliseconds)
        setTimeout(function() {
            $('#error-text-message').fadeOut(); // You can also use .hide() to hide instantly
        }, 5000);
    }
});
