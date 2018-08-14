<?php  
		if($_POST['field_date']!=""){
			$field_date = explode("-",$_POST['date_return']);
	$row  = $sys->dataList($tbl,$id=null,20,$fiel_id,$_GET['sort'],$_GET['field'],$join,$_POST['key_search'].$field_date[2]."-".$field_date[1]."-".$field_date[0],$_POST['field_search'].$_POST['field_date']);

		}else{
	$row  = $sys->dataList($tbl,$id=null,20,$fiel_id,$_GET['sort'],$_GET['field'],$join,$_POST['key_search'],$_POST['field_search']);
		}

		
	
		echo $sys->fnc->confirm();
		echo $sys->fnc->checkall();
    
	if($_POST[id]){
	$sys->Delete_all($_POST[id],$tbl,$fiel_id,getenv('HTTP_REFERER'));
	}
	if($_GET[del] != ""){
	 $sys->Del($_GET[del],$tbl,getenv('HTTP_REFERER'),$fiel_id);
	}


include "date_picker.php";



?>

<script type="text/javascript">
function form_check(){
	if(document.getElementById('field_search').value == "0"){
		alert("กรุณาเลือก ฟิลล์ที่ต้องการค่ะ");
		return false;
	}
}
function form_check_date(){
	if(document.getElementById('date_rent_temp').value == ""){
		alert("กรุณาเลือกวันที่ต้องการค่ะ");
		return false;
	}
}
</script>

<table width="100%" cellspacing="0" cellpadding="1" border="0" >
    <tr>
        <td align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">ข้อมูลคืน</td>
        </tr></table></td>
    </tr>

    <tr>
        <td align="left"> 
		<?php if($_SESSION[level]=="1"){?>
		<a href="main.php?op=<?=$_GET['op']?>&act=add"><img src="images/b_add.gif" /></a>
		<?php }?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
		</td>
    </tr>
	
	<!-- <tr>
        <td align="left">
		<form method="post" action="#" onsubmit = "return form_check();">
			<select name="field_search" id = "field_search">
			<option value ="0">เลือกประเภทเพื่อค้นหา</option>
			<option value = "tb_product.name_product_thai">ชื่อProject ภาษาไทย</option>
			<option value = "tb_product.name_product">ชื่อProject ภาษาอังกฤษ</option>
			<option value = "tb_product.name_student">ชื่อผู้จัดทำ</option>
			<option value = "tb_product.date_student">ปีการศึกษา</option>
			<option value = "tb_product.teacher_student">อาจารย์ที่ปรึกษา</option>
        </select>&nbsp;&nbsp;<input type="text" name="key_search" id = "key_search" value = "Keyword" onclick = "document.getElementById('key_search').value='';">	<input type="submit" value = "Search">
		</form>
      </td>
    </tr>
 -->
	<tr>
        <td align="left">
		<form method="post" action="" onsubmit = "return form_check_date();">
		<input type="hidden" name="field_date" value = "tb_return.date_return">
		<input name="date_return" id = "date_return" size="20" > 
		<a href="javascript:displayDatePicker('date_return')">
		<IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a> -	<input type="submit" value = "Search วันที่คืน">&nbsp;&nbsp;<b>
		</form>
      </td>
    </tr>

    <tr>
        <td><FORM name="myForm" METHOD="POST" ACTION="">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  
      <td align="center" bgcolor="#BBD8EC" class="th">ลำดับ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">รหัสยืม</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ผู้ยืม</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">วันที่ยืม</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">จำนวนยืมรวม</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">จำนวนคืนรวม</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">พิมพ์</td>
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
    <tr height="25" bgcolor="<?php echo $bgc?>" align="center" class="tb">
      <td align="center"><?php echo $i;?></td>
	  
	  <td align="center"><?php echo $rs->id_rent;?></td>
	  <td align="center"><?php echo $rs->name; ?></td>
	  <td align="center"><?php echo $fnc->_date($rs->date_rent_temp);?></td>
	  <td align="center"><?php echo $db->sum("tb_rent_temp", " id_rent = '".$rs->id_rent."' ",NULL,"total_rent");?></td>
	  <td align="center"><?php echo $db->sum("tb_return", " id_rent = '".$rs->id_rent."' ",NULL,"total_return");?></td>
	  <td align="center" bgcolor="<?php echo $bgc?>">
	  &nbsp; 
	  <a href="report_return.php?id_rent=<?php echo $rs->id_rent;?>&amp;rd=<?php echo rand(1,99999); ?>&name=<?php echo urlencode($rs->name."  ".$rs->surname);?>" target = "_blank"><img src="images/b_print.gif" width="16" height="16" border="0" alt=""></a> </td>

	  <td align="center" bgcolor="<?php echo $bgc?>">
	  <?php if($_SESSION[level]=="1"){?>
	  &nbsp; <a href="main.php?op=<?php echo $_GET[op];?>&act=list&amp;rd=<?php echo rand(1,99999); ?>&amp;del=<?php echo $rs->id_section?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf('<?php echo $rs->name_section;?>')" /></a> <?php }?></td>

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