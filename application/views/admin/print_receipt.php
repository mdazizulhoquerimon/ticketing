<?php if (1)
{
?>
<script type="text/javascript">



$(window).load(function()
{
	
		if (window.jsPrintSetup) 
		{
			
		var divToPrint = document.getElementById('print');
var win = window.open('', '_blank');
	win.document.write('<html><head><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><style>tr{line-height:15px;}</style><link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css"></head><body>');
	win.document.write($("#print").html());
	win.document.write('</body></html>');
	win.print();
	win.close();
		}
		else
		{
			var divToPrint = document.getElementById('print');
var win = window.open('', '_blank');
	win.document.write('<html><head><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><style>tr{line-height:15px;}</style><link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css"></head><body>');
	win.document.write($("#print").html());
	win.document.write('</body></html>');
	win.print();
	win.close();
		}
		
		
		
		//window.location="http://localhost/ospos/index.php/sales";
		
		
	
});
</script>
<?php
}

?>