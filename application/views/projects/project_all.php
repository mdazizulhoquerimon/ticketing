<div id="page-wrapper">
    <div class="container-fluid">
        <div class="col-sm-12" style="overflow:auto;width:100%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <h4 class="card-title col-md-2">Project List</h4>
                        <div class="col-sm-2">
                            <input onkeyup="getSearchProjectList(this)" class="form-control" id="search_project" placeholder="Search"/>
                        </div>
                        <div class="col-sm-1">
                            <button onclick="getAllProjectInfo(this)" class="btn btn-primary"><span
                                        class='glyphicon glyphicon-search'></span>Search
                            </button>
                        </div>
                        <div class="col-md-7">
                            <div class="col-md-6" id="message"></div>
                            <div class="text-right">
                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addProjectModal">Add Project</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="width: 100%;">
                    <div class="row rr">
                        <table class="table table-bordered" style="width:95%; margin: auto">
                            <thead>
                            <th class="text-center">SL</th>
                            <th class="text-center">Project Name</th>
                            <th class="text-center">Start Date</th>
                            <th class="text-center">End Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Ticket</th>
                            <th class="text-center">Action</th>
                            </thead>

                            <tbody id="ptoject_details_table_data">

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addProjectModal" role="dialog" aria-labelledby="projectModalLabel">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Add New Project</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="hidden" id="project_id" name="project_id">
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Project Name:</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="project_name"
                                                   name="project_name">
                                        </div>
                                        <label class="col-md-2 control-label">Status:</label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="project_status" name="project_status">
                                                <option value=0>Select Status</option>
                                                <?php foreach ($allStatus as $status): ?>
                                                    <option value="<?= $status['id'] ?>"> <?= $status['status_name'] ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Star Date:</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="project_start_date"
                                                   name="project_start_date"
                                                   value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <label class="col-md-2 control-label">End Date:</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="project_end_date"
                                                   name="project_end_date">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button onclick="add_project()" type="submit" class="btn btn-default">Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <div class="col-md-6" id="message1"></div>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>js/custom/link.js"></script>
<script>
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
                + "<td>" + val.project_ticket + "</td>"
                + "<td>"
                + "<a onclick = edit_project_details('"+val.id+"') class='btn btn-sm btn-info' data-toggle='modal' data-target='#addProjectModal' id='edit_project_details'>Edit</a>"
                + "</td>"
                + "</tr>";
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


</script>
