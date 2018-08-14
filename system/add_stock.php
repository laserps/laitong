<?php
$page_admin = "main.php?op=add_stock&act=list";
$tbl = "tb_add_stock";
$fiel_id = "id_add_stock";

$join	= ' 
left join tb_product on tb_product.id_product = tb_add_stock.id_product
left join tb_member on tb_member.id_member = tb_add_stock.id_member
';

$message_alert = array("id_product"=>"สินค้านี้ไม่มีในสต๊อกค่ะ","tottal_add_stock"=>"กรุณากรอกจำนวนด้วยค่ะ");






$data = array(
			'id_product'			=> $_POST['id_product'],
			'tottal_add_stock'		=> $_POST['tottal_add_stock'],
			'id_member'				=> $_SESSION['id_member'],
			'date_add_stock'		=> date("Y-m-d"),
			'remark_add_stock'		=> $_POST['remark_add_stock']
		);




?>