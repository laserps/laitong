<?php   

	$sys  = new position;
	
	echo $sys->checkadd();

	$brand = $sys->Type();
	if($_GET['id'] !=""){
	$rs = $sys->Update($_GET['id']);
	}

	if($_POST[id] != "")
	$sys->Edit($_POST[id]);
	
	if(($_POST[save] == "news_add") and ($_GET[id] == "")){
	$sys->Add();
	}


?>

<table width="100%" cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td height="40" align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th"><?php echo ($_GET['id'])? 'แก้ไข' : 'เพิ่ม' ;?>Content</td>
        </tr></table></td>
    </tr>
    <tr>
        <td align="center">
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


<table width="100%" border="0" cellpadding="0" cellspacing="0" class="th2">
	<FORM METHOD=POST onsubmit="return chkvalue1()" ACTION="#">
		<tr height="30" class="l">
			<td width="12%" bgcolor="#BBD8EC" align="right" class="th r"></td>
			<td width="88%" align="left" bgcolor="#E7F1F8">
				<table class="th2" cellpadding="5" border="0">

			

					<tr>
					  <td align="right" class="r">ฝ่าย : </td>
					  <td>
					  <select name="id_division" id = "id_brand">
					  <option value = "0">เลือก ฝ่าย</option>
					  	<?php 
							if($brand)
								foreach($brand as $crsbrand){
					    			echo '<option value="'.$crsbrand->id_division.'" '.(($crsbrand->id_division==$rs->id_division)? 'selected="selected"': '').'>'.$crsbrand->name_division.'</option>';
					    }?>		
					  </select>
					  </td>
					</tr>
			

					<tr>
					  <td align="right" class="r">ชื่อตำแหน่ง: </td>
					  <td><input name="name_position" type="text" class="box" id="name_position" style="border:dotted; border-color:#0000FF; width:350px"  value="<?php echo $rs->name_position;?>"/>
					</td>
					</tr>

					<tr>
					  <td align="right" class="r">Level: </td>
					  <td>
					  <INPUT TYPE="radio" NAME="level" id = "title_member" value = "1" <?php echo $sys->checked("1",$rs->level)?>>:ผู้บริหาร
					  <INPUT TYPE="radio" NAME="level" id = "title_member2" value = "2" <?php echo $sys->checked("2",$rs->level)?>>:ฝ่ายบุคคล
					  <INPUT TYPE="radio" NAME="level" id = "title_member3" value = "3" <?php echo $sys->checked("3",$rs->level)?>>:หัวหน้าฝ่าย
					  <INPUT TYPE="radio" NAME="level" id = "title_member4" value = "4" <?php echo $sys->checkednon("4",$rs->level)?>>:พนักงานทั่วไป
				      <input name="save" type="hidden" id="save" value="news_add" /></td>
					</tr>


			

					<tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td>
					  <INPUT TYPE="hidden" NAME="id" value = "<?php echo $_GET['id']?>">
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