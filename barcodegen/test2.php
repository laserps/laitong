
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style>
body { margin: 0px 0px 0px 0px; }
.text_barcode{
	font-size:9px;
	font-weight:bold;
}
.text_ston_sum{

	font-size:8px;
	
}

</style>

</head>


<body  >
<?php 
$num_2 = substr($_GET['dm_product'], -12);
$code_product = $_GET['code_product'];
$dm_product   = $_GET['dm_product'];
$stone_sum_1_product = (urldecode($_GET['stone_sum_1_product']));
$stone_sum_2_product = (urldecode($_GET['stone_sum_2_product']));
$stone_sum_3_product = (urldecode($_GET['stone_sum_3_product']));
$stone_sum_4_product = (urldecode($_GET['stone_sum_4_product']));



?>
<table border = "0" cellspacing = "0" cellpadding = "0">
<tr>
	<td style = "width: 2px;">&nbsp;</td>
	<td align = "center" class = "text_barcode"><b><?php echo (trim($code_product));?></b></br>
	<img src="test.php?id=<?php echo (trim($dm_product));?>"  alt = "พิมพ์บาร์โค๊ท"></td>
	
	<td class = "text_ston_sum"><?php echo (trim(htmlspecialchars($stone_sum_1_product)));?></br><?php echo "<b>".(trim(htmlspecialchars($stone_sum_2_product)))."</b>";?> (<?php echo $_GET['size_'];?>)<br><?php echo (trim(htmlspecialchars($stone_sum_3_product)));?> <br><?php echo (trim(htmlspecialchars($stone_sum_4_product)));?>
	</td>
</tr>
</table>
</body>
</html>
<script type="text/javascript">
window.print();
</script>