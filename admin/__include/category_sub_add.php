<?php  

	


	if($_GET['id_sub'] !=""){
		$rs = $sys->Update("tb_sub_category","id_sub_category",$_GET['id_sub']);
	}



	if(($_POST['save'] == "news_add") and ($_GET['id_sub'] == "")){
		
		
		$data_sub_category = array(
			"no_sub_category"			=> $_POST['no_sub_category'],
			"name_sub_category"			=> $_POST['name_sub_category'],
			"pic_sub_category"			=> $fnc->upload($_FILES["file"]["tmp_name"],$_FILES["file"]["name"],"../thumb/"),
			"size_sub_category"			=> $_POST['size_sub_category'],
			"id_category"				=> $_SESSION['id_category']			
		);
		$sys->db->insert("tb_sub_category",$data_sub_category);
		$id_sub_category = $sys->db->id();
		

		$c  = array("one","two","three","four","five");
		
		foreach($c as $c_){
		if(!empty($_POST['data_backmunk_'.$c_.''])){
		foreach($_POST['data_backmunk_'.$c_.''] as $data_backmunk){
			$data_munk_back_sub_category = array(
			"id_back_munk"		=>	$data_backmunk,
			"id_sub_category"	=>  $id_sub_category
		);
			$sys->db->insert("tb_munk_back_sub_category_".$c_."",$data_munk_back_sub_category);
		}
		}

		}


		foreach($c as $c_){
			if(!empty($_POST['data_type_product_'.$c_.''])){
		foreach($_POST['data_type_product_'.$c_.''] as $data_type_product){
			$data_data_type_product = array(
			"id_type_product"	=>	$data_type_product,
			"id_sub_category"	=>  $id_sub_category
		);
			$sys->db->insert("tb_type_product_sub_category_".$c_."",$data_data_type_product);
		}
			}
		}


		foreach($c as $c_){
		if(!empty($_POST['data_medicine_'.$c_.''])){
		foreach($_POST['data_medicine_'.$c_.''] as $data_medicine){
			$data_data_medicine = array(
			"id_medicine"	=>	$data_medicine,
			"id_sub_category"	=>  $id_sub_category
		);
			$sys->db->insert("tb_medicine_sub_category_".$c_."",$data_data_medicine);
		}
		}
		}

		foreach($c as $c_){
			if(!empty($_POST['data_special_'.$c_.''])){
		foreach($_POST['data_special_'.$c_.''] as $data_special){
			$data_data_special = array(
			"id_special"	=>	$data_special,
			"id_sub_category"	=>  $id_sub_category
		);
			$sys->db->insert("tb_special_sub_category_".$c_."",$data_data_special);
		}
			}
		}

		foreach($c as $c_){
		if(!empty($_POST['data_diamond_'.$c_.''])){
		foreach($_POST['data_diamond_'.$c_.''] as $data_diamond){
			$data_data_diamond = array(
			"id_diamond"	=>	$data_diamond,
			"id_sub_category"	=>  $id_sub_category
		);
			$sys->db->insert("tb_diamond_sub_category_".$c_."",$data_data_diamond);
		}
		}
		}

		echo '<script type="text/javascript">
		<!--
			window.location.replace("?op=category&act=list_subcategory");
		//-->
		</script>';

	}

/////////////////////////// Edit/////////////////////////////////////////////////////////////

	if(($_POST['save'] == "news_add") and ($_GET['id_sub'] != "")){
	
		if($_FILES["file"]["tmp_name"] != ""){
			$data_sub_category = array(
				"no_sub_category"			=> $_POST['no_sub_category'],
				"name_sub_category"			=> $_POST['name_sub_category'],
				"pic_sub_category"			=> $fnc->upload($_FILES["file"]["tmp_name"],$_FILES["file"]["name"],"../thumb/"),
				"size_sub_category"			=> $_POST['size_sub_category']		
			);
		}else{
			$data_sub_category = array(
				"no_sub_category"			=> $_POST['no_sub_category'],
				"name_sub_category"			=> $_POST['name_sub_category'],
				"size_sub_category"			=> $_POST['size_sub_category']		
			);

		}

		$sys->db->update("tb_sub_category", $data_sub_category, " id_sub_category = '".$_POST['id']."' ");

		$id_sub_category = $_POST['id'];
		
	

		$c  = array("one","two","three","four","five");
		
		foreach($c as $c_){
			$sys->db->delete("tb_munk_back_sub_category_".$c_."", " id_sub_category = '".$_POST['id']."' ");

		if(!empty($_POST['data_backmunk_'.$c_.''])){
		foreach($_POST['data_backmunk_'.$c_.''] as $data_backmunk){
			$data_munk_back_sub_category = array(
			"id_back_munk"		=>	$data_backmunk,
			"id_sub_category"	=>  $id_sub_category
		);
			$sys->db->insert("tb_munk_back_sub_category_".$c_."",$data_munk_back_sub_category);
		}
		}

		}


		foreach($c as $c_){
			$sys->db->delete("tb_type_product_sub_category_".$c_."", " id_sub_category = '".$_POST['id']."' ");
			if(!empty($_POST['data_type_product_'.$c_.''])){
		foreach($_POST['data_type_product_'.$c_.''] as $data_type_product){
			$data_data_type_product = array(
			"id_type_product"	=>	$data_type_product,
			"id_sub_category"	=>  $id_sub_category
		);
			$sys->db->insert("tb_type_product_sub_category_".$c_."",$data_data_type_product);
		}
			}
		}


		foreach($c as $c_){
			$sys->db->delete("tb_medicine_sub_category_".$c_."", " id_sub_category = '".$_POST['id']."' ");
		if(!empty($_POST['data_medicine_'.$c_.''])){
		foreach($_POST['data_medicine_'.$c_.''] as $data_medicine){
			$data_data_medicine = array(
			"id_medicine"	=>	$data_medicine,
			"id_sub_category"	=>  $id_sub_category
		);
			$sys->db->insert("tb_medicine_sub_category_".$c_."",$data_data_medicine);
		}
		}
		}

		foreach($c as $c_){
			$sys->db->delete("tb_special_sub_category_".$c_."", " id_sub_category = '".$_POST['id']."' ");
			if(!empty($_POST['data_special_'.$c_.''])){
		foreach($_POST['data_special_'.$c_.''] as $data_special){
			$data_data_special = array(
			"id_special"	=>	$data_special,
			"id_sub_category"	=>  $id_sub_category
		);
			$sys->db->insert("tb_special_sub_category_".$c_."",$data_data_special);
		}
			}
		}

		foreach($c as $c_){
				$sys->db->delete("tb_diamond_sub_category_".$c_."", " id_sub_category = '".$_POST['id']."' ");
		if(!empty($_POST['data_diamond_'.$c_.''])){
		foreach($_POST['data_diamond_'.$c_.''] as $data_diamond){
			$data_data_diamond = array(
			"id_diamond"	=>	$data_diamond,
			"id_sub_category"	=>  $id_sub_category
		);
			$sys->db->insert("tb_diamond_sub_category_".$c_."",$data_data_diamond);
		}
		}
		}

		echo '<script type="text/javascript">
		<!--
			window.location.replace("main.php?op=category&act=list_subcategory");
		//-->
		</script>';

	}

	//echo $fnc->form_check($message_alert);

	function check_null($v=null){
		if($v == ""){
			return "0";
		}else{
			return $v;
		}
	}

	function fnc_size($j){
		switch ($j) {
			case 0:
				echo "S";
				break;
			case 1:
				echo "M";
				break;
			case 2:
				echo "L";
				break;
			case 3:
				echo "XL";
				break;
		}
	}

	function check_title($r){
		switch ($r){
			case 0:
				echo "ค่าซิ";
				break;
			case 4:
				echo "ค่าแรง";
				break;
		}
	}
	$rs_category = $sys->db->record("tb_category"," id_category = '".$_SESSION['id_category']."' ");

?>



<table width="100%" cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td height="40" align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th"><?php echo ($_GET['id'])? 'แก้ไข' : 'เพิ่ม' ;?>แบบ พิมพ์กรอบ</td>
        </tr></table></td>
    </tr>
    <tr>
        <td align="center">
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="th2">
	<FORM METHOD=POST onsubmit="return chkvalue(this)" enctype="multipart/form-data" ACTION="main.php?op=category&act=add_subcategory&rd=67126&id_sub=<?php echo $_GET['id_sub'];?>">
		<tr height="30" class="l">
			<td width="100%" align="left" bgcolor="#E7F1F8">
				<table class="th3" cellpadding="0" cellspacing = "0" border="0" width="100%">

				    <tr border = "0">
					  <td  width = "25%">&nbsp;</td>
					  <td  width = "25%">&nbsp;</td>
					  <td  width = "25%">&nbsp;</td>
					  <td  width = "25%">&nbsp;</td>
					</tr>

				   <tr>
					  <td align="right"><b>พิมพ์กรอบ:</b> &nbsp;&nbsp;</td>
					  <td colspan = "4"><?php echo $rs_category->name_category;?></td>
					</tr>

					<tr>
					  <td align="right" ><b>รหัสแบบ: </b>&nbsp;&nbsp;</td>
					  <td colspan = "4"><input name="no_sub_category" type="text" class="box" id="no_sub_category" style=" border-color:#0000FF; width:50px"  value="<?php echo $rs->no_sub_category;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" ><b>ชื่อแบบพิมพ์กรอบ:</b>&nbsp;&nbsp; </td>
					  <td colspan = "4"><input name="name_sub_category" type="text" class="box" id="name_sub_category" style=" border-color:#0000FF; width:350px"  value="<?php echo $rs->name_sub_category;?>"/>
				      </td>
					</tr>

					<tr>
					  <td align="right" ><b>ภาพแบบ:</b>&nbsp;&nbsp; </td>
					  <td colspan = "4">
					  <input type="hidden" name="pic_sub_category" value = "<?php echo $rs->pic_sub_category;?>">
					  <input type="file" name="file" style ="width:80px;">
				      </td>
					</tr>

					<tr>
					  <td align="right" ><b>Size:</b>&nbsp;&nbsp; </td>
					  <td colspan = "4">
					  <input type="radio" name="size_sub_category" value = "S" <?php echo $fnc->checked($rs->size_sub_category,"S");?>>:S&nbsp;&nbsp;<input type="radio" name="size_sub_category" value = "M" <?php echo $fnc->checked($rs->size_sub_category,"M");?>>:M&nbsp;&nbsp;
					  <input type="radio" name="size_sub_category" value = "L" <?php echo $fnc->checked($rs->size_sub_category,"L");?>>:L&nbsp;&nbsp;<input type="radio" name="size_sub_category" value = "XL" <?php echo $fnc->checked($rs->size_sub_category,"XL");?>>:XL&nbsp;&nbsp;
				      </td>
					</tr>



					<tr>
					  <td align="center" colspan = "4" >&nbsp;</td>
					</tr>

					<!--////////////////////////////////////// แผ่นปิดหลัง//////////////////////////////////////////////////////// -->
					<tr>
					  <td align="center" colspan = "4" bgcolor="#c0c0c0"><b>แผ่นปิดหลัง</b></td>
					</tr>

				    <tr width = "100%">
					 <td align="left"><b>กรอบ 90</b><br><input type="checkbox" id="check_90_backmunk" onclick = "fnc_check_all_backmunk(1);">:Check All</td>
					 
					 <td align="left"><b>ตลับ</b><br><input type="checkbox" id="check_tarub_backmunk" onclick = "fnc_check_all_backmunk(2);" name="">:Check All</td>
					 
					 <td align="left"><b>กรอบ 70</b><br><input type="checkbox" id="check_70_backmunk" onclick = "fnc_check_all_backmunk(3);">:Check All</td>
					 
					  <td align="left"><b>กรอบ 75</b><br><input type="checkbox" id="check_75_backmunk" onclick = "fnc_check_all_backmunk(4);">:Check All</td>
					</tr>

					<script type="text/javascript">
					<!--
						function fnc_check_all_backmunk(i){
							var mk_ = document.getElementById("mk_").value;

							////////////////////   กรอบ 90 //////////////////////////////
							var ch_all_mk90 = document.getElementById('ch_all_mk90').value;
							if( (i==1) && (ch_all_mk90==1) ){
								for(j=1;j<=mk_;j++){
								document.getElementById('data_backmunk_one'+j+'').checked = true;
								document.getElementById('ch_all_mk90').value = "2";
								}
							}
							
							if( (i==1) && (ch_all_mk90==2) ){
								for(j=1;j<=mk_;j++){
								document.getElementById('data_backmunk_one'+j+'').checked = false;
								document.getElementById('ch_all_mk90').value = "1";
								}
							}

							
							if(i==4){
								for(j=1;j<=mk_;j++){
								document.getElementById('data_backmunk_five'+j+'').checked = true;
								}
							}

							//////////////////////////////////////////////////////////////


							////////////////////   ตลับ //////////////////////////////
							var ch_all_mktarub = document.getElementById('ch_all_mktarub').value;
							if( (i==2) && (ch_all_mktarub==1) ){
								for(j=1;j<=mk_;j++){
								document.getElementById('data_backmunk_two'+j+'').checked = true;
								document.getElementById('ch_all_mktarub').value = "2";
								}
							}
							
							if( (i==2) && (ch_all_mktarub==2) ){
								for(j=1;j<=mk_;j++){
								document.getElementById('data_backmunk_two'+j+'').checked = false;
								document.getElementById('ch_all_mktarub').value = "1";
								}
							}
							//////////////////////////////////////////////////////////////


							////////////////////   กรอบ 70 //////////////////////////////
							var ch_all_mk70 = document.getElementById('ch_all_mk70').value;
							if( (i==3) && (ch_all_mk70==1) ){
								for(j=1;j<=mk_;j++){
								document.getElementById('data_backmunk_three'+j+'').checked = true;
								document.getElementById('ch_all_mk70').value = "2";
								}
							}
							
							if( (i==3) && (ch_all_mk70==2) ){
								for(j=1;j<=mk_;j++){
								document.getElementById('data_backmunk_three'+j+'').checked = false;
								document.getElementById('ch_all_mk70').value = "1";
								}
							}

						
							//////////////////////////////////////////////////////////////

						}
					//-->
					</script>
					
					<?php 
						$row_backmunk = $sys->db->result("tb_backmunk", null, " id_backmunk asc ");
						function fnc_check($id=null){
							if($id!=""){
								return "checked";
							}
						}
						$i = -1;
						$mk = 0;
						foreach($row_backmunk as $rs_backmunk){ $i++;
						$mk++;
					 ?>
					<tr>
					<?php 
					?>
					
					  <tr>
						<?php 
						$data = array("one","two","three","four","five"); 


					    for($i=0;$i<5;$i++){
							$rs_back = $sys->db->record("tb_munk_back_sub_category_".$data[$i].""," id_sub_category = '".$rs->id_sub_category."' and id_back_munk = '".$rs_backmunk->id_backmunk."' ");
							
							?>
						<?php if($data[$i] !="four"){?>
						<td><input type="checkbox" name="data_backmunk_<?php echo $data[$i];?>[]" id = "<?php echo "data_backmunk_".$data[$i].$mk;?>" value = "<?php echo $rs_backmunk->id_backmunk; ?>" <?php echo fnc_check($rs_back->id_back_munk);?>>&nbsp;<span style = "color:#ff0000;"><?php echo $rs_backmunk->name_backmunk;?></span></td>
						<?php }?>

						<?php }?>
					  </tr>
					  
					

					</tr>
					<?php }
						$i = -1;
	
					  ?>

					<input type="hidden" id="mk_" value = "<?php echo $mk;?>">
					<input type="hidden" id="ch_all_mk90" value = "1">
					<input type="hidden" id="ch_all_mktarub" value = "1">
					<input type="hidden" id="ch_all_mk70" value = "1">
					<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////// -->

				


				<!--////////////////////////////////////// รูแบบ//////////////////////////////////////////////////////// -->
					<tr>
					  <td align="center" colspan = "4" >&nbsp;</td>
					</tr>

					<tr>
					  <td align="center" colspan = "4" bgcolor="#c0c0c0"><b>รูปแบบ</b></td>
					</tr>

				    <tr>
					  <td align="left"><b>กรอบ 90</b><br><input type="checkbox" id="check_90_type_product" onclick = "fnc_check_all_type_product(1);">:Check All</td>
					 
					 <td align="left"><b>ตลับ</b><br><input type="checkbox" id="check_tarub_type_product" onclick = "fnc_check_all_type_product(2);" name="">:Check All</td>
					 
					 <td align="left"><b>กรอบ 70</b><br><input type="checkbox" id="check_70_type_product" onclick = "fnc_check_all_type_product(3);">:Check All</td>
					 
					 <td align="left"><b>กรอบ 75</b><br><input type="checkbox" id="check_75_type_product" onclick = "fnc_check_all_type_product(4);">:Check All</td>
					
						<script type="text/javascript">
					<!--
						function fnc_check_all_type_product(i){
							var t_ = document.getElementById("t_").value;

							////////////////////   กรอบ 90 //////////////////////////////
							var ch_all_t90 = document.getElementById('ch_all_t90').value;
							if( (i==1) && (ch_all_t90==1) ){
								for(j=1;j<=t_;j++){
								document.getElementById('data_type_product_one'+j+'').checked = true;
								document.getElementById('ch_all_t90').value = "2";
								}
							}
							
							if( (i==1) && (ch_all_t90==2) ){
								for(j=1;j<=t_;j++){
								document.getElementById('data_type_product_one'+j+'').checked = false;
								document.getElementById('ch_all_t90').value = "1";
								}
							}

							if(i==4){

								for(j=1;j<=t_;j++){
								document.getElementById('data_type_product_five'+j+'').checked = true;
								}
							}
							//////////////////////////////////////////////////////////////


							////////////////////   ตลับ //////////////////////////////
							var ch_all_ttarub = document.getElementById('ch_all_ttarub').value;
							if( (i==2) && (ch_all_ttarub==1) ){
								for(j=1;j<=t_;j++){
								document.getElementById('data_type_product_two'+j+'').checked = true;
								document.getElementById('ch_all_ttarub').value = "2";
								}
							}
							
							if( (i==2) && (ch_all_ttarub==2) ){
								for(j=1;j<=t_;j++){
								document.getElementById('data_type_product_two'+j+'').checked = false;
								document.getElementById('ch_all_ttarub').value = "1";
								}
							}
							//////////////////////////////////////////////////////////////


							////////////////////   กรอบ 70 //////////////////////////////
							var ch_all_t70 = document.getElementById('ch_all_t70').value;
							if( (i==3) && (ch_all_t70==1) ){
								for(j=1;j<=t_;j++){
								document.getElementById('data_type_product_three'+j+'').checked = true;
								document.getElementById('ch_all_t70').value = "2";
								}
							}
							
							if( (i==3) && (ch_all_t70==2) ){
								for(j=1;j<=t_;j++){
								document.getElementById('data_type_product_three'+j+'').checked = false;
								document.getElementById('ch_all_t70').value = "1";
								}
							}
							//////////////////////////////////////////////////////////////

						}
					//-->
					</script>


					</tr>
					
					<?php 
						$row_type = $sys->db->result("tb_type_product", " num_type_product = '1' ", " id_type_product asc ");
						$i = -1;
						$t = 0;
						foreach($row_type as $rs_type){ $i++;
						$t++;
					  ?>
				
					  <tr>
					  <?php for($i=0;$i<5;$i++){
							$rs_type_sub = $sys->db->record("tb_type_product_sub_category_".$data[$i].""," id_sub_category = '".$rs->id_sub_category."' and id_type_product = '".$rs_type->id_type_product."' ");
						  ?>
					<?php if($data[$i] !="four"){?>
						<td width = "70"><input type="checkbox" name="data_type_product_<?php echo $data[$i];?>[]" id = "<?php echo "data_type_product_".$data[$i].$t;?>" value = "<?php echo $rs_type->id_type_product?>" <?php echo fnc_check($rs_type_sub->id_type_product);?>>&nbsp;<span style = "color:#ff0000;"><?php echo $rs_type->name_type_product;?></span></td>
					<?php }?>

					  <?php }?>
						
					  </tr>
					
					

					</tr>
					<?php }
						$i = -1;
	
					  ?>

					<input type="hidden" id="t_" value = "<?php echo $t;?>">
					<input type="hidden" id="ch_all_t90" value = "1">
					<input type="hidden" id="ch_all_ttarub" value = "1">
					<input type="hidden" id="ch_all_t70" value = "1">
					
					<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////// -->

					

				  <!--////////////////////////////////////// ลงยา//////////////////////////////////////////////////////// -->
					
					<tr>
					  <td align="center" colspan = "4" >&nbsp;</td>
					</tr>
					<tr>
					  <td align="center" colspan = "4" bgcolor="#c0c0c0"><b>ลงยา</b></td>
					</tr>

				    <tr>
					 <td align="left"><b>กรอบ 90</b><br><input type="checkbox" id="check_90_medicine" onclick = "fnc_check_all_medicine(1);">:Check All</td>
					 
					 <td align="left"><b>ตลับ</b><br><input type="checkbox" id="check_tarub_medicine" onclick = "fnc_check_all_medicine(2);" name="">:Check All</td>
					 
					 <td align="left"><b>กรอบ 70</b><br><input type="checkbox" id="check_70_medicine" onclick = "fnc_check_all_medicine(3);">:Check All</td>

					  <td align="left"><b>กรอบ 75</b><br><input type="checkbox" id="check_75_medicine" onclick = "fnc_check_all_medicine(4);">:Check All</td>
					  
					  <td align="left"><!-- <b>อุปกรณ์</b> --></td>
					</tr>

					<script type="text/javascript">
					<!--
						function fnc_check_all_medicine(i){
							var m_ = document.getElementById("m_").value;

							////////////////////   กรอบ 90 //////////////////////////////
							var ch_all_m90 = document.getElementById('ch_all_m90').value;
							if( (i==1) && (ch_all_m90==1) ){
								for(j=1;j<=m_;j++){
								document.getElementById('data_medicine_one'+j+'').checked = true;
								document.getElementById('ch_all_m90').value = "2";
								}
							}
							
							if( (i==1) && (ch_all_m90==2) ){
								for(j=1;j<=m_;j++){
								document.getElementById('data_medicine_one'+j+'').checked = false;
								document.getElementById('ch_all_m90').value = "1";
								}
							}


							if(i==4){
								for(j=1;j<=m_;j++){
								document.getElementById('data_medicine_five'+j+'').checked = true;
								}
							}
							//////////////////////////////////////////////////////////////


							////////////////////   ตลับ //////////////////////////////
							var ch_all_mtarub = document.getElementById('ch_all_mtarub').value;
							if( (i==2) && (ch_all_mtarub==1) ){
								for(j=1;j<=m_;j++){
								document.getElementById('data_medicine_two'+j+'').checked = true;
								document.getElementById('ch_all_mtarub').value = "2";
								}
							}
							
							if( (i==2) && (ch_all_mtarub==2) ){
								for(j=1;j<=m_;j++){
								document.getElementById('data_medicine_two'+j+'').checked = false;
								document.getElementById('ch_all_mtarub').value = "1";
								}
							}
							//////////////////////////////////////////////////////////////


							////////////////////   กรอบ 70 //////////////////////////////
							var ch_all_m70 = document.getElementById('ch_all_m70').value;
							if( (i==3) && (ch_all_m70==1) ){
								for(j=1;j<=m_;j++){
								document.getElementById('data_medicine_three'+j+'').checked = true;
								document.getElementById('ch_all_m70').value = "2";
								}
							}
							
							if( (i==3) && (ch_all_m70==2) ){
								for(j=1;j<=m_;j++){
								document.getElementById('data_medicine_three'+j+'').checked = false;
								document.getElementById('ch_all_m70').value = "1";
								}
							}
							//////////////////////////////////////////////////////////////

						}
					//-->
					</script>
					
					<?php 
						$row_medicine = $sys->db->result("tb_medicine", null, " id_medicine asc ");
						$i = -1;
						$m = 0;
						foreach($row_medicine as $rs_medicine){ $i++;
						$m++;
					  ?>
					

			
					  <tr>
					  <?php for($i=0;$i<5;$i++){

						    $rs_medicine_sub = $sys->db->record("tb_medicine_sub_category_".$data[$i].""," id_sub_category = '".$rs->id_sub_category."' and id_medicine = '".$rs_medicine->id_medicine."' ");
						  ?>

						<?php if($data[$i] !="four"){?>
						<td width = "70"><input type="checkbox" name="data_medicine_<?php echo $data[$i];?>[]" id = "<?php echo "data_medicine_".$data[$i].$m;?>" value = "<?php echo $rs_medicine->id_medicine;?>" <?php echo fnc_check($rs_medicine_sub->id_medicine);?>>&nbsp;<span style = "color:#ff0000;"><?php echo $rs_medicine->name_medicine;?></span></td>
						<?php }?>

					  <?php }?>
					  </tr>
										

					</tr>
					<?php }
						$i = -1;
	
					  ?>
					<input type="hidden" id="m_" value = "<?php echo $m;?>">
					<input type="hidden" id="ch_all_m90" value = "1">
					<input type="hidden" id="ch_all_mtarub" value = "1">
					<input type="hidden" id="ch_all_m70" value = "1">

					<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////// -->



					 <!--////////////////////////////////////// ลักษณะพิเศษ//////////////////////////////////////////////////////// -->
					
					<tr>
					  <td align="center" colspan = "4" >&nbsp;</td>
					</tr>
					<tr>
					  <td align="center" colspan = "4" bgcolor="#c0c0c0"><b>ลักษณะพิเศษ</b></td>
					</tr>

				    <tr>
					  <td align="left"><b>กรอบ 90</b><br><input type="checkbox" id="check_90_special" onclick = "fnc_check_all_special(1);">:Check All</td>
					  <td align="left"><b>ตลับ</b><br><input type="checkbox" id="check_tarub_special" onclick = "fnc_check_all_special(2);" name="">:Check All</td>

					  <td align="left"><b>กรอบ 70</b><br><input type="checkbox" id="check_70_special" onclick = "fnc_check_all_special(3);">:Check All</td>

					   <td align="left"><b>กรอบ 75</b><br><input type="checkbox" id="check_75_special" onclick = "fnc_check_all_special(4);">:Check All</td>

					  <td align="left"><!-- <b>อุปกรณ์</b> --></td>
					</tr>

					<script type="text/javascript">
					<!--
						function fnc_check_all_special(i){
							var s_ = document.getElementById("s_").value;

							////////////////////   กรอบ 90 //////////////////////////////
							var ch_all_s90 = document.getElementById('ch_all_s90').value;
							if( (i==1) && (ch_all_s90==1) ){
								for(j=1;j<=s_;j++){
								document.getElementById('data_special_one'+j+'').checked = true;
								document.getElementById('ch_all_s90').value = "2";
								}
							}
							
							if( (i==1) && (ch_all_s90==2) ){
								for(j=1;j<=s_;j++){
								document.getElementById('data_special_one'+j+'').checked = false;
								document.getElementById('ch_all_s90').value = "1";
								}
							}

							if(i==4){
								for(j=1;j<=s_;j++){
								document.getElementById('data_special_five'+j+'').checked = true;
								}
							}
							//////////////////////////////////////////////////////////////


							////////////////////   ตลับ //////////////////////////////
							var ch_all_starub = document.getElementById('ch_all_starub').value;
							if( (i==2) && (ch_all_starub==1) ){
								for(j=1;j<=s_;j++){
								document.getElementById('data_special_two'+j+'').checked = true;
								document.getElementById('ch_all_starub').value = "2";
								}
							}
							
							if( (i==2) && (ch_all_starub==2) ){
								for(j=1;j<=s_;j++){
								document.getElementById('data_special_two'+j+'').checked = false;
								document.getElementById('ch_all_starub').value = "1";
								}
							}
							//////////////////////////////////////////////////////////////


							////////////////////   กรอบ 70 //////////////////////////////
							var ch_all_s70 = document.getElementById('ch_all_s70').value;
							if( (i==3) && (ch_all_s70==1) ){
								for(j=1;j<=s_;j++){
								document.getElementById('data_special_three'+j+'').checked = true;
								document.getElementById('ch_all_s70').value = "2";
								}
							}
							
							if( (i==3) && (ch_all_s70==2) ){
								for(j=1;j<=s_;j++){
								document.getElementById('data_special_three'+j+'').checked = false;
								document.getElementById('ch_all_s70').value = "1";
								}
							}
							//////////////////////////////////////////////////////////////

						}
					//-->
					</script>
					
					<?php 
						$row_special = $sys->db->result("tb_special", null, " id_special asc ");
						$i = -1;
						$s = 0;
						foreach($row_special as $rs_special){ $i++;
						$s++;
					  ?>

					  <tr>
					  <?php for($i=0;$i<5;$i++){
						    $rs_special_sub = $sys->db->record("tb_special_sub_category_".$data[$i].""," id_sub_category = '".$rs->id_sub_category."' and id_special = '".$rs_special->id_special."' ");
						  ?>
						
						<?php if($data[$i] !="four"){?>
						<td width = "70">
						<input type="checkbox" name="data_special_<?php echo $data[$i];?>[]" id = "<?php echo "data_special_".$data[$i].$s;?>"  value = "<?php echo $rs_special->id_special;?>" <?php echo fnc_check($rs_special_sub->id_special);?>>&nbsp;<span style = "color:#ff0000;"><?php echo $rs_special->name_special;?></span>
						<?php }?>
						</td>	
					  <?php }?>
					  </tr>
					

					</tr>
					<?php }
						$i = -1;
	
					  ?>

					<input type="hidden" id="s_" value = "<?php echo $s;?>">
					<input type="hidden" id="ch_all_s90" value = "1">
					<input type="hidden" id="ch_all_starub" value = "1">
					<input type="hidden" id="ch_all_s70" value = "1">

					
					<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////// -->
		
	

					 <!--////////////////////////////////////// ฝังเพชร//////////////////////////////////////////////////////// -->
					
					<tr>
					  <td align="center" colspan = "4" >&nbsp;</td>
					</tr>
					<tr>
					  <td align="center" colspan = "4" bgcolor="#c0c0c0"><b>ฝังเพชร</b></td>
					</tr>

				    <tr>
					  <td align="left"><b>กรอบ 90</b><br><input type="checkbox" id="check_90_dia" onclick = "fnc_check_all_diamond(1);">:Check All</td>
					  <td align="left"><b>ตลับ</b><br><input type="checkbox" id="check_tarub_dia" onclick = "fnc_check_all_diamond(2);" name="">:Check All</td>
					  <td align="left"><b>กรอบ 70</b><br><input type="checkbox" id="check_70_dia" onclick = "fnc_check_all_diamond(3);">:Check All</td>

					  <td align="left"><b>กรอบ 75</b><br><input type="checkbox" id="check_75_dia" onclick = "fnc_check_all_diamond(4);">:Check All</td>
					  <!-- <td align="left"><b>อุปกรณ์</b><input type="checkbox" name=""></td> -->
					</tr>

					<script type="text/javascript">
					<!--
						function fnc_check_all_diamond(i){
							var d_ = document.getElementById("d_").value;

							////////////////////   กรอบ 90 //////////////////////////////
							var ch_all_d90 = document.getElementById('ch_all_d90').value;
							if( (i==1) && (ch_all_d90==1) ){
								for(j=1;j<=d_;j++){
								document.getElementById('data_diamond_one'+j+'').checked = true;
								document.getElementById('ch_all_d90').value = "2";
								}
							}
							
							if( (i==1) && (ch_all_d90==2) ){
								for(j=1;j<=d_;j++){
								document.getElementById('data_diamond_one'+j+'').checked = false;
								document.getElementById('ch_all_d90').value = "1";
								}
							}

							if(i==4){
								for(j=1;j<=d_;j++){
								document.getElementById('data_diamond_five'+j+'').checked = true;
								}
							}
							//////////////////////////////////////////////////////////////


							////////////////////   ตลับ //////////////////////////////
							var ch_all_dtarub = document.getElementById('ch_all_dtarub').value;
							if( (i==2) && (ch_all_dtarub==1) ){
								for(j=1;j<=d_;j++){
								document.getElementById('data_diamond_two'+j+'').checked = true;
								document.getElementById('ch_all_dtarub').value = "2";
								}
							}
							
							if( (i==2) && (ch_all_dtarub==2) ){
								for(j=1;j<=d_;j++){
								document.getElementById('data_diamond_two'+j+'').checked = false;
								document.getElementById('ch_all_dtarub').value = "1";
								}
							}
							//////////////////////////////////////////////////////////////


							////////////////////   กรอบ 70 //////////////////////////////
							var ch_all_d70 = document.getElementById('ch_all_d70').value;
							if( (i==3) && (ch_all_d70==1) ){
								for(j=1;j<=d_;j++){
								document.getElementById('data_diamond_three'+j+'').checked = true;
								document.getElementById('ch_all_d70').value = "2";
								}
							}
							
							if( (i==3) && (ch_all_d70==2) ){
								for(j=1;j<=d_;j++){
								document.getElementById('data_diamond_three'+j+'').checked = false;
								document.getElementById('ch_all_d70').value = "1";
								}
							}
							//////////////////////////////////////////////////////////////

						}
					//-->
					</script>
					
					<?php 
						$row_diamond = $sys->db->result("tb_diamond", null, " id_diamond asc ");
						$i = -1;
						$d = 0;
						foreach($row_diamond as $rs_diamond){ $i++;
						$d++;
					  ?>
					
					  <tr>
					  <?php for($i=0;$i<5;$i++){
							$rs_diamond_sub = $sys->db->record("tb_diamond_sub_category_".$data[$i].""," id_sub_category = '".$rs->id_sub_category."' and id_diamond = '".$rs_diamond->id_diamond."' ");
						  ?><?php if($data[$i] !="four"){?>
						<td width = "70">
						
						<input type="checkbox" id = "<?php echo "data_diamond_".$data[$i].$d;?>" name="data_diamond_<?php echo $data[$i];?>[]" value = "<?php echo $rs_diamond->id_diamond;?>" <?php echo fnc_check($rs_diamond_sub->id_diamond);?> >&nbsp;<span style = "color:#ff0000;"><?php echo $rs_diamond->name_diamond;?></span>
						
						</td><?php }?>
					  <?php }?>
					  </tr>
				
						

					</tr>
					<?php }
						$i = -1;
	
					  ?>
					<input type="hidden" id="d_" value = "<?php echo $d;?>">
					<input type="hidden" id="ch_all_d90" value = "1">
					<input type="hidden" id="ch_all_dtarub" value = "1">
					<input type="hidden" id="ch_all_d70" value = "1">

					<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////// -->

					<tr>
					  <td colspan = "5" align = "center">&nbsp;</td>
				  </tr>
	
					<tr>
					  <td colspan = "5" align = "center">
					  <input name="save" type="hidden" id="save" value="news_add" />
					  <INPUT TYPE="hidden" NAME="id" value = "<?php echo $rs->id_sub_category;?>">
					  <input name="image" type="image" src="images/b_save.gif" />
						
					  


				        <a href="main.php?op=<?php echo $_GET['op']?>&act=list_subcategory"><img src="images/b_cancel.gif" border="0"/></a></td>
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