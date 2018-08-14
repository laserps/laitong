<?php   $sys        = new position();
	$row		= $sys->dataList($_GET[id]);
	
	echo $sys->alert();
	echo $sys->checkall();
    
	if($_POST[id]){
	$sys->deleteall($_POST[id]);
	}
	if($_GET[del] != ""){
	 $sys->Del($_GET[del]);
	}
?>

<FORM name="myForm" METHOD="POST" ACTION="">
<table width="100%" cellspacing="0" cellpadding="1" border="0" >
    <tr>
        <td align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">จัดการContent </td>
        </tr></table></td>
    </tr>

    <tr>
        <td align="left">
		<?php if($_SESSION[level]=="1"){?>
		<a href="main.php?op=<?php echo $_GET[op]?>&act=add"><img src="images/b_add.gif" /></a>
		<?php }?>
		</td>
    </tr>
    <tr>
        <td><table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  <td><IMG SRC="Admin_files/true.gif" WIDTH="14" HEIGHT="14" BORDER="0" ALT="" style = "display:none;"  id = "check_true" onclick = "handler();"><IMG SRC="Admin_files/false.gif" WIDTH="14" HEIGHT="14" BORDER="0" ALT="" onclick="handler();" id = "check_false"></td>
      <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตำแหน่ง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ฝ่าย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;&nbsp;&nbsp;&nbsp;Level&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
    <tr height="25" bgcolor="<?php echo $bgc?>" align="center" class="tb">
	  <td><INPUT TYPE="checkbox" NAME="id[]" value = "<?php echo $rs->id_position?>"></TD>
      <td align="center" style="color:#666"><?php echo $rs->name_position;?></td>
	  <td align="center" style="color:#666"><?php echo $rs->name_division;?></td>
	  <td align="center" style="color:#666"><?php echo $sys->checklevel($rs->level);?></td>
      <td align="center" bgcolor="<?php echo $bgc?>"><a href="main.php?op=<?php echo $_GET[op];?>&act=add&amp;rd=<?php echo rand(1,99999); ?>&id=<?php echo $rs->id_position?>">
	  <img src="images/document_edit.png" border="0" title="Edit" /></a> &nbsp; <a href="main.php?op=<?php echo $_GET[op];?>&act=list&amp;rd=<?php echo rand(1,99999); ?>&amp;del=<?php echo $rs->id_position?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf<?php  echo "$a" ?>(this)" /></a> </td>
    </tr>
<?php 
endforeach;
endif;
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