
<?php  
	$row		= $sys->dataList($tbl,"1",50,"num_type_product","asc",$join);
	
	echo $sys->fnc->confirm();
	echo $fnc->checkall();

	if($_POST['id']){
		$sys->Delete_all($_POST['id'],$tbl,$fiel_id,$page_admin);
	}
	if($_GET[del] != ""){
	 $sys->Del($_GET['del'],$tbl,$page_admin,$fiel_id);
	}

	if($_POST['save'] == "news_add"){
	
			$c  = array("one","three","five");

			foreach($c as $c_){

			foreach($_POST['id_type'] as $rs_id_type){
				
				  

					$data_ = array(
						"wage_first_one"	=>	$_POST['wage_first_one'.$rs_id_type.$c_.''][0],
						"wage_first_two"	=>	$_POST['wage_first_two'.$rs_id_type.$c_.''][1],
						"wage_first_three"	=>	$_POST['wage_first_three'.$rs_id_type.$c_.''][2],
						"wage_first_four"	=>	$_POST['wage_first_four'.$rs_id_type.$c_.''][3],

						"wage_first_one_"	=>	$_POST['wage_first_one_'.$rs_id_type.$c_.''][0],
						"wage_first_two_"	=>	$_POST['wage_first_two_'.$rs_id_type.$c_.''][1],
						"wage_first_three_"	=>	$_POST['wage_first_three_'.$rs_id_type.$c_.''][2],
						"wage_first_four_"	=>	$_POST['wage_first_four_'.$rs_id_type.$c_.''][3],
						
						"id_type"			=>  $rs_id_type,
						"branch_type"		=>  "1"
						);
						
						
					$sys->db->delete("tb_wage_first_".$c_."", " id_type = '".$rs_id_type."' and branch_type = '1' ");
					$sys->db->insert("tb_wage_first_".$c_."",$data_);
				}
			}
			
			echo '<script type="text/javascript">
			<!--
			    alert("Update Complete");
				window.location.replace("main.php?op=type&act=list");
			//-->
			</script>';
			
	}

?>


<table width="100%" cellspacing="0" cellpadding="1" border="0" >
    <tr>
        <td align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th"><input type="button" value="<<<ตั้งค่าซิ-ค่าแรง" onclick="window.location.replace('main.php?op=setting_&act=list');">&nbsp;&nbsp;จัดการค่าแรงตั้งต้น(<span style = "color:#ff0000" >ในเครือ</span>)</td>
        </tr></table></td>
    </tr>

	
<tr>
        <td align="left">
		<?php if(($_SESSION[id_division]=="1") or ($_SESSION[id_division]=="2")){?>
		<a href="main.php?op=<?php echo $_GET[op]?>&act=add&rd=123456"><img src="images/b_add.gif" /></a>
		<?php }?>
		&nbsp;&nbsp;
		</td>
		
    </tr>


	<FORM name="myForm" METHOD="POST" ACTION="#">
    <tr>
        <td>
	 
			<table class="th2" cellpadding="0" cellspacing = "0" border="1" width = "100%">

				 


					

				    <tr >
		
					  <td align="center"><b>กรอบ 90</b></td>
					
					  <td align="center"><b>กรอบ 70</b></td>
					
					  <td align="center"><b>กรอบ 75</b></td>
					

					</tr>

					<tr >
					  <?php
					  
					  $c  = array("one","three","five");
					  $i = -1;
					  foreach($c as $c_){$i++?>	
					  <td align="center">
					  <table width = "100%" border = "1" cellpadding="0" cellspacing = "0">
					  <tr>
					    <?php if($i==0){?><td align="center" >&nbsp;</td><?php }?>
						<td align="center" colspan = "1">ไม่ยกซุ้ม</td>
						<td align="center" colspan = "1">ยกซุ้ม</td>
					  </tr>

					  <tr>
					    <?php if($i==0){?><td align = "center">แบบ</td><?php }?>
					    <td align="center" colspan = "1"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width = "25%" align = "center">S</td>
                            <td width = "25%" align = "center">M</td>
                            <td width = "25%" align = "center">L</td>
                            <td width = "25%" align = "center">XL</td>
                          </tr>
                        </table></td>
					    <td align="center" colspan = "1"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width = "25%" align = "center">S</td>
                            <td width = "25%" align = "center">M</td>
                            <td width = "25%" align = "center">L</td>
                            <td width = "25%" align = "center">XL</td>
                          </tr>
                        </table></td>
					    </tr>

					<?php 
						
					foreach($row as $rs){
						
							$rs_wage = $sys->db->record("tb_wage_first_".$c_.""," id_type = '".$rs->id_type_product."' and branch_type = '1'  ");
						?>
					  <tr >
					    <?php if($i==0){?><td >
						<input type="hidden" name="id_type[]" value = "<?php echo $rs->id_type_product;?>" >
						<b>  <a href="main.php?op=<?php echo $_GET[op];?>&act=list&amp;rd=<?php echo rand(1,99999); ?>&amp;del=<?php echo $rs->id_type_product;?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf('<?php echo $rs->code_product;?>')" /></a>&nbsp;&nbsp;<?php echo $rs->name_type_product?></b></td><?php }?>

						
					    <td align="center" colspan = "1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align = "center">
							<input type="text" name="wage_first_one<?php echo $rs->id_type_product.$c_;?>[0]" style = "width:25px;" value = "<?php echo $rs_wage->wage_first_one; ?>"></td>
                            <td align = "center"><input type="text" name="wage_first_two<?php echo $rs->id_type_product.$c_;?>[1]" style = "width:25px;" value = "<?php echo $rs_wage->wage_first_two;?>"></td>
                            <td align = "center"><input type="text" name="wage_first_three<?php echo $rs->id_type_product.$c_;?>[2]" style = "width:25px;" value = "<?php echo $rs_wage->wage_first_three;?>"></td>
                            <td align = "center"><input type="text" name="wage_first_four<?php echo $rs->id_type_product.$c_;?>[3]" style = "width:25px;" value = "<?php echo $rs_wage->wage_first_four;?>"></td>
                          </tr>
                        </table></td>

					    <td align="center" colspan = "1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align = "center"><input type="text" name="wage_first_one_<?php echo $rs->id_type_product.$c_;?>[0]" style = "width:25px;" value = "<?php echo $rs_wage->wage_first_one_;?>"></td>
                            <td align = "center"><input type="text" name="wage_first_two_<?php echo $rs->id_type_product.$c_;?>[1]" style = "width:25px;" value = "<?php echo $rs_wage->wage_first_two_;?>"></td>
                            <td align = "center"><input type="text" name="wage_first_three_<?php echo $rs->id_type_product.$c_;?>[2]" style = "width:25px;" value = "<?php echo $rs_wage->wage_first_three_;?>"></td>
                            <td align = "center"><input type="text" name="wage_first_four_<?php echo $rs->id_type_product.$c_;?>[3]" style = "width:25px;" value = "<?php echo $rs_wage->wage_first_four_;?>"></td>
                          </tr>
                        </table></td>


						



					    </tr>
					<?php }?>

					  </table>
					  </td>
					  
					  
						
					<?php }?>
					  
					</tr>
		
			

					

	
					<tr>
					  <td colspan = "4" align = "center">
					  <input name="save" type="hidden" id="save" value="news_add" />
					  <input name="image" type="image" src="images/b_save.gif" />
						
				        <a href="main.php?op=<?php echo $_GET['op']?>&act=list"><img src="images/b_cancel.gif" border="0"/></a></td>
				  </tr>
				</table>
	  </td>
    </tr>
	</form>

	

	<!-- <tr>
        <td><? echo $db->render('main.php?op='.$_GET[op].'&act='.$_GET[act].'&'); ?></td>
    </tr>
 -->

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