<?
$page_admin = "main.php?op=rent&act=list";
$tbl = "tb_rent_temp,tb_member,tb_product,tb_stock";
$fiel_id = "id_rent_temp";


	
$data = array(
			'id_rent_temp'				=> $_POST['id_rent_temp'],
			'id_member'					=> $_POST['id_member'],
			'id_product'				=> $_POST['id_product'],
			'date_rent_temp'			=> $_POST['date_rent_temp'],
			'id_rent'					=> $_POST['teacher_student']
		);




?>