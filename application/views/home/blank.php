<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome
                    <?php
                    $id = $this->session->userdata('admin');
                    $this->db->where('id', $id);
                    $info = $this->db->get('password');
                    $da = $info->row();
                    echo $da->user;
                    ?>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

