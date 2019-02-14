var li = links();

function getSearchProjectList(v) {
    var vv = $(v).val();
    if (vv != '') {
        $(v).addClass('ac_loading');
        $(v).autocomplete({
            source: function (request, response) {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: li + 'project/getSearchProjectList/',
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
    $('#project_start_date,#project_end_date').datepicker({
        daysOfWeekHighlighted: "5",
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });
});

$(document).on("focusin", "#project_start_date,#project_end_date", function () {
    $(this).prop('readonly', true);
});

$(document).on("focusout", "#project_start_date,#project_end_date", function () {
    $(this).prop('readonly', false);
});

function add_project() {
    var project_id = $("#project_id").val();
    var project_name = $("#project_name").val();
    var project_status = $("#project_status").val();
    var project_start_date = $("#project_start_date").val();
    var project_end_date = $("#project_end_date").val();

    if (project_name != '' && project_name != 0 && project_status != 0 && project_start_date != '' && project_start_date != 0) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: li + 'project/add_new_project',
            data: {
                project_id: project_id,
                project_name: project_name,
                project_status: project_status,
                project_start_date: project_start_date,
                project_end_date: project_end_date,
            },
            success: function (data) {
                if (data.id == 2) {
                    //alert('inserted');
                    document.getElementById("message").innerHTML = "<h5 style=\"color: red;\" class=\"animated fadeOut delay-2s\">Project Added Succesfully </h5>";
                    $("#project_id").val('');
                    $("#project_name").val('');
                    $("#project_status").val(0);
                    $("#project_start_date").val('');
                    $("#project_end_date").val('');
                    $('#addProjectModal').modal('hide');
                    getAllProjectInfo();
                } else if (data.id == 1) {
                    //alert('not inserted');
                    document.getElementById("message").innerHTML = "<h5 style=\"color: red;\" class=\"animated fadeOut delay-2s\">Project Added Failed </h5>";
                } else if (data.id == 3) {
                    //alert('updated');
                    document.getElementById("message").innerHTML = "<h5 style=\"color: red;\" class=\"animated fadeOut delay-2s\">Project Updated Successfully </h5>";
                    $("#project_id").val('');
                    $("#project_name").val('');
                    $("#project_status").val(0);
                    $("#project_start_date").val('');
                    $("#project_end_date").val('');
                    $('#addProjectModal').modal('hide');
                    getAllProjectInfo();
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

function getAllProjectInfo(v) {

    var search_project = $("#search_project").val();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'project/getAllProjectInfo/',
        data: {search_project: search_project},
        success: function (data) {
            viewAllProjectList(data);
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

function viewAllProjectList(data) {
    var stuff = "";
    var sl = 1;
    $.each(data.list, function (key, val) {

        stuff = stuff + "<tr class='text-center " + val.id + "tr'>"
            + "<td>" + (sl++) + "</td>"
            + "<td>" + val.project_name + "</td>"
            + "<td>" + val.project_start_date + "</td>"
            + "<td>" + val.project_end_date + "</td>"
            + "<td style='background-color: "+val.style+"'> " + val.project_status + "</td>"
            + "<td>"
            if(val.type==1||val.type==2){
                stuff = stuff + "<a onclick = edit_project_details('"+val.id+"') class='btn btn-sm btn-info' data-toggle='modal' data-target='#addProjectModal' id='edit_project_details'>Edit</a>"
            }
        stuff = stuff + "</td>"
        stuff = stuff + "</tr>";
    });
    $("#ptoject_details_table_data").html(stuff);
}

function edit_project_details(id) {
    //alert(id);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: li + 'project/getProjectInfo',
        data: {id: id},
        success: function (data) {
            $.each(data, function (key, val) {
                //alert(val.id);
                $("#project_id").val(val.id);
                $("#project_name").val(val.project_name);
                $("#project_status").val(val.project_status);
                $("#project_start_date").val(val.project_start_date);
                $("#project_end_date").val(val.project_end_date);
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