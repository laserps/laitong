<?php  




	if($_POST['save'] == "news_add"){
		$cat = array("one","two","three","four","five");
		$fix_tbl = array(
			"backmunk"		=>"id_backmunk",
			"type_product"	=>"id_type_product",
			"medicine"		=>"id_medicine",
			"special"		=>"id_special",
			"diamond"		=>"id_diamond");
		
	  foreach($fix_tbl as $tbl =>$id){$y++;
	  //echo $y;
	
       	for($i=0;$i<count($_POST[''.$id.'']);$i++){
			$p = 0;
			foreach($cat as $r_cat){
				
				//echo $r_cat." ";
			
				$sys->db->delete("tb_".$tbl."_".$r_cat."", " ".$id." = '".$_POST[''.$id.''][$i]."' ");


							
				$data1 = array("si_".$tbl."_".$r_cat."_S"	=>  $_POST['data'.$y.''][$i][$p]);
				$p=$p+1;
			
				$data2 = array("si_".$tbl."_".$r_cat."_M"	=>  $_POST['data'.$y.''][$i][$p]);
				$p=$p+1;
				
				$data3 = array("si_".$tbl."_".$r_cat."_L"	=>  $_POST['data'.$y.''][$i][$p]);
				$p=$p+1;
				
				$data4 = array("si_".$tbl."_".$r_cat."_XL"	=>  $_POST['data'.$y.''][$i][$p]);
				$p=$p+1;
				
				$data5 = array("wage_".$tbl."_".$r_cat."_S"	=>  $_POST['data'.$y.''][$i][$p]);
				$p=$p+1;
				
				$data6 = array("wage_".$tbl."_".$r_cat."_M"	=>  $_POST['data'.$y.''][$i][$p]);
				$p=$p+1;
				
				$data7 = array("wage_".$tbl."_".$r_cat."_L"	=>  $_POST['data'.$y.''][$i][$p]);
				$p=$p+1;
				
				$data8 = array("wage_".$tbl."_".$r_cat."_XL"=>  $_POST['data'.$y.''][$i][$p]);	
			    $p=$p+1;

				$data9 = array("".$id.""=>$_POST[''.$id.''][$i]);

				$data  = array_merge($data1,$data2,$data3,$data4,$data5,$data6,$data7,$data8,$data9);
				$sys->db->insert("tb_".$tbl."_".$r_cat."", $data);

			
			}
			

		

		}

	  }
		echo '<script type="text/javascript">
		<!--
			window.location.replace("?op=setting_&act=list");
		//-->
		</script>';
	}






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

?>

<script type="text/javascript">
<!--
	function fnc_open(a){
		var r_backmunk = document.getElementById('r_backmunk').value;
		var r_type_product = document.getElementById('r_type_product').value;
		var r_medicine = document.getElementById('r_medicine').value;
		var r_special = document.getElementById('r_special').value;
		var r_diamond = document.getElementById('r_diamond').value;

		if(a==1){
			for(i=1;i<=r_backmunk;i++){
				if( document.getElementById('wage_backmunk'+i+'').style.display == "none"){
					document.getElementById('wage_backmunk'+i+'').style.display = "";
					}
				else if(document.getElementById('wage_backmunk'+i+'').style.display == ""){
					document.getElementById('wage_backmunk'+i+'').style.display = "none";
				}
			}
		}


		if(a==2){
			for(i=1;i<=r_type_product;i++){
				if( document.getElementById('type_product'+i+'').style.display == "none"){
					document.getElementById('type_product'+i+'').style.display = "";
					}
				else if(document.getElementById('type_product'+i+'').style.display == ""){
					document.getElementById('type_product'+i+'').style.display = "none";
				}
			}
		}

		if(a==3){
			for(i=1;i<=r_medicine;i++){
				if( document.getElementById('medicine'+i+'').style.display == "none"){
					document.getElementById('medicine'+i+'').style.display = "";
					}
				else if(document.getElementById('medicine'+i+'').style.display == ""){
					document.getElementById('medicine'+i+'').style.display = "none";
				}
			}
		}

		if(a==4){
			for(i=1;i<=r_special;i++){
				if( document.getElementById('special'+i+'').style.display == "none"){
					document.getElementById('special'+i+'').style.display = "";
					}
				else if(document.getElementById('special'+i+'').style.display == ""){
					document.getElementById('special'+i+'').style.display = "none";
				}
			}
		}

		if(a==5){
			for(i=1;i<=r_diamond;i++){
				if( document.getElementById('diamond'+i+'').style.display == "none"){
					document.getElementById('diamond'+i+'').style.display = "";
					}
				else if(document.getElementById('diamond'+i+'').style.display == ""){
					document.getElementById('diamond'+i+'').style.display = "none";
				}
			}
		}

	}
//-->
</script>

<table width="100%" cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td height="40" align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">ตั้งค่าซิ-ค่่าแรง</td>
        </tr></table></td>
    </tr>
    <tr>
        <td align="center">
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="th3">
	<FORM METHOD=POST onsubmit="return chkvalue(this)" ACTION="main.php?op=setting_&act=list">
		<tr height="30" class="l">
			<td width="100%" align="left" bgcolor="#E7F1F8">
				<table class="th3" cellpadding="0" cellspacing = "0" border="1" width = "100%">


				<!--////////////////////////////////////// แผ่นปิดหลัง//////////////////////////////////////////////////////// -->
					<tr>
					  <td align="center" colspan = "5" bgcolor="#c0c0c0"><b>แผ่นปิดหลัง</b>&nbsp;<img src="images/other/arrow-down.gif"  border="0" alt="" style = "cursor:pointer;" onclick = "fnc_open(1);"> </td>
					</tr>

					
				    <tr>
					  <td align="center"><b>กรอบ 90</b></td>
					  <td align="center"><b>ตลับ</b></td>
					  <td align="center"><b>กรอบ 70</b></td>
					  <td align="center"><b>อุปกรณ์</b></td>
					  <td align="center"><b>กรอบ 75</b></td>
					</tr>
					
					<?php 
						$row_backmunk = $sys->db->result("tb_backmunk", null, " id_backmunk asc ");
						$i = -1;
						$k = 0;
						foreach($row_backmunk as $rs_backmunk){ $i++;
						$backmunk_one = $sys->db->record("tb_backmunk_one"," id_backmunk = '".$rs_backmunk->id_backmunk."' ");
						$data[$i][0] = $backmunk_one->si_backmunk_one_S;
						$data[$i][1] = $backmunk_one->si_backmunk_one_M;
						$data[$i][2] = $backmunk_one->si_backmunk_one_L;
						$data[$i][3] = $backmunk_one->si_backmunk_one_XL;
						$data[$i][4] = $backmunk_one->wage_backmunk_one_S;
						$data[$i][5] = $backmunk_one->wage_backmunk_one_M;
						$data[$i][6] = $backmunk_one->wage_backmunk_one_L;
						$data[$i][7] = $backmunk_one->wage_backmunk_one_XL;

						$backmunk_two = $sys->db->record("tb_backmunk_two"," id_backmunk = '".$rs_backmunk->id_backmunk."' ");
						$data[$i][8] = $backmunk_two->si_backmunk_two_S;
						$data[$i][9] = $backmunk_two->si_backmunk_two_M;
						$data[$i][10] = $backmunk_two->si_backmunk_two_L;
						$data[$i][11] = $backmunk_two->si_backmunk_two_XL;
						$data[$i][12] = $backmunk_two->wage_backmunk_two_S;
						$data[$i][13] = $backmunk_two->wage_backmunk_two_M;
						$data[$i][14] = $backmunk_two->wage_backmunk_two_L;
						$data[$i][15] = $backmunk_two->wage_backmunk_two_XL;

						$backmunk_three = $sys->db->record("tb_backmunk_three"," id_backmunk = '".$rs_backmunk->id_backmunk."' ");
						$data[$i][16] = $backmunk_three->si_backmunk_three_S;
						$data[$i][17] = $backmunk_three->si_backmunk_three_M;
						$data[$i][18] = $backmunk_three->si_backmunk_three_L;
						$data[$i][19] = $backmunk_three->si_backmunk_three_XL;
						$data[$i][20] = $backmunk_three->wage_backmunk_three_S;
						$data[$i][21] = $backmunk_three->wage_backmunk_three_M;
						$data[$i][22] = $backmunk_three->wage_backmunk_three_L;
						$data[$i][23] = $backmunk_three->wage_backmunk_three_XL;

						$backmunk_four = $sys->db->record("tb_backmunk_four"," id_backmunk = '".$rs_backmunk->id_backmunk."' ");
						$data[$i][24] = $backmunk_four->si_backmunk_four_S;
						$data[$i][25] = $backmunk_four->si_backmunk_four_M;
						$data[$i][26] = $backmunk_four->si_backmunk_four_L;
						$data[$i][27] = $backmunk_four->si_backmunk_four_XL;
						$data[$i][28] = $backmunk_four->wage_backmunk_four_S;
						$data[$i][29] = $backmunk_four->wage_backmunk_four_M;
						$data[$i][30] = $backmunk_four->wage_backmunk_four_L;
						$data[$i][31] = $backmunk_four->wage_backmunk_four_XL;


						$backmunk_five = $sys->db->record("tb_backmunk_five"," id_backmunk = '".$rs_backmunk->id_backmunk."' ");
						$data[$i][32] = $backmunk_five->si_backmunk_five_S;
						$data[$i][33] = $backmunk_five->si_backmunk_five_M;
						$data[$i][34] = $backmunk_five->si_backmunk_five_L;
						$data[$i][35] = $backmunk_five->si_backmunk_five_XL;
						$data[$i][36] = $backmunk_five->wage_backmunk_five_S;
						$data[$i][37] = $backmunk_five->wage_backmunk_five_M;
						$data[$i][38] = $backmunk_five->wage_backmunk_five_L;
						$data[$i][39] = $backmunk_five->wage_backmunk_five_XL;
						
						$k++
					 ?>
					<tr id = "wage_backmunk<?php echo $k;?>" style = "display:none;">
					<?php 

					$r =0;
					
					for($t=0;$t<5;$t++){
						
						?>
					 <td align="left">
					  <table width = "<?php if($t<1){echo "354";}else{ echo "245";}?>" align="left">
					  <tr>
						
						<?php if($t<1){?>
						<td width = "70"><span style = "color:#ff0000;"><?php echo $rs_backmunk->name_backmunk;?></span></td>
						<td width = "284">&nbsp;&nbsp;&nbsp;
						<?php }else{?>
						<td width = "245">&nbsp;&nbsp;&nbsp;
						<?php }?>

						<table>		
						<?php 
						for($tt=0;$tt<2;$tt++){?>
						<tr align = "<?php if($t<1){ echo "right";}else{ echo "left";}?>">
							<?php 
							
							for($j=0;$j<4;$j++){
								//echo $r;
							?>
							<td <?php if($t==3){echo "style = 'visibility:hidden;'";} ?>>
							<?php check_title($r);?>
							(<?php fnc_size($j);?>)<input type="text" name="data1[<?php echo $i?>][<?php echo $r;?>]" style = "width:30px; <?php if( ($r>11) && ( $r<=15 ))  {echo "background-color:#c0c0c0;";}?>" value = "<?php echo check_null($data[$i][$r]);?>" <?php if( ($r>11) && ( $r<=15 )){echo "readonly";}?>></td>
							<?php $r=$r+1; }?>
						</tr>
						<?php }?>
					
						</table>
					   </td>
					  </tr>
					  </table>

					   </td>
					   <?php }?>


						<input type="hidden" name="id_backmunk[]" value = "<?php echo $rs_backmunk->id_backmunk;?>" >
						

					</tr>
					<?php  
						 } 
						$i = -1;
						
					  ?>
					  <tr>
							<td colspan = "5"><a href="main.php?op=backmunk&act=list"><img src="images/add.gif" width="16" height="16" border="0" alt="">&nbsp;เพิ่ม ลบ แก้ไข</a></td>
						</tr>
					
					  <input type="hidden" id="r_backmunk" value = "<?php echo $k;?>">

					<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////// -->

				


				<!--////////////////////////////////////// รูแบบ//////////////////////////////////////////////////////// -->
					<tr>
					  <td align="center" colspan = "5" >&nbsp;</td>
					</tr>

					<tr>
					  <td align="center" colspan = "5" bgcolor="#c0c0c0"><b>รูปแบบ</b>&nbsp;<img src="images/other/arrow-down.gif"  border="0" alt="" style = "cursor:pointer;" onclick = "fnc_open(2);"></td>
					</tr>

				    <tr>
					  <td align="center"><b>กรอบ 90</b></td>
					  <td align="center"><b>ตลับ</b></td>
					  <td align="center"><b>กรอบ 70</b></td>
					  <td align="center"><b>อุปกรณ์</b></td>
					  <td align="center"><b>กรอบ 75</b></td
					</tr>
					
					<?php 
						$row_type = $sys->db->result("tb_type_product", " num_type_product = '1' ", " id_type_product asc ");
						$i = -1;
						$k2 = 0;
						foreach($row_type as $rs_type){ $i++;
						$type_product_one = $sys->db->record("tb_type_product_one"," id_type_product = '".$rs_type->id_type_product."' ");
						$data2[$i][0] = $type_product_one->si_type_product_one_S;
						$data2[$i][1] = $type_product_one->si_type_product_one_M;
						$data2[$i][2] = $type_product_one->si_type_product_one_L;
						$data2[$i][3] = $type_product_one->si_type_product_one_XL;
						$data2[$i][4] = $type_product_one->wage_type_product_one_S;
						$data2[$i][5] = $type_product_one->wage_type_product_one_M;
						$data2[$i][6] = $type_product_one->wage_type_product_one_L;
						$data2[$i][7] = $type_product_one->wage_type_product_one_XL;

						$type_product_two = $sys->db->record("tb_type_product_two"," id_type_product = '".$rs_type->id_type_product."' ");
						$data2[$i][8] = $type_product_two->si_type_product_two_S;
						$data2[$i][9] = $type_product_two->si_type_product_two_M;
						$data2[$i][10] = $type_product_two->si_type_product_two_L;
						$data2[$i][11] = $type_product_two->si_type_product_two_XL;
						$data2[$i][12] = $type_product_two->wage_type_product_two_S;
						$data2[$i][13] = $type_product_two->wage_type_product_two_M;
						$data2[$i][14] = $type_product_two->wage_type_product_two_L;
						$data2[$i][15] = $type_product_two->wage_type_product_two_XL;

						$type_product_three = $sys->db->record("tb_type_product_three"," id_type_product = '".$rs_type->id_type_product."' ");
						$data2[$i][16] = $type_product_three->si_type_product_three_S;
						$data2[$i][17] = $type_product_three->si_type_product_three_M;
						$data2[$i][18] = $type_product_three->si_type_product_three_L;
						$data2[$i][19] = $type_product_three->si_type_product_three_XL;
						$data2[$i][20] = $type_product_three->wage_type_product_three_S;
						$data2[$i][21] = $type_product_three->wage_type_product_three_M;
						$data2[$i][22] = $type_product_three->wage_type_product_three_L;
						$data2[$i][23] = $type_product_three->wage_type_product_three_XL;

						$type_product_four = $sys->db->record("tb_type_product_four"," id_type_product = '".$rs_type->id_type_product."' ");
						$data2[$i][24] = $type_product_four->si_type_product_four_S;
						$data2[$i][25] = $type_product_four->si_type_product_four_M;
						$data2[$i][26] = $type_product_four->si_type_product_four_L;
						$data2[$i][27] = $type_product_four->si_type_product_four_XL;
						$data2[$i][28] = $type_product_four->wage_type_product_four_S;
						$data2[$i][29] = $type_product_four->wage_type_product_four_M;
						$data2[$i][30] = $type_product_four->wage_type_product_four_L;
						$data2[$i][31] = $type_product_four->wage_type_product_four_XL;

						$type_product_five = $sys->db->record("tb_type_product_five"," id_type_product = '".$rs_type->id_type_product."' ");
						$data2[$i][32] = $type_product_five->si_type_product_five_S;
						$data2[$i][33] = $type_product_five->si_type_product_five_M;
						$data2[$i][34] = $type_product_five->si_type_product_five_L;
						$data2[$i][35] = $type_product_five->si_type_product_five_XL;
						$data2[$i][36] = $type_product_five->wage_type_product_five_S;
						$data2[$i][37] = $type_product_five->wage_type_product_five_M;
						$data2[$i][38] = $type_product_five->wage_type_product_five_L;
						$data2[$i][39] = $type_product_five->wage_type_product_five_XL;

						$k2++;
					  ?>
				<tr id = "type_product<?php echo $k2;?>" style = "display:none;">
				<?php 
					$r =0;
					
					for($t=0;$t<5;$t++){?>
					 <td align="left">
					  <table width = "<?php if($t<1){echo "354";}else{ echo "245";}?>" align="left">
					  <tr>
						
						<?php if($t<1){?>
						<td width = "70"><span style = "color:#ff0000;"><?php echo $rs_type->name_type_product;?></span></td>
						<td width = "284">&nbsp;&nbsp;&nbsp;
						<?php }else{?>
						<td width = "245">&nbsp;&nbsp;&nbsp;
						<?php }?>

						<table>		
						<?php 
						for($tt=0;$tt<2;$tt++){?>
						<tr align = "<?php if($t<1){ echo "right";}else{ echo "left";}?>">
							<?php 
							
							for($j=0;$j<4;$j++){
								 //echo $r;;
							?>
							<td <?php if($t==3){echo "style = 'visibility:hidden;'";} ?>>
							<?php check_title($r);?>
							(<?php fnc_size($j);?>)<input type="text" name="data2[<?php echo $i?>][<?php echo $r;?>]" style = "width:30px; <?php if( ($r>19) && ( $r<=23 ))  {echo "background-color:#c0c0c0;";}?>  <?php if( ($r>3) && ( $r<=7 ))  {echo "background-color:#c0c0c0;";}?>" value = "<?php echo check_null($data2[$i][$r]);?>"
							<?php if( ($r>3) && ( $r<=7 )){echo "readonly";}?>
							<?php if( ($r>19) && ( $r<=23 )){echo "readonly";}?>
							></td>
							<?php $r=$r+1; }?>
						</tr>
						<?php }?>
					
						</table>
					   </td>
					  </tr>
					  </table>
					   </td>
					   <?php }?>

						
						<input type="hidden" name="id_type_product[]" value = "<?php echo $rs_type->id_type_product;?>" >
					

					</tr>
					<?php }
						$i = -1;
					?>

					<input type="hidden" id="r_type_product" value = "<?php echo $k2;?>">
					<tr>
							<td colspan = "5"><a href="main.php?op=type&act=list"><img src="images/add.gif" width="16" height="16" border="0" alt="">&nbsp;เพิ่ม ลบ แก้ไข</a></td>
						</tr>
					
					
					<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////// -->

					

				  <!--////////////////////////////////////// ลงยา//////////////////////////////////////////////////////// -->
					
					<tr>
					  <td align="center" colspan = "5" >&nbsp;</td>
					</tr>
					<tr>
					  <td align="center" colspan = "5" bgcolor="#c0c0c0"><b>ลงยา</b>&nbsp;<img src="images/other/arrow-down.gif"  border="0" alt="" style = "cursor:pointer;" onclick = "fnc_open(3);"></td>
					</tr>

				    <tr>
					  <td align="center"><b>กรอบ 90</b></td>
					  <td align="center"><b>ตลับ</b></td>
					  <td align="center"><b>กรอบ 70</b></td>
					  <td align="center"><b>อุปกรณ์</b></td>
					  <td align="center"><b>กรอบ 75</b></td
					</tr>
					
					<?php 
						$row_medicine = $sys->db->result("tb_medicine", null, " id_medicine asc ");
						$i = -1;
						$k3 = 0;
						foreach($row_medicine as $rs_medicine){ $i++;
						$medicine_one = $sys->db->record("tb_medicine_one"," id_medicine = '".$rs_medicine->id_medicine."' ");
						$data3[$i][0] = $medicine_one->si_medicine_one_S;
						$data3[$i][1] = $medicine_one->si_medicine_one_M;
						$data3[$i][2] = $medicine_one->si_medicine_one_L;
						$data3[$i][3] = $medicine_one->si_medicine_one_XL;
						$data3[$i][4] = $medicine_one->wage_medicine_one_S;
						$data3[$i][5] = $medicine_one->wage_medicine_one_M;
						$data3[$i][6] = $medicine_one->wage_medicine_one_L;
						$data3[$i][7] = $medicine_one->wage_medicine_one_XL;

						$medicine_two = $sys->db->record("tb_medicine_two"," id_medicine = '".$rs_medicine->id_medicine."' ");
						$data3[$i][8] = $medicine_two->si_medicine_two_S;
						$data3[$i][9] = $medicine_two->si_medicine_two_M;
						$data3[$i][10] = $medicine_two->si_medicine_two_L;
						$data3[$i][11] = $medicine_two->si_medicine_two_XL;
						$data3[$i][12] = $medicine_two->wage_medicine_two_S;
						$data3[$i][13] = $medicine_two->wage_medicine_two_M;
						$data3[$i][14] = $medicine_two->wage_medicine_two_L;
						$data3[$i][15] = $medicine_two->wage_medicine_two_XL;

						$medicine_three = $sys->db->record("tb_medicine_three"," id_medicine = '".$rs_medicine->id_medicine."' ");
						$data3[$i][16] = $medicine_three->si_medicine_three_S;
						$data3[$i][17] = $medicine_three->si_medicine_three_M;
						$data3[$i][18] = $medicine_three->si_medicine_three_L;
						$data3[$i][19] = $medicine_three->si_medicine_three_XL;
						$data3[$i][20] = $medicine_three->wage_medicine_three_S;
						$data3[$i][21] = $medicine_three->wage_medicine_three_M;
						$data3[$i][22] = $medicine_three->wage_medicine_three_L;
						$data3[$i][23] = $medicine_three->wage_medicine_three_XL;

						$medicine_four = $sys->db->record("tb_medicine_four"," id_medicine = '".$rs_medicine->id_medicine."' ");
						$data3[$i][24] = $medicine_four->si_medicine_four_S;
						$data3[$i][25] = $medicine_four->si_medicine_four_M;
						$data3[$i][26] = $medicine_four->si_medicine_four_L;
						$data3[$i][27] = $medicine_four->si_medicine_four_XL;
						$data3[$i][28] = $medicine_four->wage_medicine_four_S;
						$data3[$i][29] = $medicine_four->wage_medicine_four_M;
						$data3[$i][30] = $medicine_four->wage_medicine_four_L;
						$data3[$i][31] = $medicine_four->wage_medicine_four_XL;

						$medicine_five = $sys->db->record("tb_medicine_five"," id_medicine = '".$rs_medicine->id_medicine."' ");
						$data3[$i][32] = $medicine_five->si_medicine_five_S;
						$data3[$i][33] = $medicine_five->si_medicine_five_M;
						$data3[$i][34] = $medicine_five->si_medicine_five_L;
						$data3[$i][35] = $medicine_five->si_medicine_five_XL;
						$data3[$i][36] = $medicine_five->wage_medicine_five_S;
						$data3[$i][37] = $medicine_five->wage_medicine_five_M;
						$data3[$i][38] = $medicine_five->wage_medicine_five_L;
						$data3[$i][39] = $medicine_five->wage_medicine_five_XL;

						$k3++;
					  ?>
					

				<tr id = "medicine<?php echo $k3;?>" style = "display:none;">
				<?php 
					$r =0;
					
					for($t=0;$t<5;$t++){?>
					 <td align="left">
					  <table width = "<?php if($t<1){echo "354";}else{ echo "245";}?>" align="left">
					  <tr>
						
						<?php if($t<1){?>
						<td width = "70"><span style = "color:#ff0000;"><?php echo $rs_medicine->name_medicine;?></span></td>
						<td width = "284">&nbsp;&nbsp;&nbsp;
						<?php }else{?>
						<td width = "245">&nbsp;&nbsp;&nbsp;
						<?php }?>

						<table>		
						<?php 
						for($tt=0;$tt<2;$tt++){?>
						<tr align = "<?php if($t<1){ echo "right";}else{ echo "left";}?>">
							<?php 
							
							for($j=0;$j<4;$j++){
							?>
							<td <?php if($t==3){echo "style = 'visibility:hidden;'";} ?>>
							<?php check_title($r);?>
							(<?php fnc_size($j);?>)<input type="text" name="data3[<?php echo $i?>][<?php echo $r;?>]" style = "width:30px;" value = "<?php echo check_null($data3[$i][$r]);?>"></td>
							<?php $r=$r+1; }?>
						</tr>
						<?php }?>
					
						</table>
					   </td>
					  </tr>
					  </table>
					   </td>
					   <?php }?>


						<input type="hidden" name="id_medicine[]" value = "<?php echo $rs_medicine->id_medicine;?>" >
					

					</tr>
					<?php }
						$i = -1;
	
					  ?>
					<input type="hidden" id="r_medicine" value = "<?php echo $k3;?>">
						<tr>
							<td colspan = "5"><a href="main.php?op=medicine&act=list"><img src="images/add.gif" width="16" height="16" border="0" alt="">&nbsp;เพิ่ม ลบ แก้ไข</a></td>
						</tr>
					<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////// -->



					 <!--////////////////////////////////////// ลักษณะพิเศษ//////////////////////////////////////////////////////// -->
					
					<tr>
					  <td align="center" colspan = "5" >&nbsp;</td>
					</tr>
					<tr>
					  <td align="center" colspan = "5" bgcolor="#c0c0c0"><b>ลักษณะพิเศษ</b>&nbsp;<img src="images/other/arrow-down.gif"  border="0" alt="" style = "cursor:pointer;" onclick = "fnc_open(4);"></td>
					</tr>

				    <tr>
					  <td align="center"><b>กรอบ 90</b></td>
					  <td align="center"><b>ตลับ</b></td>
					  <td align="center"><b>กรอบ 70</b></td>
					  <td align="center"><b>อุปกรณ์</b></td>
					  <td align="center"><b>กรอบ 75</b></td
					</tr>
					
					<?php 
						$row_special = $sys->db->result("tb_special", null, " id_special asc ");
						$i = -1;
						$k4 = 0;
						foreach($row_special as $rs_special){ $i++;
						$special_one = $sys->db->record("tb_special_one"," id_special = '".$rs_special->id_special."' ");
						$data4[$i][0] = $special_one->si_special_one_S;
						$data4[$i][1] = $special_one->si_special_one_M;
						$data4[$i][2] = $special_one->si_special_one_L;
						$data4[$i][3] = $special_one->si_special_one_XL;
						$data4[$i][4] = $special_one->wage_special_one_S;
						$data4[$i][5] = $special_one->wage_special_one_M;
						$data4[$i][6] = $special_one->wage_special_one_L;
						$data4[$i][7] = $special_one->wage_special_one_XL;

						$special_two = $sys->db->record("tb_special_two"," id_special = '".$rs_special->id_special."' ");
						$data4[$i][8] = $special_two->si_special_two_S;
						$data4[$i][9] = $special_two->si_special_two_M;
						$data4[$i][10] = $special_two->si_special_two_L;
						$data4[$i][11] = $special_two->si_special_two_XL;
						$data4[$i][12] = $special_two->wage_special_two_S;
						$data4[$i][13] = $special_two->wage_special_two_M;
						$data4[$i][14] = $special_two->wage_special_two_L;
						$data4[$i][15] = $special_two->wage_special_two_XL;

						$special_three = $sys->db->record("tb_special_three"," id_special = '".$rs_special->id_special."' ");
						$data4[$i][16] = $special_three->si_special_three_S;
						$data4[$i][17] = $special_three->si_special_three_M;
						$data4[$i][18] = $special_three->si_special_three_L;
						$data4[$i][19] = $special_three->si_special_three_XL;
						$data4[$i][20] = $special_three->wage_special_three_S;
						$data4[$i][21] = $special_three->wage_special_three_M;
						$data4[$i][22] = $special_three->wage_special_three_L;
						$data4[$i][23] = $special_three->wage_special_three_XL;

						$special_four = $sys->db->record("tb_special_four"," id_special = '".$rs_special->id_special."' ");
						$data4[$i][24] = $special_four->si_special_four_S;
						$data4[$i][25] = $special_four->si_special_four_M;
						$data4[$i][26] = $special_four->si_special_four_L;
						$data4[$i][27] = $special_four->si_special_four_XL;
						$data4[$i][28] = $special_four->wage_special_four_S;
						$data4[$i][29] = $special_four->wage_special_four_M;
						$data4[$i][30] = $special_four->wage_special_four_L;
						$data4[$i][31] = $special_four->wage_special_four_XL;

						$special_five = $sys->db->record("tb_special_five"," id_special = '".$rs_special->id_special."' ");
						$data4[$i][32] = $special_five->si_special_five_S;
						$data4[$i][33] = $special_five->si_special_five_M;
						$data4[$i][34] = $special_five->si_special_five_L;
						$data4[$i][35] = $special_five->si_special_five_XL;
						$data4[$i][36] = $special_five->wage_special_five_S;
						$data4[$i][37] = $special_five->wage_special_five_M;
						$data4[$i][38] = $special_five->wage_special_five_L;
						$data4[$i][39] = $special_five->wage_special_five_XL;

						$k4++;
					  ?>
						
						<tr id = "special<?php echo $k4;?>" style = "display:none;">
				<?php 
					$r =0;
					
					for($t=0;$t<5;$t++){?>
					 <td align="left">
					  <table width = "<?php if($t<1){echo "354";}else{ echo "245";}?>" align="left">
					  <tr>
						
						<?php if($t<1){?>
						<td width = "70"><span style = "color:#ff0000;"><?php echo $rs_special->name_special;?></span></td>
						<td width = "284">&nbsp;&nbsp;&nbsp;
						<?php }else{?>
						<td width = "245">&nbsp;&nbsp;&nbsp;
						<?php }?>

						<table>		
						<?php 
						for($tt=0;$tt<2;$tt++){?>
						<tr align = "<?php if($t<1){ echo "right";}else{ echo "left";}?>">
							<?php 
							
							for($j=0;$j<4;$j++){
							?>
							<td <?php if($t==3){echo "style = 'visibility:hidden;'";} ?>>
							<?php check_title($r);?>
							(<?php fnc_size($j);?>)<input type="text" name="data4[<?php echo $i?>][<?php echo $r;?>]" style = "width:30px;" value = "<?php echo check_null($data4[$i][$r]);?>"></td>
							<?php $r=$r+1; }?>
						</tr>
						<?php }?>
					
						</table>
					   </td>
					  </tr>
					  </table>
					   </td>
					   <?php }?>


						<input type="hidden" name="id_special[]" value = "<?php echo $rs_special->id_special;?>" >
					

					</tr>
					<?php }
						$i = -1;
	
					  ?>
						<input type="hidden" id="r_special" value = "<?php echo $k4;?>">
						<tr>
							<td colspan = "5"><a href="main.php?op=special&act=list"><img src="images/add.gif" width="16" height="16" border="0" alt="">&nbsp;เพิ่ม ลบ แก้ไข</a></td>
						</tr>
					
					<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////// -->
		
	

					 <!--////////////////////////////////////// ฝังเพชร//////////////////////////////////////////////////////// -->
					
					<tr>
					  <td align="center" colspan = "5" >&nbsp;</td>
					</tr>
					<tr>
					  <td align="center" colspan = "5" bgcolor="#c0c0c0"><b>ฝังเพชร</b>&nbsp;<img src="images/other/arrow-down.gif"  border="0" alt="" style = "cursor:pointer;" onclick = "fnc_open(5);"></td>
					</tr>

				    <tr>
					  <td align="center"><b>กรอบ 90</b></td>
					  <td align="center"><b>ตลับ</b></td>
					  <td align="center"><b>กรอบ 70</b></td>
					  <td align="center"><b>อุปกรณ์</b></td>
					  <td align="center"><b>กรอบ 75</b></td
					</tr>
					
					<?php 
						$row_diamond = $sys->db->result("tb_diamond", null, " id_diamond asc ");
						$i = -1;
						$k5 = 0;
						foreach($row_diamond as $rs_diamond){ $i++;
						$diamond_one = $sys->db->record("tb_diamond_one"," id_diamond = '".$rs_diamond->id_diamond."' ");
						$data5[$i][0] = $diamond_one->si_diamond_one_S;
						$data5[$i][1] = $diamond_one->si_diamond_one_M;
						$data5[$i][2] = $diamond_one->si_diamond_one_L;
						$data5[$i][3] = $diamond_one->si_diamond_one_XL;
						$data5[$i][4] = $diamond_one->wage_diamond_one_S;
						$data5[$i][5] = $diamond_one->wage_diamond_one_M;
						$data5[$i][6] = $diamond_one->wage_diamond_one_L;
						$data5[$i][7] = $diamond_one->wage_diamond_one_XL;

						$diamond_two = $sys->db->record("tb_diamond_two"," id_diamond = '".$rs_diamond->id_diamond."' ");
						$data5[$i][8] = $diamond_two->si_diamond_two_S;
						$data5[$i][9] = $diamond_two->si_diamond_two_M;
						$data5[$i][10] = $diamond_two->si_diamond_two_L;
						$data5[$i][11] = $diamond_two->si_diamond_two_XL;
						$data5[$i][12] = $diamond_two->wage_diamond_two_S;
						$data5[$i][13] = $diamond_two->wage_diamond_two_M;
						$data5[$i][14] = $diamond_two->wage_diamond_two_L;
						$data5[$i][15] = $diamond_two->wage_diamond_two_XL;

						$diamond_three = $sys->db->record("tb_diamond_three"," id_diamond = '".$rs_diamond->id_diamond."' ");
						$data5[$i][16] = $diamond_three->si_diamond_three_S;
						$data5[$i][17] = $diamond_three->si_diamond_three_M;
						$data5[$i][18] = $diamond_three->si_diamond_three_L;
						$data5[$i][19] = $diamond_three->si_diamond_three_XL;
						$data5[$i][20] = $diamond_three->wage_diamond_three_S;
						$data5[$i][21] = $diamond_three->wage_diamond_three_M;
						$data5[$i][22] = $diamond_three->wage_diamond_three_L;
						$data5[$i][23] = $diamond_three->wage_diamond_three_XL;

						$diamond_four = $sys->db->record("tb_diamond_four"," id_diamond = '".$rs_diamond->id_diamond."' ");
						$data5[$i][24] = $diamond_four->si_diamond_four_S;
						$data5[$i][25] = $diamond_four->si_diamond_four_M;
						$data5[$i][26] = $diamond_four->si_diamond_four_L;
						$data5[$i][27] = $diamond_four->si_diamond_four_XL;
						$data5[$i][28] = $diamond_four->wage_diamond_four_S;
						$data5[$i][29] = $diamond_four->wage_diamond_four_M;
						$data5[$i][30] = $diamond_four->wage_diamond_four_L;
						$data5[$i][31] = $diamond_four->wage_diamond_four_XL;

						$diamond_five = $sys->db->record("tb_diamond_five"," id_diamond = '".$rs_diamond->id_diamond."' ");
						$data5[$i][32] = $diamond_five->si_diamond_five_S;
						$data5[$i][33] = $diamond_five->si_diamond_five_M;
						$data5[$i][34] = $diamond_five->si_diamond_five_L;
						$data5[$i][35] = $diamond_five->si_diamond_five_XL;
						$data5[$i][36] = $diamond_five->wage_diamond_five_S;
						$data5[$i][37] = $diamond_five->wage_diamond_five_M;
						$data5[$i][38] = $diamond_five->wage_diamond_five_L;
						$data5[$i][39] = $diamond_five->wage_diamond_five_XL;

						$k5++;
					  ?>
					
					
					<tr id = "diamond<?php echo $k5;?>" style = "display:none;">
				<?php 
					$r =0;
					
					for($t=0;$t<5;$t++){?>
					 <td align="left">
					  <table width = "<?php if($t<1){echo "354";}else{ echo "245";}?>" align="left">
					  <tr>
						
						<?php if($t<1){?>
						<td width = "70"><span style = "color:#ff0000;"><?php echo $rs_diamond->name_diamond;?></span></td>
						<td width = "284">&nbsp;&nbsp;&nbsp;
						<?php }else{?>
						<td width = "245">&nbsp;&nbsp;&nbsp;
						<?php }?>

						<table>		
						<?php 
						for($tt=0;$tt<2;$tt++){?>
						<tr align = "<?php if($t<1){ echo "right";}else{ echo "left";}?>">
							<?php 
							
							for($j=0;$j<4;$j++){
							?>
							<td <?php if($t==3){echo "style = 'visibility:hidden;'";} ?>>
							<?php check_title($r);?>
							(<?php fnc_size($j);?>)<input type="text" name="data5[<?php echo $i?>][<?php echo $r;?>]" style = "width:30px;" value = "<?php echo check_null($data5[$i][$r]);?>"></td>
							<?php $r=$r+1; }?>
						</tr>
						<?php }?>
					
						</table>
					   </td>
					  </tr>
					  </table>
					   </td>
					   <?php }?>


						<input type="hidden" name="id_diamond[]" value = "<?php echo $rs_diamond->id_diamond;?>" >
					

					</tr>
					<?php }
						$i = -1;
	
					  ?>
					  <input type="hidden" id="r_diamond" value = "<?php echo $k5;?>">
					  <tr>
							<td colspan = "5"><a href="main.php?op=diamond&act=list"><img src="images/add.gif" width="16" height="16" border="0" alt="">&nbsp;เพิ่ม ลบ แก้ไข</a></td>
						</tr>

					<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////// -->

					<tr>
					  <td colspan = "5" align = "center">
					  <input name="save" type="hidden" id="save" value="news_add" />
					  <input name="image" type="image" src="images/b_save.gif" />
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