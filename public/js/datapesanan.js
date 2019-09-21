var count = 1;
dinamic_fil(count);
function dinamic_fil(number) {
    html = "<tr>";
    html += `<td><select class="form-control" id="rolep" name="produk[]">
                <option>-Select Produk-</option>`;
    html += getOption();
    html += `</select></td>`;
    html += `<td><select id="qty" name="qty[]" class="form-control qty">
            <option selected value="0">--Select Qty--</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
    </select></td>`;
    html +=
        '<td><input type="text" id="hargalama" name="satuan[]" class="form-control hargalama"  readonly></td>';
    html +=
        '<td><input type="text" id="harga" name="price[]" class="form-control harga" readonly></td>';
    if (number > 1) {
        html +=
            '<td><button type="button" name="hapus" id="" class="btn btn-danger remove hapus"><i class="fa fa-minus-circle"></i> Hapus</button></td></tr>';
        $("#tablePesanan tbody").append(html);
    } else {
        html +=
            '<td><button type="button" name="tambah" id="tambah" class="btn btn-success add"><i class="fa fa-plus-circle"></i> Tambah</button></td></tr>';
        $("#tablePesanan tbody").html(html);
    }
}

$(document).on("change", "#qty", function () {
    var currentRow = $(this).closest("tr");
    var kuantiti = $(this).val();
    var hargalama = currentRow.find("input#hargalama").val();
    var hasil = kuantiti * hargalama;

    currentRow.find("td #harga").val(hasil);
    findTotal();
});

$("#tablePesanan").on("change", "#rolep", function () {
    var idProduk = $(this).val();
    var currentRow = $(this).closest("tr");
    currentRow.find("td #qty").prop("selectedIndex", 0);
    $hasil = "";
    $("#formOrder #total").val(0);
    event.preventDefault();
    $.ajax({
        url: "getPrice/" + idProduk + "/edit",
        method: "get",
        dataType: "json",
        success: function (data) {
            var qty = currentRow.find("td .qty").val();
            var datahasil = data * qty;
            $hasil = currentRow.find("td .harga").val(datahasil);
            currentRow.find("td #hargalama").val(data);
            console.log($hasil);
        },
        error: function (data) {
            console.log("Error:", data);
        }
    });
    return $hasil;
});

function findTotal() {
    var arr = document.getElementsByName("price[]");

    var tot = 0;
    for (var i = 0; i < arr.length; i++) {
        if (parseInt(arr[i].value)) tot += parseInt(arr[i].value);
    }
    var hasil = "Rp." + tot;
    $("#formOrder #total").val(tot);
    $("#formOrder #total").number(true);
}
$(document).on("click", "#tambah", function () {
    count++;
    dinamic_fil(count);
});

$(document).on("click", ".hapus", function () {
    count--;
    $(this)
        .closest("tr")
        .remove();
    findTotal();
});

function getOption() {
    $output = "";
    $hasil = "";
    $.ajax({
        url: "ambilProduk",
        method: "get",
        dataType: "json",
        success: function (data) {
            var datas = data.cats;
            $output = $("#formOrder #rolep").append(datas);
        },
        error: function (data) {
            console.log("Error:", data);
        }
    });
    return [$output];
}

$("#tablePesanan").on("click", "#ok_simpan", function () {
    var totald = $("#total").val();

    // alert(totald);
    if (totald > 1) {
        $.ajax({
            data: $("#formOrder").serialize(),
            url: "submitProduk",
            type: "POST",
            dataType: "json",
            success: function (data) {
                dinamic_fil(0);
                $("#formOrder")[0].reset();
                var pesanan = data.pesanan;

                $("#newtable").prepend(pesanan);
                $("#totals").html(data.total);
                $("#totals").number(true);
                $("#order_id").html(data.order_id);
                if (data.success) {
                    $("#hasilflash").html(
                        '<div class="alert alert-success">' +
                        data.success +
                        "</div>"
                    );
                } else {
                    $("#hasilflash").html(
                        '<div class="alert alert-danger"><strong>Maaf,</strong>anda belum membuat pesanan apapun!</div>'
                    );
                }
            },
            error: function (data) {
                console.log("Error:", data);
            }
        });
        $("#confirmModal").modal("show");
    } else {
        var pesan =
            '<div class="alert alert-danger"><strong>Ooopss!!!, </strong>Harap input item kuantiti terlebih dahulu!</div>';
        $("#result").html(pesan);
    }
});

$("#confirmModal #keluar").on("click", function () {
    $("#confirmModal").modal("hide");
    $("#newtable")[0].reset();
});
