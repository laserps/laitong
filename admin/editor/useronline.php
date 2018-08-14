<?php
$online_expire=300; // ตั้งเวลาคนออนไลน์ไว้ 5 นาที หรือ 300 วินาที
$online_start=time(); 
$online_timeup=$online_start-$online_expire; 

$rs_online = mysql_query("select * from ".DB_PREFIX."users_online where session_id='$sessionid'") ;
$row_online = mysql_num_rows($rs_online);

if ($row_online == 0) {
	if(isset($_SESSION["login_user"])){	$online_who="Member";	}else{	$online_who="Guest";	}
	mysql_query("INSERT INTO ".DB_PREFIX."users_online (session_id, session_time, session_who) VALUES ('$sessionid', '$online_start', '$online_who')");
} else {
	mysql_query("UPDATE ".DB_PREFIX."users_online SET session_time = '$online_start' where session_id='$sessionid'") ;
}
	mysql_query("delete from ".DB_PREFIX."users_online where session_time < $online_timeup");

$today = date("j");    
$month= date("n");      
$year = date("Y");   


	mysql_query("UPDATE ".DB_PREFIX."stats_date SET hits = ".DB_PREFIX."stats_date.hits+1 where year='$year' && month='$month' && date='$today'") ;
	mysql_query("UPDATE ".DB_PREFIX."stats_month SET hits = ".DB_PREFIX."stats_month.hits+1 where year='$year' && month='$month'") ;
?>