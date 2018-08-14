<?php
	require "module/class.database.php";
	$sys = new Database();

	$row = $sys->result("tb_product_2",null," id_product asc limit 4900,12000 ");

	foreach($row as $rs){
		$data = array("dm_product"=>$rs->dm_product,"barcode_product"=>$rs->barcode_product,"product_id_re"=>$rs->product_id_re);
		$sys->update("tb_product",$data," id_product='".$rs->id_product."'  ");

	}

?>