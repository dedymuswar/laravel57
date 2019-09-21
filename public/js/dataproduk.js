$.ajaxSetup({
    header: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

$("#tableProduk").DataTable({
    //menampilkan povover data user dikanan
    drawCallback: function () {
        $(".metan").popover({
            trigger: "hover",
            content: myfetchData, //memanggil fungsi myfetch data
            html: true,
            placement: "right"
        });
    },

    processing: true,
    serverSide: true,
    ajax: {
        url: "getproduk",
        type: "GET"
    },

    columns: [
        { data: "id", name: "id", visible: false },
        { data: "name", name: "name" },
        { data: "created_at", name: "created_at" },
        { data: "updated_at", name: "updated_at" },
        { data: "action", name: "action" }
    ],
    order: [[0, "desc"]]
});

function myfetchData() {
    var fetch_data = "";
    var element = $(this);
    var id = element.attr("id");
    $.ajax({
        url: "getDetail/" + id + "/edit",
        method: "get",
        async: false,
        success: function (data) {
            fetch_data = data;
        }
    });
    return fetch_data;
}

/*  When user click add produk button */
$("#create-new-produk").click(function () {
    $("#btn-simpan").val("create-produk");

    $.get("getKategori", function (data) {
        $("#post_id").val("");
        $("#produkForm").trigger("reset");
        $("#produkCrudModal").html("Add New Produk");
        $("#ajax-crud-modal-produk").modal("show");
        $("#uploaded_image").html(
            "<img src=/images/noimage.jpg width='400' height='400' class='img-thumbnail' />"
        );
        if ($("#kategor").has("option").length == 0) {
            var datas = data.kategori;

            // console.log(roli);
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
            $("#kategor").append(rolet);
        }
    });
});

/* When click edit produk */
$("body").on("click", ".edit-produk", function () {
    var produk_id = $(this).data("id");
    $.get("ajax-crud-list-produk/" + produk_id + "/edit", function (data) {
        $("#name-error").hide();
        $("#email-error").hide();
        $("#produkCrudModal").html("Edit Produk");
        $("#btn-simpan").val("edit-produk");

        $("#ajax-crud-modal-produk").modal("show");
        $("#id_produk").val(data.produk["id"]);
        $("#name_produk").val(data.produk["name"]);
        $("#harga").val(data.produk["price"]);
        $("#deskripsi").val(data.produk["deskripsi"]);
        $("#select_file").val("");
        $("#uploaded_image").html(
            "<img src=/images/" +
            data.produk["thumb"] +
            " width='400' height='400' class='img-thumbnail' />"
        );
        var roli = data.kategori;
        if ($("#kategor").has("option").length == 0) {
            var datas = data.cats;

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
            $("#kategor").append(rolet);
        }
        $("#kategor").val(roli);
    });
});

$("#produkForm").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
        url: "ajax-crud-list-produk/store",
        method: "POST",
        data: new FormData(this),
        dataType: "JSON",
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            $("#btn-simpan").html("Save Changes");
            $("#ajax-crud-modal-produk").modal("hide");
            var oTable = $("#tableProduk").dataTable();
            oTable.fnDraw(false);

            $("#message").css("display", "block");
            $("#message").html(data.message);
            $("#message").addClass(data.class_name);
            // $("#ajax-crud-modal-produk")[0].reset();
        },
        error: function (data) {
            console.log("Error:", data);
        }
    });
});

if ($("#uploadGambar").length > 0) {
    $("#uploadGambar").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: "{{ route('postUpload') }}",
            method: "POST",
            data: new FormData(this),
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#message").css("display", "block");
                $("#message").html(data.message);
                $("#message").addClass(data.class_name);
                $("#uploaded_image").html(data.uploaded_image);
            }
        });
    });
}
$("#tableProduk").on("click", "#delete-produk", function () {
    id_produk = $(this).attr("data-id");
    $("#confirmModal").modal("show");
});

$("#ok_button").click(function () {
    $.ajax({
        url: "ajax-crud-list-produk/delete/" + id_produk,
        type: "post",
        beforeSend: function () {
            $("#ok_button").text("Menghapus...");
        },
        success: function (data) {
            $("#confirmModal").modal("hide");
            var oTable = $("#tableProduk").dataTable();
            oTable.fnDraw(false);
            $("#ok_button").text("OK");
        },
        error: function (data) {
            console.log("Error:", data);
        }
    });
});
