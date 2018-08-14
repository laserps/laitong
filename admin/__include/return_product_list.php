

<table width="100%" cellspacing="0" cellpadding="1" border="0" >
    <tr>
        <td align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">ข้อมูลเสาเข็มกลับโรงงาน</td>
        </tr></table></td>
    </tr>

	<tr>
	<td>
	<FORM METHOD=POST ACTION="">
<input name="d_date" size="20" value = "<?php echo date("d-m-Y");?>"> 
<a href="javascript:displayDatePicker('d_date')">
<IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a>
&nbsp;ระหว่าง&nbsp;
<input name="d_date_2" size="20" value = "<?php echo date("d-m-Y");?>"> 
<a href="javascript:displayDatePicker('d_date_2')">
<IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a>
<INPUT TYPE="hidden" NAME="action" value = "search">
<IMG SRC="images/b_print.gif"  BORDER="0" ALT="">
</FORM>
	</td>
	</tr>

	<tr>
        <td align="left">
		<a href="main.php?op=<?php echo $_GET[op]?>&act=add&rd=123456"><img src="images/b_add.gif" /></a>
		&nbsp;&nbsp;
		</td>
		
    </tr>


	<FORM name="myForm" METHOD="POST" ACTION="">
    <tr>
        <td>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  <td align="center" bgcolor="#BBD8EC" class="th">ลำดับ</td>
      <td align="center" bgcolor="#BBD8EC" class="th">JOB/NO</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ขนาดเข็ม</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">จำนวนต้น</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">เหตุผลที่ต้องนำกลับ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ทะเบียนรถ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">เครื่องมือ</td>
    </tr>
<?php 
function number_pad($number,$n) {
return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

$system = array("126-12.00 ม.","126-12.00 ม.","126-12.00 ม.");
$id		= array("014578","02457895","03457895");
$total	= array("1 ท่อน" ,"2 ท่อน", "3 ท่อน");
$because= array("ติดกองดิน","ติดกองดิน","ติดกองดิน");
$a = -1;

foreach($system as $sys){
$a++;
$bgc=($i++ % 2) ? '#FFFFFF' : '#E0F0F0';
?>
    <tr height="25" bgcolor="<?php echo $bgc?>" align="center" class="tb">
	  <td align="center"><?php echo $a+1?></td>
      <td align="center"><?php echo $id[$a]?></td>
	  <td align="center"><?php echo $sys?></td>
	  <td align="center"><?php echo $total[$a]?></td>
	  <td align="center"><?php echo $because[$a]?></td>
	  <td align="center">86-5350</td>
	  <td align="center" bgcolor="<?php echo $bgc?>">
	  <a href="main.php?op=<?php echo $_GET['op'];?>&act=add&amp;rd=<?php echo rand(1,99999); ?>&id=<?php echo $rs->id_member?>">
	  <img src="images/document_edit.png" border="0" title="Edit" /></a> &nbsp; <a href="main.php?op=<?php echo $_GET[op];?>&act=list&amp;rd=<?php echo rand(1,99999); ?>&amp;del=<?php echo $rs->id_member?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf<?php  echo "$a" ?>(this)" /></a> </td>

    </tr>
<?php }?>



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