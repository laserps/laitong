<?php 
include '../module/class.database.php';
$sys = new Database();
$rs_sub_category	  = $sys->record("tb_sub_category",' id_sub_category = "'.$_POST['id_sub_category'].'" ');

function part_tb($type){
	if($type==1){
		return "one";
	}
	else if($type==2){
		return "two";
	}
	else if($type==3){
		return "three";
	}
	else if($type==4){
		return "four";
	}
	else if($type==5){
		return "five";
	}
}

$row_diamond_sub_category = $sys->result("tb_diamond_sub_category_".part_tb($_POST['type']).",tb_diamond",' tb_diamond_sub_category_'.part_tb($_POST['type']).'.id_sub_category = "'.$_POST['id_sub_category'].'" and tb_diamond_sub_category_'.part_tb($_POST['type']).'.id_diamond = tb_diamond.id_diamond   ');

$row_munk_back_sub_category = $sys->result("tb_munk_back_sub_category_".part_tb($_POST['type']).",tb_backmunk",' tb_munk_back_sub_category_'.part_tb($_POST['type']).'.id_sub_category = "'.$_POST['id_sub_category'].'" and tb_munk_back_sub_category_'.part_tb($_POST['type']).'.id_back_munk = tb_backmunk.id_backmunk   ');

$row_type_product_sub_category = $sys->result("tb_type_product_sub_category_".part_tb($_POST['type']).",tb_type_product",' tb_type_product_sub_category_'.part_tb($_POST['type']).'.id_sub_category = "'.$_POST['id_sub_category'].'" and tb_type_product_sub_category_'.part_tb($_POST['type']).'.id_type_product = tb_type_product.id_type_product   ');

/*$row_medicine_sub_category = $sys->result("tb_medicine_sub_category_".part_tb($_POST['type']).",tb_medicine",' tb_medicine_sub_category_'.part_tb($_POST['type']).'.id_sub_category = "'.$_POST['id_sub_category'].'" and tb_medicine_sub_category_'.part_tb($_POST['type']).'.id_medicine = tb_medicine.id_medicine   ');*/

$row_medicine_sub_category = $sys->result("tb_medicine",null);



$row_special_sub_category = $sys->result("tb_special_sub_category_".part_tb($_POST['type']).",tb_special",' tb_special_sub_category_'.part_tb($_POST['type']).'.id_sub_category = "'.$_POST['id_sub_category'].'" and tb_special_sub_category_'.part_tb($_POST['type']).'.id_special = tb_special.id_special   ');

?>

<table width = "100%">
					<tr>
					  <td width = "15%" align = "right">
						<b>ขนาด:</b></td><td>
						<select name="size" id = "size">
							<?php if($rs_sub_category->size_sub_category == "S"){?><option value="S">S</option><?php }?>
							<?php if($rs_sub_category->size_sub_category == "M"){?><option value="M">M</option><?php }?>
							<?php if($rs_sub_category->size_sub_category == "L"){?><option value="L">L</option><?php }?>
							<?php if($rs_sub_category->size_sub_category == "XL"){?><option value="XL">XL</option><?php }?>
						</select>
				      </td>
					</tr>

					<?php 
					if(!empty($row_diamond_sub_category)){
						foreach($row_diamond_sub_category as $count_diamong){$d++;
						 $d;

					}
					}
					
					?>
					
					<?php if($d !=""){?>
					<tr>
					  <td width = "15%" align = "right">***
						<b>ฝังเพชร:</b></td><td>
						<select name="id_diamond" id = "id_diamond" style = "width:150px;" onchange = "check_si_diamond(this.value),check_dia(this.value);">
						<option value="0">เลือก</option>
							 <?php 
							if(!empty($row_diamond_sub_category)){
								foreach($row_diamond_sub_category as $rs_diamond){?>
									<option value="<?php echo $rs_diamond->id_diamond;?>"><?php echo $rs_diamond->name_diamond;?></option>
								<?php }?>
							<?php }?>
						</select>&nbsp;&nbsp;
				      </td>
					</tr>
					<?php }else{ echo '<input type="hidden" id="id_diamond" value = "13">';}?>


					<tr style = 'visibility:hidden;' id = "total_dia">
					  <td width = "15%" align = "right">
						&nbsp;</td><td>

						<table>
						<tr>
							<td>&nbsp;</td>
							<td><?php $i_ = range(1,99);?>
						<select name="total_diamond" id ="total_diamond" style = "width:100px;" onchange = "fnc_wage_fung(),cal_diamond_price();">
						    <option value="0">จำนวนเพชร</option>
							<?php foreach($i_ as $i_){?>
							<option value="<?php echo $i_;?>"><?php echo $i_;?></option>
							<?php }?>
						</select>
						&nbsp;X&nbsp;<input type="text" name="wage_fung" id = "wage_fung"  style = "width:50px;" value = "ค่าแรงฝัง" onclick = "document.getElementById('wage_fung').value = '';" onblur = "fnc_wage_fung();">&nbsp;
						= <span style = "color:#ff0000;" id = "diamond_line">&nbsp;</span>
						<input type="hidden" id="total_wage_first_line"></td>
						</tr>

						<tr>
							<td>เพชรเม็ดละ.</td>
							<td><input type="text" name = "karat" id="karat" value = "กี่กะรัต" style = "width:94px;" onclick = "document.getElementById('karat').value = ''" onblur = "cal_diamond_price();">&nbsp;กะรัต</td>
						</tr>

						<tr>
							<td>กะลัดละ.</td>
							<td><input type="text" name = "per_karat" id="per_karat" value = "กะรัตละ" style = "width:94px;" onclick = "document.getElementById('per_karat').value = '';" onblur = "cal_diamond_price();">&nbsp;บาท</td>
						</tr>
						</table>

						
					

				      </td>
					</tr>

					

					<?php 
						$c_m = trim(count($row_munk_back_sub_category));
							if(!empty($row_munk_back_sub_category)){
								foreach($row_munk_back_sub_category as $c_back){ $bm++;

								}

							}
						?>
					<?php if($bm !=""){?>
					<tr>
					  <td width = "15%" align = "right">
						***<b>แผ่น:</b></td><td>
						<select name="id_back_munk" id = "id_backmunk" style = "width:150px;" onchange = "check_si_backmunk(this.value);">
						<option value="0">เลือก</option>
						    <?php 
							if(!empty($row_munk_back_sub_category)){
								foreach($row_munk_back_sub_category as $rs_back_munk){?>
									<option value="<?php echo $rs_back_munk->id_backmunk;?>"><?php echo $rs_back_munk->name_backmunk?></option>
								<?php }?>
							<?php }?>
						</select>
				      </td>
					</tr>
					<?php }else{ echo '<input type="hidden" id="id_backmunk" value = "0">'; }?>

					
					<tr>
					  <td width = "15%" align = "right">
						***<b>รูปแบบ:</b></td><td>
						<select name="id_type_product" id = "id_type_product" style = "width:150px;" onchange = "check_si_type_product(this.value);">
						<option value="0">เลือก</option>
							<?php
							if(!empty($row_type_product_sub_category)){
								foreach($row_type_product_sub_category as $rs_type_product){?>
									<option value="<?php echo $rs_type_product->id_type_product;?>"><?php echo $rs_type_product->name_type_product;?></option>
								<?php }?>
							<?php }?>
						</select>
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						<b>ลงยา:</b></td><td>
						<select name="id_medicine" id = "id_medicine" style = "width:150px;" onchange = "check_si_medicine(this.value);">
						<option value="0">เลือก</option>
							<?php
							if(!empty($row_medicine_sub_category)){
								foreach($row_medicine_sub_category as $rs_medicine){?>
									<option value="<?php echo $rs_medicine->id_medicine;?>"><?php echo $rs_medicine->name_medicine;?></option>
								<?php }?>
							<?php }?>
						</select>
				      </td>
					</tr>
						<?php $c_s = trim(count($row_special_sub_category));
								
								?>
					<tr <?php if($c_s== "1" ){ echo "style = 'visibility:hidden;'";} ?>>
					  <td width = "15%" align = "right">
						<b>ลักษณะพิเศษ:</b></td><td>
						<table>
						<tr>
							<?php
							$i=0;
						
							if(!empty($row_special_sub_category)){
								foreach($row_special_sub_category as $rs_special){ $i++; $j++;
							?>
							<td><input type="checkbox" name="id_special[<?php echo $i;?>]" id = "id_special<?php echo $i;?>" value = "<?php echo $rs_special->id_special;?>" onclick = "check_si_special();">:<?php echo $rs_special->name_special;?></td>
							<?php 
									if($j==3){
										echo "</tr><tr>";
										$j=0;
									}
								}
							}
							?>
							<input type="hidden" id="total_chk" value = "<?php echo $i;?>">
						</tr>
					
						</table>
						
						
						
				      </td>
					</tr>
					</table>