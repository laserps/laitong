<?php
//$file_ = file_get_contents('http://www.goldtraders.or.th/default.aspx');
/*
$file_ = file_get_contents('http://workbythaidev.com/api/price_gold.php');

    $num1 = explode('span',$file_);

	// print_r($num1);
	
	$num1_n = explode('id="DetailPlace_uc_goldprices1_lblBLSell" style="color:Red;font-size:X-Large;font-weight:bold;">',$num1[19]);
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
		$num1_n = explode('id="DetailPlace_uc_goldprices1_lblBLSell" style="color:Black;font-size:X-Large;font-weight:bold;">',$num1[15]);
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

//$gold__ =  "20400";
*/

$num1 = file_get_contents('http://ljt888.net/software/admin/api/get_gold');
$num1 = json_decode($num1 , true);
$gold_ = $num1['gold_bar']['sell'];
$patterns = array();
	$patterns[0] = '/,/';
	$replacements = array();
	$replacements[1] = '';
$gold__ =  (int)preg_replace($patterns, $replacements, $gold_);

?>