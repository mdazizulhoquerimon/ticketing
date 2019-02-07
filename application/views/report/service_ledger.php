<div id="page-wrapper">
    <div class="container-fluid">
	
		<div class="panel panel-default">
		
		<div class="panel-heading">
		
			Service Report
		
		</div>
		<div class="panel-body">
		
		
		
		
		
		<form action="<?php echo base_url(); ?>mains/service_ledger" method="post">
<table align="center">
<tr>

<td><label for="text">Ledger</label>	</td>
<td><span class="input-wrap"> <input type="input" name="ledger_id" id="tag"></span></td>

<td><div class="feild">Start Date</div></td>
<td><input class="tcal" type="input" name="start_date" value="<?php echo date('d-m-Y') ?>" /></td>

<td><div class="feild">End Date</div></td>
<td><input class="tcal" type="input" name="end_date" value="<?php echo date('d-m-Y'); ?>" /></td>
</tr>
</table>


<div class="form-group" style="text-align:center">	
<button type="submit" target="_blank" class="btn btn-info">Submit</button></div>

</form>
		
		
		
		
		
		
		
		
		
		</div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		</div>
			<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>


<script src="<?php echo base_url(); ?>js/custom/link.js"></script>

<script src="<?php echo base_url(); ?>js/custom/mul.js"></script>




<script src="<?php echo base_url(); ?>js/custom/tcal.js"></script>	



	</div>
	
</div>


<?php

function convert_number($number) 
{ 
    if (($number < 0) || ($number > 999999999)) 
    { 
    throw new Exception("Number is out of range");
    } 

    $Gn = floor($number / 100000);  /* Millions (giga) */ 
    $number -= $Gn * 100000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 

    if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Lac"; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Thousand"; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 
} 
?>