<?php
echo '<pre>';
$file_ = file_get_contents('http://workbythaidev.com/api/price_gold.php');
$num1 = explode('span',$file_);
var_dump($num1[15]);

?>