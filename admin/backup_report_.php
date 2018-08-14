<?php session_start();?>
<html>
<head>
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
		width: 835 px;
		top: 90px;
		left: -25px;
		font-family: Tahoma, "MS Sans Serif"; 
		font-size: 10px;
	}
.detail ul{
	position: relative;
	height: 0px;
}
.detail ul li{
	margin: 0;
	float: left;
	padding-bottom: -5px;
}

.total_{
	    position:absolute;
		top: 455px;
		left: 575px;
		font-family: Tahoma, "MS Sans Serif"; 
		font-size: 12px;
}

.total_money{
	    position:absolute;
		top: 455px;
		left: 728px;
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

	$row = $db->result("tb_invoice,tb_product,tb_category  ","  tb_invoice.invoice_no = '".$_GET['invoice_no']."' and tb_invoice.id_branch = '".$_GET['id_branch']."' and tb_invoice.id_product = tb_product.id_product and tb_product.id_category = tb_category.id_category   "," id_invoice asc ","12");

	$row_2 = $db->result("tb_invoice,tb_product,tb_category  ","  tb_invoice.invoice_no = '".$_GET['invoice_no']."' and tb_invoice.id_branch = '".$_GET['id_branch']."' and tb_invoice.id_product = tb_product.id_product and tb_product.id_category = tb_category.id_category   "," id_invoice asc ","12,24");

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

?>
</div>
<div style = "position:relative;">
   <div style = "position:absolute; left: 710px; top:0px; font-size: 10px;width:100px; " class="f11"><?php echo $rs_head->num_branch." ".$fnc->number_pad($rs_head->invoice_no,7,"left");?></div>
   <div style = "position:absolute; left: 50px;  top:28px; " class="f11">สาขา <?php echo $rs_head->name_branch;?></div>
   <div style = "position:absolute; left: 528px; top:28px; " class="f11"><?php echo $fnc->datemoth($fnc->_date($rs_head->date_invoice),"thai");?>&nbsp;<?php echo $fnc->lob_date(date("H:i"),"hour",1,"H:i");?> </div>
   <div style = "position:absolute; left: 713px; top:28px; " class="f11"><?php echo number_format($rs_head->gold_price);?> </div>

   <div class = "detail"> 
   <?php 
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

		function check_si___($si){
			if($si=="-"){
				return "63";
			}
		
			else{
				return "35";
			}
		}
	  
	  foreach($row as $rs){
			$i++;
		  ?>
		<ul>
			<li style = "width:10px;" align = "center"><?php echo $i;?></li>
			<li style = "width:80px; font-size: 8.7px; padding-left:7px;"><?php echo $rs->code_product;?></li>
			<li style = "width:110px; font-size: 12px;"><?php echo $rs->name_category;?></li>
			<li style = " width: 230px; font-size: 12px;"><?php if($rs->type != 4){ echo check_grob($rs->type);}?> <?php echo check_soom($rs->soom,$rs->type);?>
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
			<li style = "padding-left:8px; font-size: 12px;"><?php echo $rs->percent_;?> % </li>
			<li style = "padding-left:30px; font-size: 12px;"><?php $si__ = fnc_check_si($rs->si_product); echo $si__; ?></li>
			
			<li style = "padding-left:<?php echo check_si___($si__ );?>px; font-size: 12px;"><?php  $total_wage_si = $total_wage_si + $rs->total_wage_si;   echo $rs->total_wage_si;?></li>

			<li style = "padding-left:40px; font-size: 12px;"> 1</li>
			<li style = "padding-left:30px;width:100px;text-align:left;"><?php echo $rs->wage_;?></li>
			<li style = " text-align:left; font-size: 12px;"><?php $price = $rs->price; echo number_format($price); $total_price = $total_price + $price;?> </li>
		</ul>

<?php }?>
		
   </div>

   <div class = "total_">
			<b><?php echo $total_wage_si;?></b>
   </div>

   <div class = "total_money">
			<b><?php echo number_format($total_price);?></b>
   </div>


</div>

<?php $check_page = count($row_check);


if($check_page >12){?>
<div style = "position:relative; top: 525px;">
   <div style = "position:absolute; left: 690px; top:0px; font-size: 10px;width:100px; " class="f11"><?php echo $rs_head->num_branch." ".$fnc->number_pad($rs_head->invoice_no,7,"left");?>/2</div>
   <div style = "position:absolute; left: 50px;  top:28px; " class="f11">สาขา <?php echo $rs_head->name_branch;?></div>
   <div style = "position:absolute; left: 515px; top:28px; " class="f11"><?php echo $fnc->datemoth($fnc->_date($rs_head->date_invoice),"thai");?>&nbsp;<?php echo $fnc->lob_date(date("H:i"),"hour",1,"H:i");?> </div>
   <div style = "position:absolute; left: 713px; top:28px; " class="f11"><?php echo number_format($rs_head->gold_price);?> </div>

   <div class = "detail"> 
<?php
foreach($row_2 as $rs){
			$i++;
		  ?>
		<ul>
			<li style = "width:10px;" align = "center"><?php echo $i;?></li>
			<li style = "width:80px; font-size: 8.7px; padding-left:7px;"><?php echo $rs->code_product;?></li>
			<li style = "width:110px;"><?php echo $rs->name_category;?></li>
			<li style = " width: 240px;"><?php if($rs->type != 4){ echo check_grob($rs->type);}?> <?php echo check_soom($rs->soom,$rs->type);?>
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
			<li ><?php echo $rs->percent_;?> % </li>
			<li style = "padding-left:30px;"><?php $si__ = fnc_check_si($rs->si_product); echo $si__; ?></li>
			<li style = "padding-left:<?php echo check_si___($si__ );?>px;"><?php  $total_wage_si = $total_wage_si + $rs->total_wage_si;   echo $rs->total_wage_si;?></li>
			<li style = "padding-left:40px;"> 1</li>
			<li style = "padding-left:30px;width:100px;text-align:left;"><?php echo $rs->total_wage;?></li>
			<li style = " text-align:left;"><?php $price = $rs->price; echo number_format($price); $total_price = $total_price + $price;?> </li>
		</ul>

<?php }?>
		
   </div>

   <div class = "total_">
			<b><?php echo $total_wage_si;?></b>
   </div>

   <div class = "total_money">
			<b><?php echo number_format($total_price);?></b>
   </div>


</div>

<?php }?>

<script type="text/javascript">
<!--
		var t = "";
		//window.print();
		//t=setTimeout("redirect__()",50);
		function redirect__(){
			//clearTimeout(t);
			//window.location.replace("main.php?op=buy&act=list");
		}
//-->
</script>
</body>
</html>