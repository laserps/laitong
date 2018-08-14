<?php 
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "wb_laithong";
$con =  mysql_connect($host,$user,$password) or die("�Դ��Ͱҹ�����������");
mysql_select_db($dbname) or die("���͡�ҹ�����������");
$charset = "SET NAMES 'tis620'"; 
mysql_query($charset);
?>

