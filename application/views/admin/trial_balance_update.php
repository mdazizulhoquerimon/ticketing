<?php include "CostOfGoods.php"; ?>
<?php include "store/store.php"; ?>
<?php $cog=new CostOfGoods(); ?>

<section id="main-content">

<section class="wrapper">
 
 <script type="text/javascript">    

 
        function PrintDiv() {
			
           var divToPrint = document.getElementById('print');
           var popupWin = window.open('', '_blank', 'width=900,height=900');
           popupWin.document.open();
           popupWin.document.write('<html><head><link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet"></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
			
			
                }
 
 </script>
 <style>
 
 
	td{font-size:10px;}
 
 </style>
 <div class="row">
 
 
<div class="col-sm-12" style="margin:0;padding:0">
<section class="panel">

<?php $pix=10; ?>

 <header class="panel-heading">
       Trail Balance
    <span class="tools pull-right">
   <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
						 
						 
						 
						 
</header>
 
 
  <div class="panel-body" style="text-align:center" id="print">
 
 
 <div class="adv-table">
<form action="<?php echo base_url(); ?>mains/trial_balance/<?php echo $id ?>/<?php echo $start ?>/<?php echo $end ?>" method="post">
<table align="center">
<tr>

<td><div class="feild">Start Date</div></td>
<td><input class="tcal" type="input" name="start_date" value="<?php echo $start ?>" /></td>

<td><div class="feild">End Date</div></td>
<td><input class="tcal" type="input" name="end_date" value="<?php echo $end; ?>" /></td>
<td><button type="button" class="btn btn-info" onclick="PrintDiv();">Print</button></div>
</td>
</tr>
</table>


<div class="form-group" style="text-align:center">	

<button type="submit" target="_blank" class="btn btn-info">Submit</button></div>

</form>

</div>
 
 
 <table  class="table table-bordered" id="dynamic-table" >

 
 <thead>
	<tr>
		<th>Particular</th>
		<th>
		
		<div class="row">
		
		
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			<strong>Opening</strong>
			
			</div>
			
			
			<div class="col-sm-12" style="border-top:2px solid;text-align:center;margin:0;padding:0">
			
			
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
					Dr
				
				</div>
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
					Cr
				
				
				</div>
			
			
			</div>
		
		
		</div>
		
		
		
		
		</th>
		<th>
		
		<div class="row">
		
		
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			<strong>Cash</strong>
			
			</div>
			
			
			<div class="col-sm-12" style="border-top:2px solid;text-align:center;margin:0;padding:0">
			
			
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
					Dr
				
				</div>
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
					Cr
				
				
				</div>
			
			
			</div>
		
		
		</div>
		
		
		
		
		</th>
		<th>
		
		<div class="row">
		
		
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			<strong>Bank</strong>
			
			</div>
			
			
			<div class="col-sm-12" style="border-top:2px solid;text-align:center;margin:0;padding:0">
			
			
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
					Dr
				
				</div>
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
					Cr
				
				
				</div>
			
			
			</div>
		
		
		</div>
		
	
		
		
		</th>
		<th>
		
		<div class="row">
		
		
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			<strong>Adjustment</strong>
			
			</div>
			
			
			<div class="col-sm-12" style="border-top:2px solid;text-align:center;margin:0;padding:0">
			
			
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
					Dr
				
				</div>
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
					Cr
				
				
				</div>
			
			
			</div>
		
		
		</div>
		
		
		
		</th>
		<th>
		
		<div class="row">
		
		
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			<strong>Closing</strong>
			
			</div>
			
			
			<div class="col-sm-12" style="border-top:2px solid;text-align:center;margin:0;padding:0">
			
			
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
					Dr
				
				</div>
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
					Cr
				
				
				</div>
			
			
			</div>
		
		
		</div>
		
		
		
		
		</th>
	</tr>
			
			
</thead>
 
<tbody>
 
 
	
 
	<?php 
	
	if(!empty($assets)){
		?>
		
		 <?php $cl_op=0;$cl_c=0;$op_op=0;$op_c=0;$ca_op=0;$ca_c=0;$ba_op=0;$ba_c=0;$ad_op=0;$ad_c=0; $j=1;$tasset=0;$tlib=0; foreach($assets as $as): ?>
 
 	<tr>
			
		<td style="font-size:10px;">
			

		
	<strong><a target="_blank" href="<?php echo base_url(); ?>mains/trial_balance/<?php echo $as['id'] ?>/<?php echo $start ?>/<?php echo $end ?>"><?php echo $as['name'] ?></a></strong>
		
	
		</td>
			
		<td style="font-size:10px;">
		
		
<div class="col-sm-12" style="text-align:center;margin:0;padding:0">		
		
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
<?php	



	   
$dc_total=explode(':',$cog->getOpeningForTrialBalances($as['id'],$start,$end));		   	   	   
$dc_cash=explode(':',$cog->getCashTransaction($as['id'],$start,$end,192));
$dc_bank=explode(':',$cog->getBankBalanceTrail($as['id'],$start,$end));		
//$dc_adjust=explode(':',$cog->getAdjustMent($as['id'],$start,$end));		
	
	
	
	
$dc_adjust[0]=($dc_total[2]-($dc_total[0]+$dc_cash[0]+$dc_bank[0]));
$dc_adjust[1]=($dc_total[3]-($dc_total[1]+$dc_cash[1]+$dc_bank[1]));
	
	
$cl_op=$cl_op+$dc_total[2];
$cl_c=$cl_c+$dc_total[3];


$op_op=$op_op+($dc_total[0]);
$op_c=$op_c+($dc_total[1]);
	
	
$ca_op=$ca_op+($dc_cash[0]);
$ca_c=$ca_c+($dc_cash[1]);	
	
	
$ba_op=$ba_op+($dc_bank[0]);
$ba_c=$ba_c+($dc_bank[1]);		
	
$ad_op=$ad_op+($dc_adjust[0]);
$ad_c=$ad_c+($dc_adjust[1]);		
	
	
echo number_format(round(($dc_total[0]),2), 2, '.', ',');	
	
	//echo $dc_total[0];
	
	
?>	
		
		</div>
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
		<?php echo number_format(round(($dc_total[1]),2), 2, '.', ',');	
 //echo $dc_total[1]; ?>
		
		
		</div>
		
		
</div>
		
		</td>	
		
		
		<td style="font-size:10px;">
		
		
<div class="col-sm-12" style="text-align:center;margin:0;padding:0">		
		
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
		<?php echo number_format(round(($dc_cash[0]),2), 2, '.', ',');	
 //echo $dc_cash[0]; ?>
		
		</div>
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
		<?php echo number_format(round(($dc_cash[1]),2), 2, '.', ','); ?>
		
		</div>
		
		
</div>
		
		</td>
		
		
	<td style="font-size:10px;">
		
		
<div class="col-sm-12" style="text-align:center;margin:0;padding:0">		
		
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
		
	


		<?php

		//echo $dc_bank[0];


echo number_format(round(($dc_bank[0]),2), 2, '.', ',');

		?>
		



	
		
		
		
		
		</div>
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
		
<?php


 //echo $dc_bank[1]; 
 
 echo number_format(round(($dc_bank[1]),2), 2, '.', ',');

 
 
 ?>		
		</div>
		
		
</div>
		
		</td>	
		
		
		<td style="font-size:10px;">
		
		
<div class="col-sm-12" style="text-align:center;margin:0;padding:0">		
		
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
<?php

 //echo $dc_adjust[0];

 echo number_format(round(($dc_adjust[0]),2), 2, '.', ',');


 ?>		
		
		</div>
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
<?php 

//echo $dc_adjust[1]; 

 echo number_format(round(($dc_adjust[1]),2), 2, '.', ',');


?>		
		
		</div>
		
		
</div>
		
		</td>
		
		
		<td style="font-size:10px;">
		
		
<div class="col-sm-12" style="text-align:center;margin:0;padding:0">		
		
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
<?php


 $d= ($dc_total[2]); 
 
  echo number_format(round(($d),2), 2, '.', ',');

 ?>		</div>
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
<?php


 $cs= $dc_total[3];


  echo number_format(round(($cs),2), 2, '.', ',');

 
 
 
 ?>		
		</div>
		
		
</div>
		
		</td>
			
			
	</tr>
 
 
 
 
 
 
 
 
 
 <?php endforeach; ?>
 
 
	
		
				
				
				
		
				
				
		
		
		<?php
		$name=null;
		$name2=null;
			if($id == 1)
			{
				
			$name="Purchase";	
		$store=explode(':',$cog->getPurchaseValueopening($start,$end,5));
			}
			else if($id == 3){
				
				
			$store=explode(':',$cog->getPurchaseValueopening($start,$end,205));	
			$name="Sales Discount";	
				
			}
			else if($id == 4){
				
				
		$name="Vat";
		$name2="Prior Year Adjustment";
				
		$vat=explode(':',$cog->getLessVatTrail($start,$end));	
	   $priors_b=explode(":",$cog->getLessDiscount_prorTrail($start,$end,532));
				
				
				
				
			}
			?>	
		
		
		<?php 
		
		
			if($id == 1 || $id == 3){
				
				?>
				
				
		<tr>		
				
				
				<td style="font-size:10px;"><?php echo $name; ?></td>
		<td style="font-size:10px;">
		
		<div class="row">
		
		
			
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
					<?php 

					echo number_format(round(($store[0]),2), 2, '.', ',');
					
					$op_op=$op_op+$store[0];
					$op_c=$op_c+$store[1];
					$cl_op=$cl_op+$store[2];
					$cl_c=$cl_c+$store[3];
					
					
					
// echo $store[0]; ?>
				
				</div>
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
				<?php echo number_format(round(($store[1]),2), 2, '.', ','); //echo $store[1]; ?>
				
				
				</div>
			
			
			</div>
		
		
		</div>
		
		
		
		
		</td>
		<td style="font-size:10px;">
		
		
		
		
		
		
		</td>
		<td style="font-size:<?php $pix; ?>px;">
		
	
		
		
		</td>
		<td style="font-size:<?php $pix; ?>px;">
		
		
		
		
		</td>
		<td style="font-size:10px;">
		
		<div class="row">
		
		
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
					<?php echo number_format(round(($store[2]),2), 2, '.', ','); ?>
				
				</div>
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
				<?php echo number_format(round(($store[3]),2), 2, '.', ','); ?>
				
				
				</div>
			
			
			</div>
		
		
		</div>
		
		
		
		
		</td>
			
				
				
		</tr>		
				
				
				
				
				
				
				<?php
				
			}
			else if($id == 4)
			{
				
				
					
					$op_op=$op_op+$priors_b[2];
					$op_c=$op_c+$priors_b[3];
					$cl_op=$cl_op+$priors_b[0];
					$cl_c=$cl_c+$priors_b[1];

				$op_op=$op_op+$vat[2];
					$op_c=$op_c+$vat[3];
					$cl_op=$cl_op+$vat[0];
					$cl_c=$cl_c+$vat[1];
				
				
				
				?>
				
				
				
		<tr>		
				
		<td style="font-size:10px;"><?php echo $name; ?></td>
		<td style="font-size:10px;">
		
		<div class="row">
		
		
			
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
					<?php 

					echo number_format(round(($vat[2]),2), 2, '.', ',');
					
					
					
// echo $store[0]; ?>
				
				</div>
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
				<?php echo number_format(round(($vat[3]),2), 2, '.', ','); //echo $store[1]; ?>
				
				
				</div>
			
			
			</div>
		
		
		</div>
		
		
		
		
		</td>
		<td style="font-size:<?php $pix; ?>px;">
		
		
		
		
		
		
		</td>
		<td style="font-size:<?php $pix; ?>px;">
		
	
		
		
		</td>
		<td style="font-size:<?php $pix; ?>px;">
		
		
		
		
		</td>
		<td style="font-size:10px;">
		
		<div class="row">
		
		
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
					<?php echo number_format(round(($vat[0]),2), 2, '.', ','); ?>
				
				</div>
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
				<?php echo number_format(round(($vat[1]),2), 2, '.', ','); ?>
				
				
				</div>
			
			
			</div>
		
		
		</div>
		
		
		
		
		</td>
			
				
				
				
		</tr>		
				
		<tr>		
				
		<td style="font-size:10px;"><?php echo $name2; ?></td>
		<td style="font-size:10px;">
		
		<div class="row">
		
		
			
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
					<?php 

					echo number_format(round(($priors_b[2]),2), 2, '.', ',');
					
					
					
// echo $store[0]; ?>
				
				</div>
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
				<?php echo number_format(round(($priors_b[3]),2), 2, '.', ','); //echo $store[1]; ?>
				
				
				</div>
			
			
			</div>
		
		
		</div>
		
		
		
		
		</td>
		<td style="font-size:<?php $pix; ?>px;">
		
		
		
		
		
		
		</td>
		<td style="font-size:<?php $pix; ?>px;">
		
	
		
		
		</td>
		<td style="font-size:<?php $pix; ?>px;">
		
		
		
		
		</td>
		<td style="font-size:10px;">
		
		<div class="row">
		
		
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
					<?php echo number_format(round(($priors_b[0]),2), 2, '.', ','); ?>
				
				</div>
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
				
				<?php echo number_format(round(($priors_b[1]),2), 2, '.', ','); ?>
				
				
				</div>
			
			
			</div>
		
		
		</div>
		
		
		
		
		</td>
			
				
				
				
		</tr>		
					
				
				
				
				<?php
				
				
				
				
			}
		
		
		?>
		
		
		
		
		
		
		
		
		
		
				
				
				
				
				
				
				
				
				
				
			
 
 
		
	
 
 
 
 
 
		<?php
	}
	else{
		
		
	$data['all']=$this->news_model->getTrialBalance('ledger','parent_head_id',$id);	
		
		?>
		
		
		
		 <?php $cl_op=0;$cl_c=0;$op_op=0;$op_c=0;$ca_op=0;$ca_c=0;$ba_op=0;$ba_c=0;$ad_op=0;$ad_c=0; $j=1;$tasset=0;$tlib=0;


		 foreach($data['all'] as $as): ?>
		
		
		
		
		
		<tr>
			
		<td  style="font-size:10px;">
			

		
	<strong>
	
	<?php echo $as['ledger_title'] ?>
	
	</strong>
		
	
		</td>
			
		<td  style="font-size:10px;">
		
		
<div class="col-sm-12" style="text-align:center;margin:0;padding:0">		
		
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
<?php	



	   
$dc_total=explode(':',$cog->getOpeningForTrialBalances($as['id'],$start,$end,1));		   
	   
	   
$dc_cash=explode(':',$cog->getCashTransaction($as['id'],$start,$end,192,1));


	
$dc_bank=explode(':',$cog->getBankBalanceTrail($as['id'],$start,$end,1));	


	
$dc_adjust=explode(':',$cog->getAdjustMent($as['id'],$start,$end,1));		
	
	
	$ch=($dc_total[2]-($dc_total[0]+$dc_cash[0]+$dc_bank[0]));
	$chs=($dc_total[3]-($dc_total[1]+$dc_cash[1]+$dc_bank[1]));
	
	$dc_adjust[0]=0;
	$dc_adjust[1]=0;
	if($ch > 0)
	{
		
		$dc_adjust[0]=$ch;
		
		
	}
	if($chs > 0){
		
		$dc_adjust[1]=$chs;
		
	}
	//$dc_adjust[0]=;
	
	
	
$cl_op=$cl_op+$dc_total[2];
$cl_c=$cl_c+$dc_total[3];


$op_op=$op_op+($dc_total[0]);
$op_c=$op_c+($dc_total[1]);
	
	
$ca_op=$ca_op+($dc_cash[0]);
$ca_c=$ca_c+($dc_cash[1]);	
	
	
$ba_op=$ba_op+($dc_bank[0]);
$ba_c=$ba_c+($dc_bank[1]);		
	
$ad_op=$ad_op+($dc_adjust[0]);
$ad_c=$ad_c+($dc_adjust[1]);		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
echo number_format(round(($dc_total[0]),2), 2, '.', ',');	
	
	//echo $dc_total[0];
	
	
?>	
		
		</div>
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
		<?php echo number_format(round(($dc_total[1]),2), 2, '.', ',');	
 //echo $dc_total[1]; ?>
		
		
		</div>
		
		
</div>
		
		</td>	
		
		
		<td style="font-size:10px;">
		
		
<div class="col-sm-12" style="text-align:center;margin:0;padding:0">		
		
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
		<?php echo number_format(round(($dc_cash[0]),2), 2, '.', ',');	
 //echo $dc_cash[0]; ?>
		
		</div>
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
		<?php echo number_format(round(($dc_cash[1]),2), 2, '.', ','); ?>
		
		</div>
		
		
</div>
		
		</td>
		
		
	<td  style="font-size:10px;">
		
		
<div class="col-sm-12" style="text-align:center;margin:0;padding:0">		
		
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
		
	


		<?php

		//echo $dc_bank[0];


echo number_format(round(($dc_bank[0]),2), 2, '.', ',');

		?>
		



	
		
		
		
		
		</div>
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
		
<?php


 //echo $dc_bank[1]; 
 
 echo number_format(round(($dc_bank[1]),2), 2, '.', ',');

 
 
 ?>		
		</div>
		
		
</div>
		
		</td>	
		
		
		<td style="font-size:10px;">
		
		
<div class="col-sm-12" style="text-align:center;margin:0;padding:0">		
		
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
<?php

 //echo $dc_adjust[0];

 echo number_format(round(($dc_adjust[0]),2), 2, '.', ',');


 ?>		
		
		</div>
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
<?php 

//echo $dc_adjust[1]; 

 echo number_format(round(($dc_adjust[1]),2), 2, '.', ',');


?>		
		
		</div>
		
		
</div>
		
		</td>
		
		
		<td style="font-size:10px;">
		
		
<div class="col-sm-12" style="text-align:center;margin:0;padding:0">		
		
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
<?php


 $d= ($dc_total[2]); 
 
  echo number_format(round(($d),2), 2, '.', ',');

 ?>		</div>
		<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		
<?php


 $cs= ($dc_total[3]); 


  echo number_format(round(($cs),2), 2, '.', ',');

 
 
 
 ?>		
		</div>
		
		
</div>
		
		</td>
			
			
	</tr>
		
		
		
	<?php endforeach; ?>	
		
		
		
		
		<?php
		
	}
	
	?>
 
 
 
 <tr>
 
 <td style="font-size:10px;"></td>
		<td style="font-size:10px;">
		
		<div class="row">
		
		
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			
			
			</div>
			
			
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
			<strong>	
				
	<?php   echo number_format(round(($op_op),2), 2, '.', ','); ?>
			</strong>	
				</div>
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
			<strong>	
	<?php   echo number_format(round(($op_c),2), 2, '.', ','); ?>
			</strong>	
				
				</div>
			
			
			</div>
		
		
		</div>
		
		
		
		
		</td>
		<td style="font-size:10px;">
		
		<div class="row">
		
		
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			
			</div>
			
			
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
			<strong>	
				
	<?php   echo number_format(round(($ca_op),2), 2, '.', ','); ?>
			</strong>	
				</div>
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
			<strong>	
				
	<?php   echo number_format(round(($ca_c),2), 2, '.', ','); ?>
			</strong>	
				
				</div>
			
			
			</div>
		
		
		</div>
		
		
		
		
		</td>
		<td style="font-size:10px;">
		
		<div class="row">
		
		
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			
			</div>
			
			
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
		<strong>		
	<?php   echo number_format(round(($ba_op),2), 2, '.', ','); ?>
		</strong>		
				</div>
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
		<strong>		
	<?php   echo number_format(round(($ba_c),2), 2, '.', ','); ?>
				
		</strong>		
				</div>
			
			
			</div>
		
		
		</div>
		
	
		
		
		</td>
		<td style="font-size:10px;">
		
		<div class="row">
		
		
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			
			</div>
			
			
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
		<strong>		
				
	<?php   echo number_format(round(($ad_op),2), 2, '.', ','); ?>
		</strong>		
				</div>
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
		<strong>		
	<?php   echo number_format(round(($ad_c),2), 2, '.', ','); ?>
			</strong>	
				
				</div>
			
			
			</div>
		
		
		</div>
		
		
		
		</td>
		<td style="font-size:10px;">
		
		<div class="row">
		
		
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			
			</div>
			
			
			<div class="col-sm-12" style="text-align:center;margin:0;padding:0">
			
			
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
		<strong>		
	<?php   echo number_format(round(($cl_op),2), 2, '.', ','); ?>
		</strong>		
				</div>
				<div class="col-sm-6 col-xs-6" style="margin:0;padding:0">
				
		<strong>		
	<?php   echo number_format(round(($cl_c),2), 2, '.', ','); ?>
				
			</strong>		
				</div>
			
			
			</div>
		
		
		</div>
		
		
		
		
		</td>
 
 
 
 
 
 
 
 </tr>
 
 
 

 
 
 
 
</tbody>
</table>
 
 
 
 </div>
 

</section>

</div>

 
 
 
 
 </div>
 
 
 
 
 
 
 
</section>
</section>