<?php include "sub_class/Head.php"; ?>

<div id="page-wrapper">
    <div class="container-fluid">
	
	
	<script type="text/javascript">     
        function PrintDiv() {
			
           var divToPrint = document.getElementById('print');
           var popupWin = window.open('', '_blank', 'width=900,height=900');
           popupWin.document.open();
           popupWin.document.write('<html><head><link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet"></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
			
			
                }
				
	</script>			
		
	
	
	
		<div class="panel panel-default heads">
		
			<div class="panel-heading">
			
			
				Stock By Value
			
			
			</div>
			<div class="panel-body">	
				<div class="row">
	
	
	<div class="col-sm-12 notice" style="display:none">
		
		
				
				<div class="col-sm-6">
	
	
	
	
		<div class="col-sm-4">
		

<div class="col-sm-9 bhead">


<button type="submit"  value="1" class="btn btn-primary" style="margin-bottom:5px" >Daily Report</button>


	
<button type="submit" value="2" class="btn btn-primary" style="margin-bottom:5px">Monthly Report</button>	


</div>
	
<div class="col-sm-3" id="titles" style="background:black;color:white;font-weight:bold;padding:0;margin:0">




</div>
		
		
		
	
		
		</div>
		<div class="col-sm-2">
		
		
		
		
		</div>
		<div class="col-sm-6">
		
	
		
		
		</div>
	

						
				
				</div>
				<div class="col-sm-6">
		<div class="col-sm-4">
		
		
		
		
		</div>
		<div class="col-sm-4"></div>		
		<div class="col-sm-4"></div>		
				

			
				
				</div>
		
		
		
		
		</div>
	
	</div>

	
	
	<div class="row">

			
	
	
	
		<div class="col-lg-12">
		
			<div class="panel panel-default">
				
				<header class="panel-heading">
					<strong>Stock Report By Value</strong>
				</header>
				
<div class="panel-body" style="overflow: auto;">
	<div class="row">			
				
<form class="form-horizontal bucket-form" method="post" action="<?php echo base_url(); ?>mains/stock_report/<?php echo $head ?>/<?php echo $head2 ?>">

				<div class="form-group">
				
				
<div class="col-sm-6">

<input type="checkbox" value="1" name="open" checked>Opening
<input type="checkbox" value="2" name="pur" checked>Purchase
<input type="checkbox" value="3" name="sale" checked>Sales
<input type="checkbox" value="4" name="close" checked>Closing

                        </div>				
				
				
				</div>
				
				<div class="form-group">
                      <label class="col-sm-2 control-label">Start Date</label>
                        <div class="col-sm-2">
 <input type="text" value="<?php echo $start ?>" name="start_date" class="form-control tcal tcalInput start">
                        </div>
						
						
						
			<label class="col-sm-1 control-label">End Date</label>				 
                        <div class="col-sm-2">
<input type="text" value="<?php echo $end ?>" name="end_date" class="form-control tcal tcalInput end">
                        </div>

			<div class="col-sm-2 ">
			
								
			<select class="form-control" name="store">
					
					<?php foreach($store as $s): ?>
					
					
			<option <?php if($s["id"] == $sts): ?>selected<?php endif;?> data-title="<?php echo $s['name']; ?>" value="<?php echo $s['id'] ?>"><?php echo $s['name'] ?></option>
					
					
					<?php endforeach; ?>
				
				
				</select>
				
				
			</div>
			<div class="col-sm-2">
			
							 
				<input type="submit" class="btn btn-primary" value="Submit">
				<input type="button" class="btn btn-primary" onclick="PrintDiv()" value="Print">

           
		   </div>
						
						
						
                    
				</div>

					</form>
					
		</div>	
		

<div class="row" id="print">
		
		
		<div class="col-sm-12" style="text-align:center;">
		
		
			<h3 style="margin:0;padding:0">Stock By Value</h3>
			<h4 style="margin:0;padding:0"><?php echo $start ?> To <?php echo $end ?></h4>
			<div class="row">
        <?php
	$this->db->where("id", $this->session->userdata('wire')); 
	$result = $this->db->get('ware');
	$row = $result->row();
        ?>		
					
	<h3 style="text-align:center;margin:0;padding:0"><?php echo $row->name; ?></h3>
<h5 style="text-align:center;margin:0;padding:0"><?php echo $row->theme; ?></h5>
<h5 style="text-align:center;margin:0;padding:0">Phone : <?php echo $row->phone; ?></h5>			
			
			</div>
		
		</div>
		
		
	<table  class="display table table-bordered" id="dynamic-table" >

		<thead>
		
			<tr>
			
			<?php 
	
		
	
				$cols=0;
				if($head != 0){
					?>
					<th>Particulars</th><th>Code</th>
					<?php
					for($i=0;$i<4;$i++){
						
						$data=array(
						
							"Opening Qnt",
							"Purchase Qnt",
							"Sales Qnt",
							"Closing Qnt",
						
						);
						$data_value=array(
						
							"Opening Value",
							"Purchase Value",
							"Sales Value",
							"Closing Value",
						
						);
						
						if(!empty($ch[$i])){
							$cols++;
							?>
							
							<th><?php echo $data[$i] ?></th>
							
							
							<?php 
							
								if($i == 3 || $i == 0)
								{
									?>
									
								
									<th>Rate</th>


								
									<?php
									
								}
							
							
							?>
							
							
							
							<th><?php echo $data_value[$i] ?></th>
							
							<?php
							
						}
						
						
					}
		
				}


			?>
			
			</tr>
		
		</thead>


		<tbody>
		
		
	
		
		
		
		
		
		<?php if($head != 0): ?>
		
		
			<?php

				$sub=0;
				
				$subc=0;  
	
	$su=new Head();
	

	//echo $head_avg."-?avarage->"."<br>";
	
	$data['all']=$this->report_model->getTrialBalance('setting','head',$head); 

				if(empty($ch[0]))
					$ch[0]=0;
					if(empty($ch[1]))
						$ch[1]=0;
					if(empty($ch[2]))
						$ch[2]=0;
					if(empty($ch[3]))
						$ch[3]=0;


			?>
			
			<?php

					if(empty($data['all'])){
						

		$ledger_id['all']=$this->report_model->getTrialBalance('product_ledger','head',$head);
		
		
			$total_open=0;
			$total_open_qun=0;
			$total_purchase_qun=0;
			$total_purchase=0;
			$total_sell=0;
			$total_sell_qun=0;
			$total_close_qun=0;
			$total_close=0;
			
				
					
			foreach($ledger_id['all'] as $leg){

		?>
				<tr>
		<?php
		
		
				$data['start_date']=$start;
				$data['end_date']=$end;
		
	$last_price_op=$this->report_model->getLastPrice_open('product',$start,$end,$leg['code']);	
		
$last_price=$this->report_model->getLastPrice('product',$start,$end,$leg['code']);	
		
		
		
		
		
		
		
				
		$op_debit=$this->report_model->getQuantity('product','date',$start,$end,'d_id',$leg['code'],'','','',$sts);			
		$op_credit=$this->report_model->getQuantity('product','date',$start,$end,'c_id',$leg['code'],'','','',$sts);
		
		    $oStock=0;
		
		if(empty($sts))
		    $oStock=$leg['opening_stock'];
		
		
		$total_open=$total_open+(($oStock+($op_debit-$op_credit))*$last_price_op);

		
		$tov_im=(($oStock+($op_debit-$op_credit))*$last_price_op);	


			
		$total_open_qun=$total_open_qun+$oStock+($op_debit-$op_credit);


		$toq_im=$oStock+($op_debit-$op_credit);
		
		
		
		
       $op_debit=$this->report_model->getQuantity3('product','date',$start,$end,'d_id',$leg['code'],'',1,$sts);		
	   $op_credit=$this->report_model->getQuantity3('product','date',$start,$end,'c_id',$leg['code'],'',2,$sts);
		
		
		$total_purchase_qun=$total_purchase_qun+($op_debit-$op_credit);
		
		
		
		
		
$op_debit_pv=$this->report_model->getFinalDCValue2('product','d_id',$leg['code'],'amount',$start,$end,'','1','',$sts);

$op_credit_pv=$this->report_model->getFinalDCValue2('product','c_id',$leg['code'],'amount',$start,$end,'','2','',$sts);	
		
		
		
		
		$tpq_im=($op_debit-$op_credit);
		$tpv_im=(($op_debit_pv-$op_credit_pv));
		
		
		
		
		
		
		
		
        $total_purchase=$total_purchase+$tpv_im;
	
		

	$op_debit=$this->report_model->getFinalDCValue2('product','c_id',$leg['code'],'amount',$start,$end,'','3','5');

	$op_credit=$this->report_model->getFinalDCValue2('product','d_id',$leg['code'],'amount',$start,$end,'','4');


	$total_sell=$total_sell+($op_debit-$op_credit);
	
	
	$tsv_im=($op_debit-$op_credit);
	
	
	$op_debit=$this->report_model->getFinalDCValue2('product','c_id',$leg['code'],'qun',$start,$end,'','3','5',$sts);

	$op_credit=$this->report_model->getFinalDCValue2('product','d_id',$leg['code'],'qun',$start,$end,'','4','',$sts);
    
	$total_sell_qun= $total_sell_qun+($op_debit-$op_credit);

	$tsq_im=($op_debit-$op_credit);
	
	
	$op_debit=$this->report_model->getQuantity2('product','date','',$end,'d_id',$leg['code'],'','','',$sts);
				
	$op_credit=$this->report_model->getQuantity2('product','date','',$end,'c_id',$leg['code'],'','','',$sts);



	$total_close=$total_close+(($oStock+($op_debit-$op_credit))*$last_price);
	
	
	
	
	$tcv_im=(($oStock+($op_debit-$op_credit))*$last_price);
	
	
	//echo $last_price." last_price ".$leg['code']."<br>";
	
	
	
	$tcq_im=$oStock+($op_debit - $op_credit);
	
	$total_close_qun=$total_close_qun+$tcq_im;

















					?>
					
					<td>

<?php

							if(!empty($leg['img']))
							{
								?>
								
													<img src="<?php echo base_url(); ?>file_upload/<?php echo $leg['img'] ?>"/>

								
								<?php
								
								
							}


					?>
<?php echo $leg['name']; ?>


</td>
<td>


	<div id="phover">

<a href="#" data-hveid="<?php echo $leg['name'] ?>" data-id="<?php echo $leg['code'];  ?>"><?php echo $leg['code'] ?></a>

	</div>

</td>







						<?php
					
				for($i=0;$i<4;$i++){
					
						$data=array(
						
							$toq_im,
							$tpq_im,
							$tsq_im,
							$tcq_im,
						
						);
						$data_value=array(
						
							$tov_im,
							$tpv_im,
							$tsv_im,
							$tcv_im,
						
						);
						
						if(!empty($ch[$i])){
							
							?>
							
							<td><?php echo $data[$i] ?></td>
							
							
						<?php 
							
							
								if($i == 0)
								{
									?>
									
								
								<td><?php echo $last_price_op; ?></td>



								
									<?php
									
								}
								if($i == 3)
								{
									?>
									
								
								<td><?php echo $last_price; ?></td>



								
									<?php
									
								}
							
							
							?>	
							
							
							
							
							
							<td><?php echo $data_value[$i] ?></td>
							
							<?php
							
						}
						
						
					}

					
					

					?>

								</tr>

				<?php
	
					
		
				}
				
				
				
				
				
				
				


		?>

					<tr>

							<td><strong>Total -> </strong></td>
							<td></td>
							<?php
							for($i=0;$i<4;$i++){
					
						$data=array(
						
							$total_open_qun,
							$total_purchase_qun,
							$total_sell_qun,
							$total_close_qun,
						
						);
						$data_value=array(
						
							$total_open,
							$total_purchase,
							$total_sell,
							$total_close,
						
						);
						
						if(!empty($ch[$i])){
							
							?>
							
						<td><strong><?php echo number_format(round($data[$i],0), 2, '.', ','); // echo $data[$i] ?></strong></td>
						
						
						<?php 
							
								if($i == 3)
								{
									?>
									
								
								<td></td>



								
									<?php
									
								}
								if($i == 0)
								{
									?>
									
									<td></td>
									
									
									<?php
								}
								
							
							
							?>
						
							<td><strong><?php echo number_format(round($data_value[$i],0), 2, '.', ',');					
// echo $data_value[$i] ?></strong></td>
							
							<?php
							
						}
						
						
					}
					?>
					</tr>

				<?php
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
					}
					
					
					else{
						
			$t_op_q=0;$t_op_v=0;$t_pu_q=0;$t_pu_v=0;$t_s_q=0;$t_s_v=0;
	
	$t_cl_q=0;$t_cl_v=0;				
						
						
						
						?>
						
	<?php $j=1; foreach($data['all'] as $ass): ?>
			
		<tr>
					
<td>

<a target="_blank" href="<?php echo base_url(); ?>mains/stock_report_details/<?php echo $ass['id'] ?>/<?php echo $start ?>/<?php echo $end; ?>/<?php echo $ch[0] ?>/<?php echo $ch[1] ?>/<?php echo $ch[2] ?>/<?php echo $ch[3] ?>/<?php echo 83 ?>/<?php echo $sts; ?>"><strong><?php echo $ass['name']; ?></strong></a>




</td>
<td>
	
	
	
</td>						
							
	<?php 
	
	
		
	
	$test=array();
	$test=$this->report_model->getTrialValue('setting','head',$ass['id']);	
	$length=count($test);
	$admin = $this->session->userdata('admin');
	
		$op_qun=0;
		
		$pur_qun=0;
		$pur_val=0;
		$sale_qun=0;
		$sale_val=0;
		$closing_qun=0;
		$closing_val=0;		
				
			
				
		
		
		$avg=0;			
		$all=0;
		
		
		
		
		$total_open=0;
		$total_open_qun=0;
		$total_purchase=0;
		$total_purchase_qun=0;	
		$total_sell=0;
		$total_sell_qun=0;
		$total_close=0;
		$total_close_qun=0;
		
		
		
		
		
		
		
		
	
	
for($i=$length-1;$i>=0;$i--){
	
				
	$ledger_id['all']=$this->report_model->getTrialBalance('product_ledger','head',$test[$i]);
			
				foreach($ledger_id['all'] as $leg){

				$data['start_date']=$start;
				$data['end_date']=$end;
	

$last_price_op=$this->report_model->getLastPrice_open('product',$start,$end,$leg['code']);	
		
$last_price=$this->report_model->getLastPrice('product',$start,$end,$leg['code']);	


   $oStock=0;
		
		if(empty($sts))
		    $oStock=$leg['opening_stock'];

	
				
		$op_debit=$this->report_model->getQuantity('product','date',$start,$end,'d_id',$leg['code'],$admin,'',$sts);	

		
		$op_credit=$this->report_model->getQuantity('product','date',$start,$end,'c_id',$leg['code'],$admin,'',$sts);
		
		$total_open=$total_open+(($oStock+($op_debit-$op_credit))*$last_price_op);		
				
		$total_open_qun=$total_open_qun+$oStock+($op_debit-$op_credit);


       $op_debit=$this->report_model->getQuantity3('product','date',$start,$end,'d_id',$leg['code'],$admin,1,$sts);


	   
	   $op_credit=$this->report_model->getQuantity3('product','date',$start,$end,'c_id',$leg['code'],$admin,2,$sts);
		
		
		
		$op_debit_pv=$this->report_model->getFinalDCValue2('product','d_id',$leg['code'],'amount',$start,$end,'','1','',$sts);

$op_credit_pv=$this->report_model->getFinalDCValue2('product','c_id',$leg['code'],'amount',$start,$end,'','2','',$sts);
		
		
		
		
		
		
		$total_purchase_qun=$total_purchase_qun+($op_debit-$op_credit);
		
		
		
        $total_purchase=$total_purchase+($op_debit_pv - $op_credit_pv);

		
		

	$op_debit=$this->report_model->getFinalDCValue2('product','c_id',$leg['code'],'amount',$start,$end,$admin,'3','5',$sts);

	$op_credit=$this->report_model->getFinalDCValue2('product','d_id',$leg['code'],'amount',$start,$end,$admin,'4','',$sts);


	$total_sell=$total_sell+($op_debit-$op_credit);
	
	
	
	$op_debit=$this->report_model->getFinalDCValue2('product','c_id',$leg['code'],'qun',$start,$end,$admin,'3','5',$sts);

	$op_credit=$this->report_model->getFinalDCValue2('product','d_id',$leg['code'],'qun',$start,$end,$admin,'4','',$sts);
    
	$total_sell_qun= $total_sell_qun+($op_debit-$op_credit);


	$op_debit=$this->report_model->getQuantity2('product','date','',$end,'d_id',$leg['code'],$admin,'','',$sts);
				
	$op_credit=$this->report_model->getQuantity2('product','date','',$end,'c_id',$leg['code'],$admin,'','',$sts);



	$total_close=$total_close+(($oStock+($op_debit-$op_credit))*$last_price);
	
	
	
	$total_close_qun=$total_close_qun+$oStock+($op_debit - $op_credit);
	
	




	
					
		
				}
			
			
			}
		
			
		
				for($i=0;$i<4;$i++){
						
						$data=array(
						
							$total_open_qun,
							$total_purchase_qun,
							$total_sell_qun,
							$total_close_qun,
						
						);
						$data_value=array(
						
							$total_open,
							$total_purchase,
							$total_sell,
							$total_close,
						
						);
						
						if(!empty($ch[$i])){
							
							?>
							
							<td><?php echo $data[$i] ?></td>
							
							
<?php 
							
								if($i == 3)
								{
									?>
									
								
								<td></td>



								
									<?php
									
								}
								if($i == 0){
									?>
									
									
									<td></td>
									
									<?php
									
								}
							
							
							?>							
							
							
							
							
							
							
							
							
							<td><?php echo $data_value[$i] ?></td>
							
							<?php
							
						}
						
						
						
						
					}

					
					$t_op_q=$t_op_q+$total_open_qun;
		$t_op_v=$t_op_v+$total_open;
		$t_pu_q=$t_pu_q+$total_purchase_qun;
		$t_pu_v=$t_pu_v+$total_purchase;
		$t_s_q=$t_s_q+$total_sell_qun;
		$t_s_v=$t_s_v+$total_sell;
		$t_cl_q=$t_cl_q+$total_close_qun;
		$t_cl_v=$t_cl_v+$total_close;	
					
					
					
					
					
					
					
					
					

			?>
							
			
							
							
							
					
					</tr>
			
			<?php endforeach; ?>
						
						<?php
						
						
						
			$ledger_id['all']=$this->report_model->getTrialBalance('product_ledger','head',$head);
		
		
			$total_open=0;
			$total_open_qun=0;
			$total_purchase_qun=0;
			$total_purchase=0;
			$total_sell=0;
			$total_sell_qun=0;
			$total_close_qun=0;
			$total_close=0;
			
				
					
			foreach($ledger_id['all'] as $leg){

		?>
				<tr>
		<?php
		
		
				$data['start_date']=$start;
				$data['end_date']=$end;
		
	$last_price_op=$this->report_model->getLastPrice_open('product',$start,$end,$leg['code']);	
		
$last_price=$this->report_model->getLastPrice('product',$start,$end,$leg['code']);	
		
		
		
		   $oStock=0;
		
		if(empty($sts))
		    $oStock=$leg['opening_stock'];
		
		
		
				
		$op_debit=$this->report_model->getQuantity('product','date',$start,$end,'d_id',$leg['code'],'','','',$sts);			
		$op_credit=$this->report_model->getQuantity('product','date',$start,$end,'c_id',$leg['code'],'','','',$sts);
		
		$total_open=$total_open+(($oStock+($op_debit-$op_credit))*$last_price_op);

		
		$tov_im=(($oStock+($op_debit-$op_credit))*$last_price_op);	


			
		$total_open_qun=$total_open_qun+$oStock+($op_debit-$op_credit);


		$toq_im=$oStock+($op_debit-$op_credit);
		
		
		
		
       $op_debit=$this->report_model->getQuantity3('product','date',$start,$end,'d_id',$leg['code'],'',1,$sts);		
	   $op_credit=$this->report_model->getQuantity3('product','date',$start,$end,'c_id',$leg['code'],'',2,$sts);
		
		
		$total_purchase_qun=$total_purchase_qun+($op_debit-$op_credit);
		
		
		
		
		
	$op_debit_pv=$this->report_model->getFinalDCValue2('product','d_id',$leg['code'],'amount',$start,$end,'','1','',$sts);

$op_credit_pv=$this->report_model->getFinalDCValue2('product','c_id',$leg['code'],'amount',$start,$end,'','2','',$sts);	
		
		
		
		
		$tpq_im=($op_debit-$op_credit);
		$tpv_im=(($op_debit_pv-$op_credit_pv));
		
		
		
		
		
		
		
		
        $total_purchase=$total_purchase+$tpv_im;
	
		

	$op_debit=$this->report_model->getFinalDCValue2('product','c_id',$leg['code'],'amount',$start,$end,'','3','5',$sts);

	$op_credit=$this->report_model->getFinalDCValue2('product','d_id',$leg['code'],'amount',$start,$end,'','4','',$sts);


	$total_sell=$total_sell+($op_debit-$op_credit);
	
	
	$tsv_im=($op_debit-$op_credit);
	
	
	$op_debit=$this->report_model->getFinalDCValue2('product','c_id',$leg['code'],'qun',$start,$end,'','3','5',$sts);

	$op_credit=$this->report_model->getFinalDCValue2('product','d_id',$leg['code'],'qun',$start,$end,'','4','',$sts);
    
	$total_sell_qun= $total_sell_qun+($op_debit-$op_credit);

	$tsq_im=($op_debit-$op_credit);
	
	
	$op_debit=$this->report_model->getQuantity2('product','date','',$end,'d_id',$leg['code'],'','','',$sts);
				
	$op_credit=$this->report_model->getQuantity2('product','date','',$end,'c_id',$leg['code'],'','','',$sts);



	$total_close=$total_close+(($oStock+($op_debit-$op_credit))*$last_price);
	
	$tcv_im=(($oStock+($op_debit-$op_credit))*$last_price);
	$tcq_im=$oStock+($op_debit - $op_credit);
	
	$total_close_qun=$total_close_qun+$tcq_im;

















					?>
					
					<td>

<?php

							if(!empty($leg['img']))
							{
								?>
								
													<img src="<?php echo base_url(); ?>file_upload/<?php echo $leg['img'] ?>"/>

								
								<?php
								
								
							}


					?>
<?php echo $leg['name']; ?>


</td>
<td><a target="_blank" href="<?php echo base_url(); ?>mains/product_ledger/<?php echo $leg['code'] ?>/<?php echo $start ?>/<?php echo $end ?>"><?php echo $leg['name']; ?></a></td>

						<?php
					
				for($i=0;$i<4;$i++){
					
						$data=array(
						
							$toq_im,
							$tpq_im,
							$tsq_im,
							$tcq_im,
						
						);
						$data_value=array(
						
							$tov_im,
							$tpv_im,
							$tsv_im,
							$tcv_im,
						
						);
						
						if(!empty($ch[$i])){
							
							?>
							
							<td><?php echo $data[$i] ?></td>
							
							
	<?php 
							
								if($i == 3)
								{
									?>
									
								
								<td><?php echo $last_price; ?></td>



								
									<?php
									
								}
								if($i == 0)
								{
									?>
									
								
								<td><?php echo $last_price_op; ?></td>



								
									<?php
									
								}
							
							
							?>						
							
							
							
							
							
							
							
							
							
							
							
							<td><?php echo $data_value[$i] ?></td>
							
							<?php
							
						}
						
						
					}

					
					

					?>

								</tr>

				<?php
	
					
		
				}
				
				
				
				
				
					$t_op_q=$t_op_q+$total_open_qun;
		$t_op_v=$t_op_v+$total_open;
		$t_pu_q=$t_pu_q+$total_purchase_qun;
		$t_pu_v=$t_pu_v+$total_purchase;
		$t_s_q=$t_s_q+$total_sell_qun;
		$t_s_v=$t_s_v+$total_sell;
		$t_cl_q=$t_cl_q+$total_close_qun;
		$t_cl_v=$t_cl_v+$total_close;	
				


		?>

					<tr>

							<td><strong>Total -> </strong></td>
							<td></td>
							<?php
							for($i=0;$i<4;$i++){
					
						$data=array(
						
							$t_op_q,
							$t_pu_q,
							$t_s_q,
							$t_cl_q,
						
						);
						$data_value=array(
						
							$t_op_v,
							$t_pu_v,
							$t_s_v,
							$t_cl_v,
						
						);
						
						if(!empty($ch[$i])){
							
							?>
							
							<td><strong><?php echo number_format(round($data[$i],0), 2, '.', ','); // echo $data[$i] ?></strong></td>
							
							
							
				<?php 
							
								if($i == 3)
								{
									?>
									
								
								<td></td>



								
									<?php
									
								}
								if($i == 0){
									?>
									
									
									<td></td>
									
									<?php
									
								}
							
							
							?>			
							
							
							
							
							
							
							
							
							<td><strong><?php echo number_format(round($data_value[$i],0), 2, '.', ',');					
// echo $data_value[$i] ?></strong></td>
							
							<?php
							
						}
						
						
					}
					?>
					</tr>

				<?php
				
				
				
				
				
					
		
				}


				
				
		?>

				
				<?php
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
					
					
					



			?>
			
			
			
			
			
		
		<?php endif; ?>
		
		
	
		
		
		</tbody>
					
					
					
					
	</table>	


</div>
		
					
				</div>
				
				<div/>
		
		</div>
		
		
		

        </div>
	
	
	
	
	
	
	
	
	
				
				
			</div>
			
	</div>
	

	
	
	
	<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>
	
	</div>
	</div>