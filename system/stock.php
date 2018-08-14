<?php
$page_admin = "main.php?op=".$_GET['op']."&act=list";
$tbl = "tb_stock";
$fiel_id = "id_stock";


$message_alert = array("name_stock"=>"กรุณากรอกชื่อสต๊อกค่ะ");

$data = array(
		'name_stock'			=> $_POST['name_stock'],
		'date_stock'			=> $_POST['date_stock'],
		'date_create_stock'		=> date("Y-m-d"),
		'id_member'				=> $_SESSION['id_member'],
		'level_stock'			=> $_POST['level_stock']

				);


?>


