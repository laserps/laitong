<?php
$page_admin = "main.php?op=category&act=list";
$tbl = "tb_category";
$fiel_id = "id_category";



$message_alert = array("num_category"=>"กรุณากรอกรหัสประเภทสินค้า","name_category"=>"กรุณากรอกชื่อประเภทสินค้าด้วยค่ะ");

$data = array('num_category'=>$_POST['num_category'],'name_category' => $_POST['name_category']);


?>


