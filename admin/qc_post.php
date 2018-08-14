<?php
include '../module/class.database.php';
include '../module/class.func.php';
$sys = new Database();
$fnc = new func();



$data_update = array("status_qc"=>$_POST['status_qc'],"remark_qc"=>$_POST['remark_qc']);
$sys->update("tb_product",$data_update," id_product = '".$_POST['id_product']."'  ");


$sys->Pagelen = "50";
$cnt	=	$sys->countRow("tb_product", "  tb_product.id_category = '".$_POST['id_category']."' and tb_product.id_stock = '".$_POST['id_stock']."' and tb_product.stone_group_id = '".$_POST['stone_group_id']."' ");
$limit  =   $sys->countRowPage($cnt);

$row = $sys->result("tb_product,tb_type_product,tb_stock","   tb_type_product.id_type_product = tb_product.id_type_product and  tb_stock.id_stock = tb_product.id_stock and tb_product.id_category = '".$_POST['id_category']."' and tb_product.id_stock = '".$_POST['id_stock']."' and tb_product.stone_group_id = '".$_POST['stone_group_id']."'  "," tb_product.status_qc desc,tb_product.product_id_re asc ",$limit);


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

	function check_bg($status_qc){
		if($status_qc!="0"){
			return '#66ff66';
		}

	}
?>


<table width="100%" cellspacing="0" cellpadding="1" border="0" >

	<FORM name="myForm" METHOD="POST" ACTION="">
    <tr>
        <td>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  
      <td align="center" bgcolor="#BBD8EC" class="th">ลำดับ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Prod.Code</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Description</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Metal</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">PO#</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">DM#</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Inven Date</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Unit Price($)</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Total Cost($)</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Qty Bal</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">สถานะ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Remark</td>
    </tr>
    <?php
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
    <tr height="25" bgcolor="<?php echo check_bg($rs->status_qc);?>" align="center" class="tb">
      <td align="center"><?php echo $i;?></td>
	  
	  <td align="center"><?php echo $rs->code_product;?></td>
	  <td align="center"><?php echo $rs->description; ?></td>
	  
	  <td align="center"><?php echo $rs->num_type_product; ?></td>

	  <td align="center"><?php echo $rs->po_product;?></td>
	  <td align="center"><?php echo $rs->dm_product;?></td>
	  <td align="center"><?php echo $rs->date_product;?></td>
	  <td align="center"><?php echo $rs->unit_price;?></td>
	  <td align="center"><?php echo $rs->total_cost_product;?></td>
	  <td align="center"><?php echo $rs->total_product;?></td>
	  <td align="center"><?php echo check_status_qc($rs->status_qc);?></td>
	  <td align="center"><?php echo $rs->remark_qc;?></td>
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
        <td><? echo $sys->render('main.php?op=qc&act=add&id='.$_GET['id'].'&id_stock='.$_GET['id_stock'].'&'); ?></td>
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