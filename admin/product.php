<?php 
include '../module/class.database.php';
$sys = new Database();
$rs = $sys->record("tb_product,tb_type_product"," tb_product.id_type_product = tb_type_product.num_type_product and tb_product.barcode_product='".trim($_POST['dm_product'])."'");

$row_stock	  = $sys->result("tb_stock",'level_stock = "2"', 'name_stock asc');
?>
<table class="th2" cellpadding="5" border="0">
					<tr id = "price">
					  <td align="right" class="r">#Barcode: </td>
					  <td><input name="dm_product" type="text" class="box" id="dm_product" style="border:dotted; border-color:#0000FF; width:150px"  value="<?=$rs->dm_product;?>" />
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">Product Code: </td>
					  <td><input name="name_product" type="text" class="box" id="name_product" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->code_product;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">Major Metal: </td>
					  <td><input name="name_type_product" type="text" class="box" id="name_type_product" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->num_type_product;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">ยืมไปสต๊อก: </td>
					  <td><select name="id_stock_rent" id  = "id_stock_rent" style = "width:200px;" onchange = "fnc_id(this.value);">
							<?php if(!empty($row_stock)){
							foreach($row_stock as $rs_stock){	
							?>
							<option value="<?php echo  $rs_stock->id_stock?>" <?php if($_POST['id_stock_rent'] == $rs_stock->id_stock){ echo "selected";}?>><?php echo $rs_stock->name_stock;?></option>
							<?php }}?>
						</select>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">จำนวนในสต๊อก: </td>
					  <td><input name="total_product" type="text" class="box" id="total_product" style="border:dotted; border-color:#0000FF; width:80px"  value="<?=$rs->total_product;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">จำนวนยืม: </td>
					  <td><input name="total_rent" type="text" class="box" id="total_rent" style="border:dotted; border-color:#0000FF; width:80px"  value="1"/>
				      </td>
					</tr>
		
					<tr>
						<input type="hidden" name="id_product" id = "id_product" value = "<?php echo $rs->id_product;?>">
					  <td align="right" class="r">&nbsp;</td>
					  <td>&nbsp;</td>
				  </tr>
				</table>