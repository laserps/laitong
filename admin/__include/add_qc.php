<?php  
/*
	if($_POST['id'] != ""){
		$sys->Edit($data,$tbl,$page_admin,$fiel_id,$_POST['id']);
	}


	if($_GET['id'] !=""){
		$rs = $sys->Update($tbl,$fiel_id,$_GET['id']);
	}


	if(($_POST['save'] == "news_add") and ($_GET['id'] == "")){
		unset($_POST['save']);
		$sys->Add($data,$tbl,$page_admin);
	}

	echo $fnc->form_check($message_alert);
*/

if($_GET['stone_group_id'] !=""){
$_SESSION['stone_group_id'] = $_GET['stone_group_id'];
}

$db->Pagelen = "50";
$cnt	=	$db->countRow("tb_product", "  tb_product.id_category = '".$_GET['id']."'  and tb_product.id_stock = '".$_SESSION['id_stock']."' ");
$limit  =   $db->countRowPage($cnt);


$row = $db->result("tb_product,tb_category,tb_stock","   
tb_category.id_category = tb_product.id_category 
and  tb_stock.id_stock = tb_product.id_stock 
and tb_product.id_category = '".$_GET['id']."' 
and tb_product.total_product > '0'
and tb_product.id_stock = '".$_SESSION['id_stock']."'  "," tb_product.status_qc 

 desc ",$limit);


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

$rs_category = $db->record('tb_category', 'id_category = "'.$_GET['id'].'"');

$rs_stock = $db->record('tb_stock', 'id_stock = "'.$_GET['id_stock'].'"');

function fnc_soom($soom){
		if($soom==1){
			return "ไม่ซุ้ม";
		}else{
			return "ยกซุ้ม";
		}
	}
?>

<SCRIPT LANGUAGE="JavaScript">
	var t ="";
	var objRequest = createRequestObject () ;

	function timeMsg()
		{
			
		var keycode;
		var status_qc = document.getElementById('status_qc').value;

		if (window.event) keycode = window.event.keyCode; // ใช้ IE
			if((keycode=="13") && (status_qc == "n") ){
				t=setTimeout("fnc_p()",800);
			}

		}

	document.onkeydown = checkKeycode


	function checkKeycode(e) {
		var keycode;
		var dm_product = document.getElementById('dm_product').value;

		if (window.event) keycode = window.event.keyCode; // ใช้ IE
			
	
			if( (keycode=="13") && (dm_product != "") ){
				fnc_post_save();
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
				var dm_product = document.getElementById('dm_product').value;
				var id_stock = document.getElementById('id_stock').value;
				var id_category = document.getElementById('id_category').value;
				if(dm_product != ""){
				var postBody =   'dm_product=' + dm_product+'&id_stock='+id_stock+'&id_category='+id_category;
				objRequest.open('POST', 'qc_add.php?'+ Math.random(), true);
				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_r;
				objRequest.send(postBody);
				}
				}

				function fnc_p_sum()
					{
				clearTimeout(t);
				var dm_product = document.getElementById('dm_product').value;
				var id_stock = document.getElementById('id_stock').value;
				var id_category = document.getElementById('id_category').value;

				var postBody =   'dm_product=' + dm_product+'&stone_group_id='+stone_group_id+'&id_stock='+id_stock+'&id_category='+id_category;
				objRequest.open('POST', 'qc_alert_sum.php?'+ Math.random(), true);
				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_r_sum;
				objRequest.send(postBody);
				}

				function fnc_post_save()
					{
				var id_product = document.getElementById('id_product').value;		
				var status_qc = document.getElementById('status_qc').value;
				var remark_qc = document.getElementById('remark_qc').value;
				var id_stock  = document.getElementById('id_stock').value;
				var stone_group_id = document.getElementById('stone_group_id').value;
				var id_category  = document.getElementById('id_category').value;
				
			    
				var postBody =   'id_product='+id_product+'&status_qc='+status_qc+'&remark_qc='+remark_qc+'&id_stock='+id_stock+'&id_category='+id_category+'&stone_group_id='+stone_group_id;
				objRequest.open('POST', 'qc_post.php?'+ Math.random(), true);
				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				
				objRequest.onreadystatechange = fnc_save_r;
				objRequest.send(postBody);
	
				}

				function fnc_r() {
					if (objRequest.readyState == 4 && objRequest.status ==200) {
						
						var data	=	objRequest.responseText;
						if(data == "1"){
						 alert("สินค้าไม่ตรงสต๊อกกรุณาตรวจสอบสินค้า");
						}
						else if(data == "2"){
						 alert("สินค้านี้ตรวจสอบแล้ว");
						 fnc_p_sum();
						 
						}
						else{
						document.getElementById('form').innerHTML = data;
						}
						}
				}

				function fnc_r_sum() {
					if (objRequest.readyState == 4 && objRequest.status ==200) {
						var data	=	objRequest.responseText;
						document.getElementById('form').innerHTML = data;
						}
				}


			function fnc_save_r() {
				if (objRequest.readyState == 4 && objRequest.status ==200) {
			    window.location.replace("main.php?op=qc&act=add&id=<?php echo $_GET['id'];?>");
				//var data = objRequest.responseText;document.getElementById('list_order').innerHTML = data;
			    //t=setTimeout("fnc_focus_refresh()",50);

				}
			}

			function fnc_focus_refresh(){
				    clearTimeout(t);
					document.getElementById('dm_product').focus();
					document.getElementById('dm_product').value = "";
					
				}


				
</script>

<script>
  $(document).ready(function () {
	document.getElementById('dm_product').focus();
	});
  </script>

<?php if(($_SESSION[id_division]=="1") or ($_SESSION[id_division]=="3")){?>
<table width="100%" cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td height="40" align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">ตรวจสอบสินค้า <?php echo $rs_category->name_category?><span style = "color:#ff0000"><?php //echo $_SESSION['name_stock'];?></span></td>
        </tr></table></td>
    </tr>
    <tr>
        <td align="center">
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div id = "form">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="th2">
		<tr height="30" class="l">
			<td width="12%"  align="center" class="th r">
			<img src="" width="150"  border="0" alt="">
			</td>

			<td width="88%" align="left" bgcolor="#ccffcc">
				<table class="th2" cellpadding="5" border="0" height = "50">

					
					<input type="hidden" name="status_qc" id = "status_qc" value = "n">
					<tr>
					  <td width = "15%" align = "right">
						Barcode#:</td><td><input  type="text" name="dm_product" id = "dm_product" style ="width:150px;" onkeyup = "timeMsg();">
				      </td>
					</tr>

					<input type="hidden" name="id_product" id = "id_product" value = "<?php echo $rs->id_product;?>">
					<input type="hidden" id="id_stock" value = "<?php echo $_SESSION['id_stock'];?>">
					<input type="hidden" id="id_category" value = "<?php echo $_GET['id'];?>">
				</table>


			</td>
		</tr>

        </td>
    </tr>

</div>
  
<tr>
<td>
&nbsp;
</td>
<td>
<?php }?>
<div id = "list_order">
<table width="100%" cellspacing="0" cellpadding="1" border="0" >

	<FORM name="myForm" METHOD="POST" ACTION="">
    <tr>
        <td>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr height="30" bgcolor="#BBD8EC">
	  
      <td align="center" bgcolor="#BBD8EC" class="th">ลำดับ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">รหัสสินค้า</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Barcode</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ขนาด</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">น้ำหนัก</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">น้ำหนักรวมซิ</td>
	   <td align="center" bgcolor="#BBD8EC" class="th">ค่าแรง</td>


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
	  <td align="center"><?php echo $rs->barcode_product;?></td>
	  <td align="center"><?php echo $rs->size;?></td>
	  <td align="center"><?php echo $rs->weight;?> กรัม </td>
	  <td align="center"><?php echo $rs->total_wage_si;?></td>
	  <td align="center"><?php echo $rs->total_wage;?></td>

	  <td align="center"><?php echo check_status_qc($rs->status_qc);?></td>
	  <td align="center"><?php echo $rs->remark_qc;?></td>
    </tr>
<?php 
endforeach;
endif;?>

</table>

	  </td>
    </tr>


	<tr>
        <td><? echo $db->render('main.php?op=qc&act=add&id='.$_GET['id'].'&id_stock='.$_GET['id_stock'].'&'); ?></td>
    </tr>
</table>


</div>
</td></tr></table>