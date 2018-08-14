<?php

$d = "12@8@6@";

$t = explode("@",$d);

foreach($t as $k){
	if($k == ""){
		echo "1";
	}else{
	echo $k."<br>";
	}
}

?>