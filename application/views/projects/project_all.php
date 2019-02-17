<div id="page-wrapper">
    <div class="container-fluid">
        <div class="col-sm-12" style="overflow:auto;width:100%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <h4 class="card-title col-md-2">Project List</h4>
                        <div class="col-sm-2">
                            <input onkeyup="getSearchProjectList(this)" class="form-control" id="search_project" placeholder="Search Project"/>
                        </div>
                        <div class="col-sm-1">
                            <button onclick="getAllProjectInfo(this)" class="btn btn-primary"><span
                                        class='glyphicon glyphicon-search'></span>Search
                            </button>
                        </div>
                        <div class="col-md-7">
                            <div class="col-md-6" id="message"></div>
                            <div class="text-right">
                                <?php if($type==1 || $type ==2):?>
                                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addProjectModal">Add Project</a>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="width: 100%;">
                    <div class="row rr">
                        <table id="" class="table table-striped table-bordered" style="width:95%; margin: auto">
                            <thead>
                            <th class="text-center">SL</th>
                            <th class="text-center">Project Name</th>
                            <th class="text-center">Start Date</th>
                            <th class="text-center">End Date</th>
                            <th class="text-center">Status</th>
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
<script src="<?php echo base_url(); ?>js/custom/project/project_all.js"></script>
<script >
    window.onload = function(e){
        getAllProjectInfo();
    }
</script>
