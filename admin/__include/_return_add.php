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
?>

<script type="text/javascript">
var id_member = "";
var status_product = "";
var objRequest = createRequestObject () ;
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
			post_return();
		 }
	
	}

function post_id_member()
{   
    var id = document.getElementById('id_member').value;
	var postBody = 'id_member=' + id;
	objRequest.open('POST', 'member_return.php?'+ Math.random(), true);
	objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	objRequest.onreadystatechange = handleResponse;
	objRequest.send(postBody);
}

function handleResponse () {
	if (objRequest.readyState == 4 && objRequest.status ==200) {
		var data	=	objRequest.responseText;
		document.getElementById("show").innerHTML = data;
	}
}


function post_product()
{   
	var id_rent  = document.getElementById('id_rent').value;
    var dm_product = document.getElementById('dm_product').value;
	var postBody = 'dm_product=' + dm_product+'&id_rent='+id_rent;
	objRequest.open('POST', 'product_return.php?'+ Math.random(), true);
	objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	objRequest.onreadystatechange = handleResponse2;
	objRequest.send(postBody);
}


function handleResponse2 () {
	if (objRequest.readyState == 4 && objRequest.status ==200) {
		var data	=	objRequest.responseText;
		
		
		if(data == "1"){
			alert("คุณได้คืนสินค้านี้เรียบร้อยแล้วค่ะ");
			document.getElementById('dm_product').value = "";
			document.getElementById('dm_product').focus();
		}else{
		document.getElementById("product").innerHTML = data;
		id_member = document.getElementById('id_member').value;
		
		
		//post_id_member();
		/*if(status_product==1){
		  
		
		}else{
          f_reset();
		  alert("โครงงานนี้คืนเรียบร้อยแล้วค่ะ");
		}*/
		}

	}
}


function post_return()
{   
    var id_product = document.getElementById('id_product').value;
	var id_rent  = document.getElementById('id_rent').value;
	var id_member = document.getElementById('id_member').value;
	var total_return = document.getElementById('total_return').value;

	

	var a = document.getElementById('id_stock').value; 
	var b = document.getElementById('test'+a+'').value;
	var total_return = document.getElementById('total_return').value;
	//alert(id_rent);
   
    if(total_return > b){

	   alert("คืนเกินจำนวนยืม");
	}else{

		//alert(id_rent);
	var postBody = 'id_product=' + id_product+'&id_rent='+id_rent+'&id_member='+id_member+'&total_return='+total_return+'&id_stock='+a;
	objRequest.open('POST', 'list_return.php?'+ Math.random(), true);
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
		document.getElementById("code_product").value = "";
		document.getElementById("name_type_product").value = "";
		//document.getElementById("date_rent_temp").value = "";
		//document.getElementById("total_rent").value = "";
		document.getElementById("total_return").value = "";
		document.getElementById("id_product").value = "";
		document.getElementById("id_member").value = "";
		document.getElementById("dm_product").focus();

		//status_product = document.getElementById('status_product').value;
		if(status_product==1){
		  //post_id_member();
		}
	}
	
}

 function handleResponse () {
	if (objRequest.readyState == 4 && objRequest.status ==200) {
		var data	=	objRequest.responseText;
		document.getElementById("show").innerHTML = data;
	}
}



function text_date() {
	if (objRequest.readyState == 4 && objRequest.status ==200) {
		var data	=	objRequest.responseText;
		document.getElementById("id_rent").value = data;
	}
}



function f_reset(){
		window.location.replace("?op=_return&act=add");
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
          <td bgcolor="#BBD8EC" align="center" height="40" class="th"><?=($_GET['id'])? 'แก้ไข' : '' ;?>คืนสินค้า</td>
        </tr></table></td>
    </tr>
    <tr>
        <td align="center">
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


<table width="100%" border="0" cellpadding="0" cellspacing="0" class="th2">

		<tr height="30" class="l">
		<td width="44%" align="left" bgcolor="#E7F1F8" id = "product">
		<input type="hidden" id="id_rent" value = "<?php echo date("Ymdhis");?>">
				<table class="th2" cellpadding="5" border="0">
					<tr id = "price">
					  <td align="right" class="r">Barcode#: </td>
					  <td><input name="dm_product" type="text" class="box" id="dm_product" style="border:dotted; border-color:#0000FF; width:150px"  value="<?=$rs->dm_product;?>" /><!-- <img src="images/b_search.png" width="16" height="16" border="0" alt=""> -->
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						Dm#:</td><td><input  type="text" name="dm_product_t" id = "dm_product_t" style ="border:dotted; border-color:#0000FF; width:150px;" value = "<?php echo $rs->dm_product?>">&nbsp;&nbsp;
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">Product Code: </td>
					  <td><input name="code_product" type="text" class="box" id="code_product" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->name_product_thai;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">Major Metal: </td>
					  <td><input name="name_type_product" type="text" class="box" id="name_type_product" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->name_type_product;?>"/>
				      </td>
					</tr>
					
					<tr>
					  <td align="right" class="r">ยืมเมื่อ: </td>
					  <td><input name="date_rent_temp" type="text" class="box" id="date_rent_temp" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->date_rent_temp;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">จำนวนยืม: </td>
					  <td><input name="total_rent" type="text" class="box" id="total_rent" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->total_rent;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">จำนวนคืน: </td>
					  <td><input name="total_return" type="text" class="box" id="total_return" style="border:dotted; border-color:#0000FF; width:200px"  value="1"/>
				      </td>
					</tr>

					

		
					<tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td>&nbsp;</td>
				  </tr>
				</table>
			</td>

           <td width="12%" bgcolor="#E7F1F8" align="center" class="th r">
			<!-- <input type="button" value="คืน"  onclick = "post_return();"><br> -->
			<input type="reset" value="Reset" onclick = "f_reset();">

			</td>

			<td width="44%" align="left" bgcolor="#E7F1F8" id = "show">
				<!-- <table class="th2" cellpadding="5" border="0">
					<tr id = "price">
					  <td align="right" class="r">รหัสพนักงาน: </td>
					  <td><input name="number_member" type="text" class="box" id="number_member" style="border:dotted; border-color:#0000FF; width:150px"  value="<?=$rs->number_member;?>" readonly/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">ชื่อ-นามสกุล: </td>
					  <td><input name="firstname" type="text" class="box" id="firstname" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->firstname;?>" readonly/>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">ตำแหน่ง: </td>
					  <td><input name="name_position" type="text" class="box" id="name_position" style="border:dotted; border-color:#0000FF; width:200px"  value="<?=$rs->name_position;?>" readonly/>
				      </td>
					</tr>

				
					<tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td>&nbsp;</td>
				  </tr>

				  <tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td>&nbsp;</td>
				  </tr>

			
		
		
					<tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td>&nbsp;</td>
				  </tr>
				</table> -->
			</td> 

			





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
	  <td align="center" bgcolor="#BBD8EC" class="th">จำนวนคืน</td>
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
	  <td align="center">&nbsp;</td>

	  <!-- <td align="center" bgcolor="<?php echo $bgc?>">
	  &nbsp; <a href="main.php?op=<?php echo $_GET[op];?>&act=list&amp;rd=<?php echo rand(1,99999); ?>&amp;del=<?php echo $rs->id_section?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf('<?php echo $rs->name_section;?>')" /></a> </td> -->

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
