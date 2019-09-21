$.ajaxSetup({
    header: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

load_data();

function load_data(from_date = "", to_date = "") {
    $("#tableDateRange").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "daftarOrder",
            data: { from_date: from_date, to_date: to_date }
        },
        columns: [
            { data: "id", name: "id", visible: false },
            { data: "order", name: "order" },
            { data: "order_total", name: "order_total" },
            { data: "order_date", name: "order_date" },
            { data: "action", name: "action" }
        ],
        order: [[0, "desc"]]
    });
}

$("#filter").click(function () {
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    if (from_date != "" && to_date != "") {
        $("#tableDateRange")
            .DataTable()
            .destroy();
        load_data(from_date, to_date);
    } else {
        $("#result").html(
            '<div class="alert alert-danger ml-3 mr-3 mt-2">Field form date dan to date wajib di isi</div>'
        );
    }
});

$("#refresh").click(function () {
    $("#from_date").val("");
    $("#to_date").val("");
    $("#tableDateRange")
        .DataTable()
        .destroy();
    load_data();
});

$(".input-daterange").datepicker({
    todayBtn: "linked",
    format: "yyyy-mm-dd",
    autoclose: true
});

$("#tableDateRange").on("click", ".view-detail", function () {
    $("#detailOrder tbody").empty();
    $("#order_id").html('');
    var idku = $(this).data("id");
    $.get("get-detail-order/" + idku + "/detail", function (data) {

        $("#modal-detail").modal("show");
        $("#bodyku").html(data.output);
        $("#hasil").prepend(data.nama_produk);
        $("#order_id").append(data.order_id);
        $("#hasil").append(data.order_total);
    });
});

$("#modal-detail #keluar").on("click", function () {
    $("#confirmModal").modal("hide");
    // $("#detailOrder")[0].reset();
});
