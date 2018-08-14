<?php 
	$row = $sys->dataList($tbl,$id=null,50,$fiel_id,$_GET['sort'],$_GET['field'],$join,$_POST['key_search'],$_POST['field_search']);
	
	echo $sys->fnc->confirm();
	echo $fnc->checkall();

	if($_POST['id']){
		$sys->Delete_all($_POST['id'],$tbl,$fiel_id,$page_admin);
	}
	
	if($_GET['del']!= ""){
	 $sys->Del($_GET['del'],$tbl,$page_admin,$fiel_id);
	}

include "date.php";
?>



<script language="JavaScript">
function Conf<?php  echo "$a" ?>(object) {
if (confirm("ยืนยันการลบข้อมูล") ==true) {
return true;
}
return false;
}
</script>

<SCRIPT LANGUAGE="JavaScript">
	function fncchang(status,id_order,id_member,point,total){
	window.location.reload("main.php?op=order&act=list&status="+status+"&id_order="+id_order+"&id_member="+id_member+"&point="+point+"&total="+total+"");
	}
	</SCRIPT>

<!-- <FORM METHOD=POST ACTION="">
<input name="d_date" size="20" value = "<?php echo date("d-m-Y");?>"> 
<a href="javascript:displayDatePicker('d_date')">
<IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a>
&nbsp;ระหว่าง&nbsp;
<input name="d_date_2" size="20" value = "<?php echo date("d-m-Y");?>"> 
<a href="javascript:displayDatePicker('d_date_2')">
<IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a>
<INPUT TYPE="hidden" NAME="action" value = "search">
<SELECT NAME="">
	<OPTION VALUE="">gab</option>
	<OPTION VALUE="">gab2</option>
</SELECT>
<INPUT TYPE="submit" value = "Search">
</FORM>
<br>

<input type="text" name="" value = "keyword search">&nbsp;<input type="submit" value = "search"> -->
<FORM name="myForm" METHOD="POST" ACTION="">
<table width="100%" cellspacing="0" cellpadding="1" border="0" >
    <tr>
        <td align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">จัดการOrder</td>
        </tr></table></td>
    </tr>

    <tr>
        <td align="left"><a href="main.php?op=<?php echo $_GET['op']?>&act=add"><img src="images/b_add.gif" /></a></td>
    </tr>
    <tr>
        <td><table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
       <td align = "center"><IMG SRC="Admin_files/true.gif" WIDTH="14" HEIGHT="14" BORDER="0" ALT="" style = "display:none;"  id = "check_true" onclick = "handler();"><IMG SRC="Admin_files/false.gif" WIDTH="14" HEIGHT="14" BORDER="0" ALT="" onclick="handler();" id = "check_false"></td>
	 <?php foreach($head as $fiel_name=>$head_name){?>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;<A HREF="?op=<?php echo $_GET['op']?>&act=<?php echo $_GET['act'];?>&field=<?php echo $fiel_name?>&sort=<?php echo $sys->check_link_sort($_GET['sort']);?>"><?php echo $head_name?><?php echo $sys->check_icon_sort($_GET['sort'],$_GET['field'],$fiel_name);?></A>
	  </td>
	  <?}?>

	 
	  <td width="100" align="center" bgcolor="#BBD8EC" class="th">เครื่องมือ</td>
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
		<td><INPUT TYPE="checkbox" NAME="id[]" value = "<?=$rs->id_product?>"></TD>
      <td align="center" bgcolor="<?php echo $bgc?>" style="color:#666">
	  <?php echo $fnc->number_pad($rs->id_order,5,"left");?></td>
      
	  <td align="center" style="color:#666">ทบ.</td>
	  <td align="center" style="color:#666">อ่อน</td>
	  <td align="center" style="color:#666">สมชาย</td>
	  <td align="center" style="color:#666">สมติ</td>
	  <td align="center" style="color:#666">081-8754875</td>
	  <td align="center" style="color:#666">1 ม.ค. 54</td>
	  <td align="center" style="color:#666">30 ม.ค. 54</td>
	  <td align="center" style="color:#666" bgcolor = "#ffccff">6 ม.ค. 54</td>
	  <td align="center" style="color:#666" bgcolor = "#ffccff">6 ม.ค. 54</td>
	  <td align="center" style="color:#666" bgcolor = "#ffccff">6 ม.ค. 54</td>
	  <td align="center" style="color:#666" bgcolor = "#ffccff">6 ม.ค. 54</td>
	  <td align="center" style="color:#666" bgcolor = "#ffccff">6 ม.ค. 54</td>

      <td align="center" bgcolor="<?php echo $bgc?>"><a href="<?php echo $PHP_SELF?>?id=<?php echo $rs->id_order?>&id_job=<?php echo $rs->order_id?>&op=<?php echo $_GET['op']?>&act=joblist" ><IMG SRC="images/icon_online.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT="รายละเอียด Job" title = "รายละเอียด Job"></a>&nbsp;<A HREF="?op=<?php echo $_GET['op']?>&act=add&id=<?php echo $rs->id_order;?>"><IMG SRC="images/document_edit.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></A> <a href="main.php?op=<?php echo $_GET[op];?>&amp;rd=<?php echo rand(1,99999);?>&act=<?php echo $_GET[act]?>&amp;del=<?php echo $rs->id_order?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf<?php  echo "$a" ?>(this)" /></a> </td>
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
	<INPUT TYPE="submit" value = "Delete All">
	</td>
	</tr>
    <tr>
        <td><?php echo $sys->db->render('main.php?op='.$_GET[op].'&act='.$_GET[act].'&'); ?></td>
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