
<?php  
	$row		= $sys->dataList($tbl,$id=null,50,"id_branch","asc",$join);
	
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
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">จัดการสาขา</td>
        </tr></table></td>
    </tr>

	<tr>
        <td align="left">
		<a href="main.php?op=<?php echo $_GET[op]?>&act=add&rd=123456"><img src="images/b_add.gif" /></a>
		</td>
		
    </tr>


	<FORM name="myForm" METHOD="POST" ACTION="">
    <tr>
        <td>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
      <td align="center" bgcolor="#BBD8EC" class="th">ลำดับ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">สาขา</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ประเภท</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">จำนวน</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">รวมยอดทั้งหมด</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ดูรายงาน</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">เครื่องมือ</td>
    </tr>
    <?php
		if(!$row):
	?>
    
 
    <?php
else:
foreach($row as $rs):
$bgc=($i++ % 2) ? '#FFFFFF' : '#E0F0F0';
?>
    <tr height="25" bgcolor="<?php echo $bgc?>" align="center" class="tb">
	<td align="center"><?php echo $i;?></td>
      <td align="center"><?php echo $rs->name_branch?>&nbsp;(<?php echo $rs->num_branch;?>)</td>
	  <td align="center"><?php if($rs->status_branch == "1"){ echo "ในเครือ";}else{ echo "นอกเครือ";}?></td>
	 
	  <td align="center"><?php $count_product = $db->countRow("tb_invoice", " id_branch = '".$rs->id_branch."' ", " id_invoice desc "); echo number_format($count_product);?></td>

	  <td align="center"  style = "color: #009300;"><?php $sum_price = $db->sum("tb_invoice", " id_branch = '".$rs->id_branch."' ", " id_invoice desc "," price "); echo '<a href="report_all_brance.php?id_branch='.$rs->id_branch.'" target = "_blank">'.number_format($sum_price).'</a>';?></td>

	  <td align="center"  style = "color: #009300;"><a href="report_all_brance.php?id_branch=<?php echo $rs->id_branch;?>" target = "_blank"><input type="button" value="ดูรายงาน" onclick="javascript:location.href='report_all_brance.php?id_branch=<?php echo $rs->id_branch;?>'"></a></td>
	 

	  <td align="center" bgcolor="<?php echo $bgc?>">
	  <a href="main.php?op=<?php echo $_GET['op'];?>&act=add&amp;rd=<?php echo rand(1,99999); ?>&id=<?php echo $rs->id_branch?>">
	  <img src="images/document_edit.png" border="0" title="Edit" /></a> &nbsp; <a href="main.php?op=<?php echo $_GET[op];?>&act=list&amp;rd=<?php echo rand(1,99999); ?>&amp;del=<?php echo $rs->id_branch?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf('<?php echo $rs->name_branch;?>')" /></a> 
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
        <td><? echo $db->render('main.php?op='.$_GET[op].'&act='.$_GET[act].'&'); ?></td>
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