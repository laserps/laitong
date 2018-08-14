
<?php 
include "date.php";
?>
<table width="100%" cellspacing="0" cellpadding="1" border="0" >
    <tr>
        <td align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">ตรวจสอบ Stock B</td>
        </tr></table></td>
    </tr>

<tr>
        <td align="left">
		<FORM METHOD=POST ACTION="">
<input name="d_date" size="20" value = "<?php echo date("d-m-Y");?>"> 
<a href="javascript:displayDatePicker('d_date')">
<IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a>
&nbsp;ระหว่าง&nbsp;
<input name="d_date_2" size="20" value = "<?php echo date("d-m-Y");?>"> 
<a href="javascript:displayDatePicker('d_date_2')">
<IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a>
&nbsp;&nbsp;<IMG SRC="images/b_print.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT="">

</FORM>

		<FORM METHOD=POST ACTION="">
		<input name="keyword" size="20"> 
		<INPUT TYPE="hidden" NAME="action" value = "search">
		<SELECT NAME="field">
		<OPTION VALUE="">ค้นทุกฟิลล์ข้อมูล</option>
		<OPTION VALUE="">Code</option>
		<OPTION VALUE="">Section</option>
		<OPTION VALUE="">Detail</option>
		<OPTION VALUE="">Group/Section</option>
		<OPTION VALUE="">แท่น1</option>
		<OPTION VALUE="">แท่น2</option>
		<OPTION VALUE="">แท่น3</option>
		<OPTION VALUE="">แท่น4</option>
		<OPTION VALUE="">แท่น5</option>
		<OPTION VALUE="">แท่น1/1</option>
		<OPTION VALUE="">แท่น2/1</option>
		</SELECT>
		<INPUT TYPE="submit" value = "Search">
		</FORM>

		</td>
		
    </tr>



	<FORM name="myForm" METHOD="POST" ACTION="">
    <tr>
        <td>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  
      <td align="center" bgcolor="#BBD8EC" class="th">Code<IMG SRC="images/icon_up.gif" WIDTH="21" HEIGHT="13" BORDER="0" title="เรียงลำดับ" style = "cursor:pointer;"></td>
      <td align="center" bgcolor="#BBD8EC" class="th">Section</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Detail</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Group/Section</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">นำเข้า</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">หมดอายุ</td>
      <td align="center" bgcolor="#BBD8EC" class="th">แท่น1</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">แท่น2</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">แท่น3</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">แท่น4</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">แท่น5</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">แท่น1/1</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">แท่น2/1</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">รวม</td>

	  <td align="center" bgcolor="#BBD8EC" class="th">สถานะQA</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Remark</td>
	</tr>
<?php 
function number_pad($number,$n) {
return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

$system  = array("1111-53-33-44-5","2222-53-33-44-5","3333-53-33-44-5","4444-53-33-44-5","5555-53-33-44-5","6666-53-33-44-5");
$section = array("0.03294","0.03294","0.03294","0.03294","0.03294","0.03294");
$detail  = array("S18-08.00ม. มอก.ตัวใหม่","S18-08.00ม. มอก.ตัวใหม่","S22-08.00ม. มอก.ตัวใหม่","S22-08.00ม. มอก.ตัวใหม่","S22-08.00ม. มอก.ตัวใหม่","S18-08.00ม. มอก.ตัวใหม่");

$group   = array("S18-0 ธรรมดา","S18-0 ธรรมดา","S18-0 ธรรมดา","S18-0 ธรรมดา","S18-0 ธรรมดา","S18-0 ธรรมดา");

$tock = array("Stock A","Stock B","Stock A","Stock A","Stock B");

$a = -1;

foreach($system as $sys){
$a++;
$bgc=($i++ % 2) ? '#FFFFFF' : '#E0F0F0';
?>
    <tr height="25" bgcolor="<?php echo $bgc?>" align="center" class="tb">
      <td align="center"><?php echo $sys?></td>

      <td align="center"><?php echo $section[$a]?></td>
	  <td align="center"><?php echo $detail[$a]?></td>
	  <td><?php echo $group[$a]?></td>
	  <td>02-05-2010</td>
	  <td>02-09-2010</td>
	  <td>-</td>
	  <td>141</td>
	  <td>-</td>
	  <td>71</td>
	  <td>-</td>
	  <td>21</td>
	  <td>-</td>
	  <td>325</td>

	  <td> <INPUT TYPE="radio" NAME="">ถูกต้อง &nbsp;<INPUT TYPE="radio" NAME="">&nbsp;ไม่ถูกต้อง</td>
	  
	  <td align="center" bgcolor="<?php echo $bgc?>"><INPUT TYPE="text" NAME=""></td>

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