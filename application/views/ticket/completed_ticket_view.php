<link href="<?= base_url();?>css/custom/notification.css" rel="stylesheet">
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <?php $rank = $this->session->userdata('rank'); if ($rank==1):?>
                <div class="col-md-6" style="margin-top: 10px;">
                    <button type="button" class="btn btn-primary btn-lg assign-to">Assign To</button>
                    <a href="#" class="notification">
                        <span>Tickets</span>
                        <span class="badge"></span>
                    </a>
                </div>
            <?php endif;?>
            <?php $userTyp = $this->session->userdata('type');
            if ($userTyp==1 && $rank!=1):?>
                <div class="col-md-6 ticket-refresh" style="margin-top: 10px;">
                    <a href="#" class="notification">
                        <span>Tickets</span>
                        <span class="badge"></span>
                    </a>
                </div>
            <?php endif;?>
            <input type="hidden" id="adminType" value="<?= $this->session->userdata('type');?>">
            <div class="col-md-12" style="margin-top: 10px;">

                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>#SL.</th>
                        <th>Subject</th>
                        <!--                        <th>Message</th>-->
                        <th>User</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Rating</th>
                        <th>Create Date Time</th>
<!--                        <th>Action</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0;
                    foreach ($ticketList as $ticket): ?>
                        <tr id="<?= $ticket->ticket_id?>">
                            <td><?= ++$i; ?></td>
                            <td><?= $ticket->ticket_sub; ?></td>

                            <td><?= $ticket->user; ?></td>
                            <td><?= $ticket->priority; ?></td>
                            <td bgcolor="#7fffd4"><?= $ticket->ticket_status; ?></td>
                            <td><?= $ticket->rating; ?></td>
                            <td><?= $ticket->ticket_date_time; ?></td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#SL.</th>
                        <th>Subject</th>

                        <th>User</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Rating</th>
                        <th>Create Date Time</th>

                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="modal fade" id="editTicketModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <form action="#" class="form-horizontal">
                                    <div class="form-group">
                                        <label for="edit_ticket_sub" class="col-md-3 label-heading">Ticket Subject</label>
                                        <div class="col-md-9 ui-front">
                                            <input list="edit_ticket_sub" type="text" style="font-size:12pt;" id="edit_ticket_subject" class="form-control" name="title">
                                            <datalist id="edit_ticket_sub">
                                                <?php foreach ($ticketSubject as $sub):?>
                                                <option value="<?= $sub->ticket_subject ?>">
                                                    <?php endforeach; ?>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_message" class="col-md-3 label-heading">Message</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="edit_message" name="message"></textarea>
                                        </div>
                                    </div>

                                    <hr>
                                    <input type="button" id="updateTicket" class="btn btn-primary form-control"
                                           value="Update Ticket"/>
                                    <input type="hidden" class="form-control" id="ticket_id_edit" >
                                    <input type="hidden" class="form-control" id="message_id_edit" >
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>

        </div>
        <!--        modal for message reply starts-->
        <div class="modal fade" id="replyTicketModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Reply</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="panel panel-default">
                            <div class="panel-body">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--        modal for message reply end-->

        <!--        modal for message reply starts-->

        <div class="modal fade bd-example-modal-lg" tabindex="-1" id="assignToModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal-lg" id="exampleModalLongTitle">Assign Ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="panel-body">
                            <label class="col-xs-2 control-label" style="font-size: smaller">Ticket ID</label>
                            <div class="col-xs-4">
                                <select class="form-control" data-show-subtext="true" id="tickt_id" data-live-search="true">

                                </select>
                            </div>


                            <label class="col-xs-2 control-label" style="font-size: smaller">Lock to</label>
                            <div class="col-xs-4">
                                <select class="form-control" data-show-subtext="true" id="admin_id" data-live-search="true">
                                    <?php foreach ($allAdmin as $a):?>
                                        <option value="<?= $a->id?>"><?= $a->user?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-md-12" style="margin-top: 10px;">
                                <div>
                                    <input type="button" class="btn btn-primary assign" value="Assign" style="display: block; margin: 0 auto;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--        modal for message reply end-->

    </div>
    <script src="<?php echo base_url(); ?>js/custom/link.js"></script>
    <script src="<?php echo base_url(); ?>js/custom/ticket.js"></script>

</div>
</div>


