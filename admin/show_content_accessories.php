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
}



$row_type_product_sub_category = $sys->result("tb_type_product",' num_type_product = "2" '," name_type_product asc ");


?>

<table width = "100%">
					<tr>
					  <td width = "15%" align = "right">
						<b>ขนาด:</b></td><td>
						<select name="size" id = "size">
						    <option value="">อุปกรณ์กรุณาเลือกขนาด</option>
							<option value="S">S</option>
							<option value="M">M</option>
							<option value="L">L</option>
							<option value="XL">XL</option>
						</select>
				      </td>
					</tr>


					

					
					<tr>
					  <td width = "15%" align = "right">
						<b>รูปแบบ:</b></td><td>
						<select name="id_type_product" id = "id_type_product" style = "width:250px;" onchange = "check_si_type_product(this.value);">
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

			

		
						</table>
						
						
						
				      </td>
					</tr>
					</table>