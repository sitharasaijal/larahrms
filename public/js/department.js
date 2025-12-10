$("#submit_department").click(function () {
    if ($("#department_name").val() == "") {
        $("#department_name").css("border-color", "red");
        $("#department_name").focus();
        return false;
    } else {
        $("#department_name").css("border-color", "");
        var name = $("#department_name").val();
    }
    if ($("#status").val() == "") {
        $("#status")
            .parent()
            .find(".select2-selection--single")
            .addClass("required");
        $("#status").focus();
        return false;
    } else {
        $("#status")
            .parent()
            .find(".select2-selection--single")
            .removeClass("required");
        var status = $("#status").val();
    }
    var id = $("#id").val();
    var data = {
        id: id,
        name: name,
        status: status,
    };
    $.confirm({
        title: "Confirm",
        content: "Are you sure want to submit",
        type: "orange",
        typeAnimated: true,
        buttons: {
            confirm: {
                text: "SUBMIT",
                btnClass: "btn-orange",
                action: function () {
                    $(".submit_department").html(
                        '<i class="fa fa-spinner fa-spin"></i> Submit'
                    );
                    $(".submit_department").prop("disabled", true);
                    $(".jconfirm-buttons > .btn-orange").html(
                        '<i class="fa fa-spinner fa-spin"></i> Submit'
                    );

                    $.ajax({
                        url: departmentPostUrl,
                        type: "POST",
                        async: false,
                        data: data,
                        success: function (data) {
                            try {
                                var json = jQuery.parseJSON(data);
                                var message = json.message;
                                if (json.status == true) {
                                    alert_message_modal(
                                        "alert-success",
                                        message,
                                        "AlertMessageModal"
                                    );
                                    setTimeout(function () {
                                        window.location = "";
                                    }, 2000);
                                } else {
                                    alert_message_modal(
                                        "alert-danger",
                                        message,
                                        "AlertMessageModal"
                                    );
                                }
                            } catch (e) {
                                alert(e);
                            }
                            $(".submit_department").html("Submit");
                            $(".submit_department").prop("disabled", false);
                            $(".jconfirm-buttons > .btn-orange").html("Submit");
                        },
                    });
                },
            },
            cancel: {
                text: "Cancel",
                btnClass: "btn-danger",
                action: function () {},
            },
        },
    });
});
$(document).ready(function () {
    if (segment1 == "departments") {
        // Initialize all selects with class "select"
        $("#add_update_department .select").select2({
            dropdownParent: $("#add_update_department"), // Important for modals
            width: "100%",
            placeholder: "Select",
            allowClear: true,
        });
        $(".add_update_button_department").on("click", function () {
            var id = $(this).attr("id");
            if (id) {
                $(".department_modal_title").text("Update Department");
                $.ajax({
                    url: getDepartmentByIdUrl.replace(":id", id),
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $("#id").val(data.id);
                        $("#department_name").val(data.name);
                        $("#status").val(data.status).trigger("change");
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                        alert("Could not fetch department data.");
                    },
                });
            } else {
                $(".department_modal_title").text("Add Department");
            }
        });
    }
});
