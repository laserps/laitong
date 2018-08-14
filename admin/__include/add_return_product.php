



<table width="100%" cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td height="40" align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th"><?php echo ($_GET['id'])? 'แก้ไข' : 'เพิ่ม' ;?>เสาเข็มเก็บกลับ</td>
        </tr></table></td>
    </tr>
    <tr>
        <td align="center">
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="th2">
	<form action="#" method="POST" enctype="multipart/form-data" >
		<tr height="30" class="l">
			<td width="12%" bgcolor="#BBD8EC" align="right" class="th r"></td>
			<td width="88%" align="left" bgcolor="#E7F1F8">
			      <fieldset style = "width:1000px;border:3px;">
					<legend>Header:</legend>
				<table class="th2" cellpadding="5" border="0">
					
				
					
					<tr>
					  <td align="right" class="r">JOB/NO: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>15017"/></td>
					</tr>


					<tr>
					  <td align="right" class="r">หน่วยงาน: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="บ้านพฤกษา"/></td>
					</tr>
					

					<tr>
					  <td align="right" class="r">จำนวนต้น: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>

					<tr>
					  <td align="right" class="r">เหตุผลที่ต้องนำกลับ: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>

					<tr>
					  <td align="right" class="r">ทะเบียนรถ: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>

					
				</table>
				</fieldset>
				
				<fieldset style = "width:1000px;border:3px;">
					<legend>ส่วนที่ 1 ระบุรายละเอียดเกี่ยวกับผลิตภัณท์:</legend>
				<table class="th2" cellpadding="5" border="0">
					
					<tr style = "display:none;" id = "row1">
					  <td align="right" class="r">List 1: </td>
					  <td>
					  <table width = "100%">
					  <tr>
					  <td><B>หน้าตัดความยาว</B>:I22x8.00 ml.</td>
					  <td><B>วันที่ผลิต</B>:2/7/2552</td>
					  <td><B>แท่นผลิต</B>:5</td>
					  <td><B>ระบุลักษณะความเสียหาย</B>:แตก</td>
					  <td><B>จำนวนต้น</B>:2</td>
					  <td><B>การแก้ไขระบุจำนวนต้น</B>:ตัด</td>
					  <td> <IMG SRC="images/other/del.png"  BORDER="0" ALT="" onclick  = "document.getElementById('row1').style.display = 'none';" style = "cursor:pointer;"> </td>
					  </tr>
					  </table>
					  </td>
					</tr>
					
					<tr>
					  <td align="right" class="r">หน้าตัดความยาว: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>


					<tr>
					  <td align="right" class="r">วันที่ผลิต: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value=""/></td>
					</tr>
					

					<tr>
					  <td align="right" class="r">แท่นผลิต: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>

					<tr>
					  <td align="right" class="r">ระบุลักษณะความเสียหาย: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>


					<tr>
					  <td align="right" class="r">จำนวนต้น: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>

					<tr>
					  <td align="right" class="r">การแก้ไขระบุจำนวนต้น: </td>
					  <td><INPUT TYPE="radio" NAME="">:ตัด<INPUT TYPE="radio" NAME="">:ซ่อม<INPUT TYPE="radio" NAME="">:ทิ้ง</td>
					</tr>

					<tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td> <IMG SRC="images/add.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT="" onclick  = "document.getElementById('row1').style.display = '';" style = "cursor:pointer;"> </td>
					</tr>

				</table>
				</fieldset>
				
				<HR>
				<fieldset style = "width:1000px;border:3px;">
					<legend>ส่วนที่ 2 สำหรับติดตามแก้ไข <B>กรณีเสาตัด</B>:</legend>
				<table class="th2" cellpadding="5" border="0">
					
					
					<tr>
					  <td align="right" class="r">ขนาดหน้าตัดเสา: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>


					<tr>
					  <td align="right" class="r">ก่อนตัด: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value=""/></td>
					</tr>
					

					<tr>
					  <td align="right" class="r">หลังตัด: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>

					<tr>
					  <td align="right" class="r">เศษทิ้ง: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>


					<tr>
					  <td align="right" class="r">จำนวนต้น: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>

					<tr>
					  <td align="right" class="r">จำนวนคิวทิ้ง: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>

					<tr>
					  <td align="right" class="r">ความเรียบร้อย: </td>
					  <td><INPUT TYPE="radio" NAME="">:ผ่าน<INPUT TYPE="radio" NAME="">:ไม่ผ่าน</td>
					</tr>

					<tr>
					  <td align="right" class="r">ลงรหัสเสาตัด: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>

					<tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td> <IMG SRC="images/add.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""> </td>
					</tr>

				</table>
				</fieldset>
				<fieldset style = "width:1000px;border:3px;">
					<legend>ส่วนที่ 2 สำหรับติดตามแก้ไข <B>กรณีเสาซ่อม</B>:</legend>
				<table class="th2" cellpadding="5" border="0">
					
					
					<tr>
					  <td align="right" class="r">ขนาดหน้าตัดเสา: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>


					<tr>
					  <td align="right" class="r">จำนวนต้น: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value=""/></td>
					</tr>
					

					<tr>
					  <td align="right" class="r">จำนวนคิว: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>
					
					<tr>
					  <td align="right" class="r">ความเรียบร้อย: </td>
					  <td><INPUT TYPE="radio" NAME="">:ผ่าน<INPUT TYPE="radio" NAME="">:ไม่ผ่าน</td>
					</tr>

					<tr>
					  <td align="right" class="r">หมายเหตุ: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>


					<tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td> <IMG SRC="images/add.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""> </td>
					</tr>

				</table>
				</fieldset>

				<fieldset style = "width:1000px;border:3px;">
					<legend>ส่วนที่ 2 สำหรับติดตามแก้ไข <B>กรณีเสาทิ้ง</B>:</legend>
				<table class="th2" cellpadding="5" border="0">
					
					
					<tr>
					  <td align="right" class="r">ขนาดหน้าตัดเสา: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>


					<tr>
					  <td align="right" class="r">จำนวนต้น: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value=""/></td>
					</tr>
					

					<tr>
					  <td align="right" class="r">จำนวนคิว: </td>
					  <td><input name="name_brand" type="text" class="box" id="name_brand" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_brand;?>"/></td>
					</tr>

					<tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td> <IMG SRC="images/add.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""> </td>
					</tr>
					

				</table>
				</fieldset>

				<fieldset style = "width:1000px;border:3px;">
					<legend><B>ข้อมูลสรุป</B>:</legend>
				<table class="th2" cellpadding="5" border="0">
					
					
					<tr>
					  <td align="right" class="r">เสาเก็บกลับ/NCP: </td>
					  <td><U>0.4578</U>&nbsp;คิว</td>
					</tr>


					<tr>
					  <td align="right" class="r">เสาซ่อม: </td>
					  <td><U>0.4578</U>&nbsp;คิว</td>
					</tr>
					

					<tr>
					  <td align="right" class="r">เสาตัด: </td>
					  <td><U>0.4578</U>&nbsp;คิว</td>
					</tr>

					<tr>
					  <td align="right" class="r">เศษทิ้ง: </td>
					  <td><U>0.4578</U>&nbsp;คิว</td>
					</tr>
		

				</table>
				</fieldset>
			</td>
		</tr>

		<tr>
			<td align="right" class="r" bgcolor="#E7F1F8">&nbsp;</td>
			<td bgcolor="#E7F1F8"><input name="image" type="image" src="images/b_add.gif" />
			<a href="main.php?op=shop"><img src="images/b_cancel.gif" border="0"/></a></td>
		</tr>
		
	</form>
</table>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->

        </td>
    </tr>
    <tr>
        <td> </td>  
    </tr>


    <tr>
    <td height="40" align="center" bgcolor="#BBD8EC" class="th">

        </td>
    </tr>
</table>