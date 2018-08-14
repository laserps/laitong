<?php ob_start();
session_start();

Class capcha
{
	function head($string=null){
	header("Content-type: image/png");
	$image = imagecreatefromjpeg("bg_code.jpg");
	$textColor = imagecolorallocate ($image, 255, 0, 0); 
	imagestring ($image, 5, 5, 3,  $string, $textColor); 
	$_SESSION['security_code'] = $string;
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: post-check=0, pre-check=0", false); 
	header("Pragma: no-cache"); 	
	header('Content-type: image/jpeg');
	imagejpeg($image);
	imagedestroy($image);
	}

	function  string_random(){
	$alphanum = "ABCDEFGHJKLMNPRTUVWXYZ2346789";
	$rand = substr(str_shuffle($alphanum), 0, 5);
	if($rand!=""){
	$this->head($rand);
	}else{
	$this->alert();
	}
	}

	function alert(){
	return "Please Sent Security Code";
	}

}

	$capcha = new capcha();
	echo $capcha->string_random();



?>