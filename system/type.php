<?php
$page_admin = "main.php?op=type&act=list";
$tbl = "tb_type_product";
$fiel_id = "id_type_product";



$message_alert = array("name_type_product"=>"กรุณากรอกชื่อประเภทค่ะ");

$data = array(
'name_type_product'		=> $_POST['name_type_product'],
'num_type_product'		=> $_POST['num_type_product'],
);


?>


