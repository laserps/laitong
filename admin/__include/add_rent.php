<?php  

  if($_GET['id'] !=""){
	$rs = $sys->Update($tbl,$fiel_id,$_GET['id']);
	}

	if($_POST[id] != ""){
	unset($data['id_member']);
	$sys->Edit($data,$tbl,$page_admin,$fiel_id,$_POST['id'],null);
	}
	
	if(($_POST[save] == "news_add") and ($_GET[id] == "")){
	$sys->Add($data,$tbl,$page_admin,$fiel_check);
	}


$check_swf = substr($rs->pic,32,10);

include_once("editor/fckeditor.php");
include "date_picker.php";

$row_stock	  = $db->result("tb_stock",'level_stock = "2"', 'name_stock asc');
?>

<script type="text/javascript">
var objRequest = createRequestObject () ;
var t ="";
function timeMsg()
		{
		t=setTimeout("fnc_focus()",200);
		}


function fnc_focus(){
		document.getElementById('total_rent').focus();
		clearTimeout(t);
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


	document.onkeydown = checkKeycode
	function checkKeycode(e) {
		var keycode;
		 keycode = window.event.keyCode; // ใช้ IE

		 if(keycode == 13){
			post_product();
		 }
		 
		 if(keycode == 32){
			post_rent();
		 }
	
	}


function post_id_member()
{   
    var id = document.getElementById('number_member').value;
	var postBody = 'number_member=' + id;
	objRequest.open('POST', 'member.php?'+ Math.random(), true);
	objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	objRequest.onreadystatechange = handleResponse;
	objRequest.send(postBody);
}




function post_product()
{   
    var id = document.getElementById('dm_product').value;
	var id_stock_rent = document.getElementById('id_stock_check').value;
	var postBody = 'dm_product=' + id +'&id_stock_rent='+id_stock_rent;
	objRequest.open('POST', 'product.php?'+ Math.random(), true);
	objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	objRequest.onreadystatechange = handleResponse2;
	objRequest.send(postBody);
}

function post_rent()
{   
    var id_product = document.getElementById('id_product').value;
    var id_member  = document.getElementById('id_member').value;
	var id_rent    = document.getElementById('id_rent').value;
	var total_product = document.getElementById('total_product').value;
	var total_rent = document.getElementById('total_rent').value;
	var id_stock_rent = document.getElementById('id_stock_rent').value;
	
	

	if( isNaN(total_product) < isNaN(total_rent) ){
		alert(" จำนวนสินค้าไม่พอสำหรับยืม ");
		
        document.getElementById('dm_product').focus();
		document.getElementById('dm_product').value = "";
	}
	
	else if((id_product == "") || (total_product =="0") ){
		document.getElementById('dm_product').focus();
		alert("ไม่พบข้อมูลสินค้า");
		
	}
	else{
		var postBody = 'id_product=' + id_product+'&id_member='+id_member+'&id_rent='+id_rent+'&total_rent='+total_rent+'&id_stock_rent='+id_stock_rent;
		objRequest.open('POST', 'list_rent.php?'+ Math.random(), true);
		objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		objRequest.onreadystatechange = rent_show;
		objRequest.send(postBody);
	}
}

 function rent_show () {
	if (objRequest.readyState == 4 && objRequest.status ==200) {
		var data	=	objRequest.responseText;
		document.getElementById("rent_show_tb").innerHTML = data;
		document.getElementById("dm_product").value = "";
		document.getElementById("name_product").value = "";
		document.getElementById("name_type_product").value = "";
		document.getElementById("total_product").value = "";
		document.getElementById("total_rent").value = "";
		document.getElementById("id_product").value = "";
		document.getElementById("dm_product").focus();
		
	}


}

 function handleResponse () {
	 document.getElementById('dm_product').focus();
	if (objRequest.readyState == 4 && objRequest.status ==200) {
		var data	=	objRequest.responseText;
		document.getElementById("show").innerHTML = data;
	}
}

function handleResponse2 () {
	if (objRequest.readyState == 4 && objRequest.status ==200) {
		var data	=	objRequest.responseText;
		document.getElementById("product").innerHTML = data;
		timeMsg();
	}
}

function text_date() {
	if (objRequest.readyState == 4 && objRequest.status ==200) {
		var data	=	objRequest.responseText;
		document.getElementById("id_rent").value = data;
	}
}

function del_rent(id_rent_temp){
	var id_rent    = document.getElementById('id_rent').value;
	var postBody = 'id_rent=' + id_rent+'&id_rent_temp='+id_rent_temp;
	objRequest.open('POST', 'del_rent.php?'+ Math.random(), true);
	objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	objRequest.onreadystatechange = rent_show;
	objRequest.send(postBody);
}



function f_reset(){
     window.location.replace("main.php?op=rent&act=add");
}

</script>


<SCRIPT LANGUAGE="JavaScript">
<!--
	function fncprice(a){
if(a == 1){
document.getElementById('price').style.display = "";
document.getElementById('status').style.display = "";
}
else{
document.getElementById('price').style.display = "none";
document.getElementById('status').style.display = "none";
}
}
//-->
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
function fncinsert(){
alert("555555");
}
</SCRIPT>


<table width="100%" cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td height="40" align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th"><?=($_GET['id'])? 'แก้ไข' : 'เพิ่ม' ;?>การยืม</td>
        </tr></table></td>
    </tr>
    <tr>
        <td align="center">
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<input type="hidden" id="id_rent" value = "<?php echo date("Ymdhis");?>">

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="th2">
		<tr height="30" class="l">
			<td width="44%" align="left" bgcolor="#E7F1F8" id = "show">
				<table class="th2" cellpadding="5" border="0">
					<tr id = "price">
					  <td align="right" class="r">รหัสพนักงาน: </td>
					  <td><input name="number_member" type="text" class="box" id="number_member" style="border:dotted; border-color:#0000FF; width:150px"  value="<?=$rs->number_member;?>" onblur = "post_id_member();"/><img src="images/b_search.png" width="16" height="16" border="0" alt="">
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">ชื่อ-นามสกุล: </td>
					  <td><input name="firstname" type="text" class="box" id="firstname" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->firstname;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">ตำแหน่ง: </td>
					  <td><input name="name_position" type="text" class="box" id="name_position" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->name_position;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td>&nbsp;</td>
				  </tr>
				</table>
			</td>

			<td width="12%" bgcolor="#BBD8EC" align="center" class="th r">
			<input type="button" value="ยืม"  onclick = "post_rent();"><br>
			<input type="reset" value="Reset" onclick = "f_reset();">


			</td>
<script type="text/javascript">
<!--
function	fnc_id(a){
	document.getElementById('id_stock_check').value = a;
}
//-->
</script>
<input type="hidden" id="id_stock_check" >
<!-- form2//////////////////////////////////////////////// -->

<td width="44%" align="left" bgcolor="#E7F1F8" id = "product">
				<table class="th2" cellpadding="5" border="0">
					<tr id = "price">
					  <td align="right" class="r">#Barcode: </td>
					  <td><input name="dm_product" type="text" class="box" id="dm_product" style="border:dotted; border-color:#0000FF; width:150px"  value="<?=$rs->dm_product;?>" />
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">Product Code: </td>
					  <td><input name="name_product" type="text" class="box" id="name_product" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->code_product;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">Major Metal: </td>
					  <td><input name="name_type_product" type="text" class="box" id="name_type_product" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->name_type_product;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">ยืมไปสต๊อก: </td>
					  <td><select name="id_stock_rent" id  = "id_stock_rent" style = "width:200px;" onchange = "fnc_id(this.value);">
					        <option value = "0">เลือกสต๊อก</option>
							<?php if(!empty($row_stock)){
							foreach($row_stock as $rs_stock){	
							?>
							<option value="<?php echo  $rs_stock->id_stock?>" ><?php echo $rs_stock->name_stock;?></option>
							<?php }}?>
						</select>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">จำนวนในสต๊อก: </td>
					  <td><input name="total_product" type="text" class="box" id="total_product" style="border:dotted; border-color:#0000FF; width:80px"  value="<?=$rs->total_product;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">จำนวนยืม: </td>
					  <td><input name="total_rent" type="text" class="box" id="total_rent" style="border:dotted; border-color:#0000FF; width:80px"  value="<?=$rs->total_rent;?>"/>
				      </td>
					</tr>
		
					<tr>
						<input type="hidden" name="id_product" id = "id_product" value = "<?php echo $rs->id_product;?>">
					  <td align="right" class="r">&nbsp;</td>
					  <td>&nbsp;</td>
				  </tr>
				</table>
</tr>
</td>
</table>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->

   <table width="100%" cellspacing="0" cellpadding="1" border="0" >
 
    <tr>
        <td id = "rent_show_tb">
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
	  <td align="center" bgcolor="#BBD8EC" class="th">จำนวนยืม</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ลบ</td>
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
    <tr height="25" bgcolor="<?php echo $bgc?>" align="center" class="tb">
      <td align="center"><?php echo $i;?></td>
	  
	  <td align="center"><?php echo $total[$i];?></td>
	  <td align="center"><?php echo $qc_icon[$i]; ?></td>
	  
	  <td align="center"><?php echo $metal[$i]; ?></td>

	  <td align="center"><?php echo $qc[$i];?></td>
	  <td align="center"><?php echo $dm[$i];?></td>
	  <td align="center"><?php echo $date[$i];?></td>
	  <td align="center"><?php echo $unit_price[$i];?></td>
	  <td align="center"><?php echo $total[$i];?></td>
	  <td align="center">1</td>

	  <td align="center" bgcolor="<?php echo $bgc?>">
	  &nbsp; <a href="main.php?op=<?php echo $_GET[op];?>&act=list&amp;rd=<?php echo rand(1,99999); ?>&amp;del=<?php echo $rs->id_section?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf('<?php echo $rs->name_section;?>')" /></a> </td>

    </tr>
<?php 
endforeach;
endif;?>



</table>


    
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	  </td>
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
