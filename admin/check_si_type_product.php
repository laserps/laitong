<?php 
include '../module/class.database.php';
$sys = new Database();

function check_tb($type){
	if($type == "1"){
		return "one";
	}
	else if($type == "2"){
		return "two";
	}

	else if($type == "3"){
		return "three";
	}

	else if($type == "4"){
		return "four";
	}

	else if($type == "5"){
		return "five";
	}

}

function check_tb_accesories($type){
	if($type == "S"){
		return "one";
	}
	else if($type == "M"){
		return "two";
	}

	else if($type == "L"){
		return "three";
	}

	else if($type == "XL"){
		return "four";
	}

}

function check_soom($soom){
	if($soom == 2){
		return "_";
	}
}

function check_soom3($soom){
	if($soom == 3){
		return "__";
	}
}

if($_POST['type'] =="1"){

$rs = $sys->record("tb_type_product_".check_tb($_POST['type'])."", " id_type_product = '".$_POST['id_type_product']."' "," si_type_product_".check_tb($_POST['type'])."_".$_POST['size']." as si, wage_type_product_".check_tb($_POST['type'])."_".$_POST['size']." as wage ");

$rs_wage_first = $sys->record("tb_wage_first_".check_tb($_POST['type'])."", " id_type = '".$_POST['id_type_product']."' ","  wage_first_".check_tb_accesories($_POST['size'])."".check_soom($_POST['soom'])." as wage ");
$data = $rs->si."@".($rs->wage+$rs_wage_first->wage);
}


if($_POST['type'] =="2"){

$rs = $sys->record("tb_type_product_".check_tb($_POST['type'])."", " id_type_product = '".$_POST['id_type_product']."' "," si_type_product_".check_tb($_POST['type'])."_".$_POST['size']." as si, wage_type_product_".check_tb($_POST['type'])."_".$_POST['size']." as wage ");

$rs_wage_first = $sys->record("tb_wage_first_".check_tb($_POST['type'])."", " id_type = '".$_POST['id_type_product']."' ","  wage_first_".check_tb_accesories($_POST['size'])."".check_soom($_POST['soom']).check_soom3($_POST['soom'])." as wage ");
$data = $rs->si."@".($rs->wage+$rs_wage_first->wage);
}


if($_POST['type'] =="3"){

$rs = $sys->record("tb_type_product_".check_tb($_POST['type'])."", " id_type_product = '".$_POST['id_type_product']."' "," si_type_product_".check_tb($_POST['type'])."_".$_POST['size']." as si, wage_type_product_".check_tb($_POST['type'])."_".$_POST['size']." as wage ");

$rs_wage_first = $sys->record("tb_wage_first_".check_tb($_POST['type'])."", " id_type = '".$_POST['id_type_product']."' ","  wage_first_".check_tb_accesories($_POST['size'])."".check_soom($_POST['soom'])." as wage ");
$data = $rs->si."@".($rs->wage+$rs_wage_first->wage);
}

if($_POST['type'] =="5"){

$rs = $sys->record("tb_type_product_".check_tb($_POST['type'])."", " id_type_product = '".$_POST['id_type_product']."' "," si_type_product_".check_tb($_POST['type'])."_".$_POST['size']." as si, wage_type_product_".check_tb($_POST['type'])."_".$_POST['size']." as wage ");

$rs_wage_first = $sys->record("tb_wage_first_five", " id_type = '".$_POST['id_type_product']."' and branch_type = '1' ","  wage_first_".check_tb_accesories($_POST['size'])."".check_soom($_POST['soom'])." as wage ");
$data = $rs->si."@".($rs->wage+$rs_wage_first->wage);
}




if($_POST['type'] =="4"){

////////อุปกรณ์//////////////////////////////////////////////////////////////
$rs = $sys->record("tb_si_accesories", " id_type_product = '".$_POST['id_type_product']."' ","size_si_accesories_".$_POST['size']." as si ");

$rs_wage_first = $sys->record("tb_wage_first_four", " id_type = '".$_POST['id_type_product']."' ","  wage_first_".check_tb_accesories($_POST['size'])."".check_soom($_POST['soom'])." as wage ");
$data = $rs->si."@".("0"+$rs_wage_first->wage);
}





echo $data;
?>