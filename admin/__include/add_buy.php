<?php  
	

	if($_GET['img_'] !=""){
			unlink("../img_product/".$_GET['img_']."");
			unlink("../thumb/".$_GET['img_']."");
			$data_update1 = array("picture_1_product"=>"");
			$db->update(''.$tbl.'', $data_update1, array(''.$fiel_id.'' => $_GET['id']));
			
			echo '<script type="text/javascript">
			<!--
				window.location.reload("?op=product&act=add&rd='.rand(1,99999).'&id='.$_GET['id'].'");
			//-->
			</script>';
		}

	if($_GET['img_2'] !=""){
			unlink("../img_product/".$_GET['img_2']."");
			unlink("../thumb/".$_GET['img_2']."");
			$data_update1 = array("picture_2_product"=>"");
			$db->update(''.$tbl.'', $data_update1, array(''.$fiel_id.'' => $_GET['id']));
			
			echo '<script type="text/javascript">
			<!--
				window.location.reload("?op=product&act=add&rd='.rand(1,99999).'&id='.$_GET['id'].'");
			//-->
			</script>';
		}



	if($_POST['id'] != ""){
		$sys->Edit($data,$tbl,"main.php?op=product&act=add&rd=62573&id=".$_GET['id']."",$fiel_id,$_POST['id']);
	}


	if($_GET['id'] !=""){
		
		

		/*$rs = $sys->Update($tbl,$fiel_id,$_GET['id']);
		
		$rs_back = $db->record("tb_product", " product_id_re<='".$rs->product_id_re."' and id_product < '".$rs->id_product."'  order by product_id_re desc ");
		$rs_next = $db->record("tb_product", " product_id_re>='".$rs->product_id_re."' and id_product > '".$rs->id_product."'  order by product_id_re asc ");
		*/

	}


	if(($_POST['save'] == "news_add") and ($_GET['id'] == "")){
		unset($_POST['save']);
		$sys->Add($data,$tbl,$page_admin);
	}

	//echo $fnc->form_check($message_alert);


include "date.php";

$row_category = $db->result("tb_category",NULL, 'id_category asc');
$row_type	  = $db->result("tb_type_product",NULL, 'name_type_product asc');
$row_stock	  = $db->result("tb_stock",'level_stock = "1"', 'id_stock asc');

function check_status($id,$text){
	if($id!=""){
		return $text;
	}
}

    //$file_ = file_get_contents('http://www.goldtraders.or.th/');
    $num1 = explode('span',$file_);
	$num1_n = explode('id="DetailPlace_uc_goldprices1_lblBLSell">',$num1[13]);

	//echo "Gold Export  ".strip_tags($num1_n[1])." B ";
	$gold_export = str_replace("</", "", $num1_n[1]);

	$gold_ = strip_tags($num1_n[1]);

	//echo trim($gold_)."<br>";

	$patterns = array();
	$patterns[0] = '/,/';
	$patterns[1] = '/.00/';
	$replacements = array();
	$replacements[1] = '';
	$replacements[0] = '';

$gold__ =  (int)preg_replace($patterns, $replacements, $gold_);
//echo $gold__;
?>


<SCRIPT LANGUAGE="JavaScript">
	var t ="";
	var objRequest = createRequestObject () ;


	document.onkeydown = checkKeycode
	function checkKeycode(e) {
		var id_product = document.getElementById('id_product').value; 
		var keycode;
		 keycode = window.event.keyCode; // ใช้ IE
		 //alert(keycode);

		 if( (keycode == 13) && (id_product=="") ){
			fnc_p();
		 }
		 
		 if( (keycode == 13) && (id_product!="") ){
			fnc_post_save();
		 }

		 if(keycode == 27){
			cancel_product();
		 }
	
	}


	


	function createRequestObject () {
					var objTemp = false ;
					if (window.XMLHttpRequest) {
					objTemp = new XMLHttpRequest () ;
					}else if (window.ActiveXObject) {
					objTemp = new ActiveXObject ("Microsoft.XMLHTTP") ;	
					}
					return objTemp ;
				}
				
				function fnc_p()
					{
					clearTimeout(t);
					
					var id_branch = document.getElementById('id_branch').value;
					
					var dm_product = document.getElementById('dm_product').value;
					var invoice_no = document.getElementById('invoice_no').value;
					var status_branch = document.getElementById('status_branch').value;

					var postBody =   'dm_product='+dm_product+'&id_branch='+id_branch+'&invoice_no='+invoice_no+'&status_branch='+status_branch;
					
					if( (dm_product !="") && (!isNaN(document.getElementById('dm_product').value)) && (id_branch != 0) )  {
						document.getElementById("loading").style.display = "";
						objRequest.open('POST', 'invoice_add.php?'+ Math.random(), true);
						objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
						objRequest.onreadystatechange = fnc_r;
						objRequest.send(postBody);
					}else{
						alert("ข้อมูลไม่สามารถอ่านได้กรุณากด F5 หรือเปลี่ยน Font เป็น ENG หรืออาจยังไม่เลือก สาขา");
						document.getElementById('dm_product').value = "";
						document.getElementById('dm_product').focus();
					}
				}

				function re_gold(){
					clearTimeout(t);
					var gold_text_re = document.getElementById('gold_text_re').value;
					var id_branch = document.getElementById('id_branch').value;
					
					var dm_product = document.getElementById('dm_product').value;
					var invoice_no = document.getElementById('invoice_no').value;
					var status_branch = document.getElementById('status_branch').value;
					var percent_     = document.getElementById('percent_').value;
					var postBody =   'dm_product='+dm_product+'&id_branch='+id_branch+'&invoice_no='+invoice_no+'&status_branch='+status_branch+'&gold_text_re='+gold_text_re;
					
					if( (dm_product !="") && (!isNaN(document.getElementById('dm_product').value)) && (id_branch != 0) )  {
						document.getElementById("loading").style.display = "";
						objRequest.open('POST', 'invoice_add.php?'+ Math.random(), true);
						objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
						objRequest.onreadystatechange = fnc_r;
						objRequest.send(postBody);
					}else{
						alert("ข้อมูลไม่สามารถอ่านได้กรุณากด F5 หรือเปลี่ยน Font เป็น ENG หรืออาจยังไม่เลือก สาขา");
						document.getElementById('dm_product').value = "";
						document.getElementById('dm_product').focus();
					}
				}

				function re_percent(){
					clearTimeout(t);
					var gold_text_re = document.getElementById('gold_text_re').value;
					var id_branch = document.getElementById('id_branch').value;
					
					var dm_product = document.getElementById('dm_product').value;
					var invoice_no = document.getElementById('invoice_no').value;
					var status_branch = document.getElementById('status_branch').value;
					var percent_     = document.getElementById('percent_').value;
					var postBody =   'dm_product='+dm_product+'&id_branch='+id_branch+'&invoice_no='+invoice_no+'&status_branch='+status_branch+'&gold_text_re='+gold_text_re+'&percent_='+percent_;
					
					if( (dm_product !="") && (!isNaN(document.getElementById('dm_product').value)) && (id_branch != 0) )  {
						document.getElementById("loading").style.display = "";
						objRequest.open('POST', 'invoice_add.php?'+ Math.random(), true);
						objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
						objRequest.onreadystatechange = fnc_r;
						objRequest.send(postBody);
					}else{
						alert("ข้อมูลไม่สามารถอ่านได้กรุณากด F5 หรือเปลี่ยน Font เป็น ENG หรืออาจยังไม่เลือก สาขา");
						document.getElementById('dm_product').value = "";
						document.getElementById('dm_product').focus();
					}
				}

				function fnc_post_save()
					{
				var invoice_no = document.getElementById('invoice_no').value;
				var name_customer = "";
				var surname_customer = "";
				var dm_product = document.getElementById('dm_product').value;
				var qty_invoice = document.getElementById('qty_invoice').value;
				var id_product = document.getElementById('id_product').value;
				var total_product = document.getElementById('total_product').value;
				
				var id_branch   = document.getElementById('id_branch').value;
				var gold_price  = document.getElementById('gold').value;
				var price       = document.getElementById('price').value;

				var percent_     = document.getElementById('percent_').value;

				var total_wage   = document.getElementById('total_wage').value;

				if(invoice_no==""){
					alert("กรุณากรอก Invoince No ด้วยครับ");
					document.getElementById('invoice_no').focus();
				}
				
				else if(total_product<qty_invoice){
					alert("สินค้าขายออกแล้ว");
					window.location.replace("main.php?op=buy&act=list");
				}
				else if(qty_invoice<1){
					alert("ข้อมูลไม่ถูกต้องกรุณากรอกใหม่");
					//document.getElementById('qty_invoice').focus();
					window.location.replace("main.php?op=buy&act=list&rd=45398&id="+invoice_no+"&name_customer="+name_customer+"&surname_customer="+surname_customer);
				}
				else{
				
				var postBody =   
					'dm_product=' + dm_product +
					'&invoice_no='+ invoice_no +
					'&name_customer='+name_customer+
					'&qty_invoice='+qty_invoice+
					'&id_product='+id_product+
					'&surname_customer='+surname_customer+
					'&id_branch='+id_branch+
					'&gold_price='+gold_price+
					'&price='+price+
				    '&percent_='+percent_+
					'&total_wage='+total_wage
				;
				objRequest.open('POST', 'invoice_post.php?'+ Math.random(), true);
				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_save_r;
				objRequest.send(postBody);
				}
				}

			function cancel_product(){
				
				document.getElementById("loading").style.display = "";
				var invoice_no = document.getElementById('invoice_no').value;
				var id_branch   = document.getElementById('id_branch').value;

				var postBody =   'invoice_no='+invoice_no+'&id_branch='+id_branch;
				objRequest.open('POST', 'cancel_product.php?'+ Math.random(), true);
				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_r_cancel;
				objRequest.send(postBody);

			}

			function del_invoince(id_product){
				var id_branch   = document.getElementById('id_branch').value;
				var invoice_no = document.getElementById('invoice_no').value;
				
				 if (confirm("ยืนยันการลบข้อมูล  ") ==true) {
                 var postBody =   'invoice_no='+invoice_no+'&id_product='+id_product+'&id_branch='+id_branch;
					objRequest.open('POST', 'delete_product.php?'+ Math.random(), true);
					objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					objRequest.onreadystatechange = fnc_r_cancel;
					objRequest.send(postBody);
                  }else{
					return false;
                  }

				

			}

				function fnc_r() {
					if (objRequest.readyState == 4 && objRequest.status ==200) {
						document.getElementById("loading").style.display = "none";
						var data	=	objRequest.responseText;document.getElementById('form').innerHTML = data;
						t=setTimeout("fnc_focus_qty()",50);
						}
				}

				function fnc_r_cancel() {
					if (objRequest.readyState == 4 && objRequest.status ==200) {
						document.getElementById("loading").style.display = "none";
						var data	=	objRequest.responseText;document.getElementById('form').innerHTML = data;
						t=setTimeout("fnc_focus_refresh()",50);
						}
				}


			function fnc_save_r() {
				if (objRequest.readyState == 4 && objRequest.status ==200) {
			    var data = objRequest.responseText;document.getElementById('form').innerHTML = data;
			    t=setTimeout("fnc_focus_refresh()",50);
				}
			}

			function fnc_focus_refresh(){
					document.getElementById('dm_product').focus();
					clearTimeout(t);
				}


			function fnc_focus_qty(){
					//document.getElementById('qty_invoice').focus();
					clearTimeout(t);
				}
</script>

<script type="text/javascript">
		<!--
			function fnc_branch_invoince(id_branch){
				window.location.replace("main.php?op=buy&act=list&id_branch="+id_branch+"");
			}
		//-->
		</script>

<?php
	
	
	

	if($_GET['id_branch'] == "0"){
		$_SESSION['invoice_no'] = "";
		$_SESSION['id_branch'] = 0;
	}


	if($_GET['id_branch'] > 0){
		$rs_branch = $db->record("tb_branch","id_branch = '".$_GET['id_branch']."'");
		$row_inv   = $db->result("tb_invoice where id_branch = '".$_GET['id_branch']."' group by invoice_no");
		$count_r   = count($row_inv)+1;
		
		if($count_r<5){
			$c=1;
			if(!empty($row_inv)){
				foreach($row_inv as $rs_count){
					$c++;
					
				}	
			}
		$num_last  = $fnc->number_pad($c,10,"left"); 
		}
		if($count_r>=5){
		$num_last  = $fnc->number_pad($count_r,10,"left"); 
		}


		$_SESSION['id_branch']		= $rs_branch->id_branch;
		$_SESSION['status_branch']	= $rs_branch->status_branch;
		$_SESSION['num_branch'] = $rs_branch->num_branch;
		$_SESSION['invoice_no'] = $num_last;
	}
	if($_GET['id'] != ""){
		$_SESSION['invoice_no'] = $_GET['id'];
	}

?>

<input type="hidden" name="invoice_no" id = "invoice_no" value = "<?php echo $_SESSION['invoice_no'];?>">

<input type="hidden" id="si_diamond" value = "0">&nbsp;&nbsp;<input type="hidden" id="wage_diamond" value = "0">

<input type="hidden" id="si_backmunk" value = "0">&nbsp;&nbsp;<input type="hidden" id="wage_backmunk" value = "0">

<input type="hidden" id="si_type_product" value = "0">&nbsp;&nbsp;<input type="hidden" id="wage_type_product" value = "0">

<input type="hidden" id="si_medicine" value = "0">&nbsp;&nbsp;<input type="hidden" id="wage_medicine" value = "0">

<input type="hidden" id="si_special" value = "0">&nbsp;&nbsp;<input type="hidden" id="wage_special" value = "0">

<input type="hidden" name="wage_diamond_sum" id = "wage_diamond_sum" value = "0">

<input type="hidden" name="status_branch" id = "status_branch" value = "<?php echo $_SESSION['status_branch'];?>">

<input type="hidden" id="type_">

<div style = "position:absolute; display:none; left:500px;" id = "loading">
	<img src="images/loading.gif"  border="0" alt="">
</div>

<table width="100%" cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td height="40" align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">		  
			ออกบิลส่งของ รหัสบิล <span style = "color:#ff0000"><?php echo $_SESSION['num_branch']." ".$_SESSION['invoice_no'];?></span>			
		  </td>
        </tr></table></td>
    </tr>

	<tr>

		<td>
		<?php
			//echo $_SESSION['invoice_no'];
			$rs_br  = $db->record("tb_invoice,tb_branch"," tb_invoice.invoice_no = '".$_SESSION['invoice_no']."' and tb_invoice.id_branch = tb_branch.id_branch ");
			
			$row_branch = $db->result("tb_branch"," id_branch >1 "," id_branch asc ");

			
		?>
		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สาขา:
	
		<select name="id_branch" id = "id_branch" onchange = "fnc_branch_invoince(this.value);">
			<option value = "0">เลือกสาขา</option>
			<?php foreach($row_branch as $rs_branch){?>
			<option value="<?php echo $rs_branch->id_branch?>" <?php echo $fnc->selected($rs_branch->id_branch,$_SESSION['id_branch']);?>><?php echo $rs_branch->name_branch?></option>
			<?php }?>
		</select>
	
						
	    </td>
	</tr>


    <tr>
        <td align="center" id = "form">
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="th2">
	<FORM METHOD=POST onsubmit="return chkvalue(this)" enctype="multipart/form-data" ACTION="">
		<tr height="30" class="l">
		

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
					  <?php if($_SESSION['invoice_no'] !=""){?>
					  <input type="button" value="พิมพ์ใบส่งของ" onclick="window.location.replace('report_.php?invoice_no=<?php echo $_SESSION['invoice_no'];?>&id_branch=<?php echo $_SESSION['id_branch'];?>');">
					  <?php }?>
				      </td>
					</tr>


					

			</table>
	

			<?php
$row = $sys->db->result("tb_invoice,tb_product"," tb_invoice.id_product = tb_product.id_product and  tb_invoice.invoice_no = '".$_SESSION['invoice_no']."' and id_branch = '".$_SESSION['id_branch']."'  "," tb_invoice.id_invoice asc");
?>
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



			</td>

			
		</tr>
	</form>
</table>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->

        </td>
    </tr>




</table>
<script type="text/javascript">
<!--
	document.getElementById('dm_product').focus();
	
//-->
</script>


