var li;
$(document).ready(function () {

    li = links();


});


function start_first(type, ch) {
    getNotice(0, type);
}

function getNotice(ids, type) {


    var li = links();


    var id = "";
    var show = ids;
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'transaction/getNotification/',
        data: {id: id, show: show, type: type},
        success: function (data) {


            if (data.id == 1) {


                alert('please login again...');
            }
            else {


                var stuff = "";
                var count = 0;
                $.each(data.posts, function (key, val) {

                    if (type == 10) {
                        stuff = stuff + "<tr>"

                            + "<td><a href='#'><strong>Incomplete Journal No => " + val.voucher + "</strong></a></td>"


                            + "</tr>";

                        count++;

                    }
                    else {


                        var res = encodeURI(val.sname);

                        stuff = stuff + "<li><a onclick=go_invoice(" + val.invoice_id + "," + val.type + "," + type + ",'" + val.ware + "','" + res + "') href='#'>Invoice :" + val.invoice_id + "</a></li>";

                        stuff = stuff + "<div class='divider'></div>";


                        count++;
                    }


                });

                document.getElementById("count").innerHTML = count;
                document.getElementById("details").innerHTML = stuff;

            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            //alert("Server Error");
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found.');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error.');
            } else if (errorThrown === 'parsererror') {
                alert('Requested JSON parse failed');
            } else if (errorThrown === 'timeout') {
                alert('Time out error');
            } else if (errorThrown === 'abort') {
                alert('Ajax request aborted ');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }

        }
    });


}

