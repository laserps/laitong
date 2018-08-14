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


	$rs_check = $sys->record("tb_product", "barcode_product = '".$_POST['barcode_product']."'" );


	if($rs_check->id_product ==""){
	$rs = $sys->record("tb_product", "id_product = '".$_POST['id_product']."'" );


	$num_1  = substr($_POST['barcode_product'], -4,13);
	$num_2  = substr($_POST['barcode_product'], 0,-4);
	$new_bar =  $num_2.$num_1;
	$sub_new_bar = substr($new_bar, 0,12);

	$digit   = ean13_check_digit($new_bar);
	$barcode = $sub_new_bar.$digit;
	
	$data = array("barcode_product"=>$barcode);
	$sys->update("tb_product",$data," id_product = '".$rs->id_product."' ");
	echo $barcode;
	}else{
	echo "1";
	}

?>