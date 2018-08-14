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

$si = 0;
$wage = 0;
$special = explode("@",$_POST['special']);

foreach($special as $id_special){ 

	$rs = $sys->record("tb_special_".check_tb($_POST['type'])."", " id_special = '".$id_special."' "," si_special_".check_tb($_POST['type'])."_".$_POST['size']." as si, wage_special_".check_tb($_POST['type'])."_".$_POST['size']." as wage ");
	$si    = $si + $rs->si;
	$wage  = $wage + $rs->wage;
	$data =  $si."@".$wage;

}

echo $data;
?>