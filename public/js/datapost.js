// var count = 1;
// dinamic_fil(count);

// function dinamic_fil(number) {
//     html = "<tr>";
//     html +=
//         '<td><input type="text" name="title[]" class="form-control" /></td>';
//     html += '<td><input type="text" name="body[]" class="form-control" /></td>';

//     if (number > 1) {
//         html +=
//             '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Hapus</button></td></tr>';
//         $("tbody").append(html);
//     } else {
//         html +=
//             '<td><button type="button" name="add" id="add" class="btn btn-success">Tambah</button></td></tr>';
//         $("tbody").html(html);
//     }
// }

// $(document).on("click", "#add", function() {
//     count++;
//     dinamic_fil(count);
// });

// $(document).on("click", ".remove", function() {
//     count--;
//     $(this)
//         .closest("tr")
//         .remove();
// });

// $("#dinamis-form").on("submit", function() {
//     event.preventDefault();
//     $.ajax({
//         url: "insertPost",
//         method: "post",
//         data: $(this).serialize(),
//         dataType: "json",
//         beforeSend: function() {
//             $("#save").attr("disable", "disable");
//         },
//         success: function(data) {
//             if (data.error) {
//                 var error_html = "";
//                 for (var count = 0; count < data.error.length; count++) {
//                     error_html += "<p>" + data.error[count] + "</p>";
//                 }
//                 $("#result").html(
//                     '<div class="alert alert-danger">' + error_html + "</div> "
//                 );
//             } else {
//                 dinamic_fil(1);
//                 $("#result").html(
//                     '<div class="alert alert-success">' +
//                         data.success +
//                         "</div>"
//                 );
//             }
//             $("#save").attr("disable", false);
//         }
//     });
// });
