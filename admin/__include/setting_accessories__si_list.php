
<?php  
	//$row		= $sys->dataList($tbl,"2",1000,"num_type_product","asc, name_type_product asc ",$join);

	if($_POST['name_type_product'] != ""){
		$row		= $sys->dataList($tbl,"2 and name_type_product like '%".$_POST['name_type_product']."%' ",1000,"num_type_product","asc, name_type_product asc ",$join);
	}

	if($_POST['name_type_product'] == "ดูทั้งหมด"){
		$row		= $sys->dataList($tbl,"2",1000,"num_type_product","asc, name_type_product asc ",$join);
	}




	$row_branch = $db->result("tb_branch", NULL, "id_branch asc");
	
	echo $sys->fnc->confirm();
	echo $fnc->checkall();

	if($_POST['id']){
		$sys->Delete_all($_POST['id'],$tbl,$fiel_id,$page_admin);
	}
	if($_GET[del] != ""){
	 $sys->Del($_GET['del'],$tbl,$page_admin,$fiel_id);
	}

	if($_POST['save'] == "news_add"){
	
			
			$c_ =-1;
			foreach($row as $rs){
			$sys->db->delete("tb_si_accesories", " id_type_product = '".$rs->id_type_product."' ");
			foreach($row_branch as $rs_branch){
				$c_++;
				  

					$data_ = array(
						"id_type_product"	=>	$rs->id_type_product,
						"size_si_accesories_S"			=>	$_POST['si_one'][$rs->id_type_product][1],
						"size_si_accesories_M"			=>	$_POST['si_two'][$rs->id_type_product][2],
						"size_si_accesories_L"			=>	$_POST['si_three'][$rs->id_type_product][3],
						"size_si_accesories_XL"			=>	$_POST['si_four'][$rs->id_type_product][4]
						);
						
						
					$sys->db->insert("tb_si_accesories",$data_);
				}
				$c_ =-1;
				
			}
			
			echo '<script type="text/javascript">
			<!--
			    alert("Update Complete");
				window.location.replace("main.php?op=setting_accessories_si&act=list");
			//-->
			</script>';
			
	}

?>

<script type="text/javascript">  
var name = "#float_banner";   
var locateY= null;    
$(function(){  
    locateY=parseInt($(name).css("top").replace("px",""));  
    $(window).scroll(function(){  
        offset=locateY+$(document).scrollTop()+"px";  
        $(name).animate({top:offset},{duration:0,queue:false});  
    });  
});  
</script>  

<style type="text/css">  
div#float_banner{  
    position:absolute;  
    width:340px;  
    display:block;  
    top:145px;
	left: 1000px;
    height:63px;  
}  
</style> 
<table width="100%" cellspacing="0" cellpadding="1" border="0" >
    <tr>
        <td align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th"><input type="button" value="<<<ตั้งค่าซิ-ค่าแรง" onclick="window.location.replace('main.php?op=setting_&act=list');">&nbsp;&nbsp;จัดการค่าซิ อุปกรณ์</td>
        </tr></table></td>
    </tr>

	<form method="post" action="">
		<tr>
		<td>ค้นหา: <input type="text" name="name_type_product" id = "name_type_product" value = "ดูทั้งหมด" onclick = "document.getElementById('name_type_product').value = '';">&nbsp;<input type="submit" value = 
		"ค้นหา"></td>
	</tr>
	</form>


	<FORM name="myForm" METHOD="POST" ACTION="main.php?op=setting_accessories_si&act=list">
    <tr>
        <td>
	 
			<table class="th2" cellpadding="0" cellspacing = "0" border="1" width = "100%">

				 


					

				    <tr >
		
					  <td align="center"><b>อุปกรณ์</b></td>
					
					</tr>

					<tr >
					  <?php
					  
					  $c  = array("four");
					  $i = -1;
					  foreach($c as $c_){$i++?>	
					  <td align="center">
					  <table width = "100%" border = "1" cellpadding="0" cellspacing = "0">
					 

					  <tr>
					    <?php if($i==0){?><td align = "center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แบบ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><?php }?>
						<?php ?>
					    <td align="center" colspan = "1">
						<div id="float_banner" >  
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
						
					  
						<td>
				
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td align = "center" width = "25%">&nbsp;&nbsp;&nbsp;&nbsp;S</td>
                            <td align = "center" width = "25%">M</td>
                            <td align = "center" width = "25%">L</td>
                            <td align = "center" width = "25%">XL</td>
                          </tr>
                        </table>

						</td>
						<?php }?>
						</tr>
						</table>
						</div>
						</td>
					
					    </tr>

					<?php 
						$r =-1;
					    $c =-1;

					if(!empty($row)){
					foreach($row as $rs){
						
							$r++;
						?>
					  <tr >
					    <?php if($i==0){?><td  >
						<input type="hidden" name="id_type[]" value = "<?php echo $rs->id_type_product;?>" >
						<b><?php echo $rs->name_type_product?></b></td><?php }?>

						
					    <td align="center" colspan = "1">
						
						<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
						<tr>
						<?php 

							$c++;
							$rs_wage = $sys->db->record("tb_si_accesories"," id_type_product = '".$rs->id_type_product."'");
							?>
						<td>
						<table width="100%" height = "80" border="0" cellspacing="0" cellpadding="0">
						
						 
                          
						  <tr >
                            <td align = "center" width = "25%">
							<input type="text" name="si_one[<?php echo $rs->id_type_product?>][1]" style = "width:25px;" value = "<?php echo $rs_wage->size_si_accesories_S; ?>">

							
							</td>

                            <td align = "center" width = "25%"><input type="text" name="si_two[<?php echo $rs->id_type_product?>][2]" style = "width:25px;" value = "<?php echo $rs_wage->size_si_accesories_M;?>">
					
							</td>

                            <td align = "center" width = "25%"><input type="text" name="si_three[<?php echo $rs->id_type_product?>][3]" style = "width:25px;" value = "<?php echo $rs_wage->size_si_accesories_L;?>">
					
							</td>

                            <td align = "center" width = "25%"><input type="text" name="si_four[<?php echo $rs->id_type_product?>][4]" style = "width:25px;" value = "<?php echo $rs_wage->size_si_accesories_XL;?>">
				
							</td>

                          </tr>
						  
						  

                        </table>
						</td>
						
						</tr>
						</table>
						
						</td>

					    

					    </tr>
					<?php $c =-1; } }?>

					  </table>
					  </td>
						
					
					  
					</tr>
		
			

					

	
					<tr>
					  <td colspan = "4" align = "center">
					  <input name="save" type="hidden" id="save" value="news_add" />
					  <input name="image" type="image" src="images/b_save.gif" />
						<input type="hidden" name="name_type_product" value = "<?php if($_POST['name_type_product'] == ""){ echo "ดูทั้งหมด";}else{ echo $_POST['name_type_product'];}?>">
				        <a href="main.php?op=<?php echo $_GET['op']?>&act=list"><img src="images/b_cancel.gif" border="0"/></a></td>
				  </tr>
				</table>
	  </td>
    </tr>
	</form>

	<!-- <tr>
        <td align="left">
		<?php if(($_SESSION[id_division]=="1") or ($_SESSION[id_division]=="2")){?>
		<a href="main.php?op=<?php echo $_GET[op]?>&act=add&rd=123456"><img src="images/b_add.gif" /></a>
		<?php }?>
		&nbsp;&nbsp;
		</td>
		
    </tr> -->


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