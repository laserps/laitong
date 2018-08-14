<?php
/*****************************************************************
File :	class.export.mysql.php
Description :	Export MySQL to SQL
Created : 	8/21/2005
Author :	Error code 1
E-mail : webmaster@unzeen.com
Website : www.unzeen.com
Copyright (C) 2005, www.unzeen.com all rights reserved.
*****************************************************************/

function export_db($table){
	$query = "DESCRIBE `$table`";
	$result = mysql_query($query);
	$primary = "";
	$key = "";
	$function_result = "";

	$function_result .= "\n\nCREATE TABLE `".$table."` (\n";
	while ($line = mysql_fetch_array($result)) {
		$field_properties = "";
		$field_properties .= "\t`".$line["Field"]."` ";
		$field_properties .= $line["Type"]." ";
		
		if($line["Null"]){
			$field_properties .= "NULL ";
		}else{
			$field_properties .= "NOT NULL ";
		}

		if($line["Default"]){
			$field_properties .= "default '".$line["Default"]."' ";
		}
		if($line["Extra"]){
			$field_properties .= $line["Extra"]." ";
		}
		
		$field_properties .= ",\n";

		if($line["Key"] == "PRI"){
			$primary .= "\tPRIMARY KEY (`".$line["Field"]."`)";
		}
		if($line["Key"] == "MUL"){
			$key .= "\tKEY `".$line["Field"]."` (`".$line["Field"]."`)\n";
		}

		$function_result .= $field_properties;

	}

	if($key != ""){
		$primary = $primary.",\n";
	}else{
		$primary = $primary."\n";
	}
	$function_result .= $primary.$key.") TYPE=MyISAM;\n\n\n\n";



	$query = "SELECT * FROM `$table`";
	$result = mysql_query($query);
	while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
		$insert = "INSERT INTO `$table` VALUES (";
		for($i=0;$i<count($line);$i++){
			$value = str_replace("\\", "\\\\", $line[$i]);
			$value = str_replace("\r\n", "\\r\\n", $value);
			$value = str_replace("'", "\\'", $value);
			$insert .= "'".$value."'";
			if($i < count($line)-1){
				$insert .= ",";
			}
		}

		$insert .= ");\n";
		$function_result .= $insert;
	}
return $function_result;
}

function list_table($dbname){
	$result_table = mysql_list_tables($dbname);
	
	$table_arr = array();
	while ($row = mysql_fetch_row($result_table)) {
        $table_arr[] = $row[0];
    }
	return $table_arr;
}
?>