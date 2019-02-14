<div id="page-wrapper">
    <div class="container-fluid">
        <div class="col-sm-12" style="overflow:auto;width:100%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <h4 class="card-title col-md-3">Assigned Project List</h4>
                        <div class="col-sm-2">
                            <input onkeyup="getSearchAssignedProjectList(this)" class="form-control" id="search_assigned_project" placeholder="Search"/>
                        </div>
                        <div class="col-sm-1">
                            <button onclick="getAllAssignedProjectInfo(this)" class="btn btn-primary"><span
                                    class='glyphicon glyphicon-search'></span>Search
                            </button>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6" id="message"></div>
                            <div class="text-right">
                                <?php if($type==1 || $type ==2):?>
                                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#assignProjectModal">Assign Project</a>
                                <?php endif;?>
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
                            <th class="text-center">Customer</th>
                            <th class="text-center">Is Assign</th>
                            <th class="text-center">Assigned To</th>
                            <th class="text-center">Assigned By</th>
                            <th class="text-center">Assigned Date</th>
                            <th class="text-center">Assign Note</th>
                            <th class="text-center">Ticket</th>
                            <th class="text-center">Action</th>
                            </thead>

                            <tbody id="ptoject_details_table_data">

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="assignProjectModal" role="dialog" aria-labelledby="assignProjectModalLabel">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Assign Project</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="hidden" id="assigned_by" name="assigned_by" value="<?=$admin?>">
                                    <input type="hidden" id="assigned_id" name="assigned_id">
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Projects:</label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="assigned_project" name="assigned_project">
                                                <option value=0>Select Project</option>
                                                <?php foreach ($allProject as $project): ?>
                                                    <option value="<?= $project['id'] ?>"> <?= $project['project_name'] ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <label class="col-md-2 control-label">Engineer:</label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="project_engineer" name="project_engineer">
                                                <option value=0>Select Engineer</option>
                                                <?php foreach ($allEngineer as $engineer): ?>
                                                    <?php if($engineer['id']!=$admin):?>
                                                        <option value="<?= $engineer['id'] ?>"> <?= $engineer['user'] ?> </option>
                                                     <?php endif;?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Customer:</label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="project_customer" name="project_customer">
                                                <option value=0>Select Customer</option>
                                                <?php foreach ($allCustomer as $customer): ?>
                                                    <option value="<?= $customer['id'] ?>"> <?= $customer['user'] ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <label class="col-md-2 control-label">Assigned Date:</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="assigned_date" name="assigned_date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Assign Status:</label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="assign_status" name="assign_status">
                                                <?php if ($type==1 || $type==2):?>
                                                    <option value=0>Status</option>
                                                    <option value="1">Assign</option>
                                                    <option value="2">Unassign</option>
                                                    <option value="3">Hand Over</option>
                                                <?php else:?>
                                                    <option value="3">Hand Over</option>
                                                <?php endif;?>
                                            </select>
                                        </div>
                                        <label class="col-md-2 control-label">Note:</label>
                                        <div class="col-md-4">
                                            <textarea class="form-control" name="assign_note" id="assign_note"></textarea>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button onclick="add_assigned_project()" type="submit" class="btn btn-default">Submit
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
<script src="<?php echo base_url(); ?>js/custom/project/assigned_project.js"></script>
<script >
    window.onload = function(e){
        getAllAssignedProjectInfo();
    }
</script>