<?
$page_admin = "main.php?op=product_no_return&act=list";
$tbl = "tb_product";
$fiel_id = "id_product";


	
if($_FILES['file']['name']!=""){
$data = array(
			'f_id_product'				=> $_POST['f_id_product'],
			'name_product'			    => $_POST['name_product'],
			'name_product_thai'			=> $_POST['name_product_thai'],
			'name_student'				=> $_POST['name_student'],
			'teacher_student'			=> $_POST['teacher_student'],
			'date_student'				=> $_POST['date_student'],
			'name_file'					=> $fnc->upload($_FILES['file']['tmp_name'],$_FILES['file']['name'],"../file_pdf"),
			'status_product'			=>"0"
		);
}else{

$data = array(
			'f_id_product'				=> $_POST['f_id_product'],
			'name_product'			    => $_POST['name_product'],
			'name_product_thai'			=> $_POST['name_product_thai'],
			'name_student'				=> $_POST['name_student'],
			'teacher_student'			=> $_POST['teacher_student'],
			'date_student'				=> $_POST['date_student']
		);
}



?>