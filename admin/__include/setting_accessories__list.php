<?php  
	if(($_POST['name_type_product'] != "")||($_GET['name_type_product'] != "") ){
		$row		= $sys->dataList($tbl,"2 and name_type_product like '%".$_POST['name_type_product'].$_GET['name_type_product']."%' ",1000,"num_type_product","asc, name_type_product asc ",$join);
	}

	if(($_POST['name_type_product'] == "ดูทั้งหมด")|| ($_GET['name_type_product'] == "ดูทั้งหมด")){
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
			$sys->db->delete("tb_setting_accessories", " id_type_product = '".$rs->id_type_product."' ");
			foreach($row_branch as $rs_branch){
				$c_++;
				  

					$data_ = array(
						"id_branch"			=>	$rs_branch->id_branch,
						"id_type_product"	=>	$rs->id_type_product,
						"si_one"			=>	$_POST['si_one'][$rs->id_type_product][$c_],
						"si_two"			=>	$_POST['si_two'][$rs->id_type_product][$c_],
						"si_three"			=>	$_POST['si_three'][$rs->id_type_product][$c_],
						"si_four"			=>	$_POST['si_four'][$rs->id_type_product][$c_],
						"percent_"			=>  $_POST['percent_'][$rs->id_type_product][$c_]
						);
						
						
					
					$sys->db->insert("tb_setting_accessories",$data_);
				}
				$c_ =-1;
				
			}
			
			echo '<script type="text/javascript">
			<!--
			    alert("Update Complete");
				window.location.replace("main.php?op=setting_accessories&act=list&name_type_product='.$_POST['name_type_product'].$_GET['name_type_product'].'");
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
    width:6700px;  
    display:block;  
    top:175px;
	left: 300px;
    height:53px; 
	
}  
</style>  
<table width="100%" cellspacing="0" cellpadding="1" border="0" >
    <tr>
        <td align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th"><input type="button" value="<<<ตั้งค่าซิ-ค่าแรง" onclick="window.location.replace('main.php?op=setting_&act=list');">&nbsp;&nbsp;จัดการเปอร์เซ็น อุปกรณ์</td>
        </tr></table></td>
    </tr>

	<form method="post" action="">
		<tr>
		<td>ค้นหา: <input type="text" name="name_type_product" id = "name_type_product" value = "ดูทั้งหมด" onclick = "document.getElementById('name_type_product').value = '';">&nbsp;<input type="submit" value = 
		"ค้นหา"></td>
	</tr>

	</form>

	<FORM name="myForm" METHOD="POST" ACTION="main.php?op=setting_accessories&act=list">
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
					    <td align="center" colspan = "1"><div id="float_banner" > 
						<table width="7900" border="0" align="center" cellpadding="0" cellspacing="0" style = "background-color: #aaaaaa;color: #ffffff;">
						<tr> 
						<?php foreach($row_branch as $rs_branch){?>
						<td width = "120">
						<?php echo $rs_branch->name_branch;?>
						<!-- <table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr style = 'visibility:hidden;'>
                            <td  align = "center">S</td>
                            <td  align = "center">M</td>
                            <td  align = "center">L</td>
                            <td  align = "center">XL</td>
                          </tr>
                        </table> -->
						
						</td>
						<?php }?>
						
						</td>
						</tr>
						</table></div>
						</td>
					
					    </tr>

					<?php 
						$r =-1;
					    $c =-1;
					if(!empty($row)){
					foreach($row as $rs){
						
							$r++;
						?>
					  <tr id = "rtype<?php echo $r;?>" onclick = "fnc_bg_r(<?php echo $r;?>);" >
						<input type="hidden" id="bg_rtype<?php echo $r;?>" value = "0">

					    <?php if($i==0){?><td  >
						<input type="hidden" name="id_type[]" value = "<?php echo $rs->id_type_product;?>" >
						<b><?php echo $rs->name_type_product?></b></td><?php }?>

						
					    <td align="center" colspan = "1">
						
						<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
						<tr>
						<?php foreach($row_branch as $rs_branch){
							$c++;
							$rs_wage = $sys->db->record("tb_setting_accessories"," id_type_product = '".$rs->id_type_product."' and id_branch = '".$rs_branch->id_branch."' ");
							?>
						<td>
						<table width="100%" height = "80" border="0" cellspacing="0" cellpadding="0">
						
						  <tr>
							<td colspan = "4" onmouseover = "document.getElementById('show_name_type<?php echo $r.$c;?>').style.display = '';" onmouseout = "document.getElementById('show_name_type<?php echo $r.$c;?>').style.display = 'none';"><input type="text" name="percent_[<?php echo $rs->id_type_product?>][<?php echo $c;?>]" id = "percent_" style = "width:30px;" value = "<?php echo $rs_wage->percent_;?>">%<br>
							<span id = "show_name_type<?php echo $r.$c;?>" style = "color:#ff0000;display:none;" > <?php echo $rs->name_type_product?></span>
							</td>
						  </tr>
                          
						  <tr style = 'visibility:hidden;'>
                            <td align = "center" width = "25%">
							<input type="text" name="si_one[<?php echo $rs->id_type_product?>][<?php echo $c;?>]" style = "width:25px;" value = "<?php echo $rs_wage->si_one; ?>">
							</td>

                            <td align = "center" width = "25%"><input type="text" name="si_two[<?php echo $rs->id_type_product?>][<?php echo $c;?>]" style = "width:25px;" value = "<?php echo $rs_wage->si_two;?>">
							</td>

                            <td align = "center" width = "25%"><input type="text" name="si_three[<?php echo $rs->id_type_product?>][<?php echo $c;?>]" style = "width:25px;" value = "<?php echo $rs_wage->si_three;?>">
							</td>

                            <td align = "center" width = "25%"><input type="text" name="si_four[<?php echo $rs->id_type_product?>][<?php echo $c;?>]" style = "width:25px;" value = "<?php echo $rs_wage->si_four;?>">
							</td>

							


                          </tr>
						  
						  

                        </table>
						</td>
						<?php }?>
						</tr>
						</table>
						
						</td>

					    

					    </tr>
					<?php $c =-1; } }?>

					  </table>
					  </td>
						
					<?php }?>
					  
					</tr>
		
			

					

	
					<tr>
					  <td colspan = "4" align = "center">
					  <input type="text" name="name_type_product" value = "<?php echo $_POST['name_type_product'].$_GET['name_type_product'];?>">
					  <input name="save" type="hidden" id="save" value="news_add" />
					  <input name="image" type="image" src="images/b_save.gif" />
						
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

<script type="text/javascript">
	function fnc_bg_r(i){
		var bg_i = document.getElementById('bg_rtype'+i+'').value;
		if(bg_i == "0"){
			document.getElementById('rtype'+i+'').style.backgroundColor = '#66ffff';
			document.getElementById('bg_rtype'+i+'').value = "1";
		}else{
			document.getElementById('rtype'+i+'').style.backgroundColor = '#ffffff';
		document.getElementById('bg_rtype'+i+'').value = "0";
		}
	}
</script>