<?php  

		$brand = $sys->dataList("tb_position",$id=null,20,"id_position"," asc ");


	if($_POST['id'] != ""){
		if($_POST['username']==""){
			unset($data['username']);
			unset($data['password']);
		}
		unset($data['id_member']);
		$sys->Edit($data,$tbl,$page_admin,$fiel_id,$_POST['id'],$fiel_check);
	}


	if($_GET['id'] !=""){
		$rs = $sys->Update($tbl,$fiel_id,$_GET['id']);
	}


	if(($_POST['save'] == "news_add") and ($_GET['id'] == "")){
		$sys->Add($data,$tbl,$page_admin,$fiel_check);
	}

	echo $fnc->form_check($message_alert);

?>

<table width="100%" cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td height="40" align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th"><?=($_GET['id'])? 'แก้ไข' : 'เพิ่ม' ;?>Content</td>
        </tr></table></td>
    </tr>
    <tr>
        <td align="center">
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


<table width="100%" border="0" cellpadding="0" cellspacing="0" class="th2">
	<FORM METHOD=POST onsubmit="return chkvalue(this)" ACTION="#">
		<tr height="30" class="l">
			<td width="12%" bgcolor="#BBD8EC" align="right" class="th r"></td>
			<td width="88%" align="left" bgcolor="#E7F1F8">
				<table class="th2" cellpadding="5" border="0">
<?php $row_branch = array("1"=>"BLP","2"=>"เยาวราช","3"=>"BK","4"=>"MBK","5"=>"งามวงศ์งาน","6"=>"PATA","7"=>"พระราม 3","8"=>"ลายทอง","9"=>"บางนา");?>
				  <tr>
					  <td align="right" class="r">สาขา : </td>
					  <td>
					  <select name="" style = "width:178px;-webkit-border-radius: 9px;
	-moz-border-radius: 9px;
	border-radius: 9px;">
				<option value="0">-----------เลือกสาขา----------------</option>
				<?php foreach($row_branch as $rs_branch_id=>$rs_branch_name){?>
				<option value="<?php echo $rs_branch_id;?>"><?php echo $rs_branch_name;?></option>
				<?php }?>
			</select>
					  </td>
					</tr>

					<tr>
					  <td align="right" class="r">ตำแหน่ง : </td>
					  <td>
					  <select name="id_position" id = "id_brand">
					 	<?php
							if($brand)
								foreach($brand as $crsbrand){
					    			echo '<option value="'.$crsbrand->id_position.'" '.(($crsbrand->id_position==$rs->id_position)? 'selected="selected"': '').'>'.$crsbrand->name_position.'</option>';
					    }?>		
					  </select>
					  </td>
					</tr>
			
					<tr>
					  <td align="right" class="r">คำนำหน้า: </td>
					  <td>
					  <INPUT TYPE="radio" NAME="title_member" id = "title_member" value = "นาย" <?php echo $fnc->checked("นาย",$rs->title_member);?> >:นาย
					  <INPUT TYPE="radio" NAME="title_member" id = "title_member2" value = "นาง" <?php echo $fnc->checked("นาง",$rs->title_member);?>>:นาง
					  <INPUT TYPE="radio" NAME="title_member" id = "title_member3" value = "นางสาว" <?php echo $fnc->checked("นางสาว",$rs->title_member);?> <?php echo $fnc->check_radio($rs->title_member);?>>:นางสาว
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">รหัสพนักงาน: </td>
					  <td><input name="num_member" type="text" class="box" id="num_member" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->num_member;?>"/>
					</td>
					</tr>

					<tr>
					  <td align="right" class="r">ชื่อ: </td>
					  <td><input name="name" type="text" class="box" id="name" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name;?>"/>
					</td>
					</tr>

					<tr>
					  <td align="right" class="r">นามสกุล: </td>
					  <td><input name="surname" type="text" class="box" id="surname" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->surname;?>"/>
					</td>
					</tr>

					<tr>
					  <td align="right" class="r">เพศ: </td>
					  <td>
					  <INPUT TYPE="radio" NAME="sex" value = "M" <?php echo $fnc->checked("M",$rs->sex)?>>:ชาย
					  <INPUT TYPE="radio" NAME="sex" value = "F" <?php echo $fnc->checked("F",$rs->sex)?> <?php echo $fnc->check_radio($rs->title_member);?>>:หญิง
					  </td>
					</tr>

					<tr>
					  <td align="right" class="r">โทรศัพท์: </td>
					  <td><input name="telephone" type="text" class="box" id="telephone" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->telephone;?>" maxlength="20" />
					</td>
					</tr>

					<tr>
					  <td align="right" class="r">ที่อยู่: </td>
					  <td>
					  <TEXTAREA NAME="address" id = "address" style="border:dotted; border-color:#0000FF; width:350px;height:100px;"><?php echo $rs->address;?></TEXTAREA>
					</td>
					</tr>

				
					<tr>
					  <td align="right" class="r">Username: </td>
					  <td>
					  <br>เปลี่ยนข้อมูลเข้าระบบ:<INPUT TYPE="radio" NAME="check" onclick = "fnc(1);">ไม่เปลี่ยนข้อมูลเข้าระบบ:<INPUT TYPE="radio" NAME="check"  onclick = "fnc(2);" checked><br>
					  <input name="username" type="text" class="box" id="username" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->username;?>" <?php if($rs->username!=""){echo "readonly";}?> />
					</td>
					</tr>

	<SCRIPT LANGUAGE="JavaScript">
		function fnc(a){
			if(a==1){
			document.getElementById('password').disabled = false;
			document.getElementById('password').value    = "";
			}else{
			document.getElementById('username').disabled = true;
			document.getElementById('password').disabled = true;
			document.getElementById('password').value    = "88888888888888888888888888888888888";
			}
					}
	</SCRIPT>				
					<?php if($_GET['id']!=""){?>
					<tr>
					  <td align="right" class="r">password: </td>
					  <td><input name="password" id = "password" type="password" class="box" id="password" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->password;?>" disabled/>
					</td>
					</tr>
					<?php }else{?>
					<tr>
					  <td align="right" class="r">password: </td>
					  <td><input name="password" type="password" class="box" id="password" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->password;?>"/>
					</td>
					</tr>
					<?php }?>

				

<SCRIPT LANGUAGE="JavaScript">
<!--
	function fck(){
if(document.getElementById('file').value != ""){
document.getElementById('check').value = "1";
}else{
document.getElementById('check').value = "";
}
}	
//-->
</SCRIPT>
			

					<!-- <tr>
					  <td align="right" class="r">รูปประจำตัว : </td>
					  <td>
					<INPUT TYPE="hidden" name = "check" id="check">
					<INPUT TYPE="hidden" NAME="pic" value = "<?php echo $rs->f_pic_product?>">
					<input type="file" name="file" id="file" onchange = "fck();"> 210x313 Auto Resize .jpg  .gif  .png
					  </td>
					</tr>
 -->

			

					<tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td>
					  <input name="save" type="hidden" id="save" value="news_add" />
					  <INPUT TYPE="hidden" NAME="id" value = "<?php echo $rs->id_member;?>">
					  <input name="image" type="image" src="images/b_add.gif" />
				        <a href="main.php?op=<?php echo $_GET['op']?>&act=list"><img src="images/b_cancel.gif" border="0"/></a></td>
				  </tr>
				</table>
			</td>
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