<link rel="stylesheet" href="<?= base_url();?>css/custom/reply_message_css.css"
      xmlns:display="http://www.w3.org/1999/xhtml">
<div id="page-wrapper"  style="">
    <div class="container-fluid">
        <div class="col-md-12" style="overflow: hidden;">
            <div class="row messageBody" style="height: 80vh;">
                <div class="msgbdy" style="height: 79vh;max-height: 80vh;overflow: auto;">
                <table style="width: 100%;border-radius: 10px; ">
                    <tbody id="msgTbody" style="overflow: hidden;">
                    <?php
                    $loginId = $this->session->userdata('admin');
                    $typ_login=$this->session->userdata('type');
                    ?>
                    <?php foreach($messages as $msg): ?>
                    <tr style="line-height: 3;">

                        <td>
                            <?php  if ($loginId == $msg->user_id):?>
                            <div style="text-align: right;">
                                <span class="td" id="txt">
                                    <?php if ($msg->is_img==0):?>
                                    <?php echo $msg->message;?>
                                    <?php else:?>
                                        <a target="_blank" href='<?= base_url("pic_upload/{$msg->message}")?>'>
                                            <img height="100" width="100" src='<?= base_url("pic_upload/{$msg->message}")?>' alt="img"></a>
                                    <?php endif;?>
                                </span>
                                <span class="timee"><?=
                                    date("d/m/y g:i A", strtotime($msg->message_time));?></span>
                            </div>
                            <?php else:?>
                            <div style="text-align: left;">
                                <span class="td" id="clr">
                                 <?php if ($msg->is_img==0):?>
                                     <?php echo $msg->message;?>
                                 <?php else:?>
                                     <a target="_blank" href='<?= base_url("pic_upload/{$msg->message}")?>'>
                                            <img height="100" width="100" src='<?= base_url("pic_upload/{$msg->message}")?>' alt="img"></a>
                                 <?php endif;?>
                                </span>
                                <span class="timee"><?=
                                    date("d/m/y g:i A", strtotime($msg->message_time));?></span>
                            </div>
                            <?php endif;?>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 messageSend" style="background: #c4def1; height: 10vh; margin-top: 20px; overflow: auto; border-radius: 15px;">
                    <div class="row snd" style="padding-top: 15px;">

                            <div class="col-md-2 col-lg-2 col-xs-2 col-sm-2" >
                                <button class="btn btn-success ticket-complete"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>   Ticket Complete</button>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                <input autofocus type="text" id="inpt" ticket-id="<?= $ticket_id;?>" class="form-control">
                            </div>
                        <div class="col-md-3 col-lg-3">
                            <p id="msg"></p>
                            <input type="file" id="file" name="file" />
<!--                            <button id="upload">Upload</button>-->
                        </div>
                            <div class="col-md-1 col-lg-1 col-xs-1 col-sm-1" >
                                <button class="btn btn-primary send-message" ticket-id="<?= $ticket_id;?>"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </div>

                    </div>
                </div>
            </div>






<!--modal for ticket Complete start-->
            <div class="modal fade" id="ticket-complete-modal" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Complete Ticket</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="rating" class="col-md-3 label-heading">Rating</label>
                                <div class="modal-review__rating-order-wrap col-md-9">
                                  <span data-rating-value="1"></span>
                                  <span data-rating-value="2"></span>
                                  <span data-rating-value="3"></span>
                                  <span data-rating-value="4"></span>
                                  <span data-rating-value="5"></span>
                              </div>
                          </div>
                            <hr>
                            <div class="form-group" align="center">
                                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" align="center" style="margin-top: 20px;">
                                    <button class="btn btn-success complete-confirm" ticket-id="<?= $ticket_id;?>"><i class="fa fa-check" aria-hidden="true"></i> Confirm</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--modal for ticket Complete end-->

        </div>
    <script src="<?php echo base_url(); ?>js/custom/link.js"></script>
    <script src="<?php echo base_url(); ?>js/custom/ticket.js"></script>

</div>
</div>


