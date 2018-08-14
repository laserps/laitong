<?php
$page_admin = "?op=member&act=list";
$tbl = "tb_member";
$fiel_id = "id_member";
$fiel_check = array('username' =>$_POST['username']);
$fiel_login = array('username' =>$_POST['username'],'password' =>$_POST['password']);
$join = " left join tb_position on tb_member.id_position = tb_position.id_position ";

$message_alert = array("name"=>"กรุณากรอกชื่อด้วยค่ะ","surname"=>"กรุณากรอกนามสกุลด้วยค่ะ","telephone"=>"กรุณากรอกเบอร์โทรศัพท์","username"=>"กรุณากรอก Username ด้วยค่ะ","password"=>"กรุณากรอก Password ด้วยค่ะ");

$data = array(
			'num_member'				=> $_POST['num_member'],
			'title_member'			=> $_POST['title_member'],
			'name'					=> $_POST['name'],
			'surname'				=> $_POST['surname'],
			'sex'					=> $_POST['sex'],
			'id_position'			=> $_POST['id_position'],
			'username'				=> $_POST['username'],
			'password'				=> (md5($_POST['password'])),
			'address'				=> $_POST['address'],
			'telephone'				=> $_POST['telephone']
		);


?>


