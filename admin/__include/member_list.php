<?php  
	$row		= $sys->dataList($tbl,$id=null,20,$fiel_id,"desc",$join);
	
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
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">จัดการข้อมูลพนักงาน </td>
        </tr></table></td>
    </tr>

   <tr>
        <td align="left">
		<?php if(($_SESSION[id_division]=="1") or ($_SESSION[id_division]=="2")){?>
		<a href="main.php?op=<?=$_GET[op]?>&act=add&rd=123456"><img src="images/b_add.gif" /></a>
		&nbsp;&nbsp;
		<?php }?>
		</td>
		
    </tr> 
	<FORM name="myForm" METHOD="POST" ACTION="">
    <tr>
        <td><table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  <td align = "center"><IMG SRC="Admin_files/true.gif" WIDTH="14" HEIGHT="14" BORDER="0" ALT="" style = "display:none;"  id = "check_true" onclick = "handler();"><IMG SRC="Admin_files/false.gif" WIDTH="14" HEIGHT="14" BORDER="0" ALT="" onclick="handler();" id = "check_false"></td>
	  <td width="84" align="center" bgcolor="#BBD8EC" class="th">รหัสพนักงาน</td>
      <td width="84" align="center" bgcolor="#BBD8EC" class="th">ชื่อผู้ใช้</td>
      <!-- <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;&nbsp;&nbsp;&nbsp;Username</td> -->
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;&nbsp;&nbsp;&nbsp;ชื่อ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;&nbsp;&nbsp;&nbsp;นามสกุล</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;&nbsp;&nbsp;&nbsp;ตำแหน่ง</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">เพศ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ที่อยู่</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">สาขา</td>
      <td width="153" align="center" bgcolor="#BBD8EC" class="th">เครื่องมือ</td>
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
    <tr height="25" bgcolor="<?=$bgc?>" align="center" class="tb">
	  <td><INPUT TYPE="checkbox" NAME="id[]" value = "<?php echo $rs->id_member;?>"></TD>
      <td align="center" bgcolor="<?=$bgc?>" style="color:#666"><?php echo $rs->num_member;?></td>
	  <td align="center" bgcolor="<?=$bgc?>" style="color:#666"><?php echo $rs->username;?></td>
     <!--  <td align="center" style="color:#666"><?=$rs->username;?></td> -->
	  <td align="center" style="color:#666"><?php echo $rs->name;?></td>
	  <td align="center" style="color:#666"><?php echo $rs->surname;?></td>
	  <td align="center" style="color:#666"><?php echo $rs->name_position;?></td>
	  <td align="center" style="color:#666"><?php echo $fnc->sexthai($rs->sex);?></td>
	  <td align="center" style="color:#666"><?php echo (nl2br($rs->address));?></td>
      <td align="center" style="color:#666">ลายทอง</td>
      <td align="center" bgcolor="<?php echo $bgc;?>">
	  &nbsp;
	  <?php if(($_SESSION[id_division]=="1") or ($_SESSION[id_division]=="2")){?>
	  <a href="main.php?op=<?php echo $_GET['op'];?>&act=add&amp;rd=<?php echo rand(1,99999);?>&id=<?php echo $rs->id_member;?>">
	  <img src="images/document_edit.png" border="0" title="Edit" /></a> &nbsp; <a href="main.php?op=<?php echo $_GET[op];?>&act=list&amp;rd=<?php echo rand(1,99999); ?>&amp;del=<?php echo $rs->id_member;?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf('<?php echo $rs->name;?>')" /></a>
	  <?php }?>
	  </td>
    </tr>
<?php
endforeach;
endif;
?>

<tr>
	<td>
	<INPUT TYPE="submit" value = "Delete All">
	</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	</tr>
</table>
<div align="left"></div>       
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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