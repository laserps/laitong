<?php  ob_start();
session_start();
if($_SESSION["login_session"] == "") {
	header("Location:index.php");
	exit();
}
?>