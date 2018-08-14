<?php 
include '../module/class.database.php';
$sys = new Database();

if($_POST['barcode_product'] !=""){
$row	  = $sys->result("tb_product,tb_stock",'dm_product like  "%'.$_POST['barcode_product'].'%" and tb_product.id_stock = tb_stock.id_stock ', 'dm_product asc', "30");
?>
<table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  
      <td align="center" bgcolor="#BBD8EC" class="th">ลำดับ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Product Code</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">#DM</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">รายการ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">จำนวนคงเหลือ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">คลัง</td>
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
    <tr height="25" bgcolor="<?php echo $bgc?>" align="center" class="tb" onclick = "window.location.replace('?op=add_stock&act=add&id_product=<?php echo $rs->id_product;?>');" style = "cursor:pointer;">
      <td align="center"><?php echo $i;?></td>
	  <td align="center"><?php echo $rs->code_product;?></td>
	  <td align="center"><?php echo $rs->dm_product;?></td>
	  <td align="center"><?php echo $rs->description; ?></td>
	  


	  <td align="center"><?php echo $rs->total_product;?>&nbsp;<?php echo $rs->noy_per;?></td>
	  <td align="center"><?php echo $rs->name_stock;?></td>
	 
    </tr>
<?php 
endforeach;
endif;?>



</table>
<?php }?>