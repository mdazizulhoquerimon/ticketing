<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Users Panel</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-6">
                    <?php
                    $w = $this->session->userdata('wire');
                    if ($w == 0) {
                        ?>
                        <a data-toggle="modal" data-target="#Popup"><strong>Create Warehouse</strong></a>
                        <?php
                    } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Create User
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-7">
                            <form class="form-horizontal bucket-form" method="post" action="<?php echo base_url(); ?>/create_user">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Name:</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="user" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Password:</label>
                                    <div class="col-sm-4">
                                        <input type="password" id="password" class="form-control">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" id="sp">Show Password
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Type:</label>
                                    <div class="col-sm-4">
                                        <select id="type" class="form-control" name="type" onchange="type_per()">
                                            <option></option>
                                            <?php
                                            if ($w == 0) {
                                                ?>
                                                <option value="1">SUPER ADMIN</option>
                                                <option value="2">ADMIN</option>
                                                <?php
                                            }
                                            ?>
                                            <option value="3">Engineer</option>
                                            <option value="4">Customer</option>
                                        </select>
                                    </div>
                                </div>
                                <?php if ($w == 0) { ?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Warehouse:</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="shop">
                                                <?php foreach ($ware as $val): ?>
                                                    <option value="<?php echo $val['id']; ?>"><?php echo $val['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php } else {
                                    $name = $this->setting->anyName('ware', 'id', $w, 'name'); ?>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Warehouse</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="shop">
                                                <option value="<?php echo $w; ?>"><?php echo $name; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label">Permission:</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="active" value="1" type="radio" checked>Active
                                        <input name="active" value="0" type="radio">Inactive
                                    </div>
                                </div>
                                <div class="col-sm-6" style="text-align:center">
                                    <div class="btn btn-primary">
                                        <button type="button" id="sub" onclick="create_user()" class="btn btn-info">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm-6" style="text-align:left">
                                    <div>
                                        <button type="button" id="con" onclick="create_user2()" class="btn btn-success">
                                            Confirm
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong> User Access <strong>
                                </div>
                                <div class="panel-body" id="per" style="padding-left:20px">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="Popup" class="modal fade">
        <div class="modal-content" style="width:500px">
            <div class="row" style='border-bottom:2px solid;text-align:center;margin-bottom:10px'>
                <h3>CREATE WAREHOUSE</h3>
            </div>
            <div class="row r_padding">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Company Name</label>
                    <div class="col-sm-6">
                        <input type="text" id="wname" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row r_padding">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Theme</label>
                    <div class="col-sm-6">
                        <input type="text" id="wtheme" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row r_padding">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-6"><textarea id="waddress" class="form-control" rows="6"></textarea></div>
                </div>
            </div>
            <div class="row r_padding">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-6"><input type="text" id="wphone" class="form-control"></div>
                </div>
            </div>
            <div class="row r_padding">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Vat </label>
                    <div class="col-sm-6"><input type="text" id="wvat" class="form-control"></div>
                </div>
            </div>
            <div class="row r_padding">
                <div class="col-sm-12" style="text-align:right">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-3">
                        <button onclick="process_p2()" id="submit_p" class="btn btn-success">Submit</button>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
            <span class="closes"></span>
        </div>
        <div id="modals">
            <div class="col-sm-4"></div>
            <div class="col-sm-4" style="margin-top:15%;">
                <img style="display:none;" class="img" src="<?php echo base_url(); ?>css/715.gif" title="Loading........"/>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>js/custom/link.js"></script>
<script src="<?php echo base_url(); ?>js/custom/user.js"></script>

