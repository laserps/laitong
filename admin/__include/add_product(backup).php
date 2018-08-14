<?php  
	

	if($_GET['img_'] !=""){
			unlink("../img_product/".$_GET['img_']."");
			unlink("../thumb/".$_GET['img_']."");
			$data_update1 = array("picture_1_product"=>"");
			$db->update(''.$tbl.'', $data_update1, array(''.$fiel_id.'' => $_GET['id']));
			
			echo '<script type="text/javascript">
			<!--
				window.location.reload("?op=product&act=add&rd='.rand(1,99999).'&id='.$_GET['id'].'");
			//-->
			</script>';
		}

	if($_GET['img_2'] !=""){
			unlink("../img_product/".$_GET['img_2']."");
			unlink("../thumb/".$_GET['img_2']."");
			$data_update1 = array("picture_2_product"=>"");
			$db->update(''.$tbl.'', $data_update1, array(''.$fiel_id.'' => $_GET['id']));
			
			echo '<script type="text/javascript">
			<!--
				window.location.reload("?op=product&act=add&rd='.rand(1,99999).'&id='.$_GET['id'].'");
			//-->
			</script>';
		}



	if($_POST['id'] != ""){
		$sys->Edit($data,$tbl,"main.php?op=product&act=add&rd=62573&id=".$_GET['id']."",$fiel_id,$_POST['id']);
	}


	if($_GET['id'] !=""){
		
		

		$rs = $sys->Update($tbl,$fiel_id,$_GET['id']);
		
		$rs_back = $db->record("tb_product", " product_id_re<='".$rs->product_id_re."' and id_product < '".$rs->id_product."'  order by product_id_re desc ");
		$rs_next = $db->record("tb_product", " product_id_re>='".$rs->product_id_re."' and id_product > '".$rs->id_product."'  order by product_id_re asc ");

	}


	if(($_POST['save'] == "news_add") and ($_GET['id'] == "")){
		unset($_POST['save']);
		$sys->Add($data,$tbl,$page_admin);
	}

	echo $fnc->form_check($message_alert);


include "date.php";

$row_category = $db->result("tb_category",NULL, 'id_category asc');
$row_type	  = $db->result("tb_type_product",NULL, 'name_type_product asc');
$row_color	  = $db->result("tb_color",NULL, 'name_color asc');
$row_stock	  = $db->result("tb_stock",'level_stock = "1"', 'id_stock asc');

function check_status($id,$text){
	if($id!=""){
		return $text;
	}
}


echo $fnc->open_java();
echo $fnc->connect_ajax();
$data_post = array('id_type_product_'=>'value');
echo $fnc->post_body('color.php',$data_post,'fnc_r','fnc_p');
echo $fnc->funtion_ajax_ready('fnc_r','color_span','innerHTML');
echo $fnc->close_java();
?>


<script type="text/javascript">
		function fnc_re(){
				var barcode_product = document.getElementById('barcode_product').value;
				var id_product = document.getElementById('id_product').value;
				var postBody =   'barcode_product=' + barcode_product +'&id_product='+ id_product;
				objRequest.open('POST', 'gent_barcode.php?'+ Math.random(), true);
				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_put;
				objRequest.send(postBody);
			}

			function fnc_gent(){
				var dm_product = document.getElementById('dm_product').value;
				var postBody =   'dm_product=' + dm_product;
				objRequest.open('POST', 'gent_barcode_add.php?'+ Math.random(), true);
				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_put_add;
				objRequest.send(postBody);
			}

			function fnc_type(id){

			}

		function fnc_put() {
				if (objRequest.readyState == 4 && objRequest.status ==200) {
						var data	=	objRequest.responseText;
						if(data!=1){
							alert("เปลี่ยนรหัสบาร์โค๊ทเรียบร้อย");
							document.getElementById('barcode_product').value = data;
						}else{
							alert("รหัสนี้ซ้ำในระบบ");
						}
					}
				}

		function fnc_put_add() {
				if (objRequest.readyState == 4 && objRequest.status ==200) {
						var data	=	objRequest.responseText;
						if(data!=1){
							document.getElementById('barcode_product').value = data;
						}else{
							alert("รหัสนี้ซ้ำในระบบ");
						}
					}
				}
		function fnc_group(group_id){
			var id_category =	document.getElementById('id_category').value;
			var stone_group_id = group_id+id_category;
			document.getElementById('stone_group_id').value = stone_group_id;
		}
				
</script>



<table width="100%" cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td height="40" align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">
		  <a href="main.php?op=product&act=add&rd=62573&id=<?php echo $rs_back->id_product;?>">&lt;&lt;&lt;Back</a>&nbsp;&nbsp;&nbsp;
		  <?php echo ($_GET['id'])? 'แก้ไข' : 'เพิ่ม' ;?>สินค้า
		  &nbsp;&nbsp;&nbsp; <a href="main.php?op=product&act=add&rd=62573&id=<?php echo $rs_next->id_product;?>">Next&gt;&gt;&gt;</a><br>
			พิมพ์ Barcode
			<br>
		   <a href="../barcodegen/test2.php?dm_product=<?php echo $rs->barcode_product;?>&code_product=<?php echo $rs->code_product?>&stone_sum_1_product=<?php echo (urlencode($rs->stone_sum_1_product));?>&stone_sum_2_product=<?php echo urlencode($rs->stone_sum_2_product)?>&stone_sum_3_product=<?php echo urlencode($rs->stone_sum_3_product)?>&stone_sum_4_product=<?php echo urlencode($rs->stone_sum_4_product)?>" target = "_blank"><img src="images/ss122669_1.jpg" width="50" height="30" border="0" alt="พิมพ์ Barcode" title = "พิมพ์ Barcode"></a>
		  </td>
        </tr></table></td>
    </tr>
    <tr>
        <td align="center">
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="th2">
	<FORM METHOD=POST onsubmit="return chkvalue(this)" enctype="multipart/form-data" ACTION="">
		<tr height="30" class="l">
			<td width="12%"  align="center" class="th r">
			<a href="?op=product&act=add&rd=8844&id=<?php echo $_GET['id']?>&img_=<?php echo $rs->picture_1_product;?>"><img src="images/other/icon_del.gif" width="14" height="16" border="0" alt=""></a>
			<img src="../thumb/ReplyID0253573-PIC1.jpg" width = "120" id = "pic2"  border="0" alt="">
			<!-- <a href="../thumb/<?php echo $rs->picture_1_product?>" target  = "_blank"><img src="../img_product/<?php echo $rs->picture_1_product?>" id = "pic1"   border="0" alt=""></a> -->
			
			<br><br>

			<a href="?op=product&act=add&rd=8844&id=<?php echo $_GET['id']?>&img_2=<?php echo $rs->picture_2_product;?>"><img src="images/other/icon_del.gif" width="14" height="16" border="0" alt=""></a><br>
			<img src="../thumb/ReplyID0253573-PIC1.jpg" width = "120" id = "pic2"  border="0" alt="">

			<!-- <a href="../thumb/<?php echo $rs->picture_2_product?>" target  = "_blank"><img src="../img_product/<?php echo $rs->picture_2_product?>" id = "pic2"  border="0" alt=""></a> -->

			</td>

			<td width="88%" align="left" bgcolor="#ccffcc">
				<table class="th2" cellpadding="5" border="0">

					<tr>
					  <td width = "15%" align = "right">
						<b>Barcode:</b></td>
						<td>
						<?php
							
						?>
						 <input type="text" name="dm_product" id = "dm_product" style ="width:150px;" value = "<?php echo "1".date("dmyhis");?>" onblur = "fnc_gent();">&nbsp;&nbsp;
						 <input type="hidden" name="barcode_product" id = "barcode_product" style ="width:150px;" value = "<?php  if($rs->barcode_product!=""){ echo $rs->barcode_product;}?>" readonly>
						<!-- <img src="images/faq_on.gif" width="16" height="16" border="0" alt="" style = "cursor:pointer;" onclick = "fnc_re();"> -->
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						<b>ซุ้ม:</b></td><td>
						<select name="soom" id = "soom" style = "width:155px;">
							<option value="1">ไม่ซุ้ม</option>
							<option value="2">ซุ้ม</option>
						</select>
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						<b>รหัสสินค้า:</b></td>
						<td style = "color:#ff0000;">
						<input type="text" name="p1" id="p1" style = "width:100px;">-<input type="text" name="p2" id="p2" style = "width:100px;">-<input type="text" name="p3" id="p3" style = "width:100px;">-<input type="text" name="p4" id="p4">
						<br>
						<!-- <b><span id = "sp_id_1">A</span>-<span id = "sp_id_2">PT</span>-<span id = "sp_id_3">10</span>-<span id = "sp_id_4">000001</span></b>&nbsp;&nbsp; -->
						
						<b><span id = "sp_id_1">&nbsp;</span>-<span id = "sp_id_2">&nbsp;</span>-<span id = "sp_id_3">&nbsp;</span>-<span id = "sp_id_4">&nbsp;</span></b>&nbsp;&nbsp;
						<br>


						หลักที่ 2
						A กรอบ 90%  ไม่ซุ้ม<br>
						B กรอบ90%  ยกซุ้ม<br>
						C ตลับ <br>
						D อุปกรณ์ <br>
						E กรอบ<br>
						หลักที่ 2 เป็นตัวอักษณ ตัวอย่าง ปิดตา = <br>pt


						<br>
						<span style = "font-size: 14px;">หลักที่ 1 ตลับหรือกรอบ - หลักที่สอง แบบพิมพ์กรอบ - หลักที่ 3 เบอร์พิมพ์ - หลักที่ 4 ลำดับ </span>
				      </td>
					</tr>
						<script type="text/javascript">
						<!--
							function fnc_proid_1(id){
								var soom = document.getElementById('soom').value;
								if( (id == "1") && (soom == "1") ){
									document.getElementById('p1').value = "A";
									document.getElementById('sp_id_1').innerHTML = "A";

								}
								else if( (id == "1") && (soom == "2") ){
									document.getElementById('p1').value = "B";
									document.getElementById('sp_id_1').innerHTML = "B";
								}
							}
						//-->
						</script>

					<tr>
					  <td width = "15%" align = "right"><b>ประเภท:</b></td><td>
						            <input type="radio" name="type" value = "1" onclick = "fnc_proid_1(1);">:กรอบ 90
						&nbsp;&nbsp;<input type="radio" name="type" value = "2" onclick = "fnc_proid_1(2);">:ตลับ
						&nbsp;&nbsp;<input type="radio" name="type" value = "3" onclick = "fnc_proid_1(3);">:อุปกรณ์
						&nbsp;&nbsp;<input type="radio" name="type" value = "4" onclick = "fnc_proid_1(4);">:กรอบ 70


				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						<b>ฝังเพชร:</b></td><td>
						<select name="" style = "width:150px;">
							<option value="1">ไม่ฝังเพชร</option>
							<option value="2">ฝังเพชรเอง</option>
							<option value="3">ฝังมากกว่า 5 เม็ด</option>
							<option value="4">ฝังน้อยกว่า 5 เม็ด</option>
						</select>&nbsp;&nbsp;
						<?php $i_ = range(1,99);?>
						<select name="" style = "width:50px;">
							<?php foreach($i_ as $i_){?>
							<option value="<?php echo $i_;?>"><?php echo $i_;?></option>
							<?php }?>
						</select>

						&nbsp;X&nbsp;<input type="text" name="petch_price" id = "petch_price" value = "ราคาเพชร" style = "width:50px;">


				      </td>
					</tr>


					<tr>
					  <td width = "15%" align = "right"><b>แบบพิมพ์กรอบ:</b></td><td>
					
						<select name="id_category" id="id_category" onchange = "fnc_type(this.value);" style = "width:150px;">
							<option value="0">แบบพิมพ์กรอบ</option>
							<?php if(!empty($row_category)){
							foreach($row_category as $rs_category){	
							?>
							<option value="<?php echo $rs_category->num_category;?>" <?php echo $fnc->selected($rs->id_category,$rs_category->num_category);?>><?php echo $rs_category->num_category."  ".$rs_category->name_category;?></option>
							<?php }?>
							<?php }?>
						</select>
						
						


				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right"><b>&nbsp;</b></td><td>
						<select name="id_group" id = "id_group" onchange = "fnc_group(this.value);"  style = "width:150px;height:20px;">
						    <option value="0">เลือกเบอร์แบบ</option>
							<option style="background-image:url(../thumb/example1_select.png);height:50px; background-repeat:no-repeat; padding-left: 50px;padding-top:18px;" value = "1">1&nbsp;ปลดหนี้</option>
							<option style="background-image:url(../thumb/example2_select.png);height:50px; background-repeat:no-repeat; padding-left: 50px;padding-top:18px;" value = "2">2&nbspกนกข้าว</option>
							<option style="background-image:url(../thumb/example3_select.png);height:50px; background-repeat:no-repeat; padding-left: 50px;padding-top:18px;" value = "3">3&nbspจัมโบ้ 2</option>					</select>
						
						</select>


				      </td>
					</tr>
					
					

					<tr>
					  <td width = "15%" align = "right">
						<b>ขนาด:</b></td><td>
						<select name="">
							<option value="">S</option>
							<option value="">M</option>
							<option value="">L</option>
							<option value="">XL</option>
						</select>
				      </td>
					</tr>

					

					<tr>
					  <td width = "15%" align = "right">
						<b>แผ่นปิดหลัง:</b></td><td>
						<select name="" style = "width:150px;" >
							<option value="">เปิดหลัง</option>
							<option value="">ปิดหลังแกะลาย</option>
							<option value="">ปิดหลังแกะภาพ</option>
						</select>
				      </td>
					</tr>

					
					<tr>
					  <td width = "15%" align = "right">
						<b>รูปแบบ:</b></td><td>
						<select name="" style = "width:150px;">
							<option value="">แกะลาย</option>
							<option value="">พ่นทราย</option>
							<option value="">ท้องปลิง</option>
							<option value="">ล่องเกลียว</option>
							<option value="">ขัดเงา</option>
						</select>
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						<b>ลงยา:</b></td><td>
						<select name="" style = "width:150px;">
							<option value="">ไม่มี</option>
							<option value="">เฉพาะซุ้ม</option>
							<option value="">เต็มกรอบ</option>
						</select>
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						<b>ลักษณะพิเศษ:</b></td><td>
						<table>
						<tr>
							<td><input type="checkbox" name="">:ไม่มี</td>
							<td><input type="checkbox" name="">:ติดลวดเกรียวช้างคู่</td>
							<td><input type="checkbox" name="">:ติดเกรียวโปเต้</td>
						</tr>
						<tr>
							<td><input type="checkbox" name="">:ติดไข่ปลา</td>
							<td><input type="checkbox" name="">:ครอบแก้ว</td>
							<td><input type="checkbox" name="">:ฝาตะกรุดไม่มีเข็ม</td>
						</tr>
						<tr>
							<td><input type="checkbox" name="">:ติดไข่ปลา</td>
							<td><input type="checkbox" name="">:ครอบแก้ว</td>
							<td><input type="checkbox" name="">:ฝาตะกรุดไม่มีเข็ม</td>
						</tr>
						</table>
						
						
						
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						<b>ค่าแรงพิเศษ:</b></td><td><input type="text" name="" style = "width:80px;">&nbsp;&nbsp;หมายเหตุ:<input type="text" name="" style = "width:300px;"></td>
					</tr>
					

					<tr>
					  <td width = "15%" align = "right">
						<b>น้ำหนัก:</b></td><td><input type="text" name="" style = "background-color:#ffffcc;width:80px;">&nbsp;&nbsp;Auto Mettler Machine</td>
					</tr>

					


					<?php 
							function check_date_($date_){
								if($date_ == "0000-00-00"){
									return "";
								}else{
									return $date_;
								}
							}
					?>

					<tr>
					  <td width = "15%" align = "right"><b>วันที่นำเข้า:</b></td>
					  <td><input name="date_product" type="text" class="box" id="date_product" style=" width:80px"  value="<?php echo $fnc->_date($rs->date_product);?>"/><a href="javascript:displayDatePicker('date_product')"><IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a>
				      </td>
					</tr>

					<script type="text/javascript">
					function fnc(a){
					document.getElementById('id_type_product_').value = a;
					}
					</script>


					<!-- <tr>
					  <td width = "15%" align = "right">
						<b>ราคาต่อหน่วย:</b></td><td><input type="text" name="unit_price" style ="width:50px;" value = "<?php echo $rs->unit_price;?>"> Auto
				      </td>
					</tr>
 -->
			

					<tr>
					  <td width = "15%" align = "right">
						<b>จำนวนสินค้า:</b></td><td><input type="text" name="total_product" style ="width:50px;" value = "1<?php echo $rs->total_product;?>" <?php if($rs->id_product !=""){ echo "readonly";}?>>
				      </td>
					</tr>


					<tr>
					  <td width = "15%" align = "right">
						<b>Note_Barcode:</b></td>
						<td><input type="text" name="stone_sum_1_product" style ="width:120px;" value = "<?php echo $rs->stone_sum_1_product;?>">
				      </td>
					</tr>

					

					<tr>
					  <td width = "15%" align = "right">
						<b>Picture1:</b></td><td><input type="file" name="file" style ="width:150px;">
				      </td>
					</tr>
					<tr>
					  <td width = "15%" align = "right">
						<b>Picture2:</b></td><td><input type="file" name="file2" style ="width:150px;">
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						<b>Stock:</b></td><td>
						<select name="id_stock" style = "width:150px;">
							<?php if(!empty($row_stock)){
							foreach($row_stock as $rs_stock){	
							?>
							<option value="<?php echo  $rs_stock->id_stock?>" <?php echo $fnc->selected($rs_stock->id_stock,$rs->id_stock);?>><?php echo $rs_stock->name_stock;?></option>
							<?php }}?>
						</select>
				      </td>
					</tr>
					

					<tr>
					  <td width = "15%" align = "right">
						<b>Remark:</b></td><td>
						<textarea name="remark_product" style = "width:250px;height:50px;" ><?php echo $rs->remark_product;?></textarea>
				      </td>
					</tr>

	
					<tr>
					  <td>&nbsp;</td><td>
					  <input name="save" type="hidden" id="save" value="news_add" />
					  <INPUT TYPE="hidden" NAME="id" id = "id_product" value = "<?php echo $rs->id_product;?>">
					  <input name="image" type="image" src="images/b_save.gif" />
				        <a href="main.php?op=<?php echo $_GET['op']?>&act=list"><img src="images/b_cancel.gif" border="0"/></a></td>

				  </tr>
				</table>
			</td>

			<td align="left" bgcolor="#ccffcc" valign = "top">
				<table width = "300" height = "600" border = "0">
				<tr>
					<td align = "center">
					&nbsp;<br><br><br><br><br>
					</td>
				</tr>
				<tr>
					<td align = "center">
					<div style="border: 3px coral solid; width: 100px;height:100px;"><h4>ราคาทอง</h4><h2>24,700</h2></div>
					</td>
				</tr>

				<tr>
					<td align = "center">
					<div style="border: 3px coral solid; width: 100px;height:100px;"><h4>เปอร์เซ็น</h4><h2>105%</h2></div>
					</td>
				</tr>

				<tr>
					<td align = "center">
					<div style="border: 3px coral solid; width: 100px;height:100px;"><h4>น้ำหนัก</h4><h2>0.02</h2></div>
					</td>
				</tr>
				
				<tr>
					<td align = "center">
					<div style="border: 3px coral solid; width: 100px;height:100px;"><h4>ค่าซิ</h4><h2>0.1</h2></div>
					</td>
				</tr>

				<tr>
					<td align = "center">
					<div style="border: 3px coral solid; width: 100px;height:100px;"><h4>น้ำหนักรวมซิ</h4><h2>0.1</h2></div>
					</td>
				</tr>


				<tr>
					<td align = "center">
					<div style="border: 3px coral solid; width: 100px;height:100px;"><h4>ค่าแรง</h4>
					<input type="text" name="" style = "width:80px; font-weight: bold; text-align:center;" value = "200" >
					</div>
					</td>
				</tr>

				<tr>
					<td align = "center">
					<div style="border: 3px #ff0000 solid; width: 100px;height:100px;"><h4>ราคาต้นทุน</h4><h2>50,000</h2></div>
					</td>
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
<script type="text/javascript">
<!--
	document.getElementById('dm_product').focus();
//-->
</script>