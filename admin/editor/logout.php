<?php require_once '../conf.php';
$rs = mysql_query("delete from ".DB_PREFIX."users_online where session_id='".session_id()."'") ;
echo $rs;
session_destroy();
mysql_close($connect);
?>
