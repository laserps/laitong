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

$rs = $sys->record("tb_diamond_".check_tb($_POST['type'])."", " id_diamond = '".$_POST['id_diamond']."' "," si_diamond_".check_tb($_POST['type'])."_".$_POST['size']." as si, wage_diamond_".check_tb($_POST['type'])."_".$_POST['size']." as wage ");

$data = $rs->si."@".$rs->wage;
echo $data;
?>