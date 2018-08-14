<?php   
    $sys  = new product;
	$row  = $sys->productList_buy();

	echo $sys->alert();
	echo $sys->checkall();
	if($_POST[id]){
	$sys->deleteall($_POST[id]);
	}

	if($_GET[del]!=""){
	$sys->ProductDel($_GET[del]);
	}


?>


<FORM name="myForm" METHOD="POST" ACTION="">
<table width="100%" cellspacing="0" cellpadding="1" border="0" >
    <tr>
        <td align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">10 อันดับสินค้าขายดี</td>
        </tr></table></td>
    </tr>

    <tr>
        <td align="left"><!-- <a href="main.php?op=product&act=add"><img src="images/b_add.gif" /></a> --></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  <td><IMG SRC="Admin_files/true.gif" WIDTH="14" HEIGHT="14" BORDER="0" ALT="" style = "display:none;"  id = "check_true" onclick = "handler();"><IMG SRC="Admin_files/false.gif" WIDTH="14" HEIGHT="14" BORDER="0" ALT="" onclick="handler();" id = "check_false"></td>
      <td width="84" align="center" bgcolor="#BBD8EC" class="th">No.</td>
      <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;&nbsp;&nbsp;&nbsp;Product Name</td>
	 
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;&nbsp;&nbsp;&nbsp;Picture</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;&nbsp;&nbsp;&nbsp;Price</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;&nbsp;&nbsp;&nbsp;Brand</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;&nbsp;&nbsp;&nbsp;จำนวนการสั่งซื้อ</td>
      <td align="center" bgcolor="#BBD8EC" class="th">Category</td>
      <td width="153" align="center" bgcolor="#BBD8EC" class="th">เครื่องมือ</td>
    </tr>
    <?php 
if(!$row):
else:
foreach($row as $rs):
$bgc=($i++ % 2) ? '#FFFFFF' : '#E0F0F0';
$id_product[] = $rs;

endforeach;
endif;
?>	
    
<?php 
foreach($id_product as $rs_id_product):
$bgc=($i++ % 2) ? '#FFFFFF' : '#E0F0F0';
$sys->list_buy($rs_id_product);
?>
    <tr height="25" bgcolor="<?php echo $bgc?>" align="center" class="tb">
	  <td><INPUT TYPE="checkbox" NAME="id[]" value = "<?php echo $rs->id_prod?>">888</TD>
      <td align="center" bgcolor="<?php echo $bgc?>" style="color:#666"><?php echo $rs->id_product;?></td>
      <td align="center" style="color:#666"><?php echo $rs->f_name_product;?></td>
	  <td><img src="../img_product/<?php echo $rs->f_pic_product;?>" border="0" title="Edit" />
	  <td align="center" style="color:#666"><?php echo $rs->f_price_s_product?></td>
	  <td align="center" style="color:#666"><?php echo $rs->name_brand;?></td>
	  <td align="center" style="color:#666">50</td>
      <td><?php echo $rs->f_name_category?></td>
	  <td align="center" bgcolor="<?php echo $bgc?>"><a href="main.php?op=product&amp;id=<?php echo $rs->id_product?>&act=add"><img src="images/file_edit.png" border="0" title="Edit" /></a>&nbsp; <a href="main.php?op=<?php echo $_GET[op];?>&act=<?php echo $_GET[act]?>&amp;rd=<?php echo rand(1,99999); ?>&amp;del=<?php echo $rs->id_product?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf('<?php echo $rs->f_name_product?>')" /></a> </td>
    </tr>
<?php 
endforeach;
?>

<tr>
	<td>
	<INPUT TYPE="submit" value = "Delete All">
	</td>
	</tr>
</table>
<div align="left"></div>       
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	  </td>
    </tr>
    <tr>
        <td><?php  echo $sys->db->render('main.php?op='.$_GET[op].'&act='.$_GET[act].'&'); ?></td>
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
</form>