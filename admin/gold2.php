<?php

/*$file_ = file_get_contents('http://www.ranthong.com/webboard/gp.php');
    $num1 = explode('</td><td align = center><b>',$file_);
	//print_r($num1);
	$num1_n = explode('-', $num1[1]);
	//print_r($num1_n);
	$gold_ = $num1_n[1];
	$gold__ =  (int)$gold_;
*/
//$gold__ =  "20400";

//echo $gold__;


$file_ = file_get_contents('http://www.goldtraders.or.th/');
    $num1 = explode('span',$file_);

	//print_r($num1);
	
	$num1_n = explode('id="DetailPlace_uc_goldprices1_lblBLSell" style="color:Red;font-size:X-Large;font-weight:bold;">',$num1[13]);
    //$num1_n = explode('id="DetailPlace_uc_goldprices1_lblBLSell">',$num1[13]);
	//$num1_n = explode('id="DetailPlace_uc_goldprices1_lblBLSell">',$num1[17]);

	//print_r($num1_n);
	
	$gold_export = str_replace("</", "", $num1_n[1]);

	$gold_ = strip_tags($num1_n[1]);

	if($gold_ == ""){
		$num1_n = explode('id="DetailPlace_uc_goldprices1_lblBLSell" style="color:Green;font-size:X-Large;font-weight:bold;">',$num1[13]);
		$gold_export = str_replace("</", "", $num1_n[1]);
		$gold_ = strip_tags($num1_n[1]);
	}

	if($gold_ == ""){
		$num1_n = explode('id="DetailPlace_uc_goldprices1_lblBLSell">',$num1[13]);
		$gold_export = str_replace("</", "", $num1_n[1]);
		$gold_ = strip_tags($num1_n[1]);
	}

	if($gold_ == ""){
		$num1_n = explode('id="DetailPlace_uc_goldprices1_lblBLSell">',$num1[17]);
		$gold_export = str_replace("</", "", $num1_n[1]);
		$gold_ = strip_tags($num1_n[1]);
	}


	if($gold_ == ""){
		$num1_n = explode('id="DetailPlace_uc_goldprices1_lblBLSell">',$num1[15]);
		$gold_export = str_replace("</", "", $num1_n[1]);
		$gold_ = strip_tags($num1_n[1]);
	}
	
	if($gold_ == ""){
		$num1_n = explode('id="DetailPlace_uc_goldprices1_lblBLSell">',$num1[43]);
		$gold_export = str_replace("</", "", $num1_n[1]);
		$gold_ = strip_tags($num1_n[1]);
	}

	if($gold_ == ""){
		$num1_n = explode('id="DetailPlace_uc_goldprices1_lblBLSell">',$num1[11]);
		$gold_export = str_replace("</", "", $num1_n[1]);
		$gold_ = strip_tags($num1_n[1]);
	}
	if($gold_ == ""){
		$num1_n = explode('id="DetailPlace_uc_goldprices1_lblBLSell">',$num1[14]);
		$gold_export = str_replace("</", "", $num1_n[1]);
		$gold_ = strip_tags($num1_n[1]);
	}

	    
	$patterns = array();
	$patterns[0] = '/,/';
	$replacements = array();
	$replacements[1] = '';


$gold__ =  (int)preg_replace($patterns, $replacements, $gold_);

?>