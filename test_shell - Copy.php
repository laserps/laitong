<?php

$strFileName = "C:\AppServ\www\laithong\weight.txt";
fwrite($strFileName, '');
$objFopen = fopen($strFileName, 'r');
if ($objFopen) {
    while (!feof($objFopen)) {
        $file = strip_tags(fgets($objFopen, 4096));
		$rest = substr($file, 2, 11);
        echo trim($rest);
    }
	//$fp = fopen('C:\AppServ\www\laithong\weight.txt', 'w');
	//fwrite($fp, '');
    fclose($objFopen);
	//fclose($fp);
}
?>