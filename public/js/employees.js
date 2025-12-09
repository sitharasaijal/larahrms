$("#submit_department").click(function () {
    if ($("#name").val() == "") {
        $("#name").css("border-color", "red");
        $("#name").focus();
        return false;
    } else {
        $("#name").css("border-color", "");
        var name = $("#name").val();
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
                        url: base_url + "/post-department",
                        type: "POST",
                        async: false,
                        data: data,
                        success: function (data) {
                            try {
                                var json = jQuery.parseJSON(data);
                                var message = json.message;
                                if (json.status == "success") {
                                    alert_message_modal(
                                        "alert-success",
                                        message
                                    );
                                    setTimeout(function () {
                                        //window.location = base_url + 'departments';
                                    }, 2000);
                                } else {
                                    alert_message_modal(
                                        "alert-danger",
                                        message
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
    // Make sure CSRF token is included
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    function loadEmployeesTable() {
        // Get form data as array
        var formdata = $("#employees_search_form").serializeArray();
        var dataObj = { _token: csrfToken }; // Add CSRF token

        // Add form fields to dataObj
        formdata.forEach(function (item) {
            dataObj[item.name] = item.value;
        });

        $("#employees_table").DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            responsive: true,
            ajax: {
                url: employeesDataUrl,
                type: "POST",
                data: function (d) {
                    return $.extend({}, d, dataObj);
                },
            },
            columns: [
                { data: "slno" },
                { data: "full_name" },
                { data: "employee_id" },
                { data: "email" },
                { data: "phone" },
                { data: "department" },
                { data: "designation" },
                { data: "status" },
                { data: "actions", orderable: false, searchable: false },
            ],
        });
    }

    // Initial load
    loadEmployeesTable();

    // Reload on filter change
    $("#employees_search_form input, #employees_search_form select").on(
        "change keyup",
        function () {
            $("#employees_table").DataTable().destroy();
            loadEmployeesTable();
        }
    );

    // Initialize all selects with class "select"
    $("#add_department .select").select2({
        dropdownParent: $("#add_department"), // Important for modals
        width: "100%",
        placeholder: "Select",
        allowClear: true,
    });
});
