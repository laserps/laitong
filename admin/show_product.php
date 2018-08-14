<?php 
include '../module/class.database.php';
include '../module/class.func.php';
$sys = new Database();
$fnc = new func();

function ean13_check_digit($digits){
		$digits =(string)$digits;
		$even_sum = $digits{1} + $digits{3} + $digits{5} + $digits{7} + $digits{9} + $digits{11};
		$even_sum_three = $even_sum * 3;
		$odd_sum = $digits{0} + $digits{2} + $digits{4} + $digits{6} + $digits{8} + $digits{10};
		$total_sum = $even_sum_three + $odd_sum;
		$next_ten = (ceil($total_sum/10))*10;
		$check_digit = $next_ten - $total_sum;
		return  $check_digit;
    }



	$num_1  = substr($_POST['dm_product'], -13,12);
	$num_2  = substr($num_1, -11);
	$digits = '1'.$num_2;
	$digit = ean13_check_digit($digits);
	$barcode = "1".$num_2.$digit;


$rs = $sys->record('tb_product,tb_stock',' tb_stock.id_stock = tb_product.id_stock and   tb_product.barcode_product = "'.$_POST['dm_product'].'" ');

$row_category = $sys->result("tb_category",NULL, 'name_category asc');
$row_type	  = $sys->result("tb_type_product",NULL, 'name_type_product asc');
$row_color	  = $sys->result("tb_color",NULL, 'name_color asc');
$row_stock	  = $sys->result("tb_stock",NULL, 'name_stock asc');
?>