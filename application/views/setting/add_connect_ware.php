
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"></h1>
                    </div>
					
                <div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">

					
						</div>
						<div class="panel-body">
						
						
						
							<div class="row">
							
							
								<label class="col-sm-1">Ware List</label>
								<div class="col-sm-3">
								<select class="form-control" id="wl">
								
								
									<?php foreach($ware as $w): ?>
								
										<option value="<?php echo $w["id"] ?>" id="<?php echo $w["id"] ?>"><?php echo $w["name"] ?></option>
								
									<?php endforeach; ?>
								</select>
							
							
								</div>
								<div class="col-sm-1">
								
								
									<button id="connect" class="btn btn-primary">Submit</button>
								
								
								</div>
							</div>
						
						
						</div>
					</div>
                </div>
               
			   
			   
					
<script src="<?php echo base_url(); ?>js/custom/link.js"></script>					
<script src="<?php echo base_url(); ?>js/custom/connect_ware.js"></script>		
					
					
					
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

