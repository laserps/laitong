
<?php  
	$row		= $sys->dataList($tbl,2,20,"level_stock","desc",$join);
	
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
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">จัดการข้อมูลคลังสินค้าชั่วคราว</td>
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
	  
      <td align="center" bgcolor="#BBD8EC" class="th">ลำดับ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ชื่องาน</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">วันที่จัด</td>
	  <!-- <td align="center" bgcolor="#BBD8EC" class="th">จำนวนรายการสินค้า</td> -->
	  <td align="center" bgcolor="#BBD8EC" class="th">จำนวนรวมทั้งหมด</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ข้อมูลสินค้า</td>  
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
	  
	  <td align="center"><?php echo $rs->name_stock;?></td>
	  <td align="center"><?php echo $rs->date_stock; ?></td>

	  <!-- <td align="center"><?php $count_ = $db->result('tb_rent_temp','id_stock_rent = "'.$rs->id_stock.'"  and status_rent = "0"  group by id_product'); echo count($count_); 
	  
		echo $sys->db->countRow('tb_rent_temp', 'id_stock_rent = "'.$rs->id_stock.'"  and status_rent = "0"  group by id_product');
	  ?></td> -->

	   <td align="center">
	  <?php echo $sys->db->sum("tb_rent_temp", 'id_stock_rent = "'.$rs->id_stock.'" and status_rent = "0"', "id_product asc "," total_rent ");?>

	  </td>
	  <td align="center">
	  <?php echo '<a href="report_fare.php?id_stock='.$rs->id_stock.'&name_stock='.$rs->name_stock.'" target = "_blank"><img src="images/b_print.gif" width="16" height="16" border="0" alt=""></a>';
	  ?>
	  <!-- <a href="?op=product&act=fare&id_stock=<?php echo $rs->id_stock;?>"><img src="images/icon_help_s.gif" width="16" height="16" border="0" alt=""></a> --> </td>
		

	  <td align="center" bgcolor="<?php echo $bgc?>">
	  <?php if(($_SESSION[id_division]=="1") or ($_SESSION[id_division]=="3")){?>
	  <a href="main.php?op=<?php echo $_GET['op'];?>&act=add&amp;rd=<?php echo rand(1,99999); ?>&id=<?php echo $rs->id_stock?>">
	  <img src="images/document_edit.png" border="0" title="Edit" /></a> &nbsp; <a href="main.php?op=<?php echo $_GET[op];?>&act=list&amp;rd=<?php echo rand(1,99999); ?>&amp;del=<?php echo $rs->id_stock?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf('<?php echo $rs->name_stock;?>')" /></a> 
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