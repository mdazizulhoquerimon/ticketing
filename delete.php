<?php

// $name = 123;

// echo "<img class='news-thumb' src='barcode/".$name.".gif'/>";



$host="localhost";
$username="cursor";
$password="sVP;kpQVNLTU";
$db_name="cursor_obs";

//$username="root";
//$password="";
//$db_name="cursor_yes";


$w=$_GET['id'];
$by=$_GET['to'];





	if(empty($w)){
		
		
		?>
		
		
 <script language="JavaScript">
 self.location="http://www.cursorbd.com/obs/";
 </script>
		
		
		<?php
	}



$tbl_name="table";
$con=mysql_connect("$host", "$username", "$password")or die("cannot cannect");
mysql_select_db("$db_name")or die ("cannot select DB");


$sql="delete FROM `bar_code_label` where ware='$w'";


$bar=$by."".$w.".gif";

unlink('./barcode/'.$bar);



$result=mysql_query($sql);

header("Location: gen.php");

// $pieces[0] = "SL75";

// $result1 = mysql_query("SELECT selling_price FROM `store` WHERE `bar_code` = '$pieces[0]' ORDER BY id DESC LIMIT 1");
// $row1 = mysql_fetch_array($result1);
// echo "<div class='price'>TK.".$row1['selling_price']."</div>";


?>

