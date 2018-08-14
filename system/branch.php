<?php
$page_admin = "main.php?op=branch&act=list";
$tbl = "tb_branch";
$fiel_id = "id_branch";



$message_alert = array("name_branch"=>"กรุณากรอกสาขาค่ะ");

$data = array(
				'name_branch'		=> $_POST['name_branch'],
				'status_branch'		=> $_POST['status_branch'],
				'num_branch'		=> $_POST['num_branch'],
				'status_calculate'	=> $_POST['status_calculate']

);


?>
