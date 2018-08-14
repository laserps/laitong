<?php
require "../module/class.database.php";

$sys = new Database();

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

$row = $sys->result("tb_product", $where = NULL, "id_product desc", " 0,10627");

foreach($row as $rs){

	$num_1  = substr($rs->dm_product, -13,12);
	$num_2  = substr($num_1, -11);
	$digits = '1'.$num_2;
	$digit = ean13_check_digit($rs->dm_product);
	$barcode = $num_1.$digit;
	echo $barcode;
	$data = array("barcode_product"=>$barcode);
	$sys->update("tb_product",$data," id_product = '".$rs->id_product."' ");
}

?>