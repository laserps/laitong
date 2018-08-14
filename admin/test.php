<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
include '../module/class.database.php';
$sys = new Database();
$return_ = 9;


for($i=0;$i<$return_;$i++){

$row = $sys->result("tb_rent_temp", " id_product = '921' and id_stock_rent = '4' and status_rent = '0' and total_rent != '0'  ","id_rent_temp asc");


if(!empty($row)){
foreach($row as $rs){
	$total_rent = $rs->total_rent-1;

	if( ($total_rent >=0) and ($r != $return_)){
	$r = $r+1;

	if($total_rent>0){
		$data = array("total_rent"=>$total_rent);
		$sys->update("tb_rent_temp", $data, " id_rent_temp = '".$rs->id_rent_temp."' ");
	}
	if($total_rent==0){
		$data = array("total_rent"=>$total_rent,"status_rent"=>"1");
		$sys->update("tb_rent_temp", $data, " id_rent_temp = '".$rs->id_rent_temp."' ");
	}

	echo $r."<br>";
	}
	
	
}


}
}


?>
