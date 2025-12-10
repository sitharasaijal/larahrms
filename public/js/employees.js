$(document).ready(function () {
    if (segment1 == "employees") {
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
    }
    if (segment1 == "departments") {
        // Initialize all selects with class "select"
        $("#add_update_department .select").select2({
            dropdownParent: $("#add_update_department"), // Important for modals
            width: "100%",
            placeholder: "Select",
            allowClear: true,
        });
        $(".add_update_department").on("click", function () {
            var id = $(this).attr("id");
            if (id) {
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
            }
        });
    }
});
