<?php




$host="localhost";
$username="cursor";
$password="sVP;kpQVNLTU";
$db_name="cursor_obs";


//$username="root";
//$password="";
//$db_name="cursor_yes";

$tbl_name="table";
$con=mysql_connect("$host", "$username", "$password")or die("cannot cannect");
mysql_select_db("$db_name")or die ("cannot select DB");



session_start();
$session_id= session_id( );

	



$t=mysql_query("select * from password where session='$session_id'");
$c=null;
$w=null;
$by=null;
$barcodess=null;
while($row=mysql_fetch_array($t)){
	
	
	
	$c=$row['session'];
	$w=$row['ware'];
	$by=$row['id'];
	
}


	if($c != $session_id)
	{
		?>
		
		
 <script language="JavaScript">
 self.location="http://www.cursorbd.com/obs/";
 </script>
		
		
		<?php
		
	}









?>

<div style="padding:10px;color:red;background:black;margin-bottom:10px">

		<a style="color:white;font-weight:bold" href="http://www.cursorbd.com/obs/">Home</a>


</div>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

Code: <input id="product" type="text" name="name">

Quantity: <input type="text" name="quantity">

Size:<select name="class">
<option value="small">Small</option>
<option value="normal">Normal</option>

<option value="ssmall">Super Small</option>
</select>




<br>
<input type="submit" name="submit">
</form>



<script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('divToPrint');
           var popupWin = window.open('', '_blank', 'width=900,height=900');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
     </script>
<div><input type="button" value="print" onclick="PrintDiv();" /></div>


 <div id="divToPrint" style="padding: 20px;margin:auto">

 
 <style>
 .small
{
 float: left;
    font-size: 10px;
    text-align: center;
	margin: 15px 10px;
	
}

.small .price
{
margin-top: 0px;
font-size: 12px;
font-weight: 700;
}
.ssmall .product
{
margin-bottom: -2px;
}
 
 
 
.ssmall
{
 float: left;
    font-size: 10px;
    text-align: center;
	margin: 5px;
}

.ssmall .price
{
margin-top: 0px;
font-size: 9px;
font-weight:700;
}
.ssmall .product
{
margin-bottom: 0px;
}

.normal
{
 float: left;
    font-size: 13px;
    text-align: center;
	margin: 5px;
	font-weight:700;
}

.normal .price
{
margin-top: 0px;
}

.large
{
 float: left;
    font-size: 10px;
    text-align: center;
	margin: 5px;
	font-weight:700;
}
.price a
{
color: black;
    text-decoration: none;
}
</style>










<?php


if(isset($_POST['quantity'])) 
{ 

$bar_code = $name = $_POST['name'];
$class = $_POST['class'];
$pieces = explode("+", $name);
$name = $pieces[0]; // piece1
// $code = $_POST['code'];


$batch=mysql_query("select * from product_ledger where code='$bar_code' and ware='$w'");
$bat=null;
$dat=null;
$pname=null;
while($row=mysql_fetch_array($batch)){
	
	
	
	$pname=$row['name'];
	
}




// $bar_code = $pieces[0];
$quantity = $_POST['quantity'];
// $age = $_POST['age'];

for($i=1;$i<=$_POST['quantity']; $i++)
{
$sql="INSERT INTO bar_code_label (id, bar_code, size, quantity,ware,session)
VALUES ('', '$bar_code', '$class', '$quantity','$w','$by')";

$retval = mysql_query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
}

include "Barcode39.php"; 


$sql="SELECT * FROM `bar_code_label` where ware='$w' and session='$by'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$bc = new Barcode39($row['bar_code']); 


if($class=="large")
{
$bc->barcode_height = 50;
$bc->barcode_text_size = 2; 




}


if($class=="normal")
{
$bc->barcode_height = 60;
$bc->barcode_text_size = 3; 
$bc->barcode_text = false;
$bc->barcode_bar_thin = 1; 
$bc->barcode_bar_thick = 2;
$bc->barcode_padding = 1;




}


if($class=="small")
{
$bc->barcode_height = 20;
$bc->barcode_text_size = 0.5; 
$bc->barcode_text = false;
$bc->barcode_bar_thin = 1; 
$bc->barcode_bar_thick = 2;
$bc->barcode_padding = 1;


}


if($class=="ssmall")
{
$bc->barcode_height = 25;
$bc->barcode_text_size = 0; 
$bc->barcode_text = false;
$bc->barcode_bar_thin = 1; 
$bc->barcode_bar_thick = 2;
$bc->barcode_padding = 0.5;

}



$barcodess=$row['bar_code'];


$bc->draw("barcode/".$row['bar_code']."$w".".gif");



echo "<div class='".$class."'>";


$result1 = mysql_query("SELECT code,selling_price FROM `product_ledger` WHERE `code` = '$row[bar_code]'");
$row1 = mysql_fetch_array($result1);
echo "<div class='product' style='font-weight:bold;font-size:14px;'>".$row['bar_code']."</div>";



echo "<img class='news-thumb' src='barcode/".$row['bar_code']."$w".".gif'/><br/>";

//echo "<div class='product' style='font-size:12px;'>".$row1['selling_price']."</div>";

// echo "<div class='product'>".$row1['bar_code']."</div>";
echo "</div>";
}

// $bc->draw();
}

?>

</div>

<a href="delete.php?id=<?php echo $w ?>&to=<?php echo $barcodess; ?>" onclick="return confirm('Are you sure want to delete');">
<span style="color:red;float:right">Delete All</span>