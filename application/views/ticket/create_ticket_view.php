<style type="text/css">
#myHead{
    border-bottom: 1px solid #f1f1f1; text-align: center; padding: 10px; color: #FFF; margin: 2px; background: #2d6aa0; margin-bottom: 10px; border-radius: 4px; font-weight: 700; font-size: 18px; margin-bottom: 25px;
}

/*div.modal-review__rating-order-wrap > span {*/
    /*display: block; float: left;*/
    /*height: 30px; width: 40px;*/
    /*background-image: url("data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20width='80'%20height='30'%3E%3Cpath%20d='M17.5,12.5h-8.5l6.8,5-2.6,8.1,6.8-5,6.8,5-2.6-8.1,6.8-5h-8.5l-2.6-8.1z'%20fill='%23c0c0c0'%20stroke='%23c0c0c0'/%3E%3Cpath%20d='M57.5,12.5h-8.5l6.8,5-2.6,8.1,6.8-5,6.8,5-2.6-8.1,6.8-5h-8.5l-2.6-8.1z'%20fill='%23ffd83d'%20stroke='%23eac328'/%3E%3C/svg%3E");*/
    /*background-position: 0px 0px;    !* gray star *!*/
/*}*/

/*!* Persistent state *!*/
/*div.modal-review__rating-order-wrap[data-rating-value] > span {*/
    /*background-position: -40px 0px;  !* gold star *!*/
/*}*/
/*div.modal-review__rating-order-wrap > span.active ~ span {*/
    /*background-position: 0px 0px;    !* gray star *!*/
/*}*/

/*!* Hover state *!*/
/*div.modal-review__rating-order-wrap[class]:hover > span {*/
    /*background-position: -40px 0px;  !* gold star *!*/
/*}*/
/*div.modal-review__rating-order-wrap[class] > span:hover ~ span {*/
    /*background-position: 0px 0px;    !* gray star *!*/
/*}*/

</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" id="ticket-area">
                <h3 class="page-header" id="myHead">Create a Ticket</h3>
                Welcome to Support Centre
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="#" class="form-horizontal"">                                        
                            <div class="form-group">
                                <label for="ticket_sub" class="col-md-3 label-heading">Ticket Subject</label>
                                <div class="col-md-9 ui-front">
                                    <input list="ticket_sub" type="text" style="font-size:12pt;" id="ticket_subject" class="form-control" name="title">
                                    <datalist id="ticket_sub">
                                        <?php foreach ($ticketSubject as $sub):?>
                                            <option value="<?= $sub->ticket_subject ?>">
                                        <?php endforeach; ?>
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message" class="col-md-3 label-heading">Message</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" style="font-size:15pt;" id="message" name="message"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="priority" class="col-md-3 label-heading">Priority</label>
                                <div class="col-md-9 ui-front">
                                    <select id="priority" name="priority" style="font-size:12pt;" class="form-control">
                                        <?php foreach ($priorityList as $p):?>
                                            <option value="<?= $p->id ?>"><?= $p->priority ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <hr>
<!--                            <div class="form-group">-->
<!--                                <label for="rating" class="col-md-3 label-heading">Rating</label>-->
<!--                                <div class="modal-review__rating-order-wrap col-md-9">-->
<!--                                  <span data-rating-value="1"></span>-->
<!--                                  <span data-rating-value="2"></span>-->
<!--                                  <span data-rating-value="3"></span>-->
<!--                                  <span data-rating-value="4"></span>-->
<!--                                  <span data-rating-value="5"></span>-->
<!--                              </div>-->
<!--                             -->
<!--                          </div>-->
<!--                          <hr>-->
                          <input type="button" id="createTicket" class="btn btn-primary form-control" value="Create Ticket" />
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <script src="<?php echo base_url(); ?>js/custom/link.js"></script>
  <script src="<?php echo base_url(); ?>js/custom/ticket.js"></script>

</div>
</div>


