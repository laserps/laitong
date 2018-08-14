
<?php  
	$row		= $sys->dataList($tbl,$id=null,50,$fiel_id,"asc",$join);
	
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
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">จัดการรูปแบบพิมพ์กรอบ</td>
        </tr></table></td>
    </tr>

	<tr>
        <td align="left">
		<?php if(($_SESSION[id_division]=="1") or ($_SESSION[id_division]=="2")){?>
		<a href="main.php?op=<?php echo $_GET[op]?>&act=add&rd=<?php echo rand(1,99999);?>"><img src="images/b_add.gif" /></a>
		<?php }?>
		&nbsp;&nbsp;
		</td>
		
    </tr>


	<FORM name="myForm" METHOD="POST" ACTION="">
    <tr>
        <td>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  <td align="center" bgcolor="#BBD8EC" class="th">รหัส</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ชื่อพิมพ์กรอบ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">รายการพิมพ์</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">แก้ไข - ลบ</td>
    </tr>
    <?php if(!$row):?>
    <tr height="30" bgcolor="#eeeeee">
      <td align="center" colspan="5" class="th2">No Data</td>
    </tr>
    <?php
	
	
else:
$j=0;
$ddd = array("0","1-10","1-20","1-20","1-31","1-44","1-49","1-72","1-104");
foreach($row as $rs):
$bgc=($i++ % 2) ? '#FFFFFF' : '#E0F0F0';
$j++;
//echo $j;
?>
    <tr height="25" bgcolor="<?php echo $bgc?>" align="center" class="tb">
	  <td align="center"><?php echo $rs->num_category?></td>
      <td align="center"><?php echo $rs->name_category?></td>
	  <td align="center"><?php echo $ddd[$j];?><br>
	  <a href="?op=category&act=list_subcategory&id_category=<?php echo $rs->id_category;?>"><b>ดูข้อมูล</b></a>
	  
	  </td>
	  <td align="center" bgcolor="<?php echo $bgc?>">
	  <?php if(($_SESSION[id_division]=="1") or ($_SESSION[id_division]=="2")){?>
	  <a href="main.php?op=<?php echo $_GET['op'];?>&act=add&amp;rd=<?php echo rand(1,99999); ?>&id=<?php echo $rs->id_category?>">
	  <img src="images/document_edit.png" border="0" title="Edit" /></a> &nbsp; <a href="main.php?op=<?php echo $_GET[op];?>&act=list&amp;rd=<?php echo rand(1,99999); ?>&amp;del=<?php echo $rs->id_category?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf('<?php echo $rs->name_category;?>')" /></a>
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