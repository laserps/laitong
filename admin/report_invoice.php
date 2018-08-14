<?php
  header ('Content-type: text/html; charset=utf-8'); 
  header("Content-type: application/vnd.ms-excel");
//header('Content-type: application/csv'); //*** CSV ***//
  header("Content-Disposition: attachment; filename=report_Invoice_ID_".$_GET['invoice_no'].".xls");
    require "../module/database.php";
	include "../system/product.php";
	$sys  = new product($db,$fnc);
	$row		= $db->result("tb_invoice,tb_product,tb_type_product",' tb_invoice.invoice_no = "'.$_GET['invoice_no'].'"  and tb_invoice.id_product = tb_product.id_product and tb_product.id_type_product = tb_type_product.num_type_product    ');
	

	
	

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
	font-size: 9px;
	font-weight: bold;
}
.style4 {
	font-size: 10px;
	
	}
-->
</style>
<table width="695" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="124" class="f10" colspan = "2"><?php echo date("d-m-Y H:i:s");?> </td>
    <td width="189" class="f10">&nbsp;</td>
    <td width="65" class="f14">&nbsp;</td>
	<td width="218" class="f14" colspan = "2"><div align="center"><span class="abig style2"><strong>ID <?php echo $_GET['invoice_no']?></strong></span></div></td>
    <td width="152" class="f14"><div align="center"></div></td>
    
    <td width="143" class="f14"><div align="center"></div></td>
    <td width="117" class="f14"><div align="center"></div></td>
    <td width="153" class="f14"><div align="center"></div></td>
    <td width="67" class="f14"><div align="right" class="f11">&nbsp;</div></td>
  </tr>
  <tr>
    <td class="f10"><strong class="f11">ชื่อลูกค้า</strong> :</td>
    <td class="f10"><?php echo urldecode($_GET['name_customer'])?>&nbsp;&nbsp;<?php echo urldecode($_GET['surname_customer']);?> </td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
  </tr>
  <tr>
    <td class="f10"><strong>&nbsp;</strong>&nbsp;</td>
    <td colspan="2" class="f10">&nbsp;</td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
  </tr>
</table>
<br />
<table width="695" border="1" cellspacing="0" cellpadding="0">
  <tr>
  <td width="124" class="f10"><span class="style3">#</span></td>
    <td width="124" class="f10"><span class="style3">Prod.Code</span></td>
    <td width="193" class="f10"><span class="style3">Description</span></td>
    <td width="61" class="f10"><span class="style3">Metal</span></td>
    <td width="152" class="f10"><div align="center" class="style3">PO#</div></td>
    <td width="218" class="f10"><div align="center" class="style3">DM#</div></td>
    <td width="143" class="f10"><div align="center" class="style3">Inven Date </div></td>
    <td width="117" class="f10"><div align="center" class="style3">Unit Cost($) </div></td>
    <td width="153" class="f10"><div align="center" class="style3">Total Cost($) </div></td>
    <td width="67" class="f10"><span class="style3">จำนวนตัด </span></td>
  </tr>
  <?php foreach($row as $rs){
	  
	  $i++;
	  ?>
  <tr>
    <td class="f10"><?php echo $i;?></td>
    <td class="f10"><?php echo $rs->code_product;?></td>
    <td class="f10"><?php echo $rs->description; ?></td>
    <td class="f10"><?php echo $rs->num_type_product; ?></td>
    <td class="f10"><?php echo $rs->po_product;?></td>
    <td class="f10"><div align="center" class="style4"><?php echo dm_show($rs->dm_product);?></div></td>
    <td class="f10"><div align="center" class="style4"><?php echo $rs->date_product;?></div></td>
    <td class="f10"><div align="center" class="style4"><?php echo $rs->unit_price;?></div></td>
    <td class="f10"><div align="center" class="style4"><?php echo number_format($rs->unit_price*$rs->qty_invoice,2);?></div></td>
    <td class="f10"><div align="center" class="style4"><?php echo $rs->qty_invoice;?></div></td>
  </tr>
  <?php }?>
</table>
