<?php

	class func {

		function mothengmini($data){
		$mothcheck = 
		array("moth"=>array("01"=>"Jan","02"=>"Feb","03"=>"Mar","04"=>"Apr","05"=>"May","06"=>"Jun","07"=>"July","08"=>"Aug","09"=>"sep","10"=>"Oct","11"=>"Nov","12"=>"Dec"));
		return $mothcheck["moth"][$data];
		}

		function mothengfull($data){
		$mothcheck = 
		array("moth"=>array("01"=>"January","02"=>"Febuary","03"=>"Mar","04"=>"April","05"=>"May","06"=>"June","07"=>"July","08"=>"August","09"=>"september","10"=>"October","11"=>"November","12"=>"December"));
		return $mothcheck["moth"][$data];
		}

		function moththai($data){
		$mothcheck = 
		array("moth"=>array("01"=>"มกราคม","02"=>"กุมภาพันธุ์","03"=>"มีนาคม","04"=>"เมษายน","05"=>"พฤษภาคม","06"=>"มิถุุนายน","07"=>"กรกฎาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม"));
		return $mothcheck["moth"][$data];
		}

		function datemoth($data,$check){
		$data	= explode("-",$data);
		$day	= $data[0];
		$moth	= $data[1];
		if($check == "mini"){
		$moth2	= $this->mothengmini($moth);
		$year	= $data[2];
		}
		else if($check == "full"){
		$moth2  = $this->mothengfull($moth);
		$year	= $data[2];
		}
		else if($check == "thai"){
		$moth2  = $this->moththai($moth);
		$year	= $data[2]+543;
		}
		return $day." ".$moth2." ".$year;
		}

		function time_out($time=null,$check){
		if(($time<1200)and($check=="en")){
		return " AM.";
		}
		else if(($time>1200)and($check=="en")){
		return " PM.";
		}
		else if($check=="th"){
		return " นาที";
		}

		}

		function _date($date){
			if($date!=""){
			$date_book = explode("-",$date);
			return $date_book['2']."-".$date_book['1']."-".$date_book['0'];
			}else{
			return date("d-m-Y");
			}
		}

		function sexthai($sex){
		if($sex=="M"){
		return "ชาย";
		}else{
		return "หญิง";
		}
		}

		function status($status,$mesange1,$mesange2){
		if($status==1){
			return $mesange1;
		}
		else{
			return $mesange2;
		}
		}

		function count_day($dmy1,$dmy2,$type=null){
		$dmy1 = explode("-",$dmy1);
		/* วันเดือนปี ชุดเริ่มต้น*/
		$day1 =  $dmy1[0];
		$moth1 = $dmy1[1];
		$year1 = $dmy1[2];

		$dmy2 = explode("-",$dmy2);
		/* วันเดือนปี ชุดจบ*/
		$day2 =  $dmy2[0];
		$moth2 = $dmy2[1];
		$year2 = $dmy2[2];

		$result_1 = mktime(0, 0, 0, $moth1, $day1, $year1); 
		$result_2 = mktime(0, 0, 0, $moth2, $day2, $year2); 
		$result_date = $result_2 - $result_1;  
		$result = $result_date / (60 * 60 * 24);  
		return $result+$type;
		}

		function check_post($available,$post){
		if($post!=""){
		return $post;
		}else{
		return $available;
		}
		}
		
		function number_pad($number,$n,$style) {
		//example comment number_pad(ค่าที่โช,จำนวนหลัก,left หรือ right) 
		if($style == "left"){
		///0001////
		///0002///
		return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
		}
		else if($style == "right"){
		///1000////
		///2000///
		return str_pad((int) $number,$n,"0",STR_PAD_RIGHT);
		}
		}

		function selected($a,$b){
		if($a==$b){
		return "selected";
		}
		}
		
		function checked($a,$b){
			if($a==$b){
			return "checked";
			}
		}

		function check_radio($value){
			if($value==""){
				return "checked";
			}
		}
	

		function random(){
			$GEN_RAND=rand(11111,99999);
			return $GEN_RAND;
		}

		function plus_date($date,$condition,$time,$form){
			/* ฟังชั่น บวกเวลา  $date=เวลาที่บวก $condition=เงื่อนไขว่าจะบวกอะไร $time=จำนวนบวก $form = รูปแบบของ date เช่น d:i:y  */
			if($condition=="day"){
				$date_time = strtotime('+'.$time.' day', strtotime($date));
			}
			else if($condition=="year"){
				$date_time = strtotime('+'.$time.' year', strtotime($date));
			}
			else if($condition=="hour"){
				$date_time = strtotime('+'.$time.' hour', strtotime($date));
			}
			else if($condition=="minute"){
				$date_time = strtotime('+'.$time.' minute', strtotime($date));
			}

			$time = date("H:i", $date_time);
			if($time=="07:00"){
				print $date;
			}else{
				print date($form, $date_time);
			}
		}

		function lob_date($date,$condition,$time,$form){
			/* ฟังชั่น บวกเวลา  $date=เวลาที่บวก $condition=เงื่อนไขว่าจะบวกอะไร $time=จำนวนบวก $form = รูปแบบของ date เช่น d:i:y  */
			if($condition=="day"){
				$date_time = strtotime('-'.$time.' day', strtotime($date));
			}
			else if($condition=="year"){
				$date_time = strtotime('-'.$time.' year', strtotime($date));
			}
			else if($condition=="hour"){
				$date_time = strtotime('-'.$time.' hour', strtotime($date));
			}
			else if($condition=="minute"){
				$date_time = strtotime('-'.$time.' minute', strtotime($date));
			}

			$time = date("H:i", $date_time);
			if($time=="07:00"){
				print $date;
			}else{
				print date($form, $date_time);
			}
		}


		function checked_value_array($array_value_1,$array_value_2){
		if( (is_array($array_value_2)) and (in_array($array_value_1,$array_value_2)) ){
		echo "checked";
		}
		}

		function form_check($message_alert){
			$data  ='<SCRIPT LANGUAGE="JavaScript">';
			$data .='function chkvalue(obj){';
			$i=0;
			foreach($message_alert as $available=>$message){
			$i++;
			$data .=' '.$this->check_if($i).'if(obj.'.$available.'.value == ""){
					alert("'.$message.'");
					obj.'.$available.'.focus();
					return false;
					}';
			}

			
			$data .='return true;

				}
			</SCRIPT>';
			
			return  $data;
			
		}


		function checkall(){
		return '
		<script language="javascript">
		var flag = true;
		function handler()
		{	
		var ChkAsPHPArr = document.myForm["id[]"];
		if( ChkAsPHPArr )
		{
			for(i=0; i<ChkAsPHPArr.length; i++)
			{
				ChkAsPHPArr[i].checked = flag;
			}
			flag = !flag;
			if(flag)
			{
				document.getElementById("check_true").style.display = "none";
				document.getElementById("check_false").style.display = "";
			}
			else
			{
				document.getElementById("check_false").style.display = "none";
				document.getElementById("check_true").style.display = "";
			}
		}
	}</script>';
	}



	


	function check_email($email){
	list($email_user,$email_host)=explode("@",$email);
		$host_ip=gethostbyname($email_host);
		if(eregi("^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$", $email) && !ereg($host_ip,$email_host)) {
		return true;
		}else{
		return false;
	}
}

	
	function utf8_urldecode($str) {
		//encode from javascript encapt//
		$str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
		return html_entity_decode($str,null,'UTF-8');;
	}

	function lang($content_en,$content_th,$lang){
		if($lang=="TH"){
		echo $content_th;
		}
		else if($lang=="EN"){
		echo $content_en;
		}
	}

	function upload($temp,$filename,$path){
		$namedate = md5(date("dmyhis"));
		$realname = explode('.',$filename);  
		$name     = $namedate.'.'.$realname[1]."";
		if (is_uploaded_file($temp))  {     
		copy($temp, "$path/$name");
		}
		return $name;
	}


	function alert($message){
	return '<SCRIPT LANGUAGE="JavaScript">
	        alert("'.$message.'");
	        </SCRIPT>';
	}

	function window_close(){
	return '<SCRIPT LANGUAGE="JavaScript">
	window.close();
	</SCRIPT>';
	}

	function confirm(){
		return  '<script language="JavaScript">
				 function Conf(a) {
                 if (confirm("ยืนยันการลบข้อมูล  "+a) ==true) {
                 return true;
                  }
				  return false;
                  }
                 </script>';
	}


	function redirect($uri = '', $method = 'location')
	{
		switch($method)
		{
			case 'refresh'	: 
				echo '<script language="javascript">window.location.replace("' . $uri . '");</script>';
				break;
			default	:		
				echo '<script language="javascript">window.location.replace("' . $uri . '");</script>';
				break;
		}
		exit;
	}


	/////////////////Ajax Javascript  Form//////////////////////////////////////////////////////

	function open_java(){
		return '<SCRIPT LANGUAGE="JavaScript">';
	}

	function close_java(){
		return '</script>';
	}

	function alert_ajax($data){
		return "alert('".$data."');";
	}
	function connect_ajax(){
		return ' var objRequest = createRequestObject () ;
				function createRequestObject () {
					var objTemp = false ;
					if (window.XMLHttpRequest) {
					objTemp = new XMLHttpRequest () ;
					}else if (window.ActiveXObject) {
					objTemp = new ActiveXObject ("Microsoft.XMLHTTP") ;	
					}
					return objTemp ;
				}';
		}

	function check_and($i){
	 if($i>1){
		return "&";
	 }
	}

	function check_if($i){
	 if($i>1){
		return "else ";
	 }
	}

	function check_plus($i){
	 if($i>1){
		return "+";
	 }
	}


	function post_body($page_post,$data_post,$function_ready,$function_post){
		$data.= "function ".$function_post."(){";
		foreach($data_post as $rs_data_post=>$action){
		$data.= "var ".$rs_data_post." = document.getElementById('".$rs_data_post."');"; 
			$rs_data_post; 
		}
		$data.="var postBody = ";
		$i=0;
		foreach($data_post as $rs_data_post=>$action){
		$i++;
		
		$data.= " ".$this->check_plus($i)." '".$this->check_and($i)."".$rs_data_post."=' + ".$rs_data_post.".".$action."
		";

		}
		
		$data.=";";

		$data.="objRequest.open('POST', '".$page_post."?'+ Math.random(), true);";
		$data.="objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');";
		$data.="objRequest.onreadystatechange = ".$function_ready.";";
		$data.="objRequest.send(postBody);";
		$data.="}";

		return $data;
		}

	function funtion_ajax_ready($function_ready,$object_show,$action){
		$data.="function ".$function_ready."() {";
		$data.="if (objRequest.readyState == 4 && objRequest.status ==200) {";
		$data.="var data	=	objRequest.responseText;";
		$data.="document.getElementById('".$object_show."').".$action." = data;";
		$data.="}}";
			
		return $data;
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////




}
?>