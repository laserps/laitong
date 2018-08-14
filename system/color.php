<?php
$page_admin = "main.php?op=".$_GET['op']."&act=list";
$tbl = "tb_color";
$fiel_id = "id_color";


$message_alert = array("name_color"=>"กรุณากรอกชื่อสีค่ะ");

$data = array(
		'name_color'			=> $_POST['name_color']
				);


?>


