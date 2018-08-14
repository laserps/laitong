<?php session_start();
require '../module/class.admin.php';

$action = isset($_POST['hidAction'])? $_POST['hidAction']: null;

$date = date("dmyh");
$_SESSION['check'] = $date."golfgab";
$check =  base64_decode($action)."golfgab";
$sys = new admin ();

$check_error = $sys->check_error();



if(($_SESSION[check] == $check)and($_POST['txtUserID']!="")){
$check = $sys->loging($_POST['txtUserID'],$_POST['txtPassword']);

if(!$check):
else:
foreach($check as $rs):
$id_member = $rs->id_member;
$userlog = $rs->name;
$level = $rs->level;
$name_position = $rs->name_position;
$id_division = $rs->id_position;

endforeach;
endif;

if($id_division != ""){
	$sys->checklogin($userlog,$id_member,$level,$name_position,$id_division);
}else{
	$data = array("email_log"=>$_POST[txtUserID],"ip_log"=>''.$_SERVER["REMOTE_ADDR"],"status_log"=>"N","date_log"=>date("Y-m-d H:i:s"));
	$sys->db->insert("tb_logfile_member", $data);
	echo '<SCRIPT LANGUAGE="JavaScript">
	window.location.replace("login.php");
	</SCRIPT>';
}
}

if($_GET['do'] =="logout"){
	$sys->logout($_GET['do']);
}


?>	


<html>
<head>
<title>Control Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" href="css_admin.css" type="text/css">
<script language="javascript">
<!--
function doLogin(){
	var objForm = document.frm_login;
	var errMsg = "";
	var objFocus = "";
	function isEmpty(txt)
	{
		return (txt == "");
	}
	if(isEmpty(objForm.txtUserID.value)){
		errMsg += "กรุณาใส่ข้อมูลในช่อง Login Name\n";
		objFocus = (objFocus)? objFocus : objForm.txtUserID;
	}
	
	if(isEmpty(objForm.txtPassword.value)){
		errMsg += "กรุณาใส่ข้อมูลในช่อง Password\n";
		objFocus = (objFocus)? objFocus : objForm.txtPassword;
	}
	
	if(errMsg != ""){
		objFocus.focus();
		alert(errMsg);
		return false;
	}
	else{
		//objForm.hidAction.value = "Login";
		//objForm.action = "main.php";
		//objForm.submit();
		return true;
	}
}
// -->
</script>
<script>
<!--
if (window!= top)
top.location.href=location.href
// -->
</script>
<style type="text/css">
<!--
.style2 {font-size: 18px}
.style3 {color: #FF0000}
-->
</style>
</head>


<body bgcolor="#F5F5F5" onLoad="document.frm_login.txtUserID.focus();">
<?php $row_branch = array("1"=>"BLP","2"=>"เยาวราช","3"=>"BK","4"=>"MBK","5"=>"งามวงศ์งาน","6"=>"PATA","7"=>"พระราม 3","8"=>"ลายทอง","9"=>"บางนา");?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" height="100%" align="center">
  <form name="frm_login" method="post" action="login.php" onSubmit="return doLogin()">
    <!--Start form -->
    <tr> 
      <td height="134" valign="middle" align="center"><table width="70%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><div align="center" class="abig"></div></td>
            <td><div align="left"><span class="abig style3"><span class="anormal"><span class="abig">Login System</span></span></span></div></td>
          </tr>
          <tr>
            <td><div align="right"><span class="anormal"><img src="images/key.jpg" width="83" height="76"></span></div></td>
            <td align = "left"><span class="abig style2">
	
			<br>
			Login Name</span> <br>
              <input type="text" name="txtUserID" maxlength="20"  style = "background-color:#c0c0c0;-webkit-border-radius: 9px;
	-moz-border-radius: 9px;
	border-radius: 9px;width:178px;height: 28px;">
              <br>
              <span class="abig style2">Password</span><br>
              <input type="password" name="txtPassword" maxlength="15"  style = "background-color:#c0c0c0;-webkit-border-radius: 9px;
	-moz-border-radius: 9px;
	border-radius: 9px;width:178px;height: 28px;">

<input type="hidden" name="hidAction" value="<?php echo base64_encode($date);?>">
       
		  <br></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></br>
			  <input type="submit" name="bt_login" value="Login" style = "-webkit-border-radius: 9px;
	-moz-border-radius: 9px;
	border-radius: 9px;width:80px; height: 30px;">&nbsp;&nbsp;&nbsp;
              <input type="reset" name="btnReset" value="Reset" style = "-webkit-border-radius: 9px;
	-moz-border-radius: 9px;
	border-radius: 9px;width:80px;height: 30px;"></td>
          </tr>
        </table>
      <p>&nbsp;</p></td>
    </tr>
  </form>

</table>
</body>
</html>