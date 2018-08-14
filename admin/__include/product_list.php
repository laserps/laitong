
<?php  
	if($_GET['p'] !=""){
		$_SESSION['p__'] = $_GET['p'];
	}

	$row		= $sys->dataList($tbl,$id=null,20,"id_product","desc",$join,$_REQUEST['fiel_search'],$_REQUEST['key_search']);
	
	echo $sys->fnc->confirm();
	echo $fnc->checkall();

	if($_POST['id']){
		$sys->Delete_all($_POST['id'],$tbl,$fiel_id,$page_admin);
	}
	if($_GET[del] != ""){
	 $sys->Del($_GET['del'],$tbl,$page_admin,$fiel_id);
	}

include "date.php";

	

	function fnc_soom($soom=null,$type=null){
				if( ($type==1) || ($type ==3) ) {	
					if($soom==1){
						return "ไม่ซุ้ม";
					}else{
						return "ยกซุ้ม";
					}
				}

				if($type==2){	
					if($soom==1){
						return "เปิดหลัง";
					}
					else if($soom==2){
						return "ปิดหลัง";
					}
					else if($soom==3){
						return "ปิดหลังแกะภาพ";
					}
				}


			}

	function check_sum_talub($soom=null){
				if($soom==2){
						return ",ยกซุ้ม";
					}
				else if($soom==1){
						return ",ไม่ซุ้ม";
					}
			}

	$row_category = $db->result("tb_category",NULL, 'id_category asc');
	$row_type_accessories = $db->result("tb_type_accessories",NULL, 'name_type_accessories asc');
?>

<table width="100%" cellspacing="0" cellpadding="0" border="1" >
    <tr>
        <td align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">รายการสินค้า(Stock รวม)</td>
        </tr></table></td>
    </tr>

	<tr>
        <td align="left">
		<?php if(($_SESSION[id_division]=="1") or ($_SESSION[id_division]=="3")){?>
		<a href="main.php?op=<?php echo $_GET[op]?>&act=add&rd=123456"><img src="images/b_add.gif" /></a>
		<?php }?>
		&nbsp;&nbsp;
		</td>
    </tr>

	<tr> 
        <td align="left"><b>รายงานสต๊อก&nbsp;<img src="images/icon_excel2.png" width="18" height="17" border="0" alt=""></b> 
		<form method="post" action="report_invent_date.php" target = "_blank">
			<table>
			<tr>
				<td>วันที่ทำ Stock</td>
				<td><input name="date_product_first" type="text" class="box" id="date_product_first" style=" width:80px"  value="<?php echo $_POST['date_product_first'];?>"/><a href="javascript:displayDatePicker('date_product_first')"><IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a>&nbsp;&nbsp;&nbsp;ถึง&nbsp;&nbsp;&nbsp;
		<input name="date_product_last" type="text" class="box" id="date_product_last" style=" width:80px"  value="<?php echo $_POST['date_product_last'];?>"/><a href="javascript:displayDatePicker('date_product_last')"><IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a>
				</td>
			</tr>

			<tr>
				<td>
				ประเภทสินค้า
				</td>
				<td>

		<input type="radio" name="type" id = "type" value = "1" onclick = "document.getElementById('id_type_accessories').style.display = 'none';">:กรอบ 90
		&nbsp;&nbsp;
		<input type="radio" name="type" id = "type" value = "2" onclick = "document.getElementById('id_type_accessories').style.display = 'none';">:ตลับ
		&nbsp;&nbsp;
		<input type="radio" name="type" id = "type" value = "3" onclick = "document.getElementById('id_type_accessories').style.display = 'none';">:กรอบ 70
		&nbsp;&nbsp;
		<input type="radio" name="type" id = "type" value = "5" onclick = "document.getElementById('id_type_accessories').style.display = 'none';">:กรอบ 75
		&nbsp;&nbsp;
		<input type="radio" name="type" id = "type" value = "4" onclick = "document.getElementById('id_type_accessories').style.display = '';">:อุปกรณ์
		&nbsp;&nbsp;
		<input type="radio" name="type" id = "type" value = "6" checked>:เลือกทั้งหมด
				</td>

			</tr>

			<tr>
				<td>พิมพ์กรอบ</td>
				<td><select name="id_category" id="id_category"  style = "width:150px;">
							<option value="0">แบบพิมพ์กรอบทั้งหมด</option>
							<?php if(!empty($row_category)){
							foreach($row_category as $rs_category){	
							?>
							<option value="<?php echo $rs_category->id_category;?>@<?php echo $rs_category->num_category;?>" <?php echo $fnc->selected($rs->id_category,$rs_category->id_category);?>><?php echo $rs_category->num_category."  ".$rs_category->name_category;?></option>
							<?php }?>
							<?php }?>
						</select>

					<select name="id_type_accessories" id="id_type_accessories"  style = "width:150px; display:none;">
							<option value="0">ประเภทอุปกรณ์</option>
							<?php if(!empty($row_type_accessories)){
							foreach($row_type_accessories as $rs_type_accessories){	
							?>
							<option value="<?php echo $rs_type_accessories->id_type_accessories;?>" <?php echo $fnc->selected($rs->id_type_accessories,$rs_type_accessories->id_type_accessories);?>><?php echo $rs_type_accessories->name_type_accessories;?></option>
							<?php }?>
							<?php }?>
						</select>
				</td>
			</tr>
			</table>
		
		
		<br>
		<input type="submit" value = "พิมพ์รายงาน"><br><br>
		</form>
		</td>
    </tr>

	<tr>
        <td align="left">
		<b>ค้นหาสินค้า</b>
		<form method="post" action="">
			<input type="text" name="key_search" id = "key_search" value = "Keyword" onclick = "document.getElementById('key_search').value = '';">&nbsp;
			<select name="fiel_search" id = "fiel_search">
			    <option value="barcode_product">รหัส Barcode</option>
				<option value="code_product">รหัสสินค้า.</option>
				<option value="id_category">รหัสพิมพ์กรอบ.</option>
				<option value="description">รหัสรูปแบบ.</option>
				<option value="date_product">วัันที่ทำ Stock.</option>
				<option value="weight_product">น้ำหนัก</option>
				<option value="size_product">ราคาทอง.</option>
			</select>&nbsp;<input type="submit" value = "ค้นหา"><br>
		</form>
		</td>
    </tr>

	
	<tr>
        <td><?PHP 
		if($_REQUEST['key_search'] !=""){
		echo $db->render('main.php?op='.$_GET[op].'&act='.$_GET[act].'&fiel_search='.$_REQUEST['fiel_search'].'&key_search='.$_REQUEST['key_search'].'&');
		}else{
		echo	$db->render('main.php?op='.$_GET[op].'&act='.$_GET[act].'&');
			
		}?>
		
		<center>
			กรอกหน้า:----><input type="text" name="p_" id = "p_" style = "width:30px;" value = "<?php echo $_GET['p']?>">&nbsp;<input type="button" value="CLICK PAGE" onclick="fnc_p();">
		</center>
		</td>
    </tr>

		<script type="text/javascript">
		<!--
			function fnc_p(){
				var p = document.getElementById('p_').value;
				window.location.replace("?op=product&act=list&p="+p+"");
			}
		//-->
		</script>

	<FORM name="myForm" METHOD="POST" ACTION="">


    <tr>
        <td>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  
      <td align="center" bgcolor="#BBD8EC" class="th">ลำดับ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">รหัสสินค้า</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Barcode</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">พิมพ์</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">รูปแบบ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ภาพสินค้า</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ขนาด</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">รูปแบบ</td>
	  
	  <td align="center" bgcolor="#BBD8EC" class="th">ลงยา</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">แผ่นปิดหลัง</td>
	  <!-- <td align="center" bgcolor="#BBD8EC" class="th">ลักษณะพิเศษ</td> -->
	  <td align="center" bgcolor="#BBD8EC" class="th">ซุ้ม</td>
      <td align="center" bgcolor="#BBD8EC" class="th">ฝังเพชร</td>

	  <!-- <td align="center" bgcolor="#BBD8EC" class="th">คลัง</td> -->
	  <td align="center" bgcolor="#BBD8EC" class="th">น้ำหนัก รวมซิ</td>
	  
	  <?php if($_REQUEST['key_search'] !=""){?>
		<td align="center" bgcolor="#BBD8EC" class="th">ขายให้สาขา</td>
	  <?php }?>
	  
	  <td align="center" bgcolor="#BBD8EC" class="th">เครื่องมือ</td>
    </tr>
    <?php
	
if($_GET['p']!=""){
$i=((20*$_GET['p'])-20);
}else{
$i=0;
}

$type_1 = array("ปิดตา","หยดน้ำ","ปรกพระชัย","กลม","ไข่","ปิดตา","หยดน้ำ","ปรกพระชัย","กลม","ไข่","ปิดตา","หยดน้ำ","ปรกพระชัย","กลม","ไข่","ปิดตา","หยดน้ำ","ปรกพระชัย","กลม","ไข่");


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
    <?php if($rs->total_product>0){?>
	<tr height="25" bgcolor="<?php echo $bgc?>" align="center" class="tb">
	<?php  }else{?>
	<tr height="25" bgcolor="#bcbcbc" align="center" >
    <?php }?>

      <td align="center"><?php echo $i;?></td>
	  
	  <td align="center"><?php echo $rs->code_product."<br>".$rs->name_type_accessories;?></td>
	  <td align="center"><?php echo $rs->barcode_product;?></td>
	  <td align="center"><?php echo $rs->name_category;?></td>
	  
	  <td align="center"><?php echo $rs->name_sub_category;?></b><br>
	  <?php if($rs->pic_sub_category != ""){?>
		<a href="../thumb/<?php echo $rs->pic_sub_category;?>" target = "_blank"><img src="../thumb/<?php echo $rs->pic_sub_category;?>" width="90" border="0" alt=""></a>
	  <?php }else {?>
			<img src="images/no_photo.png" width="70" border="0" alt="">
	  <?php }?>
	  </td>

	  <td align="center">
	  <?php if($rs->picture_1_product != ""){?>
		<img src="../thumb/<?php echo $rs->picture_1_product;?>" width="100"  border="0" alt="">
	  <?php }else {?>
			<img src="images/no_photo.png" width="70" border="0" alt="">
	  <?php }?><br>
	<?php
	  $special = $db->result("tb_special_product,tb_special"," tb_special_product.id_product = '".$rs->id_product."' and tb_special_product.id_special = tb_special.id_special   "," tb_special_product.id_special asc  ");

		  if(!empty($special)){
			foreach($special as $rs_special ){
				if($rs_special->name_special !="ไม่มี"){
				echo $rs_special->name_special.",";

				}
			}
		  }
		  ?>
	  </td>

	  <td align="center"><?php echo $rs->size;?></td>
	  <td align="center"><?php echo $rs->name_type_product?></td>
	  
	  <td align="center"><?php echo $rs->name_medicine;?></td>
	  <td align="center"><?php echo $rs->name_backmunk;?></td>
	  <!-- <td align="center">ติดเกรียวโปเต้</td> -->
	  
	  <td align="center"><?php echo fnc_soom($rs->soom,$rs->type);?> <br><?php echo check_sum_talub($rs->sum_talub);?></td>

	  <td align="center"><?php echo $rs->name_diamond;?></td>
	  <!-- <td align="center"><?php echo $rs->name_stock;?></td> -->
	  <td align="center"><?php echo $rs->total_wage_si;?>  </td>
	  <?php 
	   if($_REQUEST['key_search'] !=""){?>
	  <td>
	  <?php
	  $rs_invoince = $db->record("tb_invoice,tb_branch","  tb_invoice.id_product = '".$rs->id_product."' and tb_branch.id_branch = tb_invoice.id_branch ");
		if($rs_invoince->invoice_no != ""){
			echo "รหัสใบ".$fnc->number_pad($rs_invoince->invoice_no,10,"left")."<br>";
			echo $rs_invoince->name_branch."<br>";
			echo $fnc->datemoth($fnc->_date($rs_invoince->date_invoice),"thai");
		}
	  ?>
	  </td>
	  <?php }?>

	  <td align="center" bgcolor="<?php echo $bgc?>">
	  <a href="../barcodegen/test2.php?dm_product=<?php echo $rs->barcode_product;?>&code_product=<?php echo $rs->code_product?>&stone_sum_1_product=<?php echo (urlencode($rs->name_category.""));?>&stone_sum_2_product=<?php echo urlencode($rs->total_wage_si." G")?>&stone_sum_3_product=<?php if($rs->type==4){
	  echo (urlencode($rs->name_type_product));}?>&stone_sum_4_product=<?php echo urlencode($rs->stone_sum_4_product)?>&size_=<?php echo $rs->size;?>" target = "_blank"><img src="images/b_print.gif" width="16" height="16" border="0" alt="พิมพ์บาโค๊ท"></a>&nbsp;&nbsp;&nbsp;
	  <?php if(($_SESSION[id_division]=="1") or ($_SESSION[id_division]=="3")){?>
	  <a href="main.php?op=<?php echo $_GET['op'];?>&act=add&amp;rd=<?php echo rand(1,99999); ?>&id=<?php echo $rs->id_product?>">
	  <img src="images/document_edit.png" border="0" title="Edit" /></a> &nbsp; <a href="main.php?op=<?php echo $_GET[op];?>&act=list&amp;rd=<?php echo rand(1,99999); ?>&amp;del=<?php echo $rs->id_product?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf('<?php echo $rs->code_product;?>')" /></a>
	  <?php }?>
	  </td>

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
        <td><?PHP 
		if($_REQUEST['key_search'] !=""){
		echo $db->render('main.php?op='.$_GET[op].'&act='.$_GET[act].'&fiel_search='.$_REQUEST['fiel_search'].'&key_search='.$_REQUEST['key_search'].'&');
		}else{
		echo	$db->render('main.php?op='.$_GET[op].'&act='.$_GET[act].'&');
			
		}?></td>
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
