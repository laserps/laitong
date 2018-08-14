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


include "date.php";
?>



<table width="100%" cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td height="40" align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th"><?php echo ($_GET['id'])? 'แก้ไข' : 'เพิ่ม' ;?> งานแฟร์</td>
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
					  <td align="right" class="r">ชื่องาน: </td>
					  <td><input name="name_stock" type="text" class="box" id="name_stock" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_stock;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">ประจำวันที่: </td>
					  <td><input name="date_stock" type="text" class="box" id="name_position" style="border:dotted; border-color:#0000FF; width:80px"  value="<?php echo $rs->date_stock;?>"/><a href="javascript:displayDatePicker('date_stock')"><IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a>
					  <!-- เวลา<select name="">
					    <?php $hour = range(1,12);?>
						<?php foreach($hour as $h){?>
						<option value="<?php echo $h;?>"><?php echo $h;?></option>
						<?php }?>
					  </select>:
					  <select name="">
					    <?php $minute = range(0,59);?>
						<?php foreach($minute as $m){?>
						<option value="<?php echo $m;?>"><?php echo $m;?></option>
						<?php }?>
					  </select> -->

					</td>
					</tr>

					

	
					<tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td>
					  <input type="hidden" name="level_stock" value = "2">
					  <input name="save" type="hidden" id="save" value="news_add" />
					  <INPUT TYPE="hidden" NAME="id" value = "<?php echo $rs->id_stock;?>">
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