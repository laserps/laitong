<?php 
include '../module/class.database.php';
$sys = new Database();
$rs = $sys->record('tb_member,tb_position', ' tb_member.id_position = tb_position.id_position and  tb_member.id_member = "'.$_POST['id_member'].'"');
?>
<table class="th2" cellpadding="5" border="0">
					<tr id = "price">
					  <td align="right" class="r">รหัสพนักงาน: </td>
					  <td><input name="num_member" type="text" class="box" id="num_member" style="border:dotted; border-color:#0000FF; width:150px"  value="<?=$rs->num_member;?>" readonly/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">ชื่อ-นามสกุล: </td>
					  <td><input name="name" type="text" class="box" id="name" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->name."-".$rs->surname;?>" readonly/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">ตำแหน่ง: </td>
					  <td><input name="name_position" type="text" class="box" id="name_position" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->name_position;?>" readonly/>
				      </td>
					</tr>

				
					<tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td>&nbsp;</td>
				  </tr>

				  <tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td>&nbsp;</td>
				  </tr>

			
		
		
					<tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td>&nbsp;</td>
				  </tr>
				</table>