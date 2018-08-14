<?php
$num_1  = substr("2200007696093", -4,13)+1000;

$num_2  = substr("2200007696093", 0,-4);


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




echo "2200007696093"."<br>";


echo $num_1."<br>";

$new_bar =  $num_2.$num_1;
$digit   = ean13_check_digit($new_bar);

$sub_new_bar = substr($new_bar, 0,12);

echo $sub_new_bar.$digit ;

?>