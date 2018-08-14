<?php
$page_admin = "main.php?op=product&act=list";
$tbl = "tb_product";
$fiel_id = "id_product";

$join	= ' 
left join tb_stock on tb_stock.id_stock = tb_product.id_stock
left join tb_category on tb_category.id_category = tb_product.id_category
left join tb_sub_category on tb_sub_category.id_sub_category = tb_product.id_sub_category
left join tb_type_product on tb_type_product.id_type_product = tb_product.id_type_product
left join tb_diamond on tb_diamond.id_diamond = tb_product.id_diamond
left join tb_medicine on tb_medicine.id_medicine = tb_product.id_medicine
left join tb_backmunk on tb_backmunk.id_backmunk = tb_product.id_back_munk
left join tb_type_accessories on  tb_type_accessories.id_type_accessories = tb_product.id_type_accessories
';

$message_alert = array("name_stock"=>"กรุณากรอกชื่อสต๊อกค่ะ");

function re_id_product($id_product){
	$string = ''.$id_product.'';
    $patterns = array();
    $patterns[0] = '/-/';
    $replacements = array();
    $replacements[0] = '';
    $new_num =  preg_replace($patterns, $replacements, $string);
	return $new_num;
}
	
if( ($_FILES['file']['name']!="") and ($_FILES['file2']['name'] != "") ){
        require '../include/resize.php';
		$path = '../img_product/';
		
		$fileupload=$_FILES['file']['tmp_name'];
		$fileupload_name=$_FILES['file']['name'];
		$fileupload2=$_FILES['file2']['tmp_name'];
		$fileupload_name2=$_FILES['file2']['name'];
		$pic1_w=150;$pic1_h=150;
		$pic2_w=300;$pic2_h=300;
		$imagename=upLoadimage($fileupload,$fileupload_name,$path,$pic1_w,$pic1_h,$pic2_w,$pic2_h);
		$imagename2=upLoadimage($fileupload2,$fileupload_name2,$path,$pic1_w,$pic1_h,$pic2_w,$pic2_h);

$data = array(
	        'barcode_product'			=> $_POST['barcode_product'],
	        'soom'						=> $_POST['soom'],
	        'code_product'			    => $_POST['p1']."-".$_POST['p2']."-".$_POST['p3']."-".$_POST['p4'],
			'type'						=> $_POST['type'],			
			'id_category'				=> $_POST['id_category'],
			'id_sub_category'		    => $_POST['id_sub_category'],
	        'size'						=> $_POST['size'],
			'id_diamond'				=> $_POST['id_diamond'],
			'total_diamond'				=> $_POST['total_diamond'],
	        'diamond_price'				=> $_POST['wage_diamond_sum'],
			'id_back_munk'				=> $_POST['id_back_munk'],
	        'id_type_product'			=> $_POST['id_type_product'],
			'id_medicine'				=> $_POST['id_medicine'],
	        'special_wage'				=> $_POST['special_wage'],
			'special_si'				=> $_POST['special_si'],
	        'weight'					=> $_POST['weight'],
	        'date_product'				=> $fnc->_date($_POST['date_product']),
	        'total_product'				=> $_POST['total_product'],
	        'stone_sum_1_product'		=> $_POST['stone_sum_1_product'],
			'remark_wage'				=> $_POST['remark_wage'],
	        'id_stock'					=> $_POST['id_stock'],
	        'remark_product'			=> $_POST['remark_product'],
			'id_type_accessories'		=> $_POST['id_type_accessories'],
			'picture_1_product'			=> $imagename,
			'picture_2_product'			=> $imagename2,
			'id_stock'					=> $_POST['id_stock'],
			'product_id_re'				=> re_id_product($_POST['p1']."-".$_POST['p2']."-".$_POST['p3']."-".$_POST['p4']),
			'si_product'				=> $_POST['si'],
			'total_wage_si'				=> $_POST['total_wage_si'],
			'total_wage'				=> $_POST['total_wage'],
			'karat'						=> $_POST['karat'],
			'per_karat'					=> $_POST['per_karat'],
			'sum_talub'					=> $_POST['sum_talub']

		);
}

else if( ($_FILES['file']['name']=="") and ($_FILES['file2']['name'] != "") ){
        require '../include/resize.php';
		$path = '../img_product/';
		
		$fileupload=$_FILES['file']['tmp_name'];
		$fileupload_name=$_FILES['file']['name'];
		$fileupload2=$_FILES['file2']['tmp_name'];
		$fileupload_name2=$_FILES['file2']['name'];
		$pic1_w=150;$pic1_h=150;
		$pic2_w=300;$pic2_h=300;
		$imagename=upLoadimage($fileupload,$fileupload_name,$path,$pic1_w,$pic1_h,$pic2_w,$pic2_h);
		$imagename2=upLoadimage($fileupload2,$fileupload_name2,$path,$pic1_w,$pic1_h,$pic2_w,$pic2_h);

$data = array(
			'barcode_product'			=> $_POST['barcode_product'],
	        'soom'						=> $_POST['soom'],
	        'code_product'			    => $_POST['p1']."-".$_POST['p2']."-".$_POST['p3']."-".$_POST['p4'],
			'type'						=> $_POST['type'],			
			'id_category'				=> $_POST['id_category'],
			'id_sub_category'		    => $_POST['id_sub_category'],
	        'size'						=> $_POST['size'],
			'id_diamond'				=> $_POST['id_diamond'],
			'total_diamond'				=> $_POST['total_diamond'],
	        'diamond_price'				=> $_POST['wage_diamond_sum'],
			'id_back_munk'				=> $_POST['id_back_munk'],
	        'id_type_product'			=> $_POST['id_type_product'],
			'id_medicine'				=> $_POST['id_medicine'],
	        'special_wage'				=> $_POST['special_wage'],
			'special_si'				=> $_POST['special_si'],
	        'weight'					=> $_POST['weight'],
	        'date_product'				=> $fnc->_date($_POST['date_product']),
	        'total_product'				=> $_POST['total_product'],
	        'stone_sum_1_product'		=> $_POST['stone_sum_1_product'],
			'remark_wage'				=> $_POST['remark_wage'],
	        'id_stock'					=> $_POST['id_stock'],
	        'remark_product'			=> $_POST['remark_product'],
			'id_type_accessories'		=> $_POST['id_type_accessories'],
			'picture_2_product'			=> $imagename2,
			'id_stock'					=> $_POST['id_stock'],
			'product_id_re'				=> re_id_product($_POST['p1']."-".$_POST['p2']."-".$_POST['p3']."-".$_POST['p4']),
			'si_product'				=> $_POST['si'],
			'total_wage_si'				=> $_POST['total_wage_si'],
			'total_wage'				=> $_POST['total_wage'],
			'karat'						=> $_POST['karat'],
			'per_karat'					=> $_POST['per_karat'],
			'sum_talub'					=> $_POST['sum_talub']

		);
}


else if( ($_FILES['file']['name']!="") and ($_FILES['file2']['name'] == "") ){
        require '../include/resize.php';
		$path = '../img_product/';
		
		$fileupload=$_FILES['file']['tmp_name'];
		$fileupload_name=$_FILES['file']['name'];
		$fileupload2=$_FILES['file2']['tmp_name'];
		$fileupload_name2=$_FILES['file2']['name'];
		$pic1_w=150;$pic1_h=150;
		$pic2_w=300;$pic2_h=300;
		$imagename=upLoadimage($fileupload,$fileupload_name,$path,$pic1_w,$pic1_h,$pic2_w,$pic2_h);
		$imagename2=upLoadimage($fileupload2,$fileupload_name2,$path,$pic1_w,$pic1_h,$pic2_w,$pic2_h);

$data = array(
			'barcode_product'			=> $_POST['barcode_product'],
	        'soom'						=> $_POST['soom'],
	        'code_product'			    => $_POST['p1']."-".$_POST['p2']."-".$_POST['p3']."-".$_POST['p4'],
			'type'						=> $_POST['type'],			
			'id_category'				=> $_POST['id_category'],
			'id_sub_category'		    => $_POST['id_sub_category'],
	        'size'						=> $_POST['size'],
			'id_diamond'				=> $_POST['id_diamond'],
			'total_diamond'				=> $_POST['total_diamond'],
	        'diamond_price'				=> $_POST['wage_diamond_sum'],
			'id_back_munk'				=> $_POST['id_back_munk'],
	        'id_type_product'			=> $_POST['id_type_product'],
			'id_medicine'				=> $_POST['id_medicine'],
	        'special_wage'				=> $_POST['special_wage'],
			'special_si'				=> $_POST['special_si'],
	        'weight'					=> $_POST['weight'],
	        'date_product'				=> $fnc->_date($_POST['date_product']),
	        'total_product'				=> $_POST['total_product'],
	        'stone_sum_1_product'		=> $_POST['stone_sum_1_product'],
			'remark_wage'				=> $_POST['remark_wage'],
	        'id_stock'					=> $_POST['id_stock'],
	        'remark_product'			=> $_POST['remark_product'],
			'id_type_accessories'		=> $_POST['id_type_accessories'],
			'picture_1_product'			=> $imagename,
			'id_stock'					=> $_POST['id_stock'],
			'product_id_re'				=> re_id_product($_POST['p1']."-".$_POST['p2']."-".$_POST['p3']."-".$_POST['p4']),
			'si_product'				=> $_POST['si'],
			'total_wage_si'				=> $_POST['total_wage_si'],
			'total_wage'				=> $_POST['total_wage'],
			'karat'						=> $_POST['karat'],
			'per_karat'					=> $_POST['per_karat'],
			'sum_talub'					=> $_POST['sum_talub']

		);
}


else{


$data = array(
			'barcode_product'			=> $_POST['barcode_product'],
	        'soom'						=> $_POST['soom'],
	        'code_product'			    => $_POST['p1']."-".$_POST['p2']."-".$_POST['p3']."-".$_POST['p4'],
			'type'						=> $_POST['type'],			
			'id_category'				=> $_POST['id_category'],
			'id_sub_category'		    => $_POST['id_sub_category'],
	        'size'						=> $_POST['size'],
			'id_diamond'				=> $_POST['id_diamond'],
			'total_diamond'				=> $_POST['total_diamond'],
	        'diamond_price'				=> $_POST['wage_diamond_sum'],
			'id_back_munk'				=> $_POST['id_back_munk'],
	        'id_type_product'			=> $_POST['id_type_product'],
			'id_medicine'				=> $_POST['id_medicine'],
	        'special_wage'				=> $_POST['special_wage'],
			'special_si'				=> $_POST['special_si'],
	        'weight'					=> $_POST['weight'],
	        'date_product'				=> $fnc->_date($_POST['date_product']),
	        'total_product'				=> $_POST['total_product'],
	        'stone_sum_1_product'		=> $_POST['stone_sum_1_product'],
			'remark_wage'				=> $_POST['remark_wage'],
	        'id_stock'					=> $_POST['id_stock'],
	        'remark_product'			=> $_POST['remark_product'],
			'id_type_accessories'		=> $_POST['id_type_accessories'],
			'id_stock'					=> $_POST['id_stock'],
			'product_id_re'				=> re_id_product($_POST['p1']."-".$_POST['p2']."-".$_POST['p3']."-".$_POST['p4']),
			'si_product'				=> $_POST['si'],
			'total_wage_si'				=> $_POST['total_wage_si'],
			'total_wage'				=> $_POST['total_wage'],
			'karat'						=> $_POST['karat'],
			'per_karat'					=> $_POST['per_karat'],
			'sum_talub'					=> $_POST['sum_talub']
		);
}



?>