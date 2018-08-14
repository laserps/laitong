<?php 
require "../module/database.php";
include "../system/product.php";
$sys  = new product($db,$fnc);


function ean13_check_digit($digits){
		$digits =(string)$digits;
		$even_sum = $digits{1} + $digits{3} + $digits{5} + $digits{7} + $digits{9} + $digits{11};
		$even_sum_three = $even_sum * 3;
		$odd_sum = $digits{0} + $digits{2} + $digits{4} + $digits{6} + $digits{8} + $digits{10};
		$total_sum = $even_sum_three + $odd_sum;
		$next_ten = (ceil($total_sum/10))*10;
		$check_digit = $next_ten - $total_sum;
		return  $check_digit;
    }



	$num_1  = substr($_POST['dm_product'], -13,12);
	$num_2  = substr($num_1, -11);
	$digits = '1'.$num_2;
	$digit = ean13_check_digit($digits);
	$barcode = "1".$num_2.$digit;


$rs = $db->record('tb_product',' barcode_product = "'.$_POST['dm_product'].'" ');

$row_category = $db->result("tb_category",NULL, 'name_category asc');
$row_type	  = $db->result("tb_type_product",NULL, 'name_type_product asc');
$row_color	  = $db->result("tb_color",NULL, 'name_color asc');
$row_stock	  = $db->result("tb_stock",NULL, 'name_stock asc');

$count_invoce = $db->sum("tb_invoice", " id_product = '".$rs->id_product."' ", $order = NULL,"qty_invoice");
$row_invoice	  = $db->result("tb_invoice"," id_product = '".$rs->id_product."' ", 'id_invoice asc');

$count_rent = $db->sum("tb_rent_temp", " id_product = '".$rs->id_product."' ", $order = NULL,"total_rent");

$row_rent	  = $db->result("tb_rent_temp,tb_stock"," tb_rent_temp.id_stock_rent = tb_stock.id_stock and  id_product = '".$rs->id_product."'  group by tb_rent_temp.id_stock_rent ", 'id_rent_temp asc');




?>
<FORM METHOD=POST onsubmit="return chkvalue(this)" enctype="multipart/form-data" ACTION="">
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
						echo $rs_invoice->invoice_no."&nbsp; Customer&nbsp;&nbsp;&nbsp;".$rs_invoice->name_customer." <a href='?op=buy&act=list&rd=70410&id=".$rs_invoice->invoice_no."&name_customer=".(urlencode($rs_invoice->name_customer))."' target = '_blank'>ดูข้อมูล</a><br>";}
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
</form>