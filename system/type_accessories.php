<?php
$page_admin = "main.php?op=".$_GET['op']."&act=list";
$tbl = "tb_type_accessories";
$fiel_id = "id_type_accessories";


$message_alert = array("name_type_accessories"=>"กรุณากรอกชื่อค่ะ");

$data = array(
		'name_type_accessories'			=> $_POST['name_type_accessories']
				);


?>


