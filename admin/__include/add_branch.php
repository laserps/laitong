<?php  

	if($_POST['id'] != ""){
		$sys->Edit($data,$tbl,$page_admin,$fiel_id,$_POST['id']);
	}


	if($_GET['id'] !=""){
		$rs = $sys->Update($tbl,$fiel_id,$_GET['id']);

	}


	if(($_POST['save'] == "news_add") and ($_GET['id'] == "")){
		unset($_POST['save']);
		$sys->Add($data,$tbl,$page_admin);
	}

	echo $fnc->form_check($message_alert);

?>



<table width="100%" cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td height="40" align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th"><?php echo ($_GET['id'])? 'แก้ไข' : 'เพิ่ม' ;?>สาขา</td>
        </tr></table></td>
    </tr>
    <tr>
        <td align="center">
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="th2">
	<FORM METHOD=POST onsubmit="return chkvalue(this)" ACTION="">
		<tr height="30" class="l">
			<td width="12%" bgcolor="#BBD8EC" align="right" class="th r"></td>
			<td width="88%" align="left" bgcolor="#E7F1F8">
				<table class="th2" cellpadding="5" border="0">

				

					<tr>
					  <td align="right" class="r">ชื่อสาขา: </td>
					  <td><input name="name_branch" type="text" class="box" id="name_branch" style="border:dotted; border-color:#0000FF; width:250px"  value="<?php echo $rs->name_branch;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">ตัวย่อ สาขา: </td>
					  <td><input name="num_branch" type="text" class="box" id="num_branch" style="border:dotted; border-color:#0000FF; width:250px"  value="<?php echo $rs->num_branch;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">ประเภทสาขา: </td>
					  <td>
					  <input type="radio" name="status_branch" value = "1" <?php echo $fnc->checked("1",$rs->status_branch);?>>:แบบหลัก&nbsp;&nbsp;
					  <input type="radio" name="status_branch" value = "2" <?php echo $fnc->checked("2",$rs->status_branch);?>>:ย่อย
					  
					  </td>
					</tr>

			
					<tr>
					  <td align="right" class="r">คำนวนปัดเศษ: </td>
					  <td>
					  <input type="radio" name="status_calculate" value = "1" <?php echo $fnc->checked("1",$rs->status_calculate);?>>:ไม่ปัดเศษ&nbsp;&nbsp;
					  <input type="radio" name="status_calculate" value = "2" <?php echo $fnc->checked("2",$rs->status_calculate);?>>:ปัดเศษ
					  
					  </td>
					</tr>

	
					<tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td>
					  <input name="save" type="hidden" id="save" value="news_add" />
					  <INPUT TYPE="hidden" NAME="id" value = "<?php echo $rs->id_branch;?>">
					  <input name="image" type="image" src="images/b_save.gif" />
						
					  


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