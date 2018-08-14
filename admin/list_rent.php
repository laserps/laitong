<?php 
include '../module/class.database.php';
$sys = new Database();

$rs_product = $sys->record("tb_product", " id_product = '".$_POST['id_product']."' ", "id_stock,total_product");

$total_product = $rs_product->total_product - $_POST['total_rent'];



$data = array(
			"id_member"			=>$_POST['id_member'],
			"date_rent_temp"	=>date("Y-m-d"),
			"id_product"		=>$_POST['id_product'],
			"id_rent"			=>$_POST['id_rent'],
			"total_rent"		=>$_POST['total_rent'],
			"id_stock_rent"		=>$_POST['id_stock_rent']
			);

$data_update = array("total_product"=>$total_product,"old_id_stock"=>$rs_product->id_stock);

$sys->insert("tb_rent_temp", $data);
$sys->update("tb_product", $data_update, " id_product = '".$_POST['id_product']."' ");


$row = $sys->result("tb_rent_temp,tb_stock,tb_product,tb_type_product"," tb_rent_temp.id_product = tb_product.id_product  and tb_product.id_type_product = tb_type_product.num_type_product and  tb_stock.id_stock = tb_rent_temp.id_stock_rent  and tb_rent_temp.id_rent = '".$_POST['id_rent']."' and tb_rent_temp.status_rent = '0'  group by tb_rent_temp.id_stock_rent "," tb_rent_temp.id_rent_temp asc");
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
	  <td align="center" bgcolor="#BBD8EC" class="th">จำนวนยืม</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ยืมไป</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ลบ</td>
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
	<?php $total_rent_ =  $sys->sum("tb_rent_temp", 'id_product = "'.$rs->id_product.'" and status_rent = "0" and tb_rent_temp.id_rent = "'.$_POST['id_rent'].'" and tb_rent_temp.id_stock_rent = "'.$rs->id_stock_rent.'" ', "id_product asc "," total_rent ");?>

    <tr height="25" bgcolor="<?php echo $bgc?>" align="center" class="tb">
      <td align="center"><?php echo $i;?></td>
	  
	  <td align="center"><?php echo $rs->code_product;?></td>
	  <td align="center"><?php echo $rs->description; ?></td>
	  
	  <td align="center"><?php echo $rs->num_type_product; ?></td>

	  <td align="center"><?php echo $rs->po_product;?></td>
	  <td align="center"><?php echo $rs->dm_product;?></td>
	  <td align="center"><?php echo $rs->date_product;?></td>
	  <td align="center"><?php echo $rs->unit_price;?></td>
	  <td align="center"><?php echo number_format($rs->unit_price*$total_rent_,2);?></td>
	  <td align="center"><?php echo $rs->name_stock?></td>

	  <td align="center"><?php echo $total_rent_;?></td>
	 

	  <td align="center" bgcolor="<?php echo $bgc?>">
	  &nbsp; <a href="#"><img src="images/file_delete.png" border="0" title="Delete" onClick="del_rent(<?php echo $rs->id_rent?>);" /></a> </td>

    </tr>
<?php 
endforeach;
endif;?>



</table>