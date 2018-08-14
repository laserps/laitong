<?PHP
	Class admin
	{	
		
		function admin(){
			require 'class.database.php';
			$this->db = new database();
		}

		function loging($user,$pass){
			$pass_login = md5($pass);
			$tbl	    = 'tb_member  

			';
			$where = "  username = '".$user."' and password = '".$pass_login."'";
			$limit = "0,1";
		return $this->db->result($tbl,$where,'id_member desc',$limit);
		}
		
		
		function check_error(){
		 $check = $this->db->countRow("tb_logfile_member", "ip_log = '".$_SERVER["REMOTE_ADDR"]."' and status_log = 'N' ");
			return $check;
		}

		function checklogin($userlog,$id_member,$level,$name_position,$id_division){
	
			if($userlog != ""){
			    $_SESSION[login_session] = md5("wangdek")."golfgab";
				$_SESSION[id_member] = $id_member;
				$_SESSION[level] = $level;
				$_SESSION[username] = $userlog;
				$_SESSION[name_position] = $name_position;
				$_SESSION[id_division] = $id_divistion;

				$data = array("email_log"=>$_POST[txtUserID],"ip_log"=>$_SERVER["SERVER_ADDR"],"status_log"=>"Y","date_log"=>date("Y-m-d H:i:s"));
				$this->db->insert("tb_logfile_member", $data);

				echo '<script language="javascript">
				      window.location.replace("main.php");		
			          </script>';
		     }
		}

		
	function check($check){
			if($check == ""){
				echo '<script language="javascript">
				      window.location.replace("login.php");		
			          </script>';
				exit();
			}
		}

		function logout($do){
			if($do == "logout"){
			unset($_SESSION['login_session']);
			unset($_SESSION['id_division']);
			}
		}

	
	}


?>