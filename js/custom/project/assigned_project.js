var li = links();

function getSearchAssignedProjectList(v) {
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

$(document).ready(function () {
    $('#assigned_date').datepicker({
        daysOfWeekHighlighted: "5",
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });
});

$(document).on("focusin", "#assigned_date", function () {
    $(this).prop('readonly', true);
});

$(document).on("focusout", "#assigned_date", function () {
    $(this).prop('readonly', false);
});

function add_assigned_project() {
    var assigned_id = $("#assigned_id").val();
    var assigned_project = $("#assigned_project").val();
    var assigned_by = $("#assigned_by").val();
    var project_engineer = $("#project_engineer").val();
    var project_customer = $("#project_customer").val();
    var assigned_date = $("#assigned_date").val();
    var assign_status = $("#assign_status").val();
    var assign_note = $("#assign_note").val();

    if (assigned_project != '' && assigned_project != 0 && project_engineer != 0 && project_engineer != '' && project_engineer != null
        && project_customer != 0 && project_customer != '' && assigned_date != 0 && assigned_date != ''
        && assign_status != 0 && assign_status != '') {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'project/add_assigned_project',
            data: {
                assigned_id: assigned_id,
                assigned_project: assigned_project,
                project_engineer: project_engineer,
                project_customer: project_customer,
                assigned_date: assigned_date,
                assign_status: assign_status,
                assign_note: assign_note,
                assigned_by: assigned_by,
            },
            success: function (data) {
                if (data.id == 2) {
                    //alert('inserted');
                    document.getElementById("message").innerHTML = "<h5 style=\"color: darkgreen;\" class=\"animated fadeOut delay-5s\">Project Assigned Succesfully </h5>";
                    $("#assigned_id").val('');
                    $("#assigned_project").val(0);
                    $("#project_engineer").val(0);
                    $("#project_customer").val(0);
                    $("#assign_status").val(0);
                    $("#assigned_date").val('');
                    $("#assign_note").val('');
                    $('#assignProjectModal').modal('hide');
                    getAllAssignedProjectInfo();
                } else if (data.id == 1) {
                    //alert('not inserted');
                    document.getElementById("message").innerHTML = "<h5 style=\"color: red;\" class=\"animated fadeOut delay-3s\">Project Assigned Failed </h5>";
                } else if (data.id == 3) {
                    $("#assigned_id").val('');
                    $("#assigned_project").val(0);
                    $("#project_engineer").val(0);
                    $("#project_customer").val(0);
                    $("#assign_status").val(0);
                    $("#assigned_date").val('');
                    $("#assign_note").val('');
                    $('#assignProjectModal').modal('hide');
                    getAllAssignedProjectInfo();
                    document.getElementById("message").innerHTML = "<h5 style=\"color: darkgreen;\" class=\"animated fadeOut delay-3s\">Project Hand Overed </h5>";
                } else if (data.id == 4) {

                    document.getElementById("message1").innerHTML = "<h5 style=\"color: red;\" class=\"animated fadeOut delay-3s\">Can Not be hand Over Until Assign </h5>";
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

function getAllAssignedProjectInfo(v) {

    var search_assigned_project = $("#search_assigned_project").val();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'project/getAllAssignedProjectInfo/',
        data: {search_assigned_project: search_assigned_project},
        success: function (data) {
            viewAllAssignedProjectList(data);
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

function viewAllAssignedProjectList(data) {
    var stuff = "";
    var sl = 1;
    $.each(data.list, function (key, val) {
        stuff = stuff + "<tr class='text-center " + val.id + "tr'>"
            + "<td>" + (sl++) + "</td>"
            + "<td>" + val.project_name + "</td>"
            + "<td>" + val.project_customer + "</td>"
            + "<td>" + val.is_assigned + "</td>"
            + "<td>" + val.project_engineer + "</td>"
            + "<td>" + val.assigned_by + "</td>"
            + "<td>" + val.assigned_date + "</td>"
            + "<td>" + val.assign_note + "</td>"
            + "<td>" + val.project_ticket + "</td>"
            + "<td>"
            + "<a onclick = edit_assigned_project_details('"+val.id+"') class='btn btn-sm btn-info' data-toggle='modal' data-target='#assignProjectModal' id='edit_project_details'>Edit</a>"
            + "</td>"
            + "</tr>";
    });
    $("#ptoject_details_table_data").html(stuff);
}

function edit_assigned_project_details(id) {
    //alert(id);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'project/getAssignedProjectInfo',
        data: {id: id},
        success: function (data) {
            $.each(data, function (key, val) {
                //alert(val.id);
                $("#assigned_id").val(val.id);
                $("#assigned_project").val(val.project_id);
                $("#project_engineer").val(val.project_engineer);
                $("#project_customer").val(val.project_customer);
                $("#assigned_date").val(val.assigned_date);
                $("#assign_status").val(val.is_assigned);
                $("#assign_note").val(val.assign_note);
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