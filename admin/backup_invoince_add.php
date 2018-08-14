<?php 
include '../module/class.database.php';
include '../module/class.func.php';
$sys = new Database();
$fnc = new func();

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


$rs = $sys->record('tb_product,tb_stock',' tb_stock.id_stock = tb_product.id_stock and   tb_product.barcode_product = "'.$_POST['dm_product'].'" ');

$row_category = $sys->result("tb_category",NULL, 'name_category asc');
$row_subcategory = $sys->result("tb_sub_category",null," id_sub_category asc ");
$row_type	  = $sys->result("tb_type_product",NULL, 'name_type_product asc');
$row_branch   = $sys->result("tb_branch"," id_branch >1 ",' id_branch asc ');
$row_diamond_sub_category  = $sys->result("tb_diamond",NULL,' id_diamond asc ');


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

function check_tb($type){
	if($type == "1"){
		return "one";
	}
	else if($type == "2"){
		return "two";
	}

	else if($type == "3"){
		return "three";
	}

	else if($type == "4"){
		return "three";
	}

}

function check_tb_accesories($type){
	if($type == "S"){
		return "one";
	}
	else if($type == "M"){
		return "two";
	}

	else if($type == "L"){
		return "three";
	}

	else if($type == "XL"){
		return "three";
	}

}

function check_soom($soom){
	if($soom == 2){
		return "_";
	}
}

function check_soom3($soom){
	if($soom == 3){
		return "__";
	}
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

if($rs->type =="1"){
$rs_wage_first = $sys->record("tb_wage_first_".check_tb($rs->type)."", " id_type = '".$rs->id_type_product."' and branch_type = '".$_POST['status_branch']."' ","  wage_first_".check_tb_accesories($rs->size)."".check_soom($rs->soom)." as wage ");
}


if($rs->type =="2"){
$rs_wage_first = $sys->record("tb_wage_first_".check_tb($rs->type)."", " id_type = '".$rs->id_type_product."' and branch_type = '".$_POST['status_branch']."' ","  wage_first_".check_tb_accesories($rs->size)."".check_soom($rs->soom).check_soom3($rs->soom)." as wage ");
}


if($rs->type =="3"){

$rs_wage_first = $sys->record("tb_wage_first_".check_tb($rs->type)."", " id_type = '".$rs->id_type_product."' and branch_type = '".$_POST['status_branch']."' ","  wage_first_".check_tb_accesories($rs->size)."".check_soom($rs->soom)." as wage ");
}



if($rs->type =="4"){

////////อุปกรณ์//////////////////////////////////////////////////////////////
$rs_wage_first = $sys->record("tb_wage_first_four", " id_type = '".$rs->id_type_product."' and branch_type = '".$_POST['status_branch']."' ","  wage_first_".check_tb_accesories($rs->size)."".check_soom($rs->soom)." as wage ");
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

 require "gold.php";

function check_match($id_ch,$id_ch2,$avai){
	if($id_ch==$id_ch2){
		return $avai;
	}
}

function check_kud($id_type_product=null,$id_diamond=null,$id_medicine=null){
	if( ($id_type_product != "6") && ($id_diamond=="13") && ($id_medicine == "2" )  ){
		return "_nokud";//_nokud คือ แกะลาย
	}
	else if( ($id_type_product != "6") && ($id_diamond=="13") && ($id_medicine != "2" )  ){
		return "_medicine";//_nokud คือ แกะลาย
	}
	else if( ($id_diamond=="") or ($id_diamond=="1") ){
		return "_nokud";
	}
}

function  check_diamong($dia=null){
	if( ($dia == "") or ($dia == "1") ){
		return "13";
	}else{
		return $dia;
	}
}


if($rs->type !=4){
 
	$rs_percent = $sys->record("tb_diamond_branch"," id_branch = '".$_POST['id_branch']."' and id_diamond = '".check_diamong($rs->id_diamond)."' "," percent_diamond".check_kud($rs->id_type_product,$rs->id_diamond,$rs->id_medicine)."_".part_tb($rs->type)." as percent_  ");
}

if($rs->type ==4){

$rs_percent = $sys->record("tb_setting_accessories"," id_branch = '".$_POST['id_branch']."' and id_type_product = '".$rs->id_type_product."' "," percent_  ");

}


?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="th2">
		<tr height="30" class="l">
			<td width="12%"  align="center" class="th r">
			<a href="../thumb/<?php echo $rs->picture_1_product?>" target  = "_blank"><img src="../img_product/<?php echo $rs->picture_1_product?>" id = "pic1"   border="0" alt=""></a>
			<a href="../thumb/<?php echo $rs->picture_2_product?>" target  = "_blank"><img src="../img_product/<?php echo $rs->picture_2_product?>" id = "pic2"  border="0" alt=""></a>

			</td>

			<td width="88%" align="left" bgcolor="#ccffcc">
				<table class="th2" cellpadding="5" border="0">

				

					<tr>
					  <td width = "15%" align = "right">
						Barcode#:</td><td><input  type="text" name="dm_product" id = "dm_product" style ="width:150px;" value = "<?php echo $rs->barcode_product;?>">
				      </td>
					</tr>
					
					<tr>
					  <td width = "15%" align = "right">
						<b>รหัสสินค้า:</b></td>
						<td style = "color:#ff0000;"><?php echo $rs->code_product;?></td>
					</tr>

					<tr>
					  <td width = "15%" align = "right"><b>ประเภท:</b></td>
					  
					  <td>
					 
						         <input type="radio" name="type" id = "type" value = "1" onclick = "fnc_proid_1(1);" <?php echo $fnc->checked("1",$rs->type);?>>:กรอบ 90
						&nbsp;&nbsp;<input type="radio" name="type" id = "type" value = "2" onclick = "fnc_proid_1(2);" <?php echo $fnc->checked("2",$rs->type);?>>:ตลับ
						&nbsp;&nbsp;<input type="radio" name="type" id = "type" value = "3" onclick = "fnc_proid_1(3);" <?php echo $fnc->checked("3",$rs->type);?>>:กรอบ 70
						&nbsp;&nbsp;<input type="radio" name="type" id = "type" value = "4" onclick = "fnc_proid_1(4);" <?php echo $fnc->checked("4",$rs->type);?>>:อุปกรณ์<br>
						
						<?php
								function check_soom__($type,$soom){
									if( ($type==1)&& ($soom==1) ){
										return "ไม่ซุ้ม";
									}
									
									else if( ($type==1)&& ($soom==2) ){
										return "ยกซุ้ม";
									}
									else if( ($type==2)&& ($soom==1) ){
										return "เปิดหลัง";
									}
									else if( ($type==2)&& ($soom==2) ){
										return "ปิดหลังแกะลาย";
									}
									else if( ($type==2)&& ($soom==3) ){
										return "ปิดหลังแกะภาพ";
									}

									else if( ($type==3)&& ($soom==1) ){
										return "ไม่ซุ้ม";
									}
									else if( ($type==3)&& ($soom==2) ){
										return "ยกซุ้ม";
									}
								}
						
						?>

						<span style = "color: #ff0000"><?php echo check_soom__($rs->type,$rs->soom);?></span>

					 
				      </td>
					</tr>

					<?php if($rs->type != 4){?>
					<tr>
					  <td width = "15%" align = "right"><b>แบบพิมพ์:</b></td><td>
					
						<select name="id_category" id="id_category" onchange = "fnc_type(this.value);" style = "width:150px;color:#ff0000;" disabled>
							<option value="0">แบบพิมพ์</option>
							<?php if(!empty($row_category)){
							foreach($row_category as $rs_category){	
							   echo	check_match($rs->id_category,$rs_category->id_category,$rs_category->num_category);
							?>
							<option value="<?php echo $rs_category->id_category;?>@<?php echo $rs_category->num_category;?>" <?php echo $fnc->selected($rs->id_category,$rs_category->id_category);?>><?php echo $rs_category->num_category."  ".$rs_category->name_category;?></option>
							<?php }?>
							<?php }?>
						
						
				      </td>
					</tr>
					<?php }?>

					<?php if($rs->type != 4){?>
					<tr>
						<td width = "5%" align = "right">&nbsp;</td>
						<td id = "content">
					<select name="id_sub_category" id = "id_sub_category" onchange = "fnc_group(this.value);"  style = "width:150px;height:20px;" disabled>
						    <option value="0">เลือกเบอร์</option>
							<?php if(!empty($row_subcategory)){
								foreach($row_subcategory as $rs_subcategory){
								?>
							<option style="background-image:url(../thumb/example1_select.png);height:50px; background-repeat:no-repeat; padding-left: 50px;padding-top:18px;" value = "<?php echo $rs_subcategory->id_sub_category;?>" <?php echo $fnc->selected($rs->id_sub_category,$rs_subcategory->id_sub_category);?>>
							<?php echo $rs_subcategory->no_sub_category."  ".$rs_subcategory->name_sub_category;?></option>
								<?php 
									}
								  }
								?>				
							
							</select>
					</td>
					</tr>
					<?php }?>


					<tr>
					  <td width = "15%" align = "right">
						<b>ขนาด:</b></td><td>
						<?php echo $rs->size;?>
				      </td>
					</tr>
					
		<?php if($rs->type != 4){?>
					<tr>
					  <td width = "15%" align = "right">
						<b>ฝังเพชร:</b></td><td>
						<select name="id_diamond" id = "id_diamond" style = "width:150px;" onchange = "check_si_diamond(this.value);" disabled>
						<option value="0">เลือก</option>
							 <?php 
							if(!empty($row_diamond_sub_category)){
								foreach($row_diamond_sub_category as $rs_diamond){?>
									<option value="<?php echo $rs_diamond->id_diamond;?>" <?php echo $fnc->selected($rs_diamond->id_diamond,$rs->id_diamond);?>><?php echo $rs_diamond->name_diamond;?></option>
								<?php }?>
							<?php }?>>
						</select>&nbsp;&nbsp;
				      </td>
					</tr>

					<?php if($rs->id_diamond > 13){?>
					<tr>
					  <td width = "15%" align = "right">
						&nbsp;</td><td>
						<?php $i_ = range(1,99);?>
						<select name="total_diamond" id ="total_diamond" style = "width:100px;">
						    <option value="0">จำนวนเพชร</option>
							<?php foreach($i_ as $i_){?>
							<option value="<?php echo $i_;?>" <?php echo $fnc->selected($i_,$rs->total_diamond);?>><?php echo $i_;?></option>
							<?php }?>
						</select>

						&nbsp;X&nbsp;<input type="text" name="wage_fung" id = "wage_fung"  style = "width:50px;" value = "15" onclick = "document.getElementById('wage_fung').value = '';" onblur = "fnc_wage_fung();">&nbsp;
						= <span style = "color:#ff0000;" id = "diamond_line"><?php echo $rs->total_diamond*15;?></span>
						<input type="hidden" id="total_wage_first_line" value = "<?php echo $rs->total_diamond*15;?>"><br>

						<input type="text" name = "karat" id="karat" value = "<?php echo $rs->karat;?>" style = "width:94px;">&nbsp;กะรัต<br>

						<input type="text" name = "per_karat" id="per_karat" value = "<?php echo $rs->per_karat;?>" style = "width:94px;" onclick = "document.getElementById('per_karat').value = '';" >&nbsp;บาท<br>

				      </td>
					</tr>
					<?php }?>

					<?php 
					$row_munk_back_sub_category = $sys->result("tb_backmunk",null,' id_backmunk asc ');
					
					?>
					<tr>
					  <td width = "15%" align = "right">
						<b>แผ่น:</b></td><td>
						<select name="id_back_munk" id = "id_backmunk" style = "width:150px;" onchange = "check_si_backmunk(this.value);" disabled>
						<option value="0">เลือก</option>
						    <?php 
							if(!empty($row_munk_back_sub_category)){
								foreach($row_munk_back_sub_category as $rs_back_munk){?>
									<option value="<?php echo $rs_back_munk->id_backmunk;?>" <?php echo $fnc->selected($rs_back_munk->id_backmunk,$rs->id_back_munk);?>><?php echo $rs_back_munk->name_backmunk?></option>
								<?php }?>
							<?php }?>
						</select>
				      </td>
					</tr>
					<?php }?>

					<?php 
					$row_type_product_sub_category = $sys->result("tb_type_product",null,' id_type_product asc ');
					
					?>

					<tr>
					  <td width = "15%" align = "right">
						<b>รูปแบบ:</b></td><td>
						<select name="id_type_product" id = "id_type_product" style = "width:150px;" onchange = "check_si_type_product(this.value);" disabled>
						<option value="0">เลือก</option>
							<?php
							if(!empty($row_type_product_sub_category)){
								foreach($row_type_product_sub_category as $rs_type_product){?>
									<option value="<?php echo $rs_type_product->id_type_product;?>" <?php echo $fnc->selected($rs_type_product->id_type_product,$rs->id_type_product);?> ><?php echo $rs_type_product->name_type_product;?></option>
								<?php }?>
							<?php }?>
						</select>
				      </td>
					</tr>

					<?php 
					$row_medicine_sub_category = $sys->result("tb_medicine",null,' id_medicine asc ');
					
					?>

					<?php if($rs->type != 4){?>
					<tr>
					  <td width = "15%" align = "right">
						<b>ลงยา:</b></td><td>
						<select name="id_medicine" id = "id_medicine" style = "width:150px;" onchange = "check_si_medicine(this.value);" disabled>
						<option value="0">เลือก</option>
							<?php
							if(!empty($row_medicine_sub_category)){
								foreach($row_medicine_sub_category as $rs_medicine){?>
									<option value="<?php echo $rs_medicine->id_medicine;?>"  <?php echo $fnc->selected($rs_medicine->id_medicine,$rs->id_medicine);?>><?php echo $rs_medicine->name_medicine;?></option>
								<?php }?>
							<?php }?>
						</select>
				      </td>
					</tr>
					<?php }?>


					<?php
					
						$row_special_sub_category = $sys->result("tb_special_sub_category_".part_tb($rs->type).",tb_special",' tb_special_sub_category_'.part_tb($rs->type).'.id_sub_category = "'.$_POST['id_sub_category'].'" and tb_special_sub_category_'.part_tb($rs->type).'.id_special = tb_special.id_special   ');
					?>
					

					<tr>
					  <td width = "15%" align = "right"><b>วันที่นำเข้า:</b></td>
					  <td><input name="date_product" type="text" class="box" id="date_product" style=" width:80px" value = "<?php echo $rs->date_product;?>"/>
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						<b>จำนวนสินค้า:</b></td><td><input type="text" name="total_product" style ="width:50px;" value = "<?php echo $rs->total_product;?>" <?php if($rs->id_product !=""){ echo "readonly";}?>>
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
						<b>Remark:</b></td><td>
						<textarea name="remark_product" style = "width:250px;height:50px;" ><?php echo $rs->remark_product;?></textarea>
				      </td>
					</tr>
					

					<tr>
					  <td width = "15%" align = "right">
						QTY:</td><td><input type="text" name="qty_invoice" id = "qty_invoice" style ="width:50px;" value = "1">

						&nbsp;จำนวนที่เหลือในสต๊อก<input type="text" name="total_product" id = "total_product" style ="width:50px;" value = "<?php echo $rs->total_product?>" readonly>
				      </td>
					</tr>

					<input type="hidden" name="id_product" id = "id_product" value = "<?php echo $rs->id_product;?>">
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
					<div style="border: 3px coral solid; width: 120px;height:100px;"><h4 >ราคาทอง</h4><h2 id = "gold_text"><?php echo $gold__;?></h2><input type="hidden" id ="gold" value = "<?php echo $gold__;?>">
					
					</div>
					</td>
				</tr>

				<!-- <tr>
					<td align = "center">
					<div style="border: 3px coral solid; width: 100px;height:100px;"><h4 >ราคาทอง</h4><h2 id = "gold_text"><?php echo $gold__;?></h2><input type="hidden" id ="gold" value = "<?php echo $gold__;?>">
					
					</div>
					</td>
				</tr> -->

				<tr>
					<td align = "center">
					<div style="border: 3px coral solid; width: 120px;height:100px;"><h4>เปอร์เซ็น</h4><h2 id="percent_text"><?php echo $rs_percent->percent_;?></h2><input type="hidden" id="percent_" value = "<?php echo $rs_percent->percent_;?>">
					
					</div>
					</td>
				</tr>

				<tr>
					<td align = "center">
					<input type="hidden" name="weight" id = "weight"  value="<?php echo $rs->weight;?>" > &nbsp;&nbsp;
					<div style="border: 3px coral solid; width: 120px;height:100px;"><h4>น้ำหนัก</h4><h2 id="weight_text"><?php echo $rs->weight;?></h2>&nbsp;
					
					</div>
					</td>
				</tr>
				
				<tr>
					<td align = "center">
					<div style="border: 3px coral solid; width: 120px;height:100px;"><h4>ค่าซิ</h4><h2 id="si_text"><?php echo $rs->si_product;?></h2>
					<input type="hidden" name = "si" id="si" value = "<?php echo $rs->si_product;?>">
					</div>
					</td>
				</tr>

				<tr>
					<td align = "center">
					<div style="border: 3px coral solid; width: 120px;height:100px;"><h4>น้ำหนักรวมซิ</h4><h2 id="total_wage_si_text"><?php echo $rs->total_wage_si;?></h2>
					<input type="hidden" name = "total_wage_si" id="total_wage_si" value = "<?php echo $rs->total_wage_si;?>">
					</div>
					</td>
				</tr>


				<tr>
					<td align = "center">
					<div style="border: 3px coral solid; width: 120px;height:100px;"><h4>ค่าแรง</h4>
					
					<h2 id="total_wage_text"><?php echo $rs_wage_first->wage;?></h2><input type="hidden" name="total_wage" id="total_wage"  value = "<?php echo $rs_wage_first->wage;?>">

				


					</div>
					</td>
				</tr>

				<tr>
					<td align = "center">
					<?php  $price_ =  
					( (($gold__ * 0.0656 * $rs_percent->percent_)/100) * ($rs->weight + $rs->si_product) )   + $rs_wage_first->wage; 
				 ?>
					<div style="border: 3px #ff0000 solid; width: 120px;height:100px;"><h4 >ราคา</h4><h2 id="price_text">&nbsp;
					<?php echo (int)$price_;?></h2><input type="hidden" id="price" value = "<?php echo (int)$price_;?>">
					</div>
					</td>
				</tr>

				<input type="hidden" name="id_product" id="id_product" value = "<?php echo $rs->id_product?>">

				
		

				
				</table>
			</td>



		</tr>
</table>

<?php
$row = $sys->result("tb_invoice,tb_product"," tb_invoice.id_product = tb_product.id_product and  tb_invoice.invoice_no = '".$_POST['invoice_no']."' and tb_invoice.id_branch = '".$_POST['id_branch']."'  "," tb_invoice.id_invoice asc");
?>
<table width="100%" cellspacing="0" cellpadding="1" border="0" >

	<FORM name="myForm" METHOD="POST" ACTION="">
    <tr>
        <td>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  
      <td align="center" bgcolor="#BBD8EC" class="th">ลำดับ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">รายการ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">น้ำหนัก</td>	 
	  <td align="center" bgcolor="#BBD8EC" class="th">ค่าแรง</td> 
	  <td align="center" bgcolor="#BBD8EC" class="th">ราคาทอง</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">จำนวนเงิน</td>
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
	  <td align="center"><?php echo $rs->weight; ?></td>
	  <td align="center"><?php echo $rs->total_wage; ?></td>
	  <td align="center"><?php echo $rs->gold_price; ?></td>
	  <td align="center"><?php echo $rs->price;?></td>
	  <td align="center"><img src="images/notification_error.png" width="16" height="16" border="0" alt="" style = "cursor:pointer;" onclick = "del_invoince(<?php echo $rs->id_product;?>);"></td>
    </tr>
<?php 
endforeach;
endif;?>


</table>
