<?php
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



$data = "4400004911796";


echo $data."<br>";
$num_1  = substr($data, -13,2);
$num_2  = substr($data, -11,9);
$num_3  = substr($data, -2,13);
echo $num_1."-".$num_2."-".$num_3;
//$digits = '1'.$num_2;
//$digit = ean13_check_digit($digits);

//echo "1".$num_2.$digit;


?>