<?php  
	
	if($_GET['id_category'] !=""){
			$_SESSION['id_category'] = $_GET['id_category'];
		}

	$row		= $sys->db->result("tb_sub_category", "id_category = '".$_SESSION['id_category']."'"," no_sub_category asc");
	
		echo $sys->fnc->confirm();
		echo $fnc->checkall();

	if($_POST['id']){
		$sys->Delete_all($_POST['id'],$tbl,$fiel_id,$page_admin);
	}
	if($_GET[del] != ""){
	 $sys->db->delete("tb_sub_category", " id_sub_category = '".$_GET[del]."' ");
	 echo '<script type="text/javascript">
	 <!--
		window.location.replace("main.php?op=category&act=list_subcategory");
	 //-->
	 </script>';
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
		<a href="main.php?op=<?php echo $_GET[op]?>&act=add_subcategory&rd=<?php echo rand(1,99999);?>"><img src="images/b_add.gif" /></a>
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
	  <td align="center" bgcolor="#BBD8EC" class="th">ชื่อแบบพิมพ์กรอบ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">แบบ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">แก้ไข - ลบ</td>
    </tr>
   

<?php 
	if(!empty($row)){
	foreach($row as $rs){?>
    <tr height="25" bgcolor="<?php echo $bgc?>" align="center" class="tb">
	  <td align="center"><?php echo $rs->no_sub_category;?></td>
      <td align="center"><?php echo $rs->name_sub_category;?></td>
	  <td align="center">
	 <img src="../thumb/<?php echo $rs->pic_sub_category;?>" width="80" border="0" alt=""><br>
	  </td>
	  <td align="center" bgcolor="<?php echo $bgc?>">
	 
	  <a href="?op=category&act=add_subcategory&rd=67126&id_sub=<?php echo $rs->id_sub_category;?>">
	  <img src="images/document_edit.png" border="0" title="Edit" /></a> &nbsp; <a href="main.php?op=<?php echo $_GET[op];?>&act=list_subcategory&amp;rd=<?php echo rand(1,99999); ?>&amp;del=<?php echo $rs->id_sub_category?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf('<?php echo $rs->name_sub_category;?>')" /></a>
	
	  </td>

    </tr>
<?php
}}
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