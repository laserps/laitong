
<?php  
	  if($_REQUEST['id_branch'] == ""){
		$row		= $sys->dataList("tb_invoice",$id=null,500," id_invoice","desc"," group by invoice_no,id_branch ");
	  }else{
		$row		= $sys->dataList__("tb_invoice",$_REQUEST['id_branch'],500,null,"desc"," group by invoice_no,id_branch ");
	  }

	
	echo $sys->fnc->confirm();
	echo $fnc->checkall();

	if($_POST['id']){
		$sys->Delete_all($_POST['id'],$tbl,$fiel_id,$page_admin);
	}
	if($_GET[del] != ""){
		$db->delete("tb_invoice", " invoice_no = '".$_GET['del']."' and id_branch = '".$_GET['id_branch']."' ");

		echo '<script type="text/javascript">
		<!--
			window.location.replace("?op=buy_data&act=list");
		//-->
		</script>';

	}
include "date.php";

$row_branch = $db->result("tb_branch"," id_branch >'1' "," id_branch asc");
?>


<table width="100%" cellspacing="0" cellpadding="1" border="0" >
    <tr>
        <td align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">รายการใบส่งของ</td>
        </tr></table></td>
    </tr>

	<tr>
		<td>
		<?php  echo	$db->render('main.php?op='.$_GET[op].'&act='.$_GET[act].'&id_branch='.$_GET['id_branch'].'&');?>
		</td>
	</tr>

	<tr>
        <td align="left">
		<form method="post" action="report_invoince_date.php" target = "_blank">
			สรุปยอดตั้งแต่วันที่&nbsp;<input name="date_product_first" type="text" class="box" id="date_product_first" style=" width:80px"  value="<?php echo $_POST['date_product_first'];?>"/><a href="javascript:displayDatePicker('date_product_first')"><IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a>&nbsp;&nbsp;&nbsp;ถึง&nbsp;&nbsp;&nbsp;
		<input name="date_product_last" type="text" class="box" id="date_product_last" style=" width:80px"  value="<?php echo $_POST['date_product_last'];?>"/><a href="javascript:displayDatePicker('date_product_last')"><IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a>&nbsp;&nbsp;
		<select name="id_branch">
		<?php foreach($row_branch as $rs_branch){?>
			<option value="<?php echo $rs_branch->id_branch?>"><?php echo $rs_branch->name_branch?></option>
		<?php }?>
		</select>
		<input type="submit" value = "พิมพ์รายงาน">
		</form>
		<hr>
		</td>
    </tr>

		<script type="text/javascript">
		  function fnc_search_(id_branch){	
			window.location.replace("main.php?op=buy_data&act=list&id_branch="+id_branch+"");
		  }
	
		</script>


	<tr>
		<td>
			ค้นหา:<select name="id_branch" id = "id_branch" onchange = "fnc_search_(this.value);">
			<option>เลือกสาขา</option>
		<?php foreach($row_branch as $rs_branch){?>
			<option value="<?php echo $rs_branch->id_branch?>" <?php echo $fnc->selected($rs_branch->id_branch,$_GET['id_branch']);?>><?php echo $rs_branch->name_branch?></option>
		<?php }?>
		</select>
		</td>
	</tr>


	<FORM name="myForm" METHOD="POST" ACTION="">
    <tr>
        <td>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  <td align="center" bgcolor="#BBD8EC" class="th">ลำดับ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">รหัสใบส่งของ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">สาขา</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">วันที่</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">เครื่องมือ</td>
    </tr>
    <?php if(!$row):?>
    <tr height="30" bgcolor="#eeeeee">
      <td align="center" colspan="5" class="th2">No Data</td>
    </tr>
    <?php
else:
foreach($row as $rs):
$bgc=($i++ % 2) ? '#FFFFFF' : '#E0F0F0';
?>
    <tr height="25" bgcolor="<?php echo $bgc?>" align="center" class="tb">
	  <td><?php echo $i;?></td>
	<?php $rs_branch = $sys->db->record("tb_branch", " id_branch = '".$rs->id_branch."' "," num_branch,name_branch "); ?>
      <td align="center"><?php echo $rs_branch->num_branch;?>&nbsp;<?php echo $fnc->number_pad($rs->invoice_no,7,"left");?></td>
	  <td align="center"><?php echo $rs_branch->name_branch;?></td>

	  <td> <?php echo $fnc->datemoth($fnc->_date($rs->date_invoice),"thai");?></td>
	  <td align="center" bgcolor="<?php echo $bgc?>">
	  <a href="report_.php?invoice_no=<?php echo $fnc->number_pad($rs->invoice_no,7,"left");?>&amp;rd=<?php echo rand(1,99999); ?>&id_branch=<?php echo $rs->id_branch;?>" target = "_blank"><img src="images/b_print.gif" width="16" height="16" border="0" alt=""></a>
	  &nbsp;
	  <?php if(($_SESSION[id_division]=="1") or ($_SESSION[id_division]=="3")){?>
	  <a href="?op=buy&act=list&amp;rd=<?php echo rand(1,99999); ?>&id=<?php echo $fnc->number_pad($rs->invoice_no,10,"left");?>&id_branch=<?php echo $rs->id_branch;?>">
	  <img src="images/document_edit.png" border="0" title="Edit" /></a>
	  <?php }?>
	  </td>

    </tr>
<?php
endforeach;
endif;
?>



</table>
<div align="left"></div>       
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	  </td>
    </tr>
	<tr>
		<td>
		<?php  echo	$db->render('main.php?op='.$_GET[op].'&act='.$_GET[act].'&id_branch='.$_GET['id_branch'].'&');?>
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