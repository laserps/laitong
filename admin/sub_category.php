<?php 
include '../module/class.database.php';
$sys = new Database();
$row	  = $sys->result("tb_sub_category",' id_category = "'.$_POST['id_category'].'" ', 'no_sub_category asc');
?>
<select name="id_sub_category" id = "id_sub_category" onchange = "fnc_group(this.value);"  style = "width:250px;height:20px;">
						    <option value="0">เลือกเบอร์</option>
							<?php if(!empty($row)){
								foreach($row as $rs){
								?>
							<option style="background-image:url(../thumb/example1_select.png);height:50px; background-repeat:no-repeat; padding-left: 50px;padding-top:18px;" value = "<?php echo $rs->id_sub_category."@".$rs->no_sub_category;?>"><?php echo $rs->no_sub_category."  ".$rs->name_sub_category;?></option>
								<?php 
									}
								  }
								?>				
							
							</select>
						
