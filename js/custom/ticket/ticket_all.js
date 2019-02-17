var li = links();

function getTickettList(v) {
    var vv = $(v).val();
    if (vv != '') {
        $(v).addClass('ac_loading');
        $(v).autocomplete({
            source: function (request, response) {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: li + 'project/getSearchAssignedProjectList/',
                    data: {id: vv},
                    success: function (data) {
                        response(data);
                    }
                });
                $(v).removeClass('ac_loading');
            }
        });
    }
}

function add_new_ticket() {
    var ticket_id = $("#ticket_id").val();
    var opened_by = $("#opened_by").val();
    var project_id = $("#project_id").val();
    var ticket_subject = $("#ticket_subject").val();
    var ticket_priority = $("#ticket_priority").val();
    var ticket_message = $("#ticket_message").val();

    if (project_id != '' && project_id != 0 && ticket_subject != 0 && ticket_subject != ''
        && ticket_priority != 0 && ticket_priority != '' && ticket_message != 0 && ticket_message != '') {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'ticketing/add_new_ticket',
            data: {
                ticket_id: ticket_id,
                opened_by: opened_by,
                project_id: project_id,
                ticket_subject: ticket_subject,
                ticket_priority: ticket_priority,
                ticket_message: ticket_message,
            },
            success: function (data) {
                if (data.id == 2) {
                    //alert('inserted');
                    document.getElementById("message").innerHTML = "<h5 style=\"color: darkgreen;\" class=\"animated fadeOut delay-5s\">Succesfull</h5>";
                    $("#ticket_id").val('');
                    $("#project_id").val(0);
                    $("#ticket_subject").val('');
                    $("#ticket_priority").val(0);
                    $("#ticket_message").val('');
                    getAllTicketInfo();
                    $('#newTicketModal').modal('hide');
                } else if (data.id == 1) {
                    //alert('not inserted');
                    document.getElementById("message").innerHTML = "<h5 style=\"color: red;\" class=\"animated fadeOut delay-3s\">Failed </h5>";
                } else if (data.id == 3) {
                    $("#ticket_id").val('');
                    $("#project_id").val(0);
                    $("#ticket_subject").val('');
                    $("#ticket_priority").val(0);
                    $("#ticket_message").val('');
                    getAllTicketInfo();
                    $('#newTicketModal').modal('hide');
                    document.getElementById("message").innerHTML = "<h5 style=\"color: darkgreen;\" class=\"animated fadeOut delay-3s\">Updated</h5>";
                } else if(data.id == 4){
                    document.getElementById("message1").innerHTML = "<h5 style=\"color: red;\" class=\"animated fadeOut delay-3s\">Information Incomplete</h5>";
                } else
                    alert('Please Retry.....');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status === 0) {
                    alert('Not connect.\n Verify Network.');
                } else if (jqXHR.status == 404) {
                    alert('Requested page not found. [404] - Click \'OK\'');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error. [500] - Click \'OK\'');
                } else if (errorThrown === 'parsererror') {
                    alert('Requested JSON parse failed - Click \'OK\'');
                } else if (errorThrown === 'timeout') {
                    alert('Time out error - Click \'OK\' and try to re-submit your responses');
                } else if (errorThrown === 'abort') {
                    alert('Ajax request aborted ');
                } else {
                    alert('Uncaught Error.\n' + jqXHR.responseText + ' - Click \'OK\' and try to re-submit your responses');
                }
            }
        });

    }
    else {
        document.getElementById("message1").innerHTML = "<h5 style=\"color: red;\" class=\"animated fadeOut delay-2s\">Information Incomplete </h5>";
    }
}

function getAllTicketInfo(v) {

    var search_ticket = $("#search_ticket").val();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'ticketing/getAllTicketInfo/',
        data: {search_ticket: search_ticket},
        success: function (data) {
            viewAllTicketList(data);
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

function viewAllTicketList(data) {
    var stuff = "";
    var sl = 1;
    $.each(data.list, function (key, val) {
        stuff = stuff + "<tr class='text-center " + val.id + "tr'>"
            + "<td>" + (sl++) + "</td>"
            + "<td>" + val.project_name + "</td>"
            + "<td>" + val.ticket_subject + "</td>"
            + "<td>" + val.ticket_priority + "</td>"
            + "<td style='background-color: "+val.style+"'>" + val.ticket_status + "</td>"
            + "<td>" + val.rating + "</td>"
            + "<td>" + val.opened_by + "</td>"
            + "<td>" + val.is_hand_over + "</td>"
            + "<td>" + val.hand_over_by + "</td>"
            + "<td>" + val.hand_over_to + "</td>"
            + "<td>" + val.ticket_date + "</td>"

            + "<td>"
            if(val.type==1 ||val.type==2){
            stuff = stuff + "<a onclick = edit_ticket_details('"+val.id+"') class='btn btn-sm btn-info' data-toggle='modal' data-target='#newTicketModal' id='edit_ticket_details'><i class='fa fa-pencil'></i></a>"
            }
            stuff = stuff + "</td>"
            + "<td>"
            if(val.type==1|| val.type==2||val.type==3){
                stuff = stuff + "<a onclick = edit_ticket_details('"+val.id+"') class='btn btn-sm btn-info' data-toggle='modal' data-target='#TicketChangeStatusModal' id='edit_ticket_details'><i class='fa fa-toggle-on'></i></a>"
            }
            stuff = stuff + "</td>"
            + "<td>"
            if(val.type==1|| val.type==2||val.type==3||val.type==4){
                stuff = stuff + "<a onclick = reply_ticket_('"+val.id+"') class='btn btn-sm btn-info reply-ticket' target='_blank' data-toggle='tooltip' data-placement='top' title='Reply!'><i class='fa fa-reply'></i></a>"
            }
            stuff = stuff + "</td>"
            stuff = stuff + "</tr>";
    });
    $("#ticket_details_table_data").html(stuff);
}

function edit_ticket_details(id) {
    //alert(id);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'ticketing/getTicketInfo',
        data: {id: id},
        success: function (data) {
            $.each(data, function (key, val) {
                //alert(val.id);
                $("#ticket_id").val(val.id);
                $("#project_id").val(val.assigned_project_id);
                $("#ticket_subject").val(val.ticket_subject);
                $("#ticket_priority").val(val.ticket_priority);
                $("#ticket_message").val(val.ticket_message);
                $("#project_engineer").val(val.project_engineer);
                $("#is_hand_over").val(val.is_hand_over);
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404] - Click \'OK\'');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error. [500] - Click \'OK\'');
            } else if (errorThrown === 'parsererror') {
                alert('Requested JSON parse failed - Click \'OK\'');
            } else if (errorThrown === 'timeout') {
                alert('Time out error - Click \'OK\' and try to re-submit your responses');
            } else if (errorThrown === 'abort') {
                alert('Ajax request aborted ');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText + ' - Click \'OK\' and try to re-submit your responses');
            }
        }
    });
}

function hand_over_ticket(){

    var ticket_id = $("#ticket_id").val();
    var hand_over_by = $("#hand_over_by").val();
    var project_engineer = $("#project_engineer").val();
    var is_hand_over = $("#is_hand_over").val();

    if (project_engineer != '' && project_engineer != 0 && is_hand_over != 0 && is_hand_over != '') {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'ticketing/hand_over_ticket',
            data: {
                ticket_id: ticket_id,
                hand_over_by: hand_over_by,
                project_engineer: project_engineer,
                is_hand_over: is_hand_over,
            },
            success: function (data) {
                if (data.id == 2) {
                    getAllTicketInfo();
                    // $("#hand_over_by").val('');
                    $("#project_engineer").val(0);
                    $("#is_hand_over").val(0);
                    $('#TicketChangeStatusModal').modal('hide');
                    document.getElementById("message").innerHTML = "<h5 style=\"color: darkgreen;\" class=\"animated fadeOut delay-3s\">Updated</h5>";

                } else if (data.id == 1) {
                    //alert('not inserted');
                    document.getElementById("message").innerHTML = "<h5 style=\"color: red;\" class=\"animated fadeOut delay-3s\">Failed </h5>";
                } else
                    alert('Please Retry.....');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status === 0) {
                    alert('Not connect.\n Verify Network.');
                } else if (jqXHR.status == 404) {
                    alert('Requested page not found. [404] - Click \'OK\'');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error. [500] - Click \'OK\'');
                } else if (errorThrown === 'parsererror') {
                    alert('Requested JSON parse failed - Click \'OK\'');
                } else if (errorThrown === 'timeout') {
                    alert('Time out error - Click \'OK\' and try to re-submit your responses');
                } else if (errorThrown === 'abort') {
                    alert('Ajax request aborted ');
                } else {
                    alert('Uncaught Error.\n' + jqXHR.responseText + ' - Click \'OK\' and try to re-submit your responses');
                }
            }
        });

    }
    else {
        document.getElementById("message2").innerHTML = "<h5 style=\"color: red;\" class=\"animated fadeOut delay-2s\">Information Incomplete </h5>";
    }
}

function reply_ticket_(id) {
    //alert(id);
    window.location = li + "ticket/reply_message/"+id;
}
