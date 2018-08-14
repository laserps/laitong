
<?php  
	$row		= $sys->dataList($tbl,1,20,"level_stock","desc",$join);
	
	echo $sys->fnc->confirm();
	echo $fnc->checkall();

	if($_POST['id']){
		$sys->Delete_all($_POST['id'],$tbl,$fiel_id,$page_admin);
	}
	if($_GET[del] != ""){
	 $sys->Del($_GET['del'],$tbl,$page_admin,$fiel_id);
	}

	if($_GET['id_stock'] !=""){
		$data_update = array('status_qc'=>'0','remark_qc'=>'');
		$db->update('tb_product',$data_update,' id_stock = "'.$_GET['id_stock'].'" ');

		echo '<script type="text/javascript">
		alert("Clear Qc Complete");
		window.location.replace("main.php?op=section&act=list");
		</script>';
	}

?>

<script type="text/javascript">
	function fnc_clear_check(id_stock){
		window.location.replace('main.php?op=section&act=list&id_stock='+id_stock+'');
	}
</script>

<table width="100%" cellspacing="0" cellpadding="1" border="0" >
    <tr>
        <td align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">จัดการคลังสินค้า</td>
        </tr></table></td>
    </tr>

	<tr>
        <td align="left">
		<?php if(($_SESSION[id_division]=="1") or ($_SESSION[id_division]=="3")){?>
		<a href="main.php?op=<?php echo $_GET[op]?>&act=add&rd=123456"><img src="images/b_add.gif" /></a>
		<?php }?>
		&nbsp;&nbsp;
		</td>
		
    </tr>


	<FORM name="myForm" METHOD="POST" ACTION="">
    <tr>
        <td>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  
      <td align="center" bgcolor="#BBD8EC" class="th">คลัง</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">จำนวนรายการสินค้า</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">จำนวนสินค้าทั้งหมด</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ตรวจสอบแล้ว</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">QC ผ่าน</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">QC ไม่ผ่าน</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">(QC)</td>
	   
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
      <td align="center"><?php echo $rs->name_stock;?></td>
	  <td align="center"><?php echo $db->countRow('tb_product',' id_stock = "'.$rs->id_stock.'" ');?></td>
	  <td align="center">
	  <?php echo $sys->db->sum("tb_product", 'id_stock = "'.$rs->id_stock.'"', "id_product asc "," total_product ");?>

	  </td>

	  <td align="center"><?php echo $db->countRow('tb_product','status_qc != "0" and id_stock = "'.$rs->id_stock.'" ');?></td>
      
	  <td align="center" style = "color:#00ff00;"><b><?php echo $db->countRow('tb_product','status_qc = "1" and id_stock = "'.$rs->id_stock.'" ');?></b></td>

	   <td align="center" style = "color:#ff0000;"><b><?php echo $db->countRow('tb_product','status_qc = "2" and id_stock = "'.$rs->id_stock.'" ');?></b></td>
	
	

	  <td align="center">
	 
	  <a href="?op=qc&act=list&id_stock=<?php echo $rs->id_stock;?>&name_stock=<?php echo $rs->name_stock;?>">ตรวจสอบ</a></td>
	  <td align="center" bgcolor="<?php echo $bgc?>"> 
	  <?php if(($_SESSION[id_division]=="1") or ($_SESSION[id_division]=="3")){?>
	  <a href="report.php?id_stock=<?php echo $rs->id_stock;?>&name_stock=<?php echo $rs->name_stock;?>" target = "_blank"><img src="images/b_print.gif" width="16" height="16" border="0" alt=""></a> &nbsp;&nbsp;
	  <a href="main.php?op=<?php echo $_GET['op'];?>&act=add&amp;rd=<?php echo rand(1,99999); ?>&id=<?php echo $rs->id_stock?>">
	  <img src="images/document_edit.png" border="0" title="Edit" /></a> &nbsp; <a href="main.php?op=<?php echo $_GET[op];?>&act=list&amp;rd=<?php echo rand(1,99999); ?>&amp;del=<?php echo $rs->id_stock?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf('<?php echo $rs->name_stock;?>')" /></a> 
	  &nbsp;&nbsp;<input type="button" value="Clear QC" onclick="fnc_clear_check(<?php echo $rs->id_stock;?>);">
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