
$(document).ready(function() {
	li = links();
});
var li;

$('#createTicket').on('click',function(){
	//alert('ok');
	var ticket_sub = $('#ticket_subject').val();
	var message = $('#message').val();
	var priority = $('#priority').val();

	// alert(ticket_sub);
	// alert(message);
	// alert(priority);

	if(ticket_sub===""){
		alert('Please give your ticket subject!');
	}else if(message===""){
		alert('Please give your ticket message!');
	}else{
		$.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'ticket/add_ticket',
            data: {
                ticket_sub: ticket_sub,
                message: message,
                priority: priority
                //ticket_status: ticket_status,
                //rate: rate
            },
            success: function(data) {

                alert("Ticked inserted!");
                window.location = li + 'ticket/all_ticket';
            },
            error: function(jqXHR, textStatus, errorThrown) {
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
	
});


//for rating start
$('.modal-review__rating-order-wrap > span').click(function() {
    $(this).addClass('active').siblings().removeClass('active');
    $(this).parent().attr('data-rating-value', $(this).data('rating-value'));
});
//for rating end


$('.edit-ticket').on('click',function () {
    jQuery("#editTicketModal").modal('show');
    var ticket_id = $(this).attr("ticket-id");
    var message_id = $(this).attr("message-id");
    //alert(ticket_id);

    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'ticket/fetch_ticket',
            data: {
                ticket_id: ticket_id
            },
            success: function(data) {
                //console.log(data);
                $("#ticket_id_edit").val(data.ticket_id);
                $("#message_id_edit").val(data.message_id);
                $('#edit_ticket_subject').val(data.ticket_sub);
                $('#edit_message').val(data.message);
                //$("."+data.priority_id+"priorityList").prop("selected",true);
                //$("."+data.ticket_status_id+"ticketStatusList").prop("selected",true);
                // $(".modal-review__rating-order-wrap").attr('data-rating-value',data.rating);
            },
            error: function(jqXHR, textStatus, errorThrown) {
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
});


$('#updateTicket').on('click',function () {
    var ticket_sub = $('#edit_ticket_subject').val();
    var message = $('#edit_message').val();
    //var priority = $('#edit_priority').val();
    //var ticket_status = $('#edit_ticket_status').val();
    var ticket_id = $('#ticket_id_edit').val();
    var message_id = $('#message_id_edit').val();
    //alert(ticket_id);

    if(ticket_sub===""){
        alert('Please give your ticket subject!');
    }else {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'ticket/update_ticket',
            data: {
                ticket_sub: ticket_sub,
                message: message,
                message_id: message_id,
                //priority: priority,
                //ticket_status: ticket_status,
                ticket_id: ticket_id
            },
            success: function(data) {
                //console.log(data);
                if (data.sts==1)
                {
                    $('#'+ticket_id+" td:nth-child(2)").html(ticket_sub);
                    //$('#'+ticket_id+" td:nth-child(3)").html(message);
                    //$('#'+ticket_id+" td:nth-child(5)").html(data.temp[0].priority);
                    //$('#'+ticket_id+" td:nth-child(6)") .html(data.temp[0].ticket_status);

                }else if(data.sts==0){

                    alert(data.msg);
                }
                jQuery("#editTicketModal").modal('hide');

            },
            error: function(jqXHR, textStatus, errorThrown) {
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

});
/*
$(".reply-ticket").on('click',function () {
    jQuery("#replyTicketModal").modal("show");
});
*/


$(".assign-to").on('click',function () {
    jQuery("#assignToModal").modal("show");
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'ticket/get_notLockTicket',

        success: function(data) {
        //console.log(data.notLockTicket);
        // makeTicketDropdown();
            helpers.buildDropdown(
                data.notLockTicket,
                $('#tickt_id'),
                '---Select Ticket ID---'
            );

        },
        error: function(jqXHR, textStatus, errorThrown) {
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
});

var helpers =
    {

        buildDropdown: function(result, dropdown, emptyMessage)
        {
            //console.log(result);
            // Remove current options
            dropdown.html('');
            // Add the empty option with the empty message
            dropdown.append('<option value="">' + emptyMessage + '</option>');
            // Check result isnt empty
            if(result != '')
            {
                for (var i=0; i<result.length; i++){
                    dropdown.append('<option value="' + result[i].ticket_id + '">' + result[i].ticket_id +" "+result[i].ticket_sub+ '</option>');
                }
            }
        }
    };




$(".assign").on('click',function () {
    var ticket_id = $('#tickt_id').val();
    var admin_id = $('#admin_id').val();
    // alert(ticket_id);
    // alert(admin_id);
    if(ticket_id===""){
        alert("Please select ticket ID!");
    }else {
        $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'ticket/assign_to',
        data: {
            ticket_id: ticket_id,
            admin_id: admin_id
        },
        success: function(data) {
            // jQuery("#assignToModal").modal("hide");
            //alert(data);
            if (data.assignConfirm=== true){
                helpers.buildDropdown(
                    data.notLockTicket,
                    $('#tickt_id'),
                    '---Select Ticket ID---'
                );
            } else {
                alert("Not assign!");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
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

});

var ajax_call = function() {// this function is for check notification under specific super-admin
    //your jQuery ajax code

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'ticket/check_incomplete',

        success: function(data) {
            console.log(data.notification.length);

            $(".badge").text(data.notification.length);
        },
        error: function(jqXHR, textStatus, errorThrown) {
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
};
var interval = 1000 * 60 * 0.1; // where X is your every X minutes
var adminType = $('#adminType').val();
if(adminType==1){
    setInterval(ajax_call, interval);
}

$('.ticket-refresh').on('click',function () {
   window.location = li+ 'ticket/all_ticket';
});

// $(".msgbdy").scrollTop(1000);
$(".msgbdy").animate({scrollTop:$("#msgTbody").height()}, 'slow');









$('.send-message').on('click',function () {
    var msg = $("#inpt").val();
    var ticket_id = $(this).attr('ticket-id');
    $("#inpt").focus();
    //console.log(msg);
    var file_data = $('#file').prop('files')[0];
    if(file_data != null){
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('ticket_id', ticket_id);
        sendImageMessage(form_data);
    }
    if ( msg != ''){
        sendMessage(msg,ticket_id);
    }
});






$('#inpt').on('keypress', function (e) {
    if(e.which === 13){
        var ticket_id = $(this).attr('ticket-id');
        var msg = $("#inpt").val();
        $("#inpt").focus();
        //console.log($("#inpt").val());
        var file_data = $('#file').prop('files')[0];
        if(file_data != null){
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('ticket_id', ticket_id);
            sendImageMessage(form_data);
        }
        if ( msg != ''){
           sendMessage(msg,ticket_id);
        }
    }
});


function sendImageMessage(form_data) {
    $.ajax({
        url: li + 'ticket/upld', // point to server-side controller method
        dataType: 'text', // what to expect back from the server
        cache: false,
        contentType: false,
        processData: false,
        data:form_data,
        type: 'post',
        success: function (response) {
            //$('#msg').html(response); // display success response from the server
            console.log(response);
            // window.location =  li + 'ticket/reply_message/'+ticket_id+'';
        },
        error: function (response) {
            $('#msg').html(response); // display error response from the server
        }
    });
}



function sendMessage(msg,ticket_id){

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'ticket/chat_ticket',
            data: {
                msg: msg,
                ticket_id: ticket_id
            },
            success: function(data) {
                $("#inpt").val();
                window.location =  li + 'ticket/reply_message/'+ticket_id+'';
            },
            error: function(jqXHR, textStatus, errorThrown) {
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


$('.ticket-complete').on('click',function () {
   jQuery('#ticket-complete-modal').modal('show');
});

$('.complete-confirm').on('click',function () {
    var rate = $(".modal-review__rating-order-wrap").attr('data-rating-value');
    var ticket_id = $(this).attr('ticket-id');
    //alert(ticket_id);
    if (rate == ''){
        rate = 0;
    }
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'ticket/complete_ticket',
        data: {
            rate: rate,
            ticket_id: ticket_id

        },
        success: function(data) {
            if (data== true) {
                alert('Ticket Completed!');
            }else {
                alert('Ticket not Completed!');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
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
});