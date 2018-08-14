<?php 
include '../module/class.database.php';
include '../module/class.func.php';
$sys = new Database();
$fnc = new func();

$data = array(
		"id_product"	=> trim($_POST['id_product']),
		"qty_invoice"	=> trim( $_POST['qty_invoice']),
		"invoice_no"	=> trim($_POST['invoice_no']),
		"name_customer"	=> trim($_POST['name_customer']),
		"surname_customer" => trim($_POST['surname_customer']),
		"id_branch"		=> $_POST['id_branch'],
		"gold_price"	=> $_POST['gold_price'],
		"price"			=> $_POST['price'],
		"date_invoice"	=> date("Y-m-d"),
		"percent_"		=> $_POST['percent_'],
		"wage_"	=> $_POST['total_wage']

);
$sys->insert("tb_invoice", $data);
$row = $sys->result("tb_invoice,tb_product"," tb_invoice.id_product = tb_product.id_product and  tb_invoice.invoice_no = '".$_POST['invoice_no']."' and tb_invoice.id_branch = '".$_POST['id_branch']."'   "," tb_invoice.id_invoice asc");

$rs_product = $sys->record("tb_product","id_product='".$_POST['id_product']."'");

//$total = $rs_product->total_product - $_POST['qty_invoice'];
$row_update_qty = array("total_product"=>"0");
$sys->update("tb_product", $row_update_qty, "id_product = '".$_POST['id_product']."' ");
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="th2">
	<FORM METHOD=POST onsubmit="return chkvalue(this)" enctype="multipart/form-data" ACTION="">
		<tr height="30" class="l">
			<td width="12%"  align="center" class="th r">
			
			<a href="../thumb/<?php echo $rs->picture_1_product?>" target  = "_blank"><img src="../img_product/<?php echo $rs->picture_1_product?>" id = "pic1"   border="0" alt=""></a>
			
			<br><br>

			 <a href="../thumb/<?php echo $rs->picture_2_product?>" target  = "_blank"><img src="../img_product/<?php echo $rs->picture_2_product?>" id = "pic2"  border="0" alt=""></a>

			</td>

			<td width="88%" align="left" bgcolor="#ccffcc">
				<table class="th2" cellpadding="5" border="0">

					<tr>
					  <td width = "15%" align = "right">
						Barcode#:</td><td><input  type="text" name="dm_product" id = "dm_product" style ="width:150px;" >
						<input type="hidden" name="id_product" id="id_product">
				      </td>
					</tr>
					

					

					<tr>
					  <td width = "15%" align = "right">&nbsp;</td><td><input type="text" name="total_product" style ="width:10px;" value = "1<?php echo $rs->total_product;?>" <?php if($rs->id_product !=""){ echo "readonly";}?>><br>
					  <input type="button" value="พิมพ์ใบส่งของ" onclick="window.location.replace('report_.php?invoice_no=<?php echo $_POST['invoice_no'];?>&id_branch=<?php echo $_POST['id_branch'];?>');">
				      </td>
					</tr>


					

			</table>
			</td>

			
		</tr>
	</form>
</table>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->

        </td>
    </tr>
    <tr>
        <td> </td>  
    </tr>


    <tr>
    <td height="40" align="center" bgcolor="#BBD8EC" class="th">

        </td>
    </tr>
</table>
<script type="text/javascript">
<!--
	document.getElementById('dm_product').focus();
//-->
</script>


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
	  <td align="center"><?php echo $rs->wage_; ?></td>
	  <td align="center"><?php echo $rs->gold_price; ?></td>
	  <td align="center"><?php echo $rs->price;?></td>
	  <td align="center"><img src="images/notification_error.png" width="16" height="16" border="0" alt="" style = "cursor:pointer;" onclick = "del_invoince(<?php echo $rs->id_product;?>);"></td>

    </tr>
<?php 
endforeach;
endif;?>


</table>