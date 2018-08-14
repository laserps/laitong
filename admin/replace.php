<?php

	$test = "21,900.00";

	$patterns = array();
	$patterns[0] = '/,/';
	$replacements = array();
	$replacements[1] = '';


$gold__ =  (int)preg_replace($patterns, $replacements, $test);
echo $gold__;

?>