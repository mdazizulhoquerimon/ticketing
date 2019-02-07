<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <?php
            $info = null;
            $t = $this->session->userdata('type');
            $w = $this->session->userdata('wire');
            $a = $this->session->userdata('admin');
            if ($t == 1 || $t == 2) {
                $this->db->where("(ware='" . $w . "' OR ware='0')");
                $this->db->order_by('asce', 'asc');
                $info = $this->db->get('menu');
            } else {
                $info = $this->db->query("SELECT DISTINCT menu.name, menu.id as id,menu.name
FROM `menu`
LEFT JOIN user_access ON menu.id = user_access.head
WHERE user_access.sub !=0 AND user = '$a' order by menu.asce ASC");
            }
            foreach ($info->result_array() as $val) {
                ?>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> <?php echo $val['name'] ?><span
                                class="fa arrow"></span>


                    </a>
                    <ul class="nav nav-second-level">
                        <?php

                        /*$this->db->where('root',$val['id']);
                        $this->db->where("(ware='".$w."' OR ware='0')");
                        $infos=$this->db->get('sub_menu');*/


                        if ($t != 3) {

                            $this->db->where('root', $val['id']);
                            $this->db->where("(ware='" . $w . "' OR ware='0')");
                            $infos = $this->db->get('sub_menu');

                        } else {
                            $infos = $this->db->query("SELECT DISTINCT sub_menu.id, sub_menu.id AS id,sub_menu.name,sub_menu.links
                                                        FROM `sub_menu`
                                                        JOIN user_access ON user_access.head ='" . $val['id'] . "'
                                                        AND sub_menu.id = user_access.sub
                                                        WHERE user ='$a'");

                            //$this->db->where('user');

                        }


                        foreach ($infos->result_array() as $vals) {
                            ?>


                            <li>

                                <a href="<?php echo base_url(); ?><?php echo $vals['links'] ?>"><?php echo $vals['name'] ?></a>


                            </li>


                            <?php

                        }
                        ?>
                    </ul>

                    <?php

                    ?>
                </li>

                <?php

            }


            ?>


        </ul>


        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>


    </div>
    <!-- /.sidebar-collapse -->


</div>
