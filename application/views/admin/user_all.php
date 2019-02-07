<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User List</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Users
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr style="background:#f0ad4e">
                                <th style="text-align:center">Name</th>
                                <th style="text-align:center">Ware</th>
                                <th style="text-align:center">Type</th>
                                <th colspan="2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($user as $val): ?>
                                <tr>
                                    <td><?php echo $val['user'] ?></td>
                                    <td>
                                        <?php echo $this->setting->anyName('ware', 'id', $val['ware'], 'name'); ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($val['type'] == 1) {
                                            echo "Super Admin";
                                        } else if ($val['type'] == 2)
                                            echo "Admin";
                                        else if ($val['type'] == 3)
                                            echo "User";
                                        ?>
                                    </td>
                                    <td style="width:100px;">
                                        <?php
                                        if ($val['active'] == 1) {
                                            ?>
                                            <button class="btn btn-success">Active</button>
                                            <?php

                                        } else {
                                            ?>
                                            <button class="btn btn-danger">Inactive</button>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td><a style='color:red;font-weight:bold'
                                           onclick="getUser(<?php echo $val['id'] ?>,<?php echo $val['type'] ?>,<?php echo $val['ware'] ?>)"
                                           href="#Popup">Edit</a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="Popup" class="Modal">
                <div class="content" style="width:1000px">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Update User
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-7">
                                <div class="row r_padding">
                                    <label class="col-sm-4 control-label">Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="user" class="form-control">
                                    </div>
                                </div>
                                <div class="row r_padding">
                                    <label class="col-sm-4 control-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="password" class="form-control">
                                    </div>
                                </div>


                                <div class="row r_padding">
                                    <label class="col-sm-4 control-label">Type</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="type_u">
                                        </select>
                                    </div>
                                </div>

                                <div class="row r_padding">
                                    <label class="col-sm-4 control-label">Ware</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="shop"></select>
                                    </div>
                                </div>
                                <div class="row r_padding">
                                    <label class="col-sm-4 control-label">Permission</label>
                                    <div class="col-sm-8">
                                        <input name="active" value="1" type="radio" checked> Active
                                        <input name="active" value="0" type="radio">Inactive
                                    </div>
                                </div>
                                <div class="row r_padding">
                                    <div class="col-sm-1">
                                        <button type="button" id="sub" onclick="user_update()" class="btn btn-info">
                                            Submit
                                        </button>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" id="con" onclick="create_user2()" class="btn btn-success">
                                            Confirm
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Already Access
                                    </div>
                                    <div class="panel-body" id="accs">
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Update Access Permission
                                    </div>
                                    <div class="panel-body" style="padding-left:20px" id="user_list">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="closes"></span>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>js/custom/link.js"></script>
        <script src="<?php echo base_url(); ?>js/custom/user.js"></script>
    </div>