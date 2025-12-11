$("#submit_designation").click(function () {
    if ($("#designation_name").val() == "") {
        $("#designation_name").css("border-color", "red");
        $("#designation_name").focus();
        return false;
    } else {
        $("#designation_name").css("border-color", "");
        var name = $("#designation_name").val();
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
                    $(".submit_designation").html(
                        '<i class="fa fa-spinner fa-spin"></i> Submit'
                    );
                    $(".submit_designation").prop("disabled", true);
                    $(".jconfirm-buttons > .btn-orange").html(
                        '<i class="fa fa-spinner fa-spin"></i> Submit'
                    );

                    $.ajax({
                        url: designationPostUrl,
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
                            $(".submit_designation").html("Submit");
                            $(".submit_designation").prop("disabled", false);
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
    if (segment1 == "designations") {
        // Initialize all selects with class "select"
        $("#add_update_designation .select").select2({
            dropdownParent: $("#add_update_designation"), // Important for modals
            width: "100%",
            placeholder: "Select",
            allowClear: true,
        });
        $(".add_update_button_designation").on("click", function () {
            var id = $(this).attr("id");
            if (id) {
                $(".designation_modal_title").text("Update Designation");
                $.ajax({
                    url: getDesignationByIdUrl.replace(":id", id),
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $("#id").val(data.id);
                        $("#designation_name").val(data.name);
                        $("#status").val(data.status).trigger("change");
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                        alert("Could not fetch designation data.");
                    },
                });
            } else {
                $(".designation_modal_title").text("Add Designation");
            }
        });
    }
});
