<?php 
include '../module/class.database.php';
$sys = new Database();

$rs = $sys->record("tb_product,tb_type_product","  tb_product.id_type_product = tb_type_product.num_type_product and barcode_product ='".$_REQUEST['dm_product']."' ");

$row_stock	  = $sys->result("tb_stock",'level_stock = "2"', 'name_stock asc');

$row_rent  = $sys->result("tb_rent_temp,tb_stock",' tb_rent_temp.id_stock_rent = tb_stock.id_stock and   id_product = "'.$rs->id_product.'" and tb_rent_temp.status_rent = "0" group by tb_rent_temp.id_stock_rent ', 'name_stock asc');

if(!empty($row_rent)){
foreach($row_rent as $r){
	$j++;
}
}

if($j !=""){
?>
 
<input type="hidden" id="id_rent" value = "<?=$_POST['id_rent'];?>">
<table class="th2" cellpadding="5" border="0">
					<tr id = "price">
					  <td align="right" class="r">Barcode#<?php echo $j;?>: </td>
					  <td><input name="dm_product" type="text" class="box" id="dm_product" style="border:dotted; border-color:#0000FF; width:150px"  value="<?=$rs->dm_product;?>" /><!-- <img src="images/b_search.png" width="16" height="16" border="0" alt=""> -->
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						Dm#:</td><td><input  type="text" name="dm_product_t" id = "dm_product_t" style ="border:dotted; border-color:#0000FF; width:150px;" value = "<?php echo $rs->dm_product?>">&nbsp;&nbsp;
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">Product Code: </td>
					  <td><input name="code_product" type="text" class="box" id="code_product" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->code_product;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">Major Metal: </td>
					  <td><input name="name_type_product" type="text" class="box" id="name_type_product" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->num_type_product;?>"/>
				      </td>
					</tr>
			
			<?php if(!empty($row_rent)){?>
					<tr>
					  <td align="right" class="r">ยืมไป: </td>
					  <td>
					  <?php 
						
						foreach($row_rent as $rs_rent){
		
				$total_rent = $sys->sum("tb_rent_temp", " id_product = '".$rs->id_product."' and status_rent = '0' and id_stock_rent = '".$rs_rent->id_stock_rent."' ", " id_rent_temp asc ","total_rent");

				

							echo $rs_rent->name_stock."  จำนวน  ".$total_rent."<br>
							";
							echo '<input type="hidden" id="test'.$rs_rent->id_stock_rent.'" value = "'.$total_rent.'">';
						}
						?>
						
				      </td>
					</tr>
						  <?}?>
					
					<?php if(!empty($row_rent)){?>
					<tr>
					  <td align="right" class="r">คืนจาก: </td>
					  <td><select name="id_stock" id = "id_stock">
						<?php foreach($row_rent as $rs_rent){
						
						?>
						<option value="<?php echo $rs_rent->id_stock_rent;?>"><?php echo $rs_rent->name_stock;?></option>
						<?php }?>
					  </select>
				      </td>
					</tr>
					<?}?>

				

					<tr>
					  <td align="right" class="r">จำนวนคืน: </td>
					  <td><input name="total_return" type="text" class="box" id="total_return" style="border:dotted; border-color:#0000FF; width:200px"  value="1"/>
				      </td>
					</tr>

					

		
					<tr>
					  <td align="right" class="r"><input type="hidden" name="id_member" id="id_member" value = "<?php echo $rs->id_member?>"></td>
					  <td>&nbsp;</td>
				  </tr>
				  <input type="hidden" name="id_product" id = "id_product" value = "<?php echo $rs->id_product;?>">
				  <input type="hidden" name="id_rent" id = "id_rent" value = "<?php echo $rs->id_rent;?>">
				</table>
				<?php }else{echo "1";}?>