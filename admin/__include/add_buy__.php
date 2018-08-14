<?php  
/*
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
*/

if($_GET['id']!=""){
$row = $sys->db->result("tb_invoice,tb_product,tb_stock,tb_type_product"," tb_invoice.id_product = tb_product.id_product and   tb_stock.id_stock = tb_product.id_stock and tb_product.id_type_product = tb_type_product.num_type_product  and tb_invoice.invoice_no = '".$_GET['id']."'  "," tb_invoice.id_invoice asc");
}


?>
<SCRIPT LANGUAGE="JavaScript">
	var t ="";
	var objRequest = createRequestObject () ;


	document.onkeydown = checkKeycode
	function checkKeycode(e) {
		var keycode;
		 keycode = window.event.keyCode; // ใช้ IE

		 if(keycode == 13){
			fnc_p();
		 }
		 
		 if((keycode=="32")&&(qty_invoice!="")){
			fnc_post_save();
		 }
	
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
				var surname_customer = document.getElementById('surname_customer').value;
				var dm_product = document.getElementById('dm_product').value;
				var postBody =   'dm_product=' + dm_product +'&invoice_no='+ invoice_no +'&name_customer='+ name_customer+'&surname_customer='+surname_customer;
				objRequest.open('POST', 'invoice_add.php?'+ Math.random(), true);
				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_r;
				objRequest.send(postBody);
				}

				function fnc_post_save()
					{
				var invoice_no = document.getElementById('invoice_no').value;
				var name_customer = document.getElementById('name_customer').value;
				var surname_customer = document.getElementById('surname_customer').value;
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
					window.location.replace("main.php?op=buy&act=list&rd=45398&id="+invoice_no+"&name_customer="+name_customer+"&surname_customer="+surname_customer);
				}
				else if(qty_invoice<1){
					alert("ข้อมูลไม่ถูกต้องกรุณากรอกใหม่");
					document.getElementById('qty_invoice').focus();
					window.location.replace("main.php?op=buy&act=list&rd=45398&id="+invoice_no+"&name_customer="+name_customer+"&surname_customer="+surname_customer);
				}
				else{
				
				var postBody =   'dm_product=' + dm_product +'&invoice_no='+ invoice_no +'&name_customer='+ name_customer +'&qty_invoice='+qty_invoice+'&id_product='+id_product+'&surname_customer='+surname_customer;
				objRequest.open('POST', 'invoice_post.php?'+ Math.random(), true);
				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_save_r;
				objRequest.send(postBody);
				}
				}

				function fnc_r() {
					if (objRequest.readyState == 4 && objRequest.status ==200) {
						var data	=	objRequest.responseText;document.getElementById('form').innerHTML = data;
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
					document.getElementById('qty_invoice').focus();
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
          <td bgcolor="#BBD8EC" align="center" height="40" class="th"><?php echo ($_GET['id'])? 'แก้ไข' : '' ;?>Invoice</td>
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
			<a href="../thumb/<?php echo $rs->picture_1_product?>" target  = "_blank"><img src="../img_product/<?php echo $rs->picture_1_product?>" id = "pic1"   border="0" alt=""></a>
			<a href="../thumb/<?php echo $rs->picture_2_product?>" target  = "_blank"><img src="../img_product/<?php echo $rs->picture_2_product?>" id = "pic2"  border="0" alt=""></a>

			</td>

			<td width="88%" align="left" bgcolor="#ffffcc">
				<table class="th2" cellpadding="5" border="0" height = "50">

					<tr>
					  <td width = "15%" align = "right">
						Inv.No.:</td>
						<td>
						<input type="text" id = "invoice_no" name="invoice_no" style ="width:150px;" value = "<?php echo $_GET['id'];?>">&nbsp;ชื่อลูกค้า:<input type="text" id = "name_customer" name="name_customer" style ="width:150px;" value = "<?php echo $_GET['name_customer']?>">&nbsp;นามสกุล ลูกค้า:<input type="text" id = "surname_customer" name="surname_customer" style ="width:150px;" value = "<?php echo $_GET['surname_customer']?>">
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						Barcode#:</td><td><input  type="text" name="dm_product" id = "dm_product" style ="width:150px;" >
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						Dm#:</td><td><input  type="text" name="dm_product_t" id = "dm_product_t" style ="width:150px;" >&nbsp;&nbsp;
				      </td>
					</tr>
					
					<tr>
					  <td width = "15%" align = "right">
						Product Code:</td><td><input type="text" name="" style ="width:150px;">&nbsp;|&nbsp;
						Description:<input type="text" name="" style ="width:150px;">
				      </td>
					</tr>


					<tr>
					  <td width = "15%" align = "right">PO#:</td>
					  <td><input type="text" name="" style ="width:150px;">&nbsp;
					  |&nbsp;Date:<input name="date_stock" type="text" class="box" id="name_position" style=" width:80px"  value="<?php echo $rs->date_stock;?>"/><a href="javascript:displayDatePicker('date_stock')">
				      </td>
					</tr>

					

					<tr>
					  <td width = "15%" align = "right">
						Major Metal:</td><td>
						<script type="text/javascript">
						function fnc(i){
							if(i==1){
								document.getElementById('c1').style.display = "none";
								document.getElementById('c2').style.display = "";
							}else{
								document.getElementById('c1').style.display = "";
								document.getElementById('c2').style.display = "none";
							}
						}
						</script>
						<select name="" onchange = "fnc(this.value);">
							

						</select>
						
						&nbsp;|&nbsp;
						<select name="" style = "width:50px;" id = "c1">
							
						</select>

						<select name="" style = "width:50px;display:none;" id = "c2">
							
						</select>

						wt:<input type="text" name="" style ="width:60px;">
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						Size:</td><td><input type="text" name="" style ="width:242px;">
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						QTY:</td><td><input type="text"  id = "qty_invoice" style ="width:50px;">
				      </td>
					</tr>


					<tr>
					  <td width = "15%" align = "right">
						Stone Sum:</td>
						<td><input type="text" name="" style ="width:150px;">1.
						<input type="text" name="" style ="width:150px;">2.
						<input type="text" name="" style ="width:150px;">3.
				      </td>
					</tr>

					
					<tr>
					  <td width = "15%" align = "right">
						Location:</td><td><input type="text" name="" style ="width:150px;">
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						Total Cost:</td><td><input type="text" name="" style ="width:150px;">
				      </td>
					</tr>


					<tr>
					  <td width = "15%" align = "right">
						Stock:</td><td><select name="" style = "width:150px;">
						</select>

						
				      </td>
					</tr>
					

					


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
	  
      <td align="center" bgcolor="#BBD8EC" class="th">ลำดับ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Prod.Code</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Description</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Metal</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">PO#</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">DM#</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Inven Date</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Unit Price($)</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Total Cost($)</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Qty Bal</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ลบ</td>
    </tr>
    <?php
	$j=1;
if(!$row):
?>
    <tr height="30" bgcolor="#eeeeee">
      <td align="center" colspan="5" class="th2">No Data</td>
    </tr>
    <?php
else:
foreach($row as $rs):

$bgc=($i++ % 2) ? '#FFFFFF' : '#E0F0F0';
?>
    <tr height="25" bgcolor="<?php echo $bgc?>" align="center" class="tb">
      <td align="center"><?php echo $j++;?></td>
	  
	  <td align="center"><?php echo $rs->code_product;?></td>
	  <td align="center"><?php echo $rs->description; ?></td>
	  
	  <td align="center"><?php echo $rs->num_type_product; ?></td>

	  <td align="center"><?php echo $rs->po_product;?></td>
	  <td align="center"><?php echo $rs->dm_product;?></td>
	  <td align="center"><?php echo $rs->date_product;?></td>
	  <td align="center"><?php echo $rs->unit_price;?></td>
	  <td align="center"><?php echo $rs->total_cost_product;?></td>
	  <td align="center"><?php echo $rs->qty_invoice;?></td>

	  <td align="center" bgcolor="<?php echo $bgc?>">
	  &nbsp; <a href="main.php?op=<?php echo $_GET[op];?>&act=list&amp;rd=<?php echo rand(1,99999); ?>&amp;del=<?php echo $rs->id_section?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf('<?php echo $rs->name_section;?>')" /></a> </td>

    </tr>
<?php 
endforeach;
endif;?>


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
</div>