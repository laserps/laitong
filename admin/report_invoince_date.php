<?php
  header ('Content-type: text/html; charset=utf-8'); 
 header("Content-type: application/vnd.ms-excel");
//header('Content-type: application/csv'); //*** CSV ***//
 header("Content-Disposition: attachment; filename=report.xls");
    require "../module/database.php";
	include "../system/product.php";
	$date_first =  $fnc->_date($_POST['date_product_first']);
	$date_last =  $fnc->_date($_POST['date_product_last']);
	$row		= $db->result("tb_invoice",' tb_invoice.id_branch = "'.$_POST['id_branch'].' " and date_invoice >= "'.$date_first.'" and date_invoice <= "'.$date_last.'"     group by invoice_no  '," tb_invoice.invoice_no asc ");
	$rs_branch  = $db->record("tb_branch",'id_branch = "'.$_POST['id_branch'].'" ');

	
	

	function check_bg($status_qc){
		if($status_qc!="0"){
			return '#66ff66';
		}

	}

	function check_status_qc($status_qc){
		if($status_qc==1){
			return '<img src="images/qcpass.png" width="25" height="25" border="0" alt="">';
		}
		else if($status_qc==2){
			return '<img src="images/qcnopass.png" width="25" height="25" border="0" alt="">';
		}else{
			return '';
		}
	}


function dm_show($data){
	$num_1  = substr($data, -13,2);
	$num_2  = substr($data, -11,9);
	$num_3  = substr($data, -2,13);
	$dm      = $num_1."-".$num_2."-".$num_3;
	return $dm;
}

?>
<link href="http://localhost/premier_jewelry/admin/css_admin.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.style2 {font-size: 18px}
.style3 {
	font-size: 14px;
	font-weight: bold;
}
.style4 {
	font-size: 14px;
	
	}
.fbig {
	font-size: 24px;
	
	}
-->
</style>
<table width="695" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td class="fbig" colspan = "5" align = "center">สาขา <?php echo $rs_branch->name_branch;?></td>
  </tr>
  <tr>
    <td class="f10" colspan = "5">สรุปยอดวันที่&nbsp;&nbsp;&nbsp;<?php echo $_POST['date_product_first'];?>&nbsp;-&nbsp;<?php echo $_POST['date_product_last'];?></td>
  </tr>


</table>
<br />
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td  class="f10" align = "center"><span class="style3"><b>วันที่</b></span></td>
    <td  class="f10" align = "center"><span class="style3"><b>เลขที่บิล</b></span></td>
	<td  class="f10" align = "center"><span class="style3"><b>จำนวนชิ้น</b></span></td>
    <td  class="f10" align = "center"><span class="style3"><b>จำนวนเงิน</b></span></td>
  </tr>
  <?php 
  if(!empty($row)){
  foreach($row as $rs){
	  
	  $i++;
	  ?>
  <tr>
    <td class="f10" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $fnc->_date($rs->date_invoice);?></td>
    <td class="f10" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rs_branch->num_branch." ".$fnc->number_pad($rs->invoice_no,7,"left");?></td>

	<td class="f10"  align = "left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $row_sum_peace = $db->sum("tb_invoice", "invoice_no= '".$rs->invoice_no."' and id_branch = '".$_POST['id_branch']."'   ",NULL,"qty_invoice");  echo number_format($row_sum_peace); $row_sum_peace_total = $row_sum_peace+$row_sum_peace_total;?></td>

    <td class="f10"  align = "left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $row_sum = $db->sum("tb_invoice", "invoice_no= '".$rs->invoice_no."' and id_branch = '".$_POST['id_branch']."'   ",NULL,"price");  echo number_format($row_sum); $row_sum_total = $row_sum+$row_sum_total;?></td>
  </tr>
  <?php } }?>

  <tr>
    <td class="f10" colspan = "4">รวม&nbsp;&nbsp;&nbsp;<b><?php echo $i;?>&nbsp;บิล</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo  number_format($row_sum_peace_total);?> ชิ้น </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ยอดรวม&nbsp;&nbsp;<b><?php echo number_format($row_sum_total);?>&nbsp;<b>บาท</td>
    
  </tr>


</table>
