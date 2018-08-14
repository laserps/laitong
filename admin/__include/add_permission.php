


<table width="100%" cellspacing="0" cellpadding="1" border="0" >
    <tr>
        <td align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">จัดการสิทธิ์พนักงาน คุณ นัฐวุฒิ บุญทิพย์ ฝ่ายบัญชี </td>
        </tr></table></td>
    </tr>


	<FORM name="myForm" METHOD="POST" ACTION="">
    <tr>
        <td>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  <td align = "center"><IMG SRC="Admin_files/true.gif" WIDTH="5" HEIGHT="14" BORDER="0" ALT="" style = "display:none;"  id = "check_true" onclick = "handler();"><IMG SRC="Admin_files/false.gif" WIDTH="14" HEIGHT="14" BORDER="0" ALT="" onclick="handler();" id = "check_false"></td>
      <td align="center" bgcolor="#BBD8EC" class="th">ระบบ</td>
      <td align="center" bgcolor="#BBD8EC" class="th">สิทธิ์</td>
    </tr>
<?php 
function number_pad($number,$n) {
return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

$system = array("ข้อมูลพนักงาน","Stock","แท่นหล่อ","แท่นเก็บ");

foreach($system as $sys){
$bgc=($i++ % 2) ? '#FFFFFF' : '#E0F0F0';
?>
    <tr height="25" bgcolor="<?php echo $bgc?>" align="center" class="tb">
	  <td><INPUT TYPE="checkbox" NAME="id[]" value = "<?php echo $rs->id_member?>"></TD>
      <td align="center"><?php echo $sys?></td>

      <td align="center"><INPUT TYPE="checkbox" NAME="">:เพิ่มข้อมูล&nbsp;<INPUT TYPE="checkbox" NAME="">:แก้ไขข้อมูล&nbsp;<INPUT TYPE="checkbox" NAME="">:ลบข้อมูล</td>

    </tr>
<?php }?>

 <tr height="25"  align="center" class="tb">

      <td align="center"><INPUT TYPE="submit" value = "บันทึกข้อมูล"></td>

    </tr>


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