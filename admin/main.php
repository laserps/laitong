<?php session_start(); 
require '../module/class.admin.php';
$sys = new admin();
$sys->check($_SESSION[login_session]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=8" />
<link  rel="stylesheet" href="style/style.css" type="text/css">
<link  rel="stylesheet" href="style/menu.css" type="text/css">
<link  rel="stylesheet" href="css_admin.css" type="text/css">
 <link href="css_jquery.css" rel="stylesheet" type="text/css"/>
  <script src="jquery.min.js"></script>
  <script src="jquery-ui.min.js"></script>
<style>
.divleft{
position: fixed;
bottom:0px;
right:0px;
border:solid  #0000FF;
width:320px;
height:10%;
background-color:#FFFFFF;
}

</style>

<title>
<?php 
function fnc_title($op){
	if($op == "product"){
		return " Stock กรอบพระ ";
	}
	else if($op == "add_stock"){
		return " ตัด เพิ่ม Stock  ";
	}
	else if($op == "check_product"){
		return " เช็คสินค้า  ";
	}
	else if($op == "buy"){
		return " ออกใบส่งของ  ";
	}
	else if($op == "buy_data"){
		return " Invoice List  ";
	}
	else if($op == "rent"){
		return " ยืมสินค้า  ";
	}
	else if($op == "section"){
		return " คลังสินค้าเก็บ  ";
	}
	else if($op == "fare"){
		return " คลังสินค้าชั่วคราว  ";
	}
	else if($op == "category"){
		return " แบบพิมพ์  ";
	}
	else if($op == "type"){
		return " ค่าแรงตั้งต้น  ";
	}
	else if($op == "member"){
		return " ข้อมูลพนักงาน  ";
	}
	else if($op == "qc"){
		return "QC  ";
	}
	else if($op == "branch"){
		return "สาขา  ";
	}
	else if($op == "diamond"){
		return "ฝังเพชร/เปอร์เซ็น  ";
	}
	else if($op == "setting_"){
		return "กำหนดค่าซิ - ค่าแรง  ";
	}
	else if($op == "gold_price"){
		return "ราคาทอง  ";
	}



}


echo fnc_title($_GET['op']);	

echo $_GET['title'];

?>

</title>

</head>
<body>

 <table width="100%" border="0" cellpadding="0" cellspacing="1">
    <tr>
        <td align="center" height="80" width="100%" colspan="2" background="images/header.png"><h2>ระบบบริหารจัดการสต๊อก หมูจิ๊บเซ่งเฮง</h2></td>
    </tr>

	<tr>
	<td>
	<script type="text/javascript">
	function fnc_close(){
		var check = document.getElementById('close_open').value;
		if(check==1){
			document.getElementById('menu').style.display = "none";
			document.getElementById('close_open').value = 2;
		}else{
			document.getElementById('menu').style.display = "";
			document.getElementById('close_open').value = 1;
		}
	}
	</script>
	<input type="hidden" id="close_open" value = "1">
	<img src="images/icon_chang.gif" width="16" height="16" border="0" alt="" onclick = "fnc_close();" title = "เปิดปิดเมนู" alt = "เปิดปิดเมนู">
	</td>
	</tr>

    <tr>
        <td valign="top" id = "menu"><?php require 'menu.php';?></td>
        <td valign="top" width="100%" align="left" style="padding-top:3px;"><?php require 'show.php';?>
			<br><br>
			<!-- <p> &copy; 2010 <strong>&nbsp;</strong> | design by: <a href="http://blogfishthai.blogspot.com/">
			<strong>Golf</strong></a> | Mobile <strong>089-169-7619</strong>
			 | <a href="http://validator.w3.org/check/referer"><strong>XHTML</strong></a><br><br>
			</p> -->
		</td>
    </tr>
    <tr>
        <td align="center" height="80" width="100%" colspan="2" background="images/footer.png">

</td>
    </tr>
</table>
</body>
</html>