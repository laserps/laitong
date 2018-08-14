<?php 
include '../module/class.database.php';
$sys = new Database();

$rs_product = $sys->record("tb_product", " id_product = '".$_POST['id_product']."' ");



$total_product = $rs_product->total_product + $_POST['total_return'];

$data_up_return = array("total_product"=>$total_product);
$sys->update("tb_product", $data_up_return, " id_product = '".$_POST['id_product']."' ");


$data = array(
			"id_member"			=>$_POST['id_member'],
			"date_return"		=>date("Y-m-d"),
			"id_product"		=>$_POST['id_product'],
			"id_rent"			=>$_POST['id_rent'],
			"total_return"		=>$_POST['total_return'],
			"id_rent"			=>$_POST['id_rent']
			);
$sys->insert("tb_return", $data);


//////////////////////////คำนวนการคืนจากจำนวนออกมา////////////////////////////////////////////////////////////
$return_ = $_POST['total_return'];

for($i=0;$i<$return_;$i++){

$row_ = $sys->result("tb_rent_temp", " id_product = '".$rs_product->id_product."' and id_stock_rent = '".$_POST['id_stock']."' and status_rent = '0' and total_rent != '0'  ","id_rent_temp asc");


if(!empty($row_)){
foreach($row_ as $rs_){
	$total_rent = $rs_->total_rent-1;

	if( ($total_rent >=0) and ($r != $return_)){
	$r = $r+1;

	if($total_rent>0){
		$data_update = array("total_rent"=>$total_rent);
		$sys->update("tb_rent_temp", $data_update, " id_rent_temp = '".$rs_->id_rent_temp."' ");
	}
	if($total_rent==0){
		$data__ = array("total_rent"=>$total_rent,"status_rent"=>"1");
		$sys->update("tb_rent_temp", $data__, " id_rent_temp = '".$rs_->id_rent_temp."' ");
	}

	//echo $r."<br>";
	}
	
	
}


}
}




$cnt	=	$sys->countRow("tb_return,tb_product,tb_type_product,tb_stock", " tb_return.id_product = tb_product.id_product and tb_product.id_type_product = tb_type_product.num_type_product and  tb_stock.id_stock = tb_product.id_stock  and tb_return.id_rent = '".$_POST['id_rent']."'  ");
$limit  =   $sys->countRowPage($cnt);

$row = $sys->result("tb_return,tb_product,tb_type_product,tb_stock"," tb_return.id_product = tb_product.id_product and tb_product.id_type_product = tb_type_product.num_type_product and  tb_stock.id_stock = tb_product.id_stock  and tb_return.id_rent = '".$_POST['id_rent']."'  "," tb_return.id_rent asc",$limit);
?>
<table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  
      <td align="center" bgcolor="#BBD8EC" class="th">ลำดับ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Prod.Code</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Description</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Metal</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">PO#</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">DM#</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Inven Date</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Unit Price($)</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Total Cost($)</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">จำนวนคืน</td>
	  <!-- <td align="center" bgcolor="#BBD8EC" class="th">ลบ</td> -->
    </tr>
    <?php
if(!$row):
?>
    <tr height="30" bgcolor="#eeeeee">
      <td align="center" colspan="5" class="th2">No Data</td>
    </tr>
    <?php
else:
foreach($row as $rs):
$bgc=($i++ % 2) ? '#FFFFFF' : '#E0F0F0';
?>
    <tr height="25" bgcolor="<?php echo $bgc?>" align="center" class="tb">
      <td align="center"><?php echo $i;?></td>
	  
	  <td align="center"><?php echo $rs->code_product;?></td>
	  <td align="center"><?php echo $rs->description; ?></td>
	  
	  <td align="center"><?php echo $rs->name_type_product; ?></td>

	  <td align="center"><?php echo $rs->po_product;?></td>
	  <td align="center"><?php echo $rs->dm_product;?></td>
	  <td align="center"><?php echo $rs->date_product;?></td>
	  <td align="center"><?php echo $rs->unit_price;?></td>
	  <td align="center"><?php echo number_format($rs->total_return*$rs->unit_price,2);?></td>
	  <td align="center"><?php echo $rs->total_return;?></td>
	 

	  <!-- <td align="center" bgcolor="<?php echo $bgc?>">
	  &nbsp; <a href="#"><img src="images/file_delete.png" border="0" title="Delete" onClick="del_rent(<?php echo $rs->id_rent?>);" /></a> </td> -->

    </tr>
<?php 
endforeach;
endif;?>


	


</table>


