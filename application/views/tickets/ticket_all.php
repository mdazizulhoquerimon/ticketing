<div id="page-wrapper">
    <div class="container-fluid">
        <div class="col-sm-12" style="overflow:auto;width:100%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <h4 class="card-title col-md-2">Ticket List</h4>
                        <div class="col-sm-2">
                            <input onkeyup="getTickettList(this)" class="form-control" id="search_ticket" placeholder="Search"/>
                        </div>
                        <div class="col-sm-1">
                            <button onclick="getAllTicketInfo(this)" class="btn btn-primary"><span
                                    class='glyphicon glyphicon-search'></span>Search
                            </button>
                        </div>
                        <div class="col-md-7">
                            <div class="col-md-6" id="message"></div>
                            <div class="text-right">
                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#newTicketModal">New Ticket</a>
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
                            <th class="text-center">Subject</th>
                            <th class="text-center">Priority</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Rating</th>
                            <th class="text-center">Opened By</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Action</th>
                            </thead>

                            <tbody id="ptoject_details_table_data">

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="newTicketModal" role="dialog" aria-labelledby="newTicketModalLabel">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Add New Ticket</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="hidden" id="ticket_id" name="ticket_id">
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Name:</label>
                                        <div class="col-md-4">
                                            <input type="text" value="<?=$user;?>" class="form-control" id="opened_by" name="opened_by" readonly>
                                        </div>
                                        <label class="col-md-2 control-label">Project:</label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="project_id" name="project_id">
                                                <option value=0>Select Project</option>
                                                <?php foreach ($allProject as $project): ?>
                                                    <option value="<?= $project['id'] ?>"> <?= $project['project_name'] ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Subject:</label>
                                        <div class="col-md-10">
                                            <input list="ticket_sub" type="text" id="ticket_subject" class="form-control" name="ticket_subject">
                                            <datalist id="ticket_sub">
                                                <?php foreach ($ticketSubject as $sub):?>
                                                    <option value="<?= $sub->ticket_subject ?>"></option>
                                                <?php endforeach; ?>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Priority:</label>
                                        <div class="col-md-10">
                                            <select class="form-control" id="ticket_priority" name="ticket_priority">
                                                <option value=0>Select Priority</option>
                                                <option value="1">Low</option>
                                                <option value="2">Medium</option>
                                                <option value="3">High</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 control-label">Message:</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="ticket_message" id="ticket_message"></textarea>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button onclick="add_new_ticket()" type="submit" class="btn btn-default">Submit
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
<script src="<?php echo base_url(); ?>js/custom/ticket/ticket_all.js"></script>
<script >
    window.onload = function(e){
        getAllTicketInfo();
    }
</script>
