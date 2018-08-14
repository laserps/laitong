<?php
header ('Content-type: text/html; charset=utf-8'); 
//header("Content-type: application/vnd.ms-excel");
//header('Content-type: application/csv'); //*** CSV ***//
//header("Content-Disposition: attachment; filename=report_stock_onhand_".$_GET['name_stock'].".xls");
    require "../module/database.php";
	
	
	$first_ = explode("-",$_POST['date_product_first']);
	$last_ = explode("-",$_POST['date_product_last']);

	$row		= $db->result("tb_invoice,tb_product  left join tb_category on tb_category.id_category = tb_product.id_category
left join tb_sub_category on tb_sub_category.id_sub_category = tb_product.id_sub_category
left join tb_type_product on tb_type_product.id_type_product = tb_product.id_type_product
left join tb_diamond on tb_diamond.id_diamond = tb_product.id_diamond
left join tb_medicine on tb_medicine.id_medicine = tb_product.id_medicine
left join tb_backmunk on tb_backmunk.id_backmunk = tb_product.id_back_munk
left join tb_type_accessories on  tb_type_accessories.id_type_accessories = tb_product.id_type_accessories ", " tb_invoice.id_branch = '".$_POST['id_branch']."' and   tb_invoice.id_product = tb_product.id_product  and tb_invoice.date_invoice >= '".$first_[2]."-".$first_[1]."-".$first_[0]."' and  tb_invoice.date_invoice <= '".$last_[2]."-".$last_[1]."-".$last_[0]."'   ", " tb_invoice.id_invoice desc  ", NULL, $field = '*');
	
	$row_category = $db->result("tb_category",NULL, 'num_category asc');

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

	function check_type($type){
		if($type<6){
			return " and tb_product.type = '".$type."' ";
		}
	}

	function check_id_type_accessories($id_type_accessories){
		if($id_type_accessories >0){
			return " and tb_product.id_type_accessories = '".$id_type_accessories."' ";
		}
	}

	function check_id_category($id_category){
		if($id_category>0){
			return " and tb_product.id_category = '".$id_category."' ";
		}
	}


function dm_show($data){
	$num_1  = substr($data, -13,2);
	$num_2  = substr($data, -11,9);
	$num_3  = substr($data, -2,13);
	$dm      = $num_1."-".$num_2."-".$num_3;
	return $dm;
}

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

?>

<style type="text/css">
<!--
.style2 {font-size: 18px}
.style3 {
	font-size: 9px;
	font-weight: bold;
}
.style4 {font-size: 10px}
-->
</style>
<?php
	include "date.php";
?>
<table width="695" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <form method="post" action="report_all_brance.php?id_branch=<?php echo $_GET['id_branch']?>">
    <td  class="f10" colspan = "2">
	
			<input name="date_product_first" type="text" class="box" id="date_product_first" style=" width:80px"  value="<?php echo $_POST['date_product_first'];?>"/><a href="javascript:displayDatePicker('date_product_first')"><IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a>&nbsp;&nbsp;&nbsp;ถึง&nbsp;&nbsp;&nbsp;
		<input name="date_product_last" type="text" class="box" id="date_product_last" style=" width:80px"  value="<?php echo $_POST['date_product_last'];?>"/><a href="javascript:displayDatePicker('date_product_last')"><IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a>&nbsp;
		<input type="hidden" name="id_branch" value = "<?php echo $_GET['id_branch']?>">
		<input type="submit" value = "ค้นหาตามวันที่">
		
	</td></form>
    <td width="189" class="f10">&nbsp;</td>
    <td width="65" class="f14">&nbsp;</td>
    <td width="152" class="f14"><div align="center"></div></td>
    <td  class="f14" colspan = "2"><div align="center"><span class="abig style2"><strong>รายงานสาขา</strong></span></div></td>
    <td width="117" class="f14"><div align="center"></div></td>
    <td width="153" class="f14"><div align="center"></div></td>
    <td width="67" class="f14"><div align="right" class="f11">&nbsp;</div></td>
  </tr>
  <tr>
    <td class="f10" colspan = "2">&nbsp;</td>
    <td class="f10" align = "left">&nbsp;</td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
    <td class="f14">&nbsp;</td>
  </tr>
  <tr>
    <td class="f10" colspan = "2"><strong>&nbsp;</strong> </td>
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
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr height="50" bgcolor="#BBD8EC">
	  
      <td align="center" bgcolor="#BBD8EC" class="th">ลำดับ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">รหัสสินค้า</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">พิมพ์</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ขนาด</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">รูปแบบ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ลงยา</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">แผ่นปิดหลัง</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ซุ้ม</td>
      <td align="center" bgcolor="#BBD8EC" class="th">ฝังเพชร</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">น้ำหนัก</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">น้ำหนักรวมซิ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">น้ำหนักรวม</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ใบส่งของ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ราคาทอง</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ราคาสินค้า</td>

    </tr>

 <?php
	
if($_GET['p']!=""){
$i=((20*$_GET['p'])-20);
}else{
$i=0;
}



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
	<tr height="60" bgcolor="<?php echo $bgc?>" align="center" class="tb">
	<?php  }else{?>
	<tr height="60" bgcolor="#bcbcbc" align="center" >
    <?php }?>

      <td align="center"><?php echo $i;?></td>
	  
	  <td align="center"><?php echo $rs->code_product."<br>".$rs->name_type_accessories;?></td>
	  <td align="center"><?php echo $rs->name_category;?></td>
	 
	  <td align="center"><?php echo $rs->size;?></td>
	  <td align="center"><?php echo $rs->name_type_product?></td>
	  
	  <td align="center"><?php echo $rs->name_medicine;?></td>
	  <td align="center"><?php echo $rs->name_backmunk;?></td>
	  <td align="center"><?php echo fnc_soom($rs->soom,$rs->type);?></td>
	  <td align="center"><?php echo $rs->name_diamond;?></td>
	  <td align="center"><?php echo $rs->weight;?> กรัม </td>
	  <td align="center"><?php echo $rs->total_wage_si;?></td>
	  <td align="center"><?php echo $rs->total_wage;?></td>

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
	  
	   <td align="center"><?php echo number_format($rs->gold_price);?></td>
	   <td align="center"><?php echo number_format($rs->price);?></td>

    </tr>
<?php 
endforeach;
endif;?>

</table>