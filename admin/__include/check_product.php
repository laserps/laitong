<?php  

	if($_GET['img_'] !=""){
			unlink("../img_product/".$_GET['img_']."");
			unlink("../thumb/".$_GET['img_']."");
			$data_update1 = array("picture_1_product"=>"");
			$db->update(''.$tbl.'', $data_update1, array(''.$fiel_id.'' => $_GET['id']));
			
			echo '<script type="text/javascript">
			<!--
				window.location.reload("?op=check_product&act=add&rd='.rand(1,99999).'&id='.$_GET['id'].'");
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
				window.location.reload("?op=check_product&act=add&rd='.rand(1,99999).'&id='.$_POST['id'].'");
			//-->
			</script>';
		}



	if($_POST['id'] != ""){
		echo $fnc->alert("บันทึกข้อมูลเรียบร้อยแล้ว");
		$sys->Edit($data,$tbl,"?op=check_product&act=add&rd=62573",$fiel_id,$_POST['id']);
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

$row_category = $db->result("tb_category",NULL, 'num_category asc');
$row_type	  = $db->result("tb_type_product",NULL, 'name_type_product asc');
$row_color	  = $db->result("tb_color",NULL, 'name_color asc');
$row_stock	  = $db->result("tb_stock",'level_stock = "1"', 'name_stock asc');

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

$count_invoce = $db->sum("tb_invoice", " id_product = '".$rs->id_product."' ", $order = NULL,"qty_invoice");
$row_invoice	  = $db->result("tb_invoice"," id_product = '".$rs->id_product."' ", 'id_invoice asc');

$count_rent = $db->sum("tb_rent_temp", " id_product = '".$rs->id_product."' ", $order = NULL,"total_rent");

$row_rent	  = $db->result("tb_rent_temp,tb_stock"," tb_rent_temp.id_stock_rent = tb_stock.id_stock and  id_product = '".$rs->id_product."'  group by tb_rent_temp.id_stock_rent ", 'id_rent_temp asc');



?>
<SCRIPT LANGUAGE="JavaScript">
	var t ="";
	var objRequest = createRequestObject () ;

	function timeMsg()
		{
		//t=setTimeout("fnc_p()",600);
		}

	document.onkeydown = checkKeycode


	function checkKeycode(e) {
		var keycode;
		if (window.event) keycode = window.event.keyCode; // ใช้ IE
			var dm_product = document.getElementById('dm_product').value;
			if(keycode=="13"){
			fnc_p();
			
			}
	}

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

	function createRequestObject () {
					var objTemp = false ;
					if (window.XMLHttpRequest) {
					objTemp = new XMLHttpRequest () ;
					}else if (window.ActiveXObject) {
					objTemp = new ActiveXObject ("Microsoft.XMLHTTP") ;	
					}
					return objTemp ;
				}
				
				function fnc_p()
					{
				clearTimeout(t);
				var invoice_no = document.getElementById('invoice_no').value;
				var name_customer = document.getElementById('name_customer').value;
				var dm_product = document.getElementById('dm_product').value;
				var postBody =   'dm_product=' + dm_product +'&invoice_no='+ invoice_no +'&name_customer='+ name_customer;
				objRequest.open('POST', 'check_product.php?'+ Math.random(), true);
				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_r;
				objRequest.send(postBody);
				}

				function fnc_post_save()
					{
				var invoice_no = document.getElementById('invoice_no').value;
				var name_customer = document.getElementById('name_customer').value;
				var dm_product = document.getElementById('dm_product').value;
				var qty_invoice = document.getElementById('qty_invoice').value;
				var id_product = document.getElementById('id_product').value;
				var total_product = document.getElementById('total_product').value;
				
				if(invoice_no==""){
					alert("กรุณากรอก Invoince No ด้วยครับ");
					document.getElementById('invoice_no').focus();
				}
				else if(name_customer==""){
					alert("กรุณากรอก name_customer ด้วยครับ");
					document.getElementById('name_customer').focus();
				}
				else if(total_product<qty_invoice){
					alert("ยอดในสต๊อกไม่พอกรุณาตรวจสอบข้อมูล");
					window.location.replace("main.php?op=buy&act=list&rd=45398&id="+invoice_no+"&name_customer="+name_customer+"");
				}
				else if(qty_invoice<1){
					alert("ข้อมูลไม่ถูกต้องกรุณากรอกใหม่");
					document.getElementById('qty_invoice').focus();
					window.location.replace("main.php?op=buy&act=list&rd=45398&id="+invoice_no+"&name_customer="+name_customer+"");
				}
				else{
				
				var postBody =   'dm_product=' + dm_product +'&invoice_no='+ invoice_no +'&name_customer='+ name_customer +'&qty_invoice='+qty_invoice+'&id_product='+id_product;
				objRequest.open('POST', 'invoice_post.php?'+ Math.random(), true);
				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_save_r;
				objRequest.send(postBody);
				}
				}

				function fnc_r() {
					if (objRequest.readyState == 4 && objRequest.status ==200) {
						var data	=	objRequest.responseText;
						document.getElementById('form').innerHTML = data;
						t=setTimeout("fnc_focus_qty()",50);
						}
				}


			function fnc_save_r() {
				if (objRequest.readyState == 4 && objRequest.status ==200) {
			    var data = objRequest.responseText;document.getElementById('list_order').innerHTML = data;
			    t=setTimeout("fnc_focus_refresh()",50);
				}
			}

			function fnc_focus_refresh(){
					document.getElementById('dm_product').focus();
					clearTimeout(t);
				}


				function fnc_focus_qty(){
					document.getElementById('dm_product').focus();
					clearTimeout(t);
				}
</script>


  <script>
  $(document).ready(function () {
	document.getElementById('dm_product').focus();
	});
  </script>


<div id ="list_order">
<table width="100%" cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td height="40" align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th"><?php echo ($_GET['id'])? 'แก้ไข' : '' ;?>เช็คสินค้า</td>
        </tr></table></td>
    </tr>
    <tr>
        <td align="center">
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

<div id = "form">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="th2">
		<tr height="30" class="l">
			<td width="12%"  align="center" class="th r">
			<a href="?op=product&act=add&rd=8844&id=<?php echo $_GET['id']?>&img_=<?php echo $rs->picture_1_product;?>"><img src="images/other/icon_del.gif" width="14" height="16" border="0" alt=""></a>
			<a href="../thumb/<?php echo $rs->picture_1_product?>" target  = "_blank"><img src="../img_product/<?php echo $rs->picture_1_product?>" id = "pic1"   border="0" alt=""></a><br><br>

			<a href="?op=product&act=add&rd=8844&id=<?php echo $_GET['id']?>&img_2=<?php echo $rs->picture_2_product;?>"><img src="images/other/icon_del.gif" width="14" height="16" border="0" alt=""></a><br>
			<a href="../thumb/<?php echo $rs->picture_2_product?>" target  = "_blank"><img src="../img_product/<?php echo $rs->picture_2_product?>" id = "pic2"  border="0" alt=""></a>

			</td>

			<td width="88%" align="left" bgcolor="#ffccff">
				<table class="th2" cellpadding="5" border="0">

					<tr>
					  <td width = "15%" align = "right">
						&nbsp;</td>
						<td>
						<input type="hidden" id = "invoice_no" name="invoice_no" style ="width:150px;" value = "<?php echo $_POST['invoice_no']?>">&nbsp;<input type="hidden" id = "name_customer" name="name_customer" style ="width:150px;" value = "<?php echo $_POST['name_customer']?>">
				      </td>
					</tr>


					

					<tr>
					  <td width = "15%" align = "right">
						DM#:</td>
						<td>
						<input type="text" name="dm_product" id = "dm_product" style ="width:150px;" value = "<?php echo $rs->dm_product;?>" onkeyup = "timeMsg();">&nbsp;&nbsp;
						Barcode Auto---><input type="text" name="barcode_product" id = "barcode_product" style ="width:150px;" value = "<?php echo $rs->barcode_product;?>" readonly>
						<img src="images/faq_on.gif" width="16" height="16" border="0" alt="" style = "cursor:pointer;" onclick = "fnc_re();"><input type="button" value="Refresh" onclick="window.location.replace('?op=check_product&act=add');">
				      </td>
					</tr>
					
					<tr>
					  <td width = "15%" align = "right">
						Product Code:</td><td>
						<script type="text/javascript">
						function fnc_type(i){
							document.getElementById('code').value = i;
						}
						</script>
						
						<select name="id_category" id="id_category" onchange = "fnc_type(this.value);">
							<option value="0">ประเภทสินค้า</option>
							<?php if(!empty($row_category)){
							foreach($row_category as $rs_category){	
							?>
							<option value="<?php echo $rs_category->num_category;?>" <?php echo $fnc->selected($rs->id_category,$rs_category->num_category);?>><?php echo $rs_category->num_category;?></option>
							<?php }?>
							<?php }?>
						</select>
						<?php $code_p = explode('-',$rs->code_product);?>
						<input type="text" name="code_product1" style ="width:30px;" id = "code" value = "<?php echo $code_p[0]?>"> -
						<input type="text" name="code_product2" style ="width:50px;" value = "<?php echo $code_p[1]?>"> -
						<input type="text" name="code_product3" style ="width:30px;" value = "<?php echo $code_p[2]?>">-
						
						Stone group:<input type="text" name="stone_group_id" id = "stone_group_id" value = "<?php echo $rs->stone_group_id;?>" style ="width:40px;" readonly>
						<select name="id_group" id = "id_group" onchange = "fnc_group(this.value);">
						    <option value="0">Select stone group</option>
							<option value="Dia">Dia</option>
							<option value="C">C</option>
							<option value="N">N</option>
							<option value="P">P</option>
						</select>

					

						&nbsp;|&nbsp;
						Description:<input type="text" name="description" style ="width:150px;" value = "<?php echo $rs->description;?>">
				      </td>
					</tr>

					
					<tr>
					  <td width = "15%" align = "right">PO#:</td>
					  <td><input type="text" name="po_product" style ="width:150px;" value = "<?php echo $rs->po_product;?>">&nbsp;
					  |&nbsp;Date:<input name="date_product" type="text" class="box" id="date_product" style=" width:80px"  value="<?php echo $rs->date_product;?>"/><a href="javascript:displayDatePicker('date_product')"><IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a>
				      </td>
					</tr>
					

					<script type="text/javascript">
					function fnc(a){
					document.getElementById('id_type_product_').value = a;
					}
					</script>

					<tr>
					  <td width = "15%" align = "right">
						Major Metal:</td><td>
						<input type="hidden" name="id_type_product_" id = "id_type_product_">
						<select name="id_type_product"  onchange = "fnc(this.value),fnc_p();">
						<option value="0">Metal</option>
							<?php 
							foreach($row_type as $rs_type){?>
							<option value="<?php echo $rs_type->num_type_product;?>" <?php echo $fnc->selected($rs->id_type_product,$rs_type->num_type_product);?>><?php echo $rs_type->num_type_product;?></option>
							<?php }?>

						</select>
						
						&nbsp;|&nbsp;
					
					

						wt:<input type="text" name="weight_product" style ="width:60px;" value = "<?php echo $rs->weight_product;?>">
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						Size:</td><td><input type="text" name="size_product" style ="width:242px;" value = "<?php echo $rs->size_product;?>">
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						Unit Price:</td><td><input type="text" name="unit_price" style ="width:50px;" value = "<?php echo $rs->unit_price;?>">
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						Pricing:</td><td><input type="text" name="pricing_product" style ="width:50px;" value = "<?php echo $rs->pricing_product;?>">
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						Qty Bal:</td><td><input type="text" name="total_product" style ="width:50px;" value = "<?php echo $rs->total_product;?>" <?php if($rs->id_product !=""){ echo "readonly";}?>>
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						จำนวนในสต๊อก:</td>
						<td>
						
&nbsp;&nbsp;			<br>
						ออกInvoiceไป:&nbsp;<b><span style = "color:#ff0000"><?php echo $count_invoce;?></span></b>&nbsp;ชิ้น&nbsp;&nbsp;จากรหัส<br><?php 
					
			
					if(!empty($row_invoice)){
							foreach($row_invoice as $rs_invoice){
						echo $rs_invoice->invoice_no."&nbsp; Customer&nbsp;&nbsp;&nbsp;".$rs_invoice->name_customer." <a href='?op=buy&act=list&rd=70410&id=".$rs_invoice->invoice_no."&name_customer=".$rs_invoice->name_customer."' target = '_blank'>ดูข้อมูล</a><br>";}
						}	
						?>
						<hr>
						ยืมไปจำนวน:&nbsp;<b><span style = "color:#ff0000"><?php
						echo $count_rent;?></span></b>&nbsp;ชิ้น&nbsp;&nbsp;ยืมไป<br><?php 
						if(!empty($row_rent)){
						foreach($row_rent as $rs_rent){
						echo $rs_rent->name_stock."&nbsp;&nbsp; <a href='report_fare.php?id_stock=".$rs->id_stock."&name_stock=".$rs_rent->name_stock."'  target = '_blank'>ดูข้อมูล</a><br>";	
						}
						}
						?>
						<hr>

				      </td>
					</tr>


					<tr>
					  <td width = "15%" align = "right">
						Stone Sum:</td>
						<td><input type="text" name="stone_sum_1_product" style ="width:120px;" value = "<?php echo $rs->stone_sum_1_product;?>">1.
						<input type="text" name="stone_sum_2_product" style ="width:120px;" value = "<?php echo $rs->stone_sum_2_product;?>">2.
						<input type="text" name="stone_sum_3_product" style ="width:120px;" value = "<?php echo $rs->stone_sum_3_product;?>">3.
						<input type="text" name="stone_sum_4_product" style ="width:120px;" value = "<?php echo $rs->stone_sum_4_product;?>">4.
				      </td>
					</tr>

					
					<tr>
					  <td width = "15%" align = "right">
						Location:</td><td><input type="text" name="location_product" style ="width:150px;" value = "<?php echo $rs->location_product?>">
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						Total Cost:</td><td><input type="text" name="total_cost_product" style ="width:150px;" value = "<?php echo $rs->total_cost_product?>">
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						Picture1:</td><td><input type="file" name="file" style ="width:150px;">
				      </td>
					</tr>
					<tr>
					  <td width = "15%" align = "right">
						Picture2:</td><td><input type="file" name="file2" style ="width:150px;">
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						Stock:</td><td>
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
						Remark:</td><td>
						<textarea name="remark_product" style = "width:350px;height:100px;" ><?php echo $rs->remark_product;?></textarea>
				      </td>
					</tr>

					<!-- <tr>
					  <td>&nbsp;</td><td>
					  <input name="save" type="hidden" id="save" value="news_add" />
					  <INPUT TYPE="hidden" NAME="id" id = "id_product" value = "<?php echo $rs->id_product;?>">
					  <input name="image" type="image" src="images/b_save.gif" />
				        <a href="main.php?op=<?php echo $_GET['op']?>&act=list"><img src="images/b_cancel.gif" border="0"/></a></td>

				  </tr> -->
				</table>
			</td>
		</tr>
</table>
</div>
<input type="hidden" id="id_type_product_">
<!-- <input type="button" value="เพิ่มข้อมูล" onclick="fnc_p();"> -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->

        </td>
    </tr>
  
</table>



<table width="100%" cellspacing="0" cellpadding="1" border="0" >

	<FORM name="myForm" METHOD="POST" ACTION="">
    <tr>
        <td>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  
      <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;</td>
    </tr>
   </table>