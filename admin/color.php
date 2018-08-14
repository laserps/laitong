<?php 
include '../module/class.database.php';
$sys = new Database();
$row_color = $sys->result('tb_color_type_product left join tb_color on tb_color_type_product.id_color = tb_color.id_color', 'tb_color_type_product.id_type_product = "'.$_POST['id_type_product_'].'"  ', ' tb_color_type_product.id_color asc ');
?>
<select name="id_color" style = "width:50px;">
	<?php if(!empty($row_color)){
	foreach($row_color as $rs_color){	
	?>
	<option value="<?php echo $rs_color->id_color?>"><?php echo $rs_color->name_color?></option>
	<?php 
	}	
	}?>
</select>