
<?php  
	$row		= $sys->dataList("tb_rent_temp",$_GET['id_stock']." and tb_rent_temp.status_rent = '0' group by tb_rent_temp.id_product  ",20,"id_stock_rent","desc"," 
	left join tb_product on tb_product.id_product = tb_rent_temp.id_product
	left join tb_stock on tb_stock.id_stock = tb_product.id_stock
	");
	
	echo $sys->fnc->confirm();
	echo $fnc->checkall();

	if($_POST['id']){
		$sys->Delete_all($_POST['id'],$tbl,$fiel_id,$page_admin);
	}
	if($_GET[del] != ""){
	 $sys->Del($_GET['del'],$tbl,$page_admin,$fiel_id);
	}

?>

<table width="100%" cellspacing="0" cellpadding="1" border="0" >
    <tr>
        <td align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">คลังสินค้าชั่วคราว</td>
        </tr></table></td>
    </tr>

	<!-- <tr>
        <td align="left">
		<a href="main.php?op=<?php echo $_GET[op]?>&act=add&rd=123456"><img src="images/b_add.gif" /></a>
		&nbsp;&nbsp;
		</td>
		
    </tr> -->


	<FORM name="myForm" METHOD="POST" ACTION="">
    <tr>
        <td>
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
	  <td align="center" bgcolor="#BBD8EC" class="th">Qty Bal</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Size</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">คลัง</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">รูป</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">เครื่องมือ</td>
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
	  <td align="center"><?php echo $rs->total_cost_product;?></td>

	  <td align="center"><?php echo $sys->db->sum("tb_rent_temp", 'id_product = "'.$rs->id_product.'" and status_rent = "0"', "id_product asc "," total_rent ");?></td>
	  
	  <td align="center"><?php echo $rs->size_product;?></td>
	  <td align="center"><?php echo $rs->name_stock;?></td>
	  <td align="center"> <a href=""><img src="../img_product/<?php echo $rs->picture_1_product?>" width="80"  border="0" alt=""></a> </td>
		

	  <td align="center" bgcolor="<?php echo $bgc?>">
	  <?php if($_SESSION[level]=="1"){?>
	  <a href="../barcodegen/test2.php?dm_product=<?php echo $rs->dm_product;?>&code_product=<?php echo $rs->code_product?>&stone_sum_1_product=<?php echo $rs->stone_sum_1_product?>&stone_sum_2_product=<?php echo $rs->stone_sum_2_product?>&stone_sum_3_product=<?php echo $rs->stone_sum_3_product?>" target = "_blank"><img src="images/b_print.gif" width="16" height="16" border="0" alt="พิมพ์บาโค๊ท"></a>
	  <a href="main.php?op=<?php echo $_GET['op'];?>&act=add&amp;rd=<?php echo rand(1,99999); ?>&id=<?php echo $rs->id_product?>">
	  <img src="images/document_edit.png" border="0" title="Edit" /></a> &nbsp; <a href="main.php?op=<?php echo $_GET[op];?>&act=list&amp;rd=<?php echo rand(1,99999); ?>&amp;del=<?php echo $rs->id_product?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf('<?php echo $rs->code_product;?>')" /></a>
	  <?php }?>
	  </td>

    </tr>
<?php 
endforeach;
endif;?>



</table>
<div align="left"></div>       
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	  </td>
    </tr>

	<tr>
        <td><? echo $db->render('member_system.php?op='.$_GET[op].'&act='.$_GET[act].'&'); ?></td>
    </tr>

    <tr>
    <td height="40" align="center">
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="th2">
  <tr height="30">
    <td height="40" colspan="2" align="center" bgcolor="#BBD8EC" class="th"></td>
  </tr>
</table>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        </td>
    </tr>
</table>