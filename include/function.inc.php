<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<?php php  //Msg Blog
function getMsg($msgID){
	switch ($msgID)	{
		case 1 : return "เพิ่มข้อมูลเรียบร้อยแล้ว";
		case 2 : return "ลบข้อมูลเรียบร้อยแล้ว";
		case 3 : return "แก้ไขข้อมูลเรียบร้อยแล้ว";
		case 4 : return "แก้ไขรหัสผ่านเรียบร้อยแล้ว";
		case 5 : return "รหัสผ่านไม่ถูกต้อง!!";
		case 6 : return "ชื่อล็อกอินหรือรหัสผ่านไม่ถูกต้อง!!";
		default : return "";
	}
}
?>

<?php php  //Msg Error
function JSError($msgID, $str, $loc){
	if($str == "")	$str = getMsg($msgID);
?>
	<script language="javascript">
		<?php php if ($str != ""){?>
		alert("<?php php =$str?>");
		<?php }?>
		<?php  if($loc == "stop"){?>
		<?php }else if($loc == "close"){?>
		window.close();
		<?php }else if($loc != ""){?>
		window.location.replace("<?php =$loc?>");
		<?php }else{?>
		window.history.go(-1);
		<?php }?>
	</script>
<?php  }?>

<?php  //Message java complete
function JSSuccessForm($msgID, $str){
 if($str == "")
	$str = getMsg($msgID);
?>
	<script language="javascript">
		<?php if ($str != ""){?>
		alert("<?php =$str?>");
		<?php }?>
		//document.frm_add.submit();
	</script>
<?php  }?>

<?php  //Display Msg Success
function JSSuccess($msgID, $str, $loc){
global $link;
	if($str == "")
		$str = getMsg($msgID);
?>
<script language="javascript">
		<?php if ($str != ""){?>
		alert("<?php =$str?>");
		<?php }?>
		<?php if($loc == "close"){?>
		window.close();
		<?php }else{?>
		window.location.replace("<?php =$loc?>");
		<?php }?>
	</script>
<?php  }?>

<?php 
function  tran_date($c_date){
	setlocale(LC_TIME,"th");
	//$Date_y=strftime("%y")+43;
	$c_date=date("d-m-Y H:i:s",$c_date);
	return $c_date;
}
?>
