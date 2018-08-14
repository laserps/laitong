<?php
header ('Content-type: text/html; charset=utf-8'); 
header("Content-type: application/vnd.ms-excel");
//header('Content-type: application/csv'); //*** CSV ***//
header("Content-Disposition: attachment; filename=report_stock_onhand_".$_GET['name_stock'].".xls");
    require "../module/database.php";
	include "../system/product.php";
	$sys  = new product($db,$fnc);
	
	
	$row		= $sys->dataList($tbl,null,100000,"id_product","desc",$join.' where tb_product.id_stock = "'.$_GET['id_stock'].'"     and tb_product.total_product > "0" ',$_REQUEST['fiel_search'],$_REQUEST['key_search']);
	
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


function dm_show($data){
	$num_1  = substr($data, -13,2);
	$num_2  = substr($data, -11,9);
	$num_3  = substr($data, -2,13);
	$dm      = $num_1."-".$num_2."-".$num_3;
	return $dm;
}

function fnc_soom($soom){
		if($soom==1){
			return "ไม่ซุ้ม";
		}else{
			return "ยกซุ้ม";
		}
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
.style4 {font-size: 10px}
-->
</style>
<table width="695" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="124" class="f10" colspan = "2"><?php echo date("d/m/Y H:i:s");?></td>
    <td width="189" class="f10">&nbsp;</td>
    <td width="65" class="f14">&nbsp;</td>
    <td width="152" class="f14"><div align="center"></div></td>
    <td width="218" class="f14"><div align="center"><span class="abig style2"><strong>Stock </strong></span></div></td>
    <td width="143" class="f14"><div align="center"></div></td>
    <td width="117" class="f14"><div align="center"></div></td>
    <td width="153" class="f14"><div align="center"></div></td>
    <td width="67" class="f14"><div align="right" class="f11">&nbsp;</div></td>
  </tr>
  <tr>
    <td class="f10" colspan = "2"><strong class="f11">สต๊อก</strong> :</td>
    <td class="f10" align = "left"><?php echo $_GET['name_stock'];?></td>
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
<table width="895" border="1" cellspacing="0" cellpadding="0">
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
	  
	  <td align="center"><?php echo $rs->code_product;?></td>
	  <td align="center"><?php echo $rs->name_category;?></td>
	 
	  <td align="center"><?php echo $rs->size;?></td>
	  <td align="center"><?php echo $rs->name_type_product?></td>
	  
	  <td align="center"><?php echo $rs->name_medicine;?></td>
	  <td align="center"><?php echo $rs->name_backmunk;?></td>
	  <td align="center"><?php echo fnc_soom($rs->soom);?></td>
	  <td align="center"><?php echo $rs->name_diamond;?></td>
	  <td align="center"><?php echo $rs->weight;?> กรัม </td>
	  <td align="center"><?php echo $rs->total_wage_si;?></td>
	  <td align="center"><?php echo $rs->total_wage;?></td>

    </tr>
<?php 
endforeach;
endif;?>

</table>