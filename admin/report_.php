<?php session_start();?>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=8" />
<link href="css_admin.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.detail{
		position:absolute;
		width: 1285 px;
		top: 85px;
		left: -35px;
		font-family: Tahoma, "MS Sans Serif"; 
		font-size: 10px;
		border: 1px solid black;
	}
.detail ul{
	position: relative;
	height: 23px;
	width: 775px;


}
.detail ul li{
	margin: 0;
	list-style:none;
	float: left;
	height: 35px;
	border: 1px solid black;
}

.total_{
	    position:absolute;
		top: 431px;
		left: 540px;
		font-family: Tahoma, "MS Sans Serif"; 
		font-size: 12px;
}

.total_money{
	    position:absolute;
		top: 431px;
		left: 679px;
		font-family: Tahoma, "MS Sans Serif"; 
		font-size: 12px;
}		width: 200px;

-->
</style>
</head>
<body>
<div style = "position:absolute;">
<?php 
	include '../module/class.database.php';
	include '../module/class.func.php';
	$db = new Database();
	$fnc = new func();
	unset($_SESSION['invoice_no']);
	unset($_SESSION['num_branch']);
	unset($_SESSION['id_branch']);
	$rs_head = $db->record("tb_invoice,tb_branch"," tb_invoice.id_branch = tb_branch.id_branch   and tb_invoice.invoice_no = '".$_GET['invoice_no']."' and tb_invoice.id_branch = '".$_GET['id_branch']."' ");

	$row_check = $db->result("tb_invoice,tb_product,tb_category  ","  tb_invoice.invoice_no = '".$_GET['invoice_no']."' and tb_invoice.id_branch = '".$_GET['id_branch']."' and tb_invoice.id_product = tb_product.id_product and tb_product.id_category = tb_category.id_category   "," id_invoice asc ");

	$row = $db->result("tb_invoice,tb_product,tb_category  ","  tb_invoice.invoice_no = '".$_GET['invoice_no']."' and tb_invoice.id_branch = '".$_GET['id_branch']."' and tb_invoice.id_product = tb_product.id_product and tb_product.id_category = tb_category.id_category   "," id_invoice asc ","20");

	$row_2 = $db->result("tb_invoice,tb_product,tb_category  ","  tb_invoice.invoice_no = '".$_GET['invoice_no']."' and tb_invoice.id_branch = '".$_GET['id_branch']."' and tb_invoice.id_product = tb_product.id_product and tb_product.id_category = tb_category.id_category   "," id_invoice asc ","20,40");

	function fnc_check_si($si){
		if( ($si=="0.00") || ($si=="0.01") ){
			return "-";
		}else{
			return $si;
		}
	}

	function check_si_($si){
		if( ($si=="0.00") || ($si=="0.01") ){
			return "center";
		}else{
			return "right";
		}
	}

?><?php 
			function check_grob($type){
				if($type == "1"){
					return "กรอบ 90";
				}
				else if($type == "2"){
					return "ตลับ";
				}
				else if($type == "3"){
					return "กรอบ 70";
				}
				else if($type == "5"){
					return "กรอบ 75";
				}
				else if($type == "4"){
					return "อุปกรณ์";
				}
			}

			

			function check_diamond($dia=null){
				if($dia ==""){
					return "13";
				}
				else if($dia =="1"){
					return "13";
				}
				else if($dia =="13"){
					return "13";
				}else{
					return $dia;
				}
			}

			
			function check_soom($soom=null,$type=null){
				if( ($type==1) || ($type ==3) ) {	
					if($soom==1){
						return ",ไม่ซุ้ม";
					}else{
						return ",ยกซุ้ม";
					}
				}

				if($type==2){	
					if($soom==1){
						return ",เปิดหลัง";
					}
					else if($soom==2){
						return ",ปิดหลัง";
					}
					else if($soom==3){
						return ",ปิดหลังแกะภาพ";
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

		function check_si___($si){
			if($si=="-"){
				return "63";
			}
		
			else{
				return "35";
			}
		}
	  ?>
</div>
<div style = "position:relative;">
	<div style = "position:absolute; left: 310px; top:0px; font-size: 18px;width:190px; " class="f11">บิลส่งของ</div>
	<div style = "position:absolute; left: 290px; top:28px; font-size: 24px;width:190px; " class="f11">ร้านลายทอง</div>
   <div style = "position:absolute; left: 650px; top:0px; font-size: 14px;width:120px; " class="f11">รหัส <?php echo $rs_head->num_branch." ".$fnc->number_pad($rs_head->invoice_no,7,"left");?></div>
   <div style = "position:absolute; left: 50px;  top:28px; font-size: 14px; " class="f11"><strong>สาขา </strong><?php echo $rs_head->name_branch;?></div>
   <div style = "position:absolute; left: 480px; top:28px; font-size: 14px; " class="f11"><?php echo $fnc->datemoth($fnc->_date($rs_head->date_invoice),"thai");?>&nbsp;<?php echo $fnc->lob_date(date("H:i"),"hour",0,"H:i");?> </div>
   <div style = "position:absolute; left: 645px; top:28px; font-size: 14px; " class="f11"><strong>ราคาทอง:</strong> <?php echo number_format($rs_head->gold_price);?> </div>

   <div class = "detail"> 
   
	  <ul>
		  <li style = "width:17px;">&nbsp;</li>
		  <li style = "width:120px; font-size: 15px;padding-left:12px;">รหัส</li>
		  <li style = "width: 312px; font-size: 15px; padding-left: 3px;">รายละเอียด</li>
		  <li style = " width: 57px; font-size: 15px; text-align: center;">เปอร์เซ็น</li>
		  <li style = " width: 40px; font-size: 15px; text-align: center;">ค่าซิ</li>
		  <li style = " width: 70px; font-size: 15px; text-align: center;">น้ำหนักรวม</li>
		  <li style = "width: 60px; font-size: 15px; text-align: center; ">ค่าแรง</li>
		  <li style = "width: 60px; font-size: 14px; text-align: center;">จำนวนเงิน</li>

	  </ul>
	  <?php
	  foreach($row as $rs){
			$i++;
		  ?>
		<ul >
			<li style = "width:17px; font-size: 14px;" align = "center" ><strong><?php echo $i;?></strong></li>
			<li style = "width:120px; font-size: 14px;padding-left:12px; text-align: left;"><?php echo $rs->code_product;?></li>
			<li style = "width: 312px; font-size: 14px; padding-left: 3px;">(<?php echo $rs->size;?>) <?php if($rs->type != 4){ echo check_grob($rs->type);}?> <?php echo check_soom($rs->soom,$rs->type);?> <?php echo check_sum_talub($rs->sum_talub);?>
		<?php 
		$type_product = $db->record("tb_type_product","id_type_product = '".$rs->id_type_product."'");
		echo ",".$type_product->name_type_product;
		?>
		, 
		<?php 
			  $special = $db->result("tb_special_product,tb_special"," tb_special_product.id_product = '".$rs->id_product."' and tb_special_product.id_special = tb_special.id_special   "," tb_special_product.id_special asc  ");

		  if(!empty($special)){
			foreach($special as $rs_special ){
				if($rs_special->name_special !="ไม่มี"){
				echo $rs_special->name_special.",";

				}
			}
		  }
		  $rs_medicine = $db->record("tb_medicine"," id_medicine = '".$rs->id_medicine."' ");
			if($rs->id_medicine>2){
				echo "ลงยา ".$rs_medicine->name_medicine;
			}
		  ?>
		  <?php 
		  $dia = check_diamond($rs->id_diamond);
		  if($dia !="13"){?> - เพชร <?php echo $rs->total_diamond?> เม็ด <?php echo $rs->karat;?> กะรัตละ<?php echo $rs->per_karat?>บาท<br />
		  <?php }?></li>
			<li style = " width: 57px; font-size: 14px; text-align: right;"><?php echo $rs->percent_;?> % </li>
			<li style = " width: 40px; font-size: 14px; text-align: right;"><?php $si__ = fnc_check_si($rs->si_product); echo $si__; ?></li>
			
			<li style = " width: 70px; font-size: 14px; text-align: right;"><?php  $total_wage_si = $total_wage_si + $rs->total_wage_si;   echo $rs->total_wage_si;?></li>

			<li style = "width: 60px; font-size: 14px; text-align: right; "><?php echo $rs->wage_;?></li>
			<li style = "width: 60px; font-size: 14px; text-align: right;"><?php $price = $rs->price; echo number_format($price); $total_price = $total_price + $price;?> </li>
		</ul>




<?php }?>

	<?php for($j=$i;$j<10;$j++){?>
		<ul>
		  <li style = "width:17px;">&nbsp;</li>
		  <li style = "width:120px; font-size: 15px;padding-left:12px;">&nbsp;</li>
		  <li style = "width: 312px; font-size: 15px; padding-left: 3px;">&nbsp;</li>
		  <li style = " width: 57px; font-size: 15px; text-align: center;">&nbsp;</li>
		  <li style = " width: 40px; font-size: 12px; text-align: center;">&nbsp;</li>
		  <li style = " width: 70px; font-size: 15px; text-align: center;">&nbsp;</li>
		  <li style = "width: 60px; font-size: 15px; text-align: center; ">&nbsp;</li>
		  <li style = "width: 60px; font-size: 12px; text-align: center;">&nbsp;</li>
		</ul>
	<?php }?>

		<ul>
			<li style = "width:17px; font-size: 14px;" align = "center" >&nbsp;</li>
			<li style = "width:120px; font-size: 8.7px;padding-left:12px;">&nbsp;</li>
			<li style = "width: 312px; font-size: 14px; padding-left: 3px;">&nbsp;</li>

			<li style = " width: 171px; font-size: 14px; text-align: right;"><strong>น้ำหนักรวม</strong>&nbsp;<strong><?php echo $total_wage_si;?></strong></li>
			

			<li style = "width: 60px; font-size: 14px; text-align: right; "><strong>ยอดรวม</strong></li>
			<li style = "width: 60px; font-size: 14px; text-align: right;"><strong><?php echo number_format($total_price);?></strong></li>
		</ul>
		
   </div>

   <!-- <div class = "total_">
			<b><?php echo $total_wage_si;?></b>
   </div>

   <div class = "total_money">
			<b><?php echo number_format($total_price);?></b>
   </div>
 -->

</div>

<?php if($i<=10){
$total_price = 0;
$total_wage_si = 0;
?>
<div style = "position:relative; top: 665px;">

		<div style = "position:absolute; left: 310px; top:0px; font-size: 18px;width:190px; " class="f11">บิลส่งของ</div>
	<div style = "position:absolute; left: 290px; top:28px; font-size: 24px;width:190px; " class="f11">ร้านลายทอง</div>
   <div style = "position:absolute; left: 650px; top:0px; font-size: 14px;width:120px; " class="f11">รหัส <?php echo $rs_head->num_branch." ".$fnc->number_pad($rs_head->invoice_no,7,"left");?></div>
   <div style = "position:absolute; left: 50px;  top:28px; font-size: 14px; " class="f11"><strong>สาขา </strong><?php echo $rs_head->name_branch;?></div>
   <div style = "position:absolute; left: 480px; top:28px; font-size: 14px; " class="f11"><?php echo $fnc->datemoth($fnc->_date($rs_head->date_invoice),"thai");?>&nbsp;<?php echo $fnc->lob_date(date("H:i"),"hour",0,"H:i");?> </div>
   <div style = "position:absolute; left: 645px; top:28px; font-size: 14px; " class="f11"><strong>ราคาทอง:</strong> <?php echo number_format($rs_head->gold_price);?> </div>

   <div class = "detail"> 
   
	  <ul>
		  <li style = "width:17px;">&nbsp;</li>
		  <li style = "width:120px; font-size: 15px;padding-left:12px;">รหัส</li>
		  <li style = "width: 312px; font-size: 15px; padding-left: 3px;">รายละเอียด</li>
		  <li style = " width: 57px; font-size: 15px; text-align: center;">เปอร์เซ็น</li>
		  <li style = " width: 40px; font-size: 15px; text-align: center;">ค่าซิ</li>
		  <li style = " width: 70px; font-size: 15px; text-align: center;">น้ำหนักรวม</li>
		  <li style = "width: 60px; font-size: 15px; text-align: center; ">ค่าแรง</li>
		  <li style = "width: 60px; font-size: 14px; text-align: center;">จำนวนเงิน</li>

	  </ul>
	  <?php
	  $i = 0;
	  foreach($row as $rs){
			$i++;
		  ?>
		<ul>
			<li style = "width:17px; font-size: 14px;" align = "center" ><strong><?php echo $i;?></strong></li>
			<li style = "width:120px; font-size: 14px;padding-left:12px; text-align: left;"><?php echo $rs->code_product;?></li>
			<li style = "width: 312px; font-size: 14px; padding-left: 3px;">(<?php echo $rs->size;?>) <?php if($rs->type != 4){ echo check_grob($rs->type);}?> <?php echo check_soom($rs->soom,$rs->type);?> <?php echo check_sum_talub($rs->sum_talub);?>
		<?php 
		$type_product = $db->record("tb_type_product","id_type_product = '".$rs->id_type_product."'");
		echo ",".$type_product->name_type_product;
		?>
		, 
		<?php 
			  $special = $db->result("tb_special_product,tb_special"," tb_special_product.id_product = '".$rs->id_product."' and tb_special_product.id_special = tb_special.id_special   "," tb_special_product.id_special asc  ");

		  if(!empty($special)){
			foreach($special as $rs_special ){
				if($rs_special->name_special !="ไม่มี"){
				echo $rs_special->name_special.",";

				}
			}
		  }
		  $rs_medicine = $db->record("tb_medicine"," id_medicine = '".$rs->id_medicine."' ");
			if($rs->id_medicine>2){
				echo "ลงยา ".$rs_medicine->name_medicine;
			}
		  ?>
		  <?php 
		  $dia = check_diamond($rs->id_diamond);
		  if($dia !="13"){?><br />
		  - เพชร <?php echo $rs->total_diamond?> เม็ด <?php echo $rs->karat;?> กะรัตละ<?php echo $rs->per_karat?>บาท<br />
		  <?php }?></li>
			<li style = " width: 57px; font-size: 14px; text-align: right;"><?php echo $rs->percent_;?> % </li>
			<li style = " width: 40px; font-size: 14px; text-align: right;"><?php $si__ = fnc_check_si($rs->si_product); echo $si__; ?></li>
			
			<li style = " width: 70px; font-size: 14px; text-align: right;"><?php  $total_wage_si = $total_wage_si + $rs->total_wage_si;   echo $rs->total_wage_si;?></li>

			<li style = "width: 60px; font-size: 14px; text-align: right; "><?php echo $rs->wage_;?></li>
			<li style = "width: 60px; font-size: 14px; text-align: right;"><?php $price = $rs->price; echo number_format($price); $total_price = $total_price + $price;?> </li>
		</ul>




<?php }?>

	<?php for($j=$i;$j<10;$j++){?>
		<ul>
			<li style = "width:17px;">&nbsp;</li>
		  <li style = "width:120px; font-size: 15px;padding-left:12px;">&nbsp;</li>
		  <li style = "width: 312px; font-size: 15px; padding-left: 3px;">&nbsp;</li>
		  <li style = " width: 57px; font-size: 15px; text-align: center;">&nbsp;</li>
		  <li style = " width: 40px; font-size: 12px; text-align: center;">&nbsp;</li>
		  <li style = " width: 70px; font-size: 15px; text-align: center;">&nbsp;</li>
		  <li style = "width: 60px; font-size: 15px; text-align: center; ">&nbsp;</li>
		  <li style = "width: 60px; font-size: 12px; text-align: center;">&nbsp;</li>
		</ul>
	<?php }?>

		<ul>
			<li style = "width:17px; font-size: 14px;" align = "center" >&nbsp;</li>
			<li style = "width:120px; font-size: 8.7px;padding-left:12px;">&nbsp;</li>
			<li style = "width: 312px; font-size: 14px; padding-left: 3px;">&nbsp;</li>

			<li style = " width: 171px; font-size: 14px; text-align: right;"><strong>น้ำหนักรวม</strong>&nbsp;<strong><?php echo $total_wage_si;?></strong></li>
			

			<li style = "width: 60px; font-size: 14px; text-align: right; "><strong>ยอดรวม</strong></li>
			<li style = "width: 60px; font-size: 14px; text-align: right;"><strong><?php echo number_format($total_price);?></strong></li>
		</ul>
		
   </div>

</div>
<?php }?>
</body>
</html>