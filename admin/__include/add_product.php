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
		
		

		$rs = $sys->Update($tbl,$fiel_id,$_GET['id']);
		
		$rs_back = $db->record("tb_product", " product_id_re<='".$rs->product_id_re."' and id_product < '".$rs->id_product."'  order by product_id_re desc ");
		$rs_next = $db->record("tb_product", " product_id_re>='".$rs->product_id_re."' and id_product > '".$rs->id_product."'  order by product_id_re asc ");

	}


	if(($_POST['save'] == "news_add") and ($_POST['id'] == "")){
		unset($_POST['save']);
		$rs_check_double = $db->record("tb_product"," barcode_product = '".$_POST['barcode_product']."' ");
		if(!empty($rs_check_double->barcode_product)){
			echo '<script type="text/javascript">
			<!--
				alert("รหัสบาร์โคํทซ้ำให้ทำการกรอกเข้าไปใหม่");
				window.location.replace("http://192.168.1.33/laithong/admin/main.php?op=product&act=add&rd=123456");
			//-->
			</script>';	
		}else{
			$sys->Add($data,$tbl,$page_admin);
		}
		
	}

	echo $fnc->form_check($message_alert);


include "date.php";

$row_category = $db->result("tb_category",NULL, 'id_category asc');
$row_type	  = $db->result("tb_type_product",NULL, 'name_type_product asc');
$row_stock	  = $db->result("tb_stock",'level_stock = "1"', 'id_stock asc');


function check_status($id,$text){
	if($id!=""){
		return $text;
	}
}

?>


<script type="text/javascript">
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
		function fnc_re(){
				var barcode_product = document.getElementById('barcode_product').value;
				var id_product = document.getElementById('id_product').value;
				var postBody =   'barcode_product=' + barcode_product +'&id_product='+ id_product;
				objRequest.open('POST', 'gent_barcode.php?'+ Math.random(), true);
				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_put;
				objRequest.send(postBody);
			}

			function fnc_gent(){
				var dm_product = document.getElementById('dm_product').value;
				var postBody =   'dm_product=' + dm_product;
				objRequest.open('POST', 'gent_barcode_add.php?'+ Math.random(), true);
				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_put_add;
				objRequest.send(postBody);
			}

			function fnc_type(id){
				var id_category = document.getElementById('id_category').value;
			
				var mySplitResult = id_category.split("@");

				document.getElementById('p2').value = mySplitResult[1];
				document.getElementById('sp_id_2').innerHTML = mySplitResult[1];

				var postBody =   'id_category=' + mySplitResult[0];
				objRequest.open('POST', 'sub_category.php?'+ Math.random(), true);
				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = show_sub;
				objRequest.send(postBody);
			}


			function show_sub() {
				if (objRequest.readyState == 4 && objRequest.status ==200) {
						var data	=	objRequest.responseText;
						document.getElementById('sub_category').innerHTML = data;
				}
			}

			function fnc_group(id){
						//alert(id);
					var mySplitResult = id.split("@");
				///////////// กรอบ ตลับ /////////////////////////////////////////////////////////////////////
					if(mySplitResult[0] >4){//ตรวจสอบว่าเป็นอุปกรณ์หรือไม่ ถ้า 4 คืออุปกร์
					document.getElementById('p3').value = mySplitResult[1];
					document.getElementById('sp_id_3').innerHTML = mySplitResult[1];
					var soom = document.getElementById('soom').value;
					var type    = document.getElementById('type_').value;
					var postBody =   'id_sub_category=' + mySplitResult[0] +'&soom='+soom+'&type='+type;
					objRequest.open('POST', 'show_content.php?'+ Math.random(), true);
					objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					objRequest.onreadystatechange = show_content;
					objRequest.send(postBody);
				}else{

					var postBody =   'id_sub_category=4';
					objRequest.open('POST', 'show_content_accessories.php?'+ Math.random(), true);
					objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					objRequest.onreadystatechange = show_content;
					objRequest.send(postBody);
				}
			
				
				
				
				
			}

			function show_content() {
				if (objRequest.readyState == 4 && objRequest.status ==200) {
						var data	=	objRequest.responseText;
						document.getElementById('content').innerHTML = data;
				}
			}

		function fnc_put() {
				if (objRequest.readyState == 4 && objRequest.status ==200) {
						var data	=	objRequest.responseText;
						if(data!=1){
							alert("เปลี่ยนรหัสบาร์โค๊ทเรียบร้อย");
							document.getElementById('barcode_product').value = data;
						}else{
							alert("รหัสนี้ซ้ำในระบบ");
						}
					}
				}

		function fnc_put_add() {
				if (objRequest.readyState == 4 && objRequest.status ==200) {
						var data	=	objRequest.responseText;
						if(data!=1){
							document.getElementById('barcode_product').value = data;
						}else{
							alert("รหัสนี้ซ้ำในระบบ");
						}
					}
				}

		function fnc_search(){
			var postBody = '';
			objRequest.open('POST', '../test_shell.php?'+ Math.random(), true);
			objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			objRequest.onreadystatechange = fnc_show_search;
			objRequest.send(postBody);
		}



		function fnc_show_search() {
			if (objRequest.readyState == 4 && objRequest.status ==200) {
				
				
				var data	=	objRequest.responseText;
				if(document.getElementById('type3').checked == false){
					document.getElementById('weight').value = ( parseFloat(data)+0.01 );
					document.getElementById('weight_text').innerHTML = ( parseFloat(data)+0.01 );
				}else{
					document.getElementById('weight').value = ( parseFloat(data)+0.02 );
					document.getElementById('weight_text').innerHTML = ( parseFloat(data)+0.02 );
				}

				calculate();
			}
		}

		////////////////////ฝังเพชร/////////////////////////////////////////////////////////////////////////
		function check_si_diamond(){
				var id_diamond = document.getElementById('id_diamond').value;// ฝังเพชร
				var soom       = document.getElementById('soom').value; //ซุ้ม ไม่ซุ้ม
				var type       = document.getElementById('type_').value;//ประเภทสินค้า กรอบ 90 70
				var size       = document.getElementById('size').value;
				var postBody =   'id_diamond=' + id_diamond +'&soom='+soom+'&type='+type+'&size='+size;

				objRequest.open('POST', 'checksi_diamond.php?'+ Math.random(), true);
				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_sum_diamond;
				objRequest.send(postBody);
			}

		function fnc_sum_diamond() {
			if (objRequest.readyState == 4 && objRequest.status ==200) {
				var data	=	objRequest.responseText;
				
				var mySplitResult = data.split("@");
				var si = mySplitResult[0];
				var wage = mySplitResult[1];	
				
				document.getElementById('si_diamond').value = mySplitResult[0];
				document.getElementById('wage_diamond').value = mySplitResult[1];

				var si_diamond = document.getElementById('si_diamond').value;
				var si_backmunk = document.getElementById('si_backmunk').value;
				var si_type_product = document.getElementById('si_type_product').value;
				var si_medicine = document.getElementById('si_medicine').value;
				var si_special = document.getElementById('si_special').value;
				



				var special_wage = document.getElementById('special_wage').value;//ค่าแรงพิเศษ
				var special_si = document.getElementById('special_si').value;// ค่าซะเพิ่ม

				var wage_diamond = document.getElementById('wage_diamond').value;
				var wage_backmunk = document.getElementById('wage_backmunk').value;
				var wage_type_product = document.getElementById('wage_type_product').value;
				var wage_medicine = document.getElementById('wage_medicine').value;
				var wage_special = document.getElementById('wage_special').value;
				var wage_diamond_sum_ = document.getElementById('wage_diamond_sum').value;

				var total_si = (parseFloat(si_diamond)) + (parseFloat(si_backmunk)) + (parseFloat(si_type_product)) + (parseFloat(si_medicine)) + (parseFloat(si_special)) + (parseFloat(special_si)) ;

				var total_wage = (parseFloat(wage_diamond)) + (parseFloat(wage_backmunk)) + (parseFloat(wage_type_product)) + (parseFloat(wage_medicine)) + (parseFloat(wage_diamond_sum_)) + (parseFloat(special_wage)) + (parseFloat(wage_special)) ;

				document.getElementById('si').value = total_si;
				document.getElementById('total_wage').value = total_wage;

				document.getElementById('si_text').innerHTML = total_si.toFixed(2);
				document.getElementById('total_wage_text').innerHTML = total_wage.toFixed(0);
						
				//alert(wage);
				//total_si_ = (parseFloat(total_si))+(parseFloat(si));
				//total_wage_ = (parseFloat(total_wage))+(parseFloat(wage));
				
				
    
			}
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////

		
		////////////////////แผ่นปิดหลัง/////////////////////////////////////////////////////////////////////////
		function check_si_backmunk(){
				var id_backmunk = document.getElementById('id_backmunk').value;// ฝังเพชร
				var soom       = document.getElementById('soom').value; //ซุ้ม ไม่ซุ้ม
				var type       = document.getElementById('type_').value;//ประเภทสินค้า กรอบ 90 70
				var size       = document.getElementById('size').value;
				var postBody =   'id_backmunk=' + id_backmunk +'&soom='+soom+'&type='+type+'&size='+size;
				
				objRequest.open('POST', 'check_si_backmunk.php?'+ Math.random(), true);

				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_sum_backmunk;
				objRequest.send(postBody);
			}

		function fnc_sum_backmunk() {
			if (objRequest.readyState == 4 && objRequest.status ==200) {
				var data	=	objRequest.responseText;
			
				var mySplitResult = data.split("@");
				var si = mySplitResult[0];
				var wage = mySplitResult[1];	
				document.getElementById('si_backmunk').value = mySplitResult[0];
				document.getElementById('wage_backmunk').value = mySplitResult[1];

				var si_diamond = document.getElementById('si_diamond').value;
				var si_backmunk = document.getElementById('si_backmunk').value;
				var si_type_product = document.getElementById('si_type_product').value;
				var si_medicine = document.getElementById('si_medicine').value;
				var si_special = document.getElementById('si_special').value;

				var special_wage = document.getElementById('special_wage').value;//ค่าแรงพิเศษ
				var special_si = document.getElementById('special_si').value;// ค่าซะเพิ่ม


				var wage_diamond = document.getElementById('wage_diamond').value;
				var wage_backmunk = document.getElementById('wage_backmunk').value;
				var wage_type_product = document.getElementById('wage_type_product').value;
				var wage_medicine = document.getElementById('wage_medicine').value;
				var wage_special = document.getElementById('wage_special').value;
				var wage_diamond_sum_ = document.getElementById('wage_diamond_sum').value;

				var total_si = (parseFloat(si_diamond)) + (parseFloat(si_backmunk)) + (parseFloat(si_type_product)) + (parseFloat(si_medicine)) + (parseFloat(si_special)) + (parseFloat(special_si)) ;

				var total_wage = (parseFloat(wage_diamond)) + (parseFloat(wage_backmunk)) + (parseFloat(wage_type_product)) + (parseFloat(wage_medicine)) + (parseFloat(wage_diamond_sum_)) + (parseFloat(special_wage)) + (parseFloat(wage_special)) ;

				document.getElementById('si').value = total_si;
				document.getElementById('total_wage').value = total_wage;


				document.getElementById('si_text').innerHTML = total_si.toFixed(2);
				document.getElementById('total_wage_text').innerHTML = total_wage.toFixed(0);
    
			}
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////


		////////////////////รูปแบบ/////////////////////////////////////////////////////////////////////////
		function check_si_type_product(){
				var id_type_product = document.getElementById('id_type_product').value;// ฝังเพชร
				var soom       = document.getElementById('soom').value; //ซุ้ม ไม่ซุ้ม
				var type       = document.getElementById('type_').value;//ประเภทสินค้า กรอบ 90 70
				var size       = document.getElementById('size').value;
				var postBody =   'id_type_product=' + id_type_product +'&soom='+soom+'&type='+type+'&size='+size;

				objRequest.open('POST', 'check_si_type_product.php?'+ Math.random(), true);

				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_sum_type_product;
				objRequest.send(postBody);
			}

		function fnc_sum_type_product() {
			if (objRequest.readyState == 4 && objRequest.status ==200) {
				var data	=	objRequest.responseText;
				//alert(data);
			
				var mySplitResult = data.split("@");
				var si = mySplitResult[0];
				var wage = mySplitResult[1];
				

				document.getElementById('si_type_product').value = mySplitResult[0];
				document.getElementById('wage_type_product').value = mySplitResult[1];

				var si_diamond = document.getElementById('si_diamond').value;
				var si_backmunk = document.getElementById('si_backmunk').value;
				var si_type_product = document.getElementById('si_type_product').value;
				var si_medicine = document.getElementById('si_medicine').value;
				var si_special = document.getElementById('si_special').value;

				var special_wage = document.getElementById('special_wage').value;//ค่าแรงพิเศษ
				var special_si = document.getElementById('special_si').value;// ค่าซะเพิ่ม

				var wage_diamond = document.getElementById('wage_diamond').value;
				var wage_backmunk = document.getElementById('wage_backmunk').value;
				var wage_type_product = document.getElementById('wage_type_product').value;
				var wage_medicine = document.getElementById('wage_medicine').value;
				var wage_special = document.getElementById('wage_special').value;
				var wage_diamond_sum_ = document.getElementById('wage_diamond_sum').value;


				var total_si = (parseFloat(si_diamond)) + (parseFloat(si_backmunk)) + (parseFloat(si_type_product)) + (parseFloat(si_medicine)) + (parseFloat(si_special)) + (parseFloat(special_si)) ;

				var total_wage = (parseFloat(wage_diamond)) + (parseFloat(wage_backmunk)) + (parseFloat(wage_type_product)) + (parseFloat(wage_medicine)) + (parseFloat(wage_diamond_sum_)) + (parseFloat(special_wage)) + (parseFloat(wage_special)) ;

				document.getElementById('si').value = total_si;
				document.getElementById('total_wage').value = total_wage;

				document.getElementById('si_text').innerHTML = total_si.toFixed(2);
				document.getElementById('total_wage_text').innerHTML = total_wage.toFixed(0);
    
			}
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////


		////////////////////ลงยา/////////////////////////////////////////////////////////////////////////
		function check_si_medicine(){

				var id_medicine = document.getElementById('id_medicine').value;// ฝังเพชร
				var soom       = document.getElementById('soom').value; //ซุ้ม ไม่ซุ้ม
				var type       = document.getElementById('type_').value;//ประเภทสินค้า กรอบ 90 70
				var size       = document.getElementById('size').value;
				var postBody =   'id_medicine=' + id_medicine +'&soom='+soom+'&type='+type+'&size='+size;
				
				objRequest.open('POST', 'check_si_medicine.php?'+ Math.random(), true);

				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_sum_medicine;
				objRequest.send(postBody);
			}

		function fnc_sum_medicine() {
			if (objRequest.readyState == 4 && objRequest.status ==200) {
				var data	=	objRequest.responseText;
			
				var mySplitResult = data.split("@");
				var si = mySplitResult[0];
				var wage = mySplitResult[1];	
				document.getElementById('si_medicine').value = mySplitResult[0];
				document.getElementById('wage_medicine').value = mySplitResult[1];

				var si_diamond = document.getElementById('si_diamond').value;
				var si_backmunk = document.getElementById('si_backmunk').value;
				var si_type_product = document.getElementById('si_type_product').value;
				var si_medicine = document.getElementById('si_medicine').value;
				var si_special = document.getElementById('si_special').value;

				var special_wage = document.getElementById('special_wage').value;//ค่าแรงพิเศษ
				var special_si = document.getElementById('special_si').value;// ค่าซะเพิ่ม


				var wage_diamond = document.getElementById('wage_diamond').value;
				var wage_backmunk = document.getElementById('wage_backmunk').value;
				var wage_type_product = document.getElementById('wage_type_product').value;
				var wage_medicine = document.getElementById('wage_medicine').value;
				var wage_special = document.getElementById('wage_special').value;
				var wage_diamond_sum_ = document.getElementById('wage_diamond_sum').value;


				var total_si = (parseFloat(si_diamond)) + (parseFloat(si_backmunk)) + (parseFloat(si_type_product)) + (parseFloat(si_medicine)) + (parseFloat(si_special)) + (parseFloat(special_si)) ;

				var total_wage = (parseFloat(wage_diamond)) + (parseFloat(wage_backmunk)) + (parseFloat(wage_type_product)) + (parseFloat(wage_medicine)) + (parseFloat(wage_diamond_sum_)) + (parseFloat(special_wage)) + (parseFloat(wage_special)) ;

				document.getElementById('si').value = total_si;
				document.getElementById('total_wage').value = total_wage;

				document.getElementById('si_text').innerHTML = total_si.toFixed(2);
				document.getElementById('total_wage_text').innerHTML = total_wage.toFixed(0);
    
			}
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////


		////////////////////special/////////////////////////////////////////////////////////////////////////


		function check_si_special(){

				
				var soom       = document.getElementById('soom').value; //ซุ้ม ไม่ซุ้ม
				var type       = document.getElementById('type_').value;//ประเภทสินค้า กรอบ 90 70
				var size       = document.getElementById('size').value;
				var total_chk  = document.getElementById('total_chk').value;
				var special    = "";
				for(i=1;i<=total_chk;i++){
					
					if(document.getElementById('id_special'+i).checked == true){
							
						special    =  document.getElementById('id_special'+i).value+"@"+special;
					}
				}
				
				var postBody =   'special=' + special +'&soom='+soom+'&type='+type+'&size='+size;
				
				objRequest.open('POST', 'check_si_special.php?'+ Math.random(), true);

				objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				objRequest.onreadystatechange = fnc_sum_special;
				objRequest.send(postBody);
			}


		function fnc_sum_special() {
			if (objRequest.readyState == 4 && objRequest.status ==200) {
				var data	=	objRequest.responseText;
				
			
				var mySplitResult = data.split("@");
				var si = mySplitResult[0];
				var wage = mySplitResult[1];	
				
				document.getElementById('si_special').value = mySplitResult[0];
				document.getElementById('wage_special').value = mySplitResult[1];


				var si_diamond = document.getElementById('si_diamond').value;
				var si_backmunk = document.getElementById('si_backmunk').value;
				var si_type_product = document.getElementById('si_type_product').value;
				var si_medicine = document.getElementById('si_medicine').value;
				var si_special = document.getElementById('si_special').value;

				var special_wage = document.getElementById('special_wage').value;//ค่าแรงพิเศษ
				var special_si = document.getElementById('special_si').value;// ค่าซะเพิ่ม


				var wage_diamond = document.getElementById('wage_diamond').value;
				var wage_backmunk = document.getElementById('wage_backmunk').value;
				var wage_type_product = document.getElementById('wage_type_product').value;
				var wage_medicine = document.getElementById('wage_medicine').value;
				var wage_special = document.getElementById('wage_special').value;
				var wage_diamond_sum_ = document.getElementById('wage_diamond_sum').value;


				var total_si = (parseFloat(si_diamond)) + (parseFloat(si_backmunk)) + (parseFloat(si_type_product)) + (parseFloat(si_medicine)) + (parseFloat(si_special)) + (parseFloat(special_si)) ;

				var total_wage = (parseFloat(wage_diamond)) + (parseFloat(wage_backmunk)) + (parseFloat(wage_type_product)) + (parseFloat(wage_medicine)) + (parseFloat(wage_diamond_sum_)) + (parseFloat(special_wage)) + (parseFloat(wage_special)) ;

				document.getElementById('si').value = total_si;
				document.getElementById('total_wage').value = total_wage;

				document.getElementById('si_text').innerHTML = total_si.toFixed(2);
				document.getElementById('total_wage_text').innerHTML = total_wage.toFixed(0);
    
			}
		}
		///////////////////////////////////////////////////////////////////////////////////////////////////////

		function calculate(){
			var gold	 = document.getElementById('gold').value;
			var percent_ = document.getElementById('percent_').value;
			var weight	 = document.getElementById('weight').value;
			var si		 = document.getElementById('si').value;
			var total_wage		 = document.getElementById('total_wage').value;
            var price     = "";


			price = (  ((gold * 0.0656 * percent_)/100) * ( parseFloat(weight) + parseFloat(si) ) ) + parseFloat(total_wage);
			
			document.getElementById('price').value = parseInt(price);

			document.getElementById('price_text').innerHTML = parseInt(price);

			document.getElementById('total_wage_si_text').innerHTML = ( parseFloat(weight) + parseFloat(si) ).toFixed(2);
			document.getElementById('total_wage_si').value = ( parseFloat(weight) + parseFloat(si) ).toFixed(2);
		}

		function fnc_wage_fung(){
			var total_diamond  = document.getElementById('total_diamond').value;
			var wage_fung      = document.getElementById('wage_fung').value;
			var diamond_line   = total_diamond * wage_fung;
			document.getElementById('total_wage_first_line').value = diamond_line;
			document.getElementById('diamond_line').innerHTML = diamond_line;
		}

		function cal_diamond_price(){
			var price_diamond = 0;
			var total_diamond = document.getElementById('total_diamond').value;//จำนวนเพชร
			var karat         = document.getElementById('karat').value;//กี่กะรัต
			var per_karat	  = document.getElementById('per_karat').value;//กะรัตละ
			var total_wage_first_line = document.getElementById('total_wage_first_line').value;//ค่าแรงฝัง
			var total_wage    = document.getElementById('total_wage').value; //ค่าแรงรวม
			

			var price_diamond = (total_diamond * karat * per_karat);
			
			

			var wage_diamond_sum = ( (parseFloat(total_wage_first_line)) + (parseFloat(price_diamond)) );
			
			document.getElementById('wage_diamond_sum').value = wage_diamond_sum;
			
			
			
				var special_wage = document.getElementById('special_wage').value;
				var wage_diamond = document.getElementById('wage_diamond').value;
				var wage_backmunk = document.getElementById('wage_backmunk').value;
				var wage_type_product = document.getElementById('wage_type_product').value;
				var wage_medicine = document.getElementById('wage_medicine').value;
				var wage_special = document.getElementById('wage_special').value;
				var wage_diamond_sum_ = document.getElementById('wage_diamond_sum').value;


				var total_wage = (parseFloat(wage_diamond)) + (parseFloat(wage_backmunk)) + (parseFloat(wage_type_product)) + (parseFloat(wage_medicine)) + (parseFloat(wage_diamond_sum_)) + (parseFloat(special_wage)) + (parseFloat(wage_special)) ;


				if(total_wage >0){
					document.getElementById('total_wage').value = total_wage;
					document.getElementById('total_wage_text').innerHTML = total_wage.toFixed(0);
				}

		}

		function special_wage_(){
				var special_wage = document.getElementById('special_wage').value;
				var wage_diamond = document.getElementById('wage_diamond').value;
				var wage_backmunk = document.getElementById('wage_backmunk').value;
				var wage_type_product = document.getElementById('wage_type_product').value;
				var wage_medicine = document.getElementById('wage_medicine').value;
				var wage_special = document.getElementById('wage_special').value;
				var wage_diamond_sum_ = document.getElementById('wage_diamond_sum').value;


				var total_wage = (parseFloat(wage_diamond)) + (parseFloat(wage_backmunk)) + (parseFloat(wage_type_product)) + (parseFloat(wage_medicine)) + (parseFloat(wage_diamond_sum_)) + (parseFloat(special_wage)) + (parseFloat(wage_special)) ;

				document.getElementById('total_wage').value = total_wage;
				document.getElementById('total_wage_text').innerHTML = total_wage;

		}


		function special_si_(){
				var si_diamond = document.getElementById('si_diamond').value;
				var si_backmunk = document.getElementById('si_backmunk').value;
				var si_type_product = document.getElementById('si_type_product').value;
				var si_medicine = document.getElementById('si_medicine').value;
				var si_special = document.getElementById('si_special').value;
				var special_si = document.getElementById('special_si').value;// ค่าซะเพิ่ม


				var total_si = (parseFloat(si_diamond)) + (parseFloat(si_backmunk)) + (parseFloat(si_type_product)) + (parseFloat(si_medicine)) + (parseFloat(si_special)) + (parseFloat(special_si)) ;

				document.getElementById('si').value = total_si;
				document.getElementById('si_text').innerHTML = total_si.toFixed(2);


		}

	    function check_dia(avai){
			if(avai>13){
				document.getElementById('total_dia').style.visibility = '';
			}else{
				document.getElementById('total_dia').style.visibility = 'hidden';
			}
		}
				
</script>
<?php
function check_tb($type){
	if($type == "1"){
		return "one";
	}
	else if($type == "2"){
		return "two";
	}

	else if($type == "3"){
		return "three";
	}

	else if($type == "4"){
		return "three";
	}

	else if($type == "5"){
		return "five";
	}

}
function check_tb_accesories($type){
	if($type == "S"){
		return "one";
	}
	else if($type == "M"){
		return "two";
	}

	else if($type == "L"){
		return "three";
	}

	else if($type == "XL"){
		return "four";
	}

}

function check_soom($soom){
	if($soom == 2){
		return "_";
	}
}

function check_soom3($soom){
	if($soom == 3){
		return "__";
	}
}
function check_null_zero($available=null){
	if($available==""){
		return "0";
	}else{
		return $available;
	}
}

if( ($rs->id_product!="") and ($rs->size !="") ){
///////////////เช็ค Si ฝั่งเพชร////////////////////////////////////////////////////////////////////////////////////////////////
$rs_si_wage_diamond = $db->record("tb_diamond_".check_tb($rs->type)."", " id_diamond = '".$rs->id_diamond."' "," si_diamond_".check_tb($rs->type)."_".$rs->size." as si, wage_diamond_".check_tb($rs->type)."_".$rs->size." as wage ");
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////เช็ค Si backmunk//////////////////////////////////////////////////////////////////////////////////////////////

$rs_si_wage_backmunk = $db->record("tb_backmunk_".check_tb($rs->type)."", " id_backmunk = '".$rs->id_back_munk."' "," si_backmunk_".check_tb($rs->type)."_".$rs->size." as si, wage_backmunk_".check_tb($rs->type)."_".$rs->size." as wage ");
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



///////////// เช็ค Si Type product////////////////////////////////////////////////////////////////////////////////////////////
if($rs->type =="1"){

$rs_si_wage_type = $db->record("tb_type_product_".check_tb($rs->type)."", " id_type_product = '".$rs->id_type_product."' "," si_type_product_".check_tb($rs->type)."_S as si, wage_type_product_".check_tb($rs->type)."_S as wage ");

$rs_wage_first_type = $db->record("tb_wage_first_".check_tb($rs->type)."", " id_type = '".$rs->id_type_product."' ","  wage_first_".check_tb($rs->type)."".check_soom($rs->soom)." as wage ");

$si_type_product   = $rs_si_wage_type->si;
$wage_type_product = $rs_si_wage_type->wage+$rs_wage_first_type->wage;


}


if($rs->type =="2"){

$rs_si_wage_type = $db->record("tb_type_product_".check_tb($rs->type)."", " id_type_product = '".$rs->id_type_product."' "," si_type_product_".check_tb($rs->type)."_S as si, wage_type_product_".check_tb($rs->type)."_S as wage ");

$rs_wage_first_type = $db->record("tb_wage_first_".check_tb($rs->type)."", " id_type = '".$rs->id_type_product."' ","  wage_first_".check_tb_accesories($rs->size)."".check_soom($rs->soom).check_soom3($rs->soom)." as wage ");

$si_type_product   = $rs_si_wage_type->si;
$wage_type_product = $rs_si_wage_type->wage+$rs_wage_first_type->wage;
}


if($rs->type =="3"){

$rs_si_wage_type = $db->record("tb_type_product_".check_tb($rs->type)."", " id_type_product = '".$rs->id_type_product."' "," si_type_product_".check_tb($rs->type)."_S as si, wage_type_product_".check_tb($rs->type)."_S as wage ");

$rs_wage_first_type = $db->record("tb_wage_first_".check_tb($rs->type)."", " id_type = '".$rs->id_type_product."' ","  wage_first_".check_tb_accesories($rs->size)."".check_soom($rs->soom)." as wage ");
$si_type_product   = $rs_si_wage_type->si;
$wage_type_product = $rs_si_wage_type->wage+$rs_wage_first_type->wage;
}



if($rs->type =="4"){

////////อุปกรณ์//////////////////////////////////////////////////////////////
$rs_si_wage_type = $db->record("tb_setting_accessories", " id_type_product = '".$rs->id_type_product."' "," si_".check_tb_accesories($rs->size)." as si ");

$rs_wage_first_type = $db->record("tb_wage_first_four", " id_type = '".$rs->id_type_product."' ","  wage_first_".check_tb_accesories($rs->size)."".check_soom($rs->soom)." as wage ");
$si_type_product   = $rs_si_wage_type->si;
$wage_type_product = $rs_si_wage_type->wage+$rs_wage_first_type->wage;
}

/////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////// เช็ค si Medicine ลงยา///////////////////////////////////////////////////////////////////////////
$rs_si_wage_medicine = $db->record("tb_medicine_".check_tb($rs->type)."", " id_medicine = '".$rs->id_medicine."' "," si_medicine_".check_tb($rs->type)."_".$rs->size." as si, wage_medicine_".check_tb($rs->type)."_".$rs->size." as wage ");
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////// เช็ค si Special ///////////////////////////////////////////////////////////////////////////////
$special_product = $db->result("tb_special_product" ," id_product = '".$rs->id_product."' "," id_special asc ");

if(!empty($special_product)){
foreach($special_product as $id_special){ 

	$rs_si_wage_special = $db->record("tb_special_".check_tb($rs->type)."", " id_special = '".$id_special->id_special."' "," si_special_".check_tb($rs->type)."_".$rs->size." as si, wage_special_".check_tb($rs->type)."_".$rs->size." as wage ");

	$si_special    = $si_special + $rs_si_wage_special->si;
	$wage_special  = $wage_special + $rs_si_wage_special->wage;
}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
}


$row_type_accessories = $db->result("tb_type_accessories",NULL, 'name_type_accessories asc');


?>
<input type="hidden" id="si_diamond" value = "<?php echo check_null_zero($rs_si_wage_diamond->si);?>">&nbsp;&nbsp;<input type="hidden" id="wage_diamond" value = "<?php echo check_null_zero($rs_si_wage_diamond->wage);?>">


<input type="hidden" id="si_backmunk" value = "<?php echo check_null_zero($rs_si_wage_backmunk->si);?>">&nbsp;&nbsp;<input type="hidden" id="wage_backmunk" value = "<?php echo check_null_zero($rs_si_wage_backmunk->wage);?>">

<input type="hidden" id="si_type_product" value = "<?php echo check_null_zero($si_type_product);?>">&nbsp;&nbsp;<input type="hidden" id="wage_type_product" value = "<?php echo check_null_zero($wage_type_product);?>">


<input type="hidden" id="si_medicine" value = "<?php echo check_null_zero($rs_si_wage_medicine->si);?>">&nbsp;&nbsp;<input type="hidden" id="wage_medicine" value = "<?php echo check_null_zero($rs_si_wage_medicine->wage);?>">

<input type="hidden" id="si_special" value = "<?php echo check_null_zero($si_special);?>">&nbsp;&nbsp;<input type="hidden" id="wage_special" value = "<?php echo check_null_zero($wage_special);?>">



<input type="hidden" id="type_" value = "<?php echo $rs->type;?>">

<table width="100%" cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td height="40" align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">
		  <a href="main.php?op=product&act=add&rd=62573&id=<?php echo $rs_back->id_product;?>"><!-- &lt;&lt;&lt;Back --></a>&nbsp;&nbsp;&nbsp;
		  <?php echo ($_GET['id'])? 'แก้ไข' : 'เพิ่ม' ;?>สินค้า
		  &nbsp;&nbsp;&nbsp; <a href="main.php?op=product&act=add&rd=62573&id=<?php echo $rs_next->id_product;?>"><!-- Next&gt;&gt;&gt; --></a><br>
			พิมพ์ Barcode
			<br>
		   <a href="../barcodegen/test2.php?dm_product=<?php echo $rs->barcode_product;?>&code_product=<?php echo $rs->code_product?>&stone_sum_1_product=<?php echo (urlencode($rs->stone_sum_1_product));?>&stone_sum_2_product=<?php echo urlencode($rs->stone_sum_2_product)?>&stone_sum_3_product=<?php echo urlencode($rs->stone_sum_3_product)?>&stone_sum_4_product=<?php echo urlencode($rs->stone_sum_4_product)?>" target = "_blank"><img src="images/ss122669_1.jpg" width="50" height="30" border="0" alt="พิมพ์ Barcode" title = "พิมพ์ Barcode"></a>
		  </td>
        </tr></table></td>
    </tr>
    <tr>
        <td align="center">
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

<script type="text/javascript">
<!--
	function chkvalue(){
		if(document.getElementById('type_').value == ""){
			alert("กรุณาเลือกประเภทสินค้า");
			return false;
		}
		else if(document.getElementById('id_category').value == "0"){
			alert("กรุณาเลือกแบบพิมพ์");
			document.getElementById('id_category').focus();
			return false;
		}

		else if(document.getElementById('id_diamond').value ==0){
			alert("กรุณาเลือกฝังเพชร");
			document.getElementById('id_diamond').focus();
			return false;
		}

		else if(document.getElementById('id_backmunk').value == 0){
			alert("กรุณาเลือกเปิดหลัง");
			document.getElementById('id_backmunk').focus();
			return false;
		}
		else if(document.getElementById('id_type_product').value ==0){
			alert("กรุณาเลือกรูปแบบ");
			document.getElementById('id_type_product').focus();
			return false;
		}
		else if(document.getElementById('id_medicine').value ==0){
			alert("กรุณาเลือกลงยา");
			document.getElementById('id_medicine').focus();
			return false;
		}
		else if(document.getElementById('weight').value ==0){
			alert("กรุณาใส่น้ำหนัก");
			document.getElementById('weight').focus();
			return false;
		}
		
		else{
			return true;
		}
		
	}
//-->
</script>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="th2">
	<FORM METHOD=POST onsubmit="return chkvalue();" enctype="multipart/form-data" ACTION="">
	<input type="hidden" name="wage_diamond_sum" id = "wage_diamond_sum" value = "<?php echo check_null_zero($rs->diamond_price);?>">
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
						<b>Barcode:</b></td>
						<td>
						 <?php if($_GET['previos'] !=1){?>
							<input type="text" name="dm_product" id = "dm_product" style ="width:150px;" value = "<?php if($rs->barcode_product ==""){ echo "1".date("dmyhis");}else{echo $rs->barcode_product;}?>" onblur = "fnc_gent();">
						 <?php }else{?>
							<input type="text" name="dm_product" id = "dm_product" style ="width:150px;" value = "<?php echo "1".date("dmyhis");?>" onblur = "fnc_gent();">
						 <?php }?>
						 
						 &nbsp;&nbsp;
						 <input type="hidden" name="barcode_product" id = "barcode_product" style ="width:150px;" value = "<?php  if($rs->barcode_product!=""){ echo $rs->barcode_product;}?>" readonly>
						<!-- <img src="images/faq_on.gif" width="16" height="16" border="0" alt="" style = "cursor:pointer;" onclick = "fnc_re();"> -->
						&nbsp;&nbsp;
						<?php $rs_pro_last = $db->record("tb_product"," id_product !='' order by id_product desc "," id_product "); ?>
						<input type="button" value="ดึงข้อมูลก่อนหน้า" onclick="window.location.replace('?op=product&act=add&rd=81326&id=<?php echo $rs_pro_last->id_product;?>&previos=1');">
				      </td>
					</tr>

					<?php $count = $db->countRow("tb_product")+1;?>
					<tr>
					  <td width = "15%" align = "right">
						<b>รหัสสินค้า:</b></td>
						<td style = "color:#ff0000;">
						<?php 
						
							$id_product = explode("-",$rs->code_product);
						
						?>
						<input type="hidden" name="p1" id="p1" style = "width:100px;" value = "<?php echo $id_product[0];?>">
						<input type="hidden" name="p2" id="p2" style = "width:100px;" value = "<?php echo $id_product[1];?>">
						<input type="hidden" name="p3" id="p3" style = "width:100px;" value = "<?php echo $id_product[2];?>">
						<input type="hidden" name="p4" id="p4" value = 
						"<?php  
						if( ($id_product[3]=="") or ($_GET['previos']=="1") ){ 
							$count = $count-1;
							echo $fnc->number_pad($count,7,"left");
							}
							
							else{ 
								echo $id_product[3];
								}
							?>">
						<input type="hidden" name="p5" id="p5" style = "width:100px;" value = "<?php echo $id_product[4];?>">

						<br>
						<!-- <b><span id = "sp_id_1">A</span>-<span id = "sp_id_2">PT</span>-<span id = "sp_id_3">10</span>-<span id = "sp_id_4">000001</span></b>&nbsp;&nbsp; -->
						
						<b><span id = "sp_id_1"><?php echo $id_product[0];?></span>-<span id = "sp_id_2"><?php echo $id_product[1];?></span>-<span id = "sp_id_3"><?php echo $id_product[2];?></span>-<span id = "sp_id_4"><?php  if( ($id_product[3]=="") or ($_GET['previos']=="1") ){ echo $fnc->number_pad($count,7,"left");}else{ echo $id_product[3];}?></span></b>&nbsp;&nbsp;
						<br>


						<!-- หลักที่ 2
						A กรอบ 90%  ไม่ซุ้ม<br>
						B กรอบ90%  ยกซุ้ม<br>
						C ตลับ <br>
						D อุปกรณ์ <br>
						E กรอบ<br>
						หลักที่ 2 เป็นตัวอักษณ ตัวอย่าง ปิดตา = <br>pt

 -->
						<br>
						<!-- <span style = "font-size: 14px;">หลักที่ 1 ตลับหรือกรอบ - หลักที่สอง แบบพิมพ์กรอบ - หลักที่ 3 เบอร์พิมพ์ - หลักที่ 4 ลำดับ </span>
 -->				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">***<b>ประเภท:</b></td>
					  
					  <td>
					 
						<input type="radio" name="type" id = "type" value = "1" onclick = "fnc_proid_1(1);" <?php echo $fnc->checked("1",$rs->type);?>>:กรอบ 90
						&nbsp;&nbsp;<input type="radio" name="type" id = "type" value = "2" onclick = "fnc_proid_1(2);" <?php echo $fnc->checked("2",$rs->type);?>>:ตลับ
						&nbsp;&nbsp;<input type="radio" name="type" id = "type3" value = "3" onclick = "fnc_proid_1(3);" <?php echo $fnc->checked("3",$rs->type);?>>:กรอบ 70

						&nbsp;&nbsp;<input type="radio" name="type" id = "type5" value = "5" onclick = "fnc_proid_1(5);" <?php echo $fnc->checked("5",$rs->type);?>>:กรอบ 75


						&nbsp;&nbsp;<input type="radio" name="type" id = "type" value = "4" onclick = "fnc_proid_1(4);" <?php echo $fnc->checked("4",$rs->type);?>>:อุปกรณ์

					
				      </td>
					</tr>


					<tr>
					  <td width = "15%" align = "right">
						&nbsp;</td>
						<td id = "cat_type">
						<?php if($rs->type=="1"){ ?>
						<select name="soom" id = "soom" style = "width:155px;" onchange ="fnc_soom(this.value);">
						<option value="1" <?php echo $fnc->selected($rs->soom,"1");?>>ไม่ซุ้ม</option>
						<option value="2" <?php echo $fnc->selected($rs->soom,"2");?>>ยกซุ้ม</option></select>
						<?php }?>

						<?php if($rs->type=="2"){ ?>
						<select name="soom" id = "soom" style = "width:155px;" onchange ="fnc_soom(this.value);">
						<option value="1" <?php echo $fnc->selected($rs->soom,"1");?>>เปิดหลัง</option>
						<option value="2" <?php echo $fnc->selected($rs->soom,"2");?>>ปิดหลัง</option>
						<option value="3" <?php echo $fnc->selected($rs->soom,"3");?>>ปิดหลังแกะภาพ</option>
						</select>
						<?php }?>
						
						<?php if($rs->type=="3"){ ?>
						<select name="soom" id = "soom" style = "width:155px;" onchange ="fnc_soom(this.value);">
						<option value="1" <?php echo $fnc->selected($rs->soom,"1");?>>ไม่ซุ้ม</option>
						<option value="2" <?php echo $fnc->selected($rs->soom,"2");?>>ยกซุ้ม</option>
						</select>
						<?php }?>

						<?php if($rs->type=="5"){ ?>
						<select name="soom" id = "soom" style = "width:155px;" onchange ="fnc_soom(this.value);">
						<option value="1" <?php echo $fnc->selected($rs->soom,"1");?>>ไม่ซุ้ม</option>
						<option value="2" <?php echo $fnc->selected($rs->soom,"2");?>>ยกซุ้ม</option>
						</select>
						<?php }?>

						<?php if($rs->type=="4"){ ?>
						<input type="hidden" id="soom" value = "1">
						<?php }?>
						&nbsp;

						
				      </td>
					</tr>

					<tr <?php if( ($rs->type != 2) || ($rs->type == "") ){?> style = "display:none;" <?php }?> id="sum_talub">
						<td>&nbsp;</td>
						<td>
							<select name="sum_talub" >
								<option value="0" <?php echo $fnc->selected($rs->sum_talub,"0");?>>เลือกซุ้ม</option>
								<option value="1" <?php echo $fnc->selected($rs->sum_talub,"1");?>>ไม่ซุ้ม</option>
								<option value="2" <?php echo $fnc->selected($rs->sum_talub,"2");?>>ยกซุ้ม</option>
							</select>
						</td>
					</tr>
					
						<script type="text/javascript">
						<!--
							function fnc_proid_1(id){
								if(id == "1"){
									document.getElementById('cat_type').innerHTML = '<select name="soom" id = "soom" style = "width:155px;" onchange ="fnc_soom(this.value);"><option value="1">ไม่ซุ้ม</option><option value="2">ยกซุ้ม</option></select>';
									document.getElementById('sum_talub').style.display = "none";
								}
								if(id == "2"){
									document.getElementById('cat_type').innerHTML = '<select name="soom" id = "soom" style = "width:155px;"><option value="1">เปิดหลัง</option><option value="2">ปิดหลัง</option><option value="3">ปิดหลังแกะภาพ</option></select>';
								document.getElementById('sum_talub').style.display = "";
								}
								if(id == "3"){
									document.getElementById('cat_type').innerHTML = '<select name="soom" id = "soom" style = "width:155px;"><option value="2">ยกซุ้ม</option><option value="1">ไม่ซุ้ม</option></select>';
									document.getElementById('sum_talub').style.display = "none";
								}
								if(id == "5"){
									document.getElementById('cat_type').innerHTML = '<select name="soom" id = "soom" style = "width:155px;" onchange ="fnc_soom(this.value);"><option value="1">ไม่ซุ้ม</option><option value="2">ยกซุ้ม</option></select>';
									document.getElementById('sum_talub').style.display = "none";
								}
								if(id == "4"){
									document.getElementById('cat_type').innerHTML = '<input type="hidden" id="soom" value = "1">';
									document.getElementById('sum_talub').style.display = "none";
								}
								

								var soom = document.getElementById('soom').value; 
									
									
								if(id == "1"){
									document.getElementById('id_category').selectedIndex = "0";
									document.getElementById('p1').value = "A";
									document.getElementById('sp_id_1').innerHTML = "A";
									document.getElementById('type_').value = "1";
									document.getElementById('type').value = "1";
									document.getElementById('id_type_accessories').style.display = "none";
								}

							
								else if(id == "5"){
									document.getElementById('id_category').selectedIndex = "0";
									document.getElementById('p1').value = "F";
									document.getElementById('sp_id_1').innerHTML = "F";
									document.getElementById('type_').value = "5";
									document.getElementById('type').value = "5";
									document.getElementById('id_type_accessories').style.display = "none";
								}


								else if(id == "2"){
									document.getElementById('id_category').selectedIndex = "0";
									document.getElementById('p1').value = "C";
									document.getElementById('sp_id_1').innerHTML = "C";
									document.getElementById('type_').value = "2";
									document.getElementById('id_type_accessories').style.display = "none";
								}

								else if(id == "3"){
									document.getElementById('id_category').selectedIndex = "0";
									document.getElementById('p1').value = "E";
									document.getElementById('sp_id_1').innerHTML = "E";
									document.getElementById('type_').value = "3";
									document.getElementById('id_type_accessories').style.display = "none";
								}

								

								else if(id == "4"){
									document.getElementById('p1').value = "D";
									document.getElementById('sp_id_1').innerHTML = "D";
									document.getElementById('type_').value = "4";
									document.getElementById('id_category').value = "36@99";
									document.getElementById('id_category').selectedIndex = "10";
									document.getElementById('p2').value = "AC";
									document.getElementById('sp_id_2').innerHTML = "AC";
									document.getElementById('id_sub_category').style.visibility = 'hidden';
									document.getElementById('id_type_accessories').style.display = "";
									fnc_group(4+"@");
								}

								document.getElementById('si').value = 0;
								document.getElementById('total_wage').value = 0;
								document.getElementById('si_text').innerHTML = "";
								document.getElementById('total_wage_text').innerHTML = "";

								document.getElementById('content').innerHTML = "";
							}

							function fnc_soom(id){
								
								var type = document.getElementById('type').value;
								//alert(id+type); กรอบ 90 /////////////////////
								if( (id==2) && (type==1) ){
									document.getElementById('p1').value = "B";
									document.getElementById('sp_id_1').innerHTML = "B";
								}

								if( (id==1) && (type==1) ){
									document.getElementById('p1').value = "A";
									document.getElementById('sp_id_1').innerHTML = "A";
								}

								if( (id==1) && (type==5) ){
									document.getElementById('p1').value = "F";
									document.getElementById('sp_id_1').innerHTML = "F";
								}

								if( (id==2) && (type==5) ){
									document.getElementById('p1').value = "G";
									document.getElementById('sp_id_1').innerHTML = "G";
								}

								/////////////////////////////////////////////


							}
						//-->
						</script>

					
					


					<tr id = "category__">
					  <td width = "15%" align = "right">***<b>แบบพิมพ์กรอบ:</b></td><td>
					
						<select name="id_category" id="id_category" onchange = "fnc_type(this.value);" style = "width:150px;">
							<option value="0">แบบพิมพ์กรอบ</option>
							<?php if(!empty($row_category)){
							foreach($row_category as $rs_category){	
							?>
							<option value="<?php echo $rs_category->id_category;?>@<?php echo $rs_category->num_category;?>" <?php echo $fnc->selected($rs->id_category,$rs_category->id_category);?>><?php echo $rs_category->num_category."  ".$rs_category->name_category;?></option>
							<?php }?>
							<?php }?>
						</select>
						
						
						<select name="id_type_accessories" id="id_type_accessories"  style = "width:150px;">
							<option value="0">ประเภทอุปกรณ์</option>
							<?php if(!empty($row_type_accessories)){
							foreach($row_type_accessories as $rs_type_accessories){	
							?>
							<option value="<?php echo $rs_type_accessories->id_type_accessories;?>" <?php echo $fnc->selected($rs->id_type_accessories,$rs_type_accessories->id_type_accessories);?>><?php echo $rs_type_accessories->name_type_accessories;?></option>
							<?php }?>
							<?php }?>
						</select>

				      </td>
					</tr>

					


					<tr>
					  <td width = "15%" align = "right"><b>&nbsp;</b></td>
					  <td id = "sub_category">
					<?php
					  $row_sub	  = $db->result("tb_sub_category",' id_category = "'.$rs->id_category.'" ', 'id_sub_category asc');

					  if($rs->type != 4){
					?>
<select name="id_sub_category" id = "id_sub_category" onchange = "fnc_group(this.value);"  style = "width:250px;height:20px;">
						    <option value="0">เลือกเบอร์</option>
							<?php if(!empty($row_sub)){
								foreach($row_sub as $rs_sub){
								?>
							<option style="background-image:url(../thumb/example1_select.png);height:50px; background-repeat:no-repeat; padding-left: 50px;padding-top:18px;" value = "<?php echo $rs_sub->id_sub_category."@".$rs_sub->no_sub_category;?>" <?php echo $fnc->selected($rs_sub->id_sub_category,$rs->id_sub_category);?> ><?php echo $rs_sub->no_sub_category."  ".$rs_sub->name_sub_category;?></option>
								<?php 
									}
								  }
								?>				
							
							</select>
						<?php }?>


				      </td>
					</tr>
					
					
					<tr>
						<td width = "5%" align = "right">&nbsp;</td>
						<td id = "content">
								

							<?php if($rs->id_product !=""){
							include "show_content_update.php";
							
							}
							?>
						</td>
					</tr>
				

					<tr>
					  <td width = "15%" align = "right">
						<b>ค่าแรงพิเศษ:</b></td><td><input type="text" name="special_wage" id = "special_wage" style = "width:80px;" onblur = "special_wage_();" value = "<?php if($rs->special_wage !=""){echo $rs->special_wage;}else{?>0<?php }?>">&nbsp;&nbsp;หมายเหตุ:<input type="text" name="remark_wage" style = "width:300px;" value = "<?php echo $rs->remark_wage;?>"></td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						<b>ค่าซิเพิ่ม:</b></td><td><input type="text" name="special_si" id = "special_si" style = "width:80px;" onblur = "special_si_();" value = "<?php if($rs->special_si !=""){echo $rs->special_si;}else{?>0<?php }?>"></td>
					</tr>
					

					<tr>
					  <td width = "15%" align = "right">
						<b>น้ำหนัก:</b></td><td><input type="text" name="weight" id = "weight" style = "background-color:#ffffcc;width:80px;" value = "<?php echo $rs->weight;?>">&nbsp;&nbsp;<input type="button" value="ขอน้ำหนัก" onclick="fnc_search();"></td>
					</tr>

					


					<?php 
							function check_date_($date_){
								if($date_ == "0000-00-00"){
									return "";
								}else{
									return $date_;
								}
							}
					?>

					<tr>
					  <td width = "15%" align = "right"><b>วันที่นำเข้า:</b></td>
					  <td><input name="date_product" type="text" class="box" id="date_product" style=" width:80px"  value="<?php echo $fnc->_date($rs->date_product);?>"/><a href="javascript:displayDatePicker('date_product')"><IMG SRC="images/b_calendar.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a>
				      </td>
					</tr>

					<script type="text/javascript">
					function fnc(a){
					document.getElementById('id_type_product_').value = a;
					}
					</script>


					<!-- <tr>
					  <td width = "15%" align = "right">
						<b>ราคาต่อหน่วย:</b></td><td><input type="text" name="unit_price" style ="width:50px;" value = "<?php echo $rs->unit_price;?>"> Auto
				      </td>
					</tr>
 -->
			
					<?php if($_GET['previos'] !=1){?>
					<tr>
					  <td width = "15%" align = "right">
						<b>จำนวนสินค้า:</b></td><td><input type="text" name="total_product" style ="width:50px;" value = "<?php if($rs->total_product !=""){echo $rs->total_product;}else{echo "1";}?>" readonly>
				      </td>
					</tr>
					<?php }else{?>
					<tr>
					  <td width = "15%" align = "right">
						<b>จำนวนสินค้า:</b></td><td><input type="text" name="total_product" style ="width:50px;" value = "1" readonly>
				      </td>
					</tr>
					<?php }?>


					<tr>
					  <td width = "15%" align = "right">
						<b>Note_Barcode:</b></td>
						<td><input type="text" name="stone_sum_1_product" style ="width:120px;" value = "<?php echo $rs->stone_sum_1_product;?>">
				      </td>
					</tr>

					

					<tr>
					  <td width = "15%" align = "right">
						<b>Picture1:</b></td><td><input type="file" name="file" style ="width:150px;">
				      </td>
					</tr>
					<tr>
					  <td width = "15%" align = "right">
						<b>Picture2:</b></td><td><input type="file" name="file2" style ="width:150px;">
				      </td>
					</tr>

					<tr>
					  <td width = "15%" align = "right">
						<b>Stock:</b></td><td>
						<select name="id_stock" style = "width:150px;">
							<?php if(!empty($row_stock)){
							foreach($row_stock as $rs_stock){	
							?>
							<option value="<?php echo  $rs_stock->id_stock?>" <?php echo $fnc->selected($rs_stock->id_stock,$rs->id_stock);?>><?php echo $rs_stock->name_stock;?></option>
							<?php }}?>
						</select>
				      </td>
					</tr>
					

					<tr>
					  <td width = "15%" align = "right">
						<b>Remark:</b></td><td>
						<textarea name="remark_product" style = "width:250px;height:50px;" ><?php echo $rs->remark_product;?></textarea>
				      </td>
					</tr>

	
					<tr>
					  <td>&nbsp;</td><td>
					  <input name="save" type="hidden" id="save" value="news_add" />
					  
					  <?php if($_GET['previos'] !=1){?>
						<INPUT TYPE="hidden" NAME="id" id = "id_product" value = "<?php echo $rs->id_product;?>">
					  <?php }?>

					  
					  <input name="image" type="image" src="images/b_save.gif" />
				        <a href="main.php?op=<?php echo $_GET['op']?>&act=list"><img src="images/b_cancel.gif" border="0"/></a></td>

				  </tr>
				</table>
			</td>

			<td align="left" bgcolor="#ccffcc" valign = "top">
				<table width = "300" height = "600" border = "0">
				<tr>
					<td align = "center">
					&nbsp;<br><br><br><br><br>
					</td>
				</tr>

				<tr style= 'visibility:hidden' >
					<td align = "center">
					<div style="border: 3px coral solid; width: 120px;height:100px;"><h4 >ราคาทอง</h4><h2 id = "gold_text">23600</h2><input type="hidden" id ="gold" value = "23600">
					
					</div>
					</td>
				</tr>

				<tr style= 'visibility:hidden'>
					<td align = "center">
					<div style="border: 3px coral solid; width: 120px;height:100px;"><h4>เปอร์เซ็น</h4><h2 id="percent_text">105</h2><input type="hidden" id="percent_" value = "105">
					
					</div>
					</td>
				</tr>

				<tr>
					<td align = "center">
					<div style="border: 3px coral solid; width: 120px;height:100px;"><h4>น้ำหนัก</h4><h2 id="weight_text"><?php echo $rs->weight;?></h2>&nbsp;
					
					</div>
					</td>
				</tr>
				
				<tr>
					<td align = "center">
					<div style="border: 3px coral solid; width: 120px;height:100px;"><h4>ค่าซิ</h4><h2 id="si_text">&nbsp;<?php echo $rs->si_product;?></h2>
					<input type="hidden" name = "si" id="si" value = "<?php if($rs->si_product !=""){ echo $rs->si_product;}else{ echo "0";} ?>">
					</div>
					</td>
				</tr>

				<tr>
					<td align = "center">
					<div style="border: 3px coral solid; width: 120px;height:100px;"><h4>น้ำหนักรวมซิ</h4><h2 id="total_wage_si_text">&nbsp;<?php echo $rs->total_wage_si;?></h2>
					<input type="hidden" name = "total_wage_si" id="total_wage_si" value = "<?php if($rs->total_wage_si !=""){echo $rs->total_wage_si;}else{ echo "0";}?>">
					</div>
					</td>
				</tr>


				<tr>
					<td align = "center">
					<div style="border: 3px coral solid; width: 120px;height:100px;"><h4>ค่าแรง</h4>
					<h2 id="total_wage_text">&nbsp;<?php echo $rs->total_wage;?></h2><input type="hidden" name="total_wage" id="total_wage" value = "<?php if($rs->total_wage !=""){ echo $rs->total_wage;}else{ echo "0";}?>">
					</div>
					</td>
				</tr>

				<tr style= 'visibility:hidden'>
					<td align = "center">
					<div style="border: 3px #ff0000 solid; width: 120px;height:100px;"><h4 >ราคาต้นทุน</h4><h2 id="price_text">&nbsp;
					</h2><input type="hidden" id="price">
					</div>
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