<?php
require "../module/class.database.php";

$sys = new Database();
$row = $sys->result("tb_product", $where = NULL, "id_product desc", " 0,10627");

foreach($row as $rs){
$string = ''.$rs->code_product.'';
$patterns = array();
$patterns[0] = '/-/';
$replacements = array();
$replacements[0] = '';
$new_num =  preg_replace($patterns, $replacements, $string);

$data = array("product_id_re"=>$new_num);
//echo $new_num,"<br>";
$sys->update("tb_product",$data," id_product = '".$rs->id_product."' ");
}
?>
