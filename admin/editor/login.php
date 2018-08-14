<?php require_once '../conf.php';

  $n = $_POST["name"];  //เก็บชื่อที่ส่งมาจากบราวเซอร์ไว้ในตัวแปร $n
  $p = $_POST["pass"];  //เก็บรหัสผ่านที่ส่งมาจากบราวเซอร์ไว้ในตัวแปร $p


  authenticateUser($n, $p);  //ตรวจสอบชื่อและรหัสผ่านที่ส่งมาจากบราวเซอร์

  //ฟังก์ชั่นที่ใช้ตรวจสอบว่ามีชื่อและรหัสผ่านนี้ในฐานข้อมูลหรือไม่
  function authenticateUser($username, $password) {

    //ดึงข้อมูลจากเทเบิล login ที่มีชื่อและรหัสผ่าน (หลังจากเข้ารหัสด้วยฟังก์ชั่น MD5 แล้ว) ตรงกับที่ส่งมาจากบราวเซอร์
	$result = mysql_query("select * from ".DB_PREFIX."users where user_username='$username' and user_password='".base64_encode($password)."'") ;
    //นับจำนวนแถวของผลลัพธ์ที่ได้ เก็บลงตัวแปร $row_count
    $row_count = mysql_num_rows($result);


    //ถ้าการดึงข้อมูลได้ผลลัพธ์ 1 แถว แสดงว่ามีชื่อและรหัสผ่านนั้นในเทเบิล login
    if ($row_count == 1) {
		$row = mysql_fetch_assoc($result);
		extract($row);
      /* ลงทะเบียนตัวแปรเซสชั่นชื่อ username เพื่อจดจำชื่อที่ใช้ล็อกอิน และการมีตัวแปรนี้ยังบ่งบอกว่าผู้ใช้ล็อกอินสำเร็จแล้ว ซึ่งค่าของตัวแปรเซสชั่นจะคงอยู่จนกว่าผู้ใช้จะปิดหน้าจอนี้ของบราวเซอร์ลงไป */
	$online_who="Member";
	mysql_query("UPDATE ".DB_PREFIX."users_online SET session_who = '$online_who' where session_id='".session_id()."'") ;
		if(!$user_group){
			$rsg[group_name]="ผู้ใช้ทั่วไป";
		}else{
			$rs = mysql_query("select * from ".DB_PREFIX."group where group_id = ".$user_group."") ;
			$rsg = mysql_fetch_assoc($rs) ;
		}

	  $_SESSION["login_id"] = $user_id;
	  $_SESSION["login_user"] = $user_username;
	  $_SESSION["login_group"] = $user_group;
	  $_SESSION["login_group_name"] = $rsg[group_name];
	  $_SESSION["login_name"] = $user_name;
	  $_SESSION["login_type"] = $user_type;
	  $_SESSION["login_gender"] = $user_gender;
      sendResponse("success", "index.php");
    } else {
      sendResponse("error", "<center><br>ชื่อหรือรหัสผ่านไม่ถูกต้อง!<br></center>");
    }
}
  //ฟังก์ชั่นที่ใช้ส่งผลลัพธ์กลับไปยังบราวเซอร์
function sendResponse($status, $message) {
    echo $status . "|" . $message;
}
mysql_close($connect);
?>
