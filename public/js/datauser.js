$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});
$("#mytable").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: "getuser",
        type: "GET"
    },

    columns: [
        { data: "id", name: "id", visible: false },
        { data: "name", name: "name" },
        { data: "email", name: "email" },
        { data: "role", name: "role", 'orderable': false, 'searchable': false },
        { data: "updated_at", name: "updated_at" },
        { data: "action", name: "action" }
    ],
    order: [[0, "desc"]]
});

if ($("#userForm").length > 0) {
    $("#userForm").validate({
        submitHandler: function (form) {
            var actionType = $("#btn-save").val();
            $("#btn-save").html("Sending..");

            $.ajax({
                data: $("#userForm").serialize(),
                url: "ajax-crud-list/store/",
                type: "POST",
                dataType: "json",
                success: function (data) {
                    $("#userForm").trigger("reset");
                    $("#ajax-crud-modal").modal("hide");
                    $("#btn-save").html("Save Changes");
                    $("#message").css("display", "block");
                    $("#message").html(data.message);
                    $("#message").addClass(data.class_name);
                    var oTable = $("#mytable").dataTable();
                    oTable.fnDraw(false);
                },
                error: function (data) {
                    console.log("Error:", data);
                    $("#btn-save").html("Save Changes");
                }
            });
        }
    });
}
/*  When user click add user button */
$("#create-new-user").click(function () {
    $("#btn-save").val("create-user");
    $.get("getRole", function (data) {
        $("#user_id").val("");
        $("#userForm").trigger("reset");
        $("#userCrudModal").html("Add New user");
        $("#ajax-crud-modal").modal("show");
        if ($("#roleh").has("option").length == 0) {
            var datas = data.rolek;
            var rolet = "";
            for (var key in datas) {
                rolet =
                    rolet +
                    '<option value="' +
                    key +
                    '">' +
                    datas[key] +
                    "</option>";
            }
            $("#roleh").append(rolet);
        }
    });
});

/* When click edit user */
$("body").on("click", ".edit-user", function () {
    var user_id = $(this).data("id");
    $.get("ajax-crud-list/" + user_id + "/edit", function (data) {
        $("#name-error").hide();
        $("#email-error").hide();
        $("#userCrudModal").html("Edit User");
        $("#btn-save").val("edit-user");

        $("#ajax-crud-modal").modal("show");
        $("#user_id").val(data.user["id"]);
        $("#name").val(data.user["name"]);
        $("#email").val(data.user["email"]);
        var roli = data.rolid;
        if ($("#roleh").has("option").length == 0) {
            var datas = data.cats;

            console.log(roli);
            var rolet = "";
            for (var key in datas) {
                rolet =
                    rolet +
                    '<option value="' +
                    key +
                    '">' +
                    datas[key] +
                    "</option>";
            }
            $("#roleh").append(rolet);
        }
        $("#roleh").val(roli);
        // $('#ajax-crud-modal')[0].reset();
    });
});

var user_id;

$("body").on("click", "#delete-user", function () {
    user_id = $(this).attr("data-id");
    // alert(id);
    $("#confirmModal").modal("show");
});

$("#ok_button").click(function () {
    $.ajax({
        url: "ajax-crud-list/delete/" + user_id,
        type: "post",
        beforeSend: function () {
            $("#ok_button").text("Menghapus...");
        },
        success: function (data) {
            $("#confirmModal").modal("hide");
            var oTable = $("#mytable").dataTable();
            oTable.fnDraw(false);
            $("#ok_button").text("OK");
        },
        error: function (data) {
            console.log("Error:", data);
        }
    });
});

// $("body").on("click", "#delete-user", function() {
//     var user_id = $(this).data("id");
//     confirm("Are You sure want to delete !");
//     $.ajax({
//         type: "post",
//         url: "ajax-crud-list/delete/" + user_id,
//         success: function(data) {
//             var oTable = $("#mytable").dataTable();
//             oTable.fnDraw(false);
//         },
//         error: function(data) {
//             console.log("Error:", data);
//         }
//     });
// });
