<?php 
include '../module/class.database.php';
$sys = new Database();
$rs = $sys->record('tb_member,tb_position', ' tb_member.id_position = tb_position.id_position and  tb_member.num_member = "'.$_POST['number_member'].'"');
?>
<table class="th2" cellpadding="5" border="0">
<tr id = "price">
					  <td align="right" class="r">รหัสพนักงาน: </td>
					  <td><input name="number_member" type="text" class="box" id="number_member" style="border:dotted; border-color:#0000FF; width:150px"  value="<?=$rs->num_member;?>" onblur = "post_id_member();"/><img src="images/b_search.png" width="16" height="16" border="0" alt="">
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">ชื่อ-นามสกุล: </td>
					  <td><input name="firstname" type="text" class="box" id="firstname" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->name." ".$rs->surname;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">ตำแหน่ง: </td>
					  <td><input name="name_position" type="text" class="box" id="name_position" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->name_position;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r"><input type="hidden" name="id_member" id = "id_member" value = "<?php echo $rs->id_member?>"></td>
					  <td>&nbsp;</td>
				  </tr>
				  </table>