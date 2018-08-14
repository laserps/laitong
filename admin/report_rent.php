<?php
  header ('Content-type: text/html; charset=utf-8'); 
  header("Content-type: application/vnd.ms-excel");
//header('Content-type: application/csv'); //*** CSV ***//
  header("Content-Disposition: attachment; filename=report_rent_ID_".$_GET['id_rent'].".xls");
    require "../module/database.php";
	include "../system/product.php";
	$sys  = new product($db,$fnc);
	

	$row		= $sys->dataList2("tb_rent_temp",$_GET['id_stock_rent']." ",100000,"id_stock_rent","desc"," 
	left join tb_product on tb_product.id_product = tb_rent_temp.id_product
	left join tb_stock on tb_stock.id_stock = tb_product.id_stock
	");

	
	$row_stock = $db->record("tb_stock"," id_stock = '".$_GET['id_stock_rent']."' ");

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
    <td width="124" class="f10" ><?php echo date("d-m-Y H:i:s");?> </td>
    <td width="189" class="f10">&nbsp;</td>
    <td width="65" class="f14">&nbsp;</td>
	<td width="218" class="f14" colspan = "2"><div align="center"><span class="abig style2"><strong>รายการยืม</strong></span></div></td>
    <td width="152" class="f14"><div align="center"></div></td>
    
    <td width="143" class="f14"><div align="center"></div></td>
    <td width="117" class="f14"><div align="center"></div></td>
    <td width="153" class="f14"><div align="center"></div></td>
    <td width="67" class="f14"><div align="right" class="f11">&nbsp;</div></td>
  </tr>
  <tr>
    <td class="f10"><strong class="f11">ยืมไปที่</strong> :</td>
    <td class="f10"><?php echo $row_stock->name_stock;?> </td>
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
    <td width="67" class="f10"><span class="style3">จำนวนยืม </span></td>
  </tr>
  <?php foreach($row as $rs){
	  
	  $i++;
	  ?>
	  
	  <?php $total_rent = $sys->db->sum("tb_rent_temp", 'id_product = "'.$rs->id_product.'" and id_stock_rent = "'.$_GET['id_stock_rent'].'"  and status_rent = "0"', "id_product asc "," total_rent ");?>
  <tr>
    <td class="f10"><?php echo $i;?></td>
    <td class="f10"><?php echo $rs->code_product;?></td>
    <td class="f10"><?php echo $rs->description; ?></td>
    <td class="f10"><?php echo $rs->id_type_product; ?></td>
    <td class="f10"><?php echo $rs->po_product;?></td>
    <td class="f10"><div align="center" class="style4"><?php echo dm_show($rs->dm_product);?></div></td>
    <td class="f10"><div align="center" class="style4"><?php echo $rs->date_product;?></div></td>
    <td class="f10"><div align="center" class="style4"><?php echo $rs->unit_price;?></div></td>
    
	<td class="f10"><div align="center" class="style4">
	<?php 
	$total_cost_ =  $rs->unit_price*$total_rent; 
	echo number_format($total_cost_,2);
	$total_cost = $total_cost+$total_cost_;?></div>
	</td>


    <td class="f10"><div align="center" class="style4">
	

	<?php 
		
	
	echo $total_rent; 
	  $total = $total+$total_rent;?></div></td>
  </tr>
  <?php }?>

  <tr>
    <td class="f10">&nbsp;</td>
    <td class="f10">&nbsp;</td>
    <td class="f10">&nbsp;</td>
    <td class="f10">&nbsp;</td>
    <td class="f10">&nbsp;</td>
    <td class="f10"><div align="center" class="style4">&nbsp;</div></td>
    <td class="f10"><div align="center" class="style4">&nbsp;</div></td>
    <td class="f10"><div align="center" class="style4">Total</div></td>
    <td class="f10"><div align="center" class="style4"><?php echo number_format($total_cost,2);?></div></td>
    <td class="f10"><div align="center" class="style4"><?php echo number_format($total);?></div></td>
  </tr>
</table>
