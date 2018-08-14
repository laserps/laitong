<?php  



	if($_GET['id_product'] !=""){
		$rs = $sys->Update("tb_product","id_product",$_GET['id_product']);

	}


	if(($_POST['save'] == "news_add") and ($_POST['id_product'] != "")){
		unset($_POST['save']);
		$sys->Add($data,$_POST['id_product'],$tbl,$page_admin);
	}

	echo $fnc->form_check($message_alert);

?>

<script language = "JavaScript">
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
				
	function fnc_post_barcode_product(){
		var barcode_product = document.getElementById('barcode_product').value;
		var postBody =   'barcode_product=' +barcode_product;
		objRequest.open('POST', 'product_search.php?'+ Math.random(), true);
		objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		objRequest.onreadystatechange = fnc_show_search;
		objRequest.send(postBody);
	}


	function fnc_post_description(){
		var description = document.getElementById('description').value;
		var postBody =   'description=' +description;
		objRequest.open('POST', 'product_search_description.php?'+ Math.random(), true);
		objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		objRequest.onreadystatechange = fnc_show_search;
		objRequest.send(postBody);

	}

	function fnc_post_code_product(){
		var code_product = document.getElementById('code_product').value;
		var postBody =   'code_product=' +code_product;
		objRequest.open('POST', 'product_search_code_product.php?'+ Math.random(), true);
		objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		objRequest.onreadystatechange = fnc_show_search;
		objRequest.send(postBody);

	}

	function fnc_show_search() {
		
		if (objRequest.readyState == 4 && objRequest.status ==200) {
			var data = objRequest.responseText;
			document.getElementById('box_search').innerHTML = data;
		}

	}

				
</script>


<table width="100%" cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td height="40" align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th"><?php echo ($_GET['id'])? 'แก้ไข' : 'เพิ่ม' ;?>Stock</td>
        </tr></table></td>
    </tr>
    <tr>
        <td align="center">
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="th2">
	<FORM METHOD=POST onsubmit="return chkvalue(this)" ACTION="">
		<tr height="30" class="l">
			<td width="12%" bgcolor="#BBD8EC" align="right" class="th r"></td>
			<td width="88%" align="left" bgcolor="#E7F1F8">
				<table class="th2" cellpadding="5" border="0">

					<tr>
					  <td align="right" class="r">#dm: </td>
					  <td><input name="barcode_product" type="text" class="box" id="barcode_product" style="border-color:#0000FF; width:150px"  value="<?php echo $rs->dm_product;?>" onkeyup = "fnc_post_barcode_product();" onchange = "fnc_post_barcode_product();"/>
						* ใส่รหัส DM
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">Description: </td>
					  <td><input name="description" type="text" class="box" id="description" style=" border-color:#0000FF; width:350px"  value="<?php echo $rs->description;?>" onkeyup = "fnc_post_description();"/> * ใส่ Description
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">Product code: </td>
					  <td><input name="code_product" type="text" class="box" id="code_product" style=" border-color:#0000FF; width:350px"  value="<?php echo $rs->code_product?>" onkeyup = "fnc_post_code_product();"/> * ใส่ product code Exp. 10-0000001-12
				      </td>
					</tr>


					

					<tr>
					  <td align="right" class="r">จำนวนเพิ่ม: </td>
					  <td><input name="tottal_add_stock" type="text" class="box" id="tottal_add_stock" style="border-color:#0000FF;<?php if($_GET['id_product'] == ""){?>background-color:#c0c0c0;<?php }?>width:70px"  value="<?php echo $rs->tottal_add_stock;?>" <?php if($_GET['id_product'] == ""){?>disabled<?php }?>/>&nbsp;
					  <?php echo $rs->noy_per;?>&nbsp;&nbsp;จำนวนที่มีอยู่ในสต๊อก&nbsp;&nbsp;<?php echo $rs->total_product;?>&nbsp;<?php echo $rs->noy_per;?>
				      </td>
					</tr>

					<tr>
					  <td align="right" class="r">Remark: </td>
					  <td><input name="remark_add_stock" type="text" class="box" id="remark_add_stock" style=" border-color:#0000FF; width:350px"  value="<?php echo $rs->remark_add_stock;?>" /> * Remark เช่น นำมาคืนจาก Invoice หรือ การเพิ่มจำนวนลงสต๊อก
				      </td>
					</tr>

	
					<tr>
					  <td align="right" class="r">&nbsp;</td>
					  <td>
					  <input name="save" type="hidden" id="save" value="news_add" />
					  <INPUT TYPE="hidden" NAME="id_product" id = "id_product" value = "<?php echo $rs->id_product;?>">
					  <input name="image" type="image" src="images/b_save.gif" />
						
					  


				        <a href="main.php?op=<?php echo $_GET['op']?>&act=list"><img src="images/b_cancel.gif" border="0"/></a></td>
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


<!-- รายการออร์เดอร์  -->
<div style = "position:absolute; top:250px; left:300px; background-color:#ccccff; width: 40%; z-index:200;  " id = "box_search">

</div>