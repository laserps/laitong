<?php
class member
{
	var $db;
	var $fnc;

	
	function member($db,$fnc)
	{	
	  $this->fnc = $fnc; 
	  $this->db  = $db;

	} 

	function Add($data,$tbl,$page,$fielcheck=null){ 
		$this->check_username($tbl,$fielcheck,$page);
		$this->db->insert($tbl, $data);
		$id_member = mysql_insert_id();
		$this->fnc->redirect($page);
	}

	function check_username($tbl,$fielcheck,$page)
	{	$i=0;
		$sql = "SELECT * FROM ".$tbl." WHERE";
		foreach($fielcheck as $fiel=>$value){ 
		$i++;
		$sql.=' '.$this->count_row($i).''.$fiel.' = "'.$value.'"';
		}
		$res = $this->db->query($sql);
		$rs = $this->db->fetch($res);
		if($rs->username!=""){
		echo $this->fnc->alert("User is not already");
		$this->fnc->redirect($page);
		exit();
		}
	}

	function check_login($tbl,$fielcheck,$page)
	{	$i=0;
		$sql = "SELECT * FROM ".$tbl." WHERE";
		foreach($fielcheck as $fiel=>$value){ 
		$i++;
		$sql.=' '.$this->count_row($i).''.$fiel.' = "'.$value.'"';
		}
		$res = $this->db->query($sql);
		$rs = $this->db->fetch($res);
		
		if($rs->email==""){
		echo $this->fnc->alert("Not format incorrect Please Activate");
		$this->fnc->redirect($page);
		}
		if($rs->email!=""){
		echo $this->fnc->alert("You Welcome ".$rs->firstname."");
		$_SESSION[id_member]	  = $rs->id_member;
		$_SESSION[title_member]   = $rs->title_member;
		$_SESSION[firstname]      = $rs->firstname;
		$_SESSION[surname]        = $rs->surname;
		$_SESSION[email]		  = $rs->email;
		$this->fnc->redirect($page);
		}


	}


	function count_row($i){
	if($i>1){
	return "and ";
	}
	}

	

	function Edit($data,$tbl,$page=null,$fiel_id,$id,$fielcheck=null){
	if($data['username']!=""){
		$this->check_username($tbl,$fielcheck,$page);
		}
	$this->db->update(''.$tbl.'', $data, array(''.$fiel_id.'' => $id));
	if(isset($page)){
	$this->fnc->redirect($page);
	}
	}

	function Update($tbl,$fiel_id,$id)
	{
		$sql = "SELECT * FROM ".$tbl." WHERE ".$fiel_id." = '{$id}'; ";
		$res = $this->db->query($sql);
		return $this->db->fetch($res);
	}

	function Del($id,$tbl,$page,$fiel)
	{
		$this->db->delete(''.$tbl.'', array(''.$fiel.'' => $id));
		$this->fnc->redirect(''.$page.'');
	}

	function Delete_all($id,$tbl,$fiel,$page){
	$id_count = count($id);
	for($i=0;$i<$id_count;$i++){
	$this->db->delete(''.$tbl.'', array(''.$fiel.'' => $id[$i]));
	}
	$this->fnc->redirect(''.$page.'');
	}



	function dataList($tbl,$id=null,$limit=null,$fiel=null,$sort=null,$join=null)
	{
		if($limit!=""){
		$this->db->Pagelen = $limit;
		}
		if($id!=''){
			$where = ''.$tbl.'.'.$fiel.' = '.$id;
		}   
		$cnt	=	$this->db->countRow($tbl, $where);
		if($limit!=""){
		$limit  =   $this->db->countRowPage($cnt);
		}
		$cnt	=	$this->db->countRow($tbl, $where);
		$limit  =   $this->db->countRowPage($cnt);
		if($limit!=""){
		return $this->db->result($tbl.$join,$where,''.$tbl.'.'.$fiel.' '.$sort.'',$limit);
		}else{
		return $this->db->result($tbl.$join);
		}
	}

	function check_sess($id_member){
	if($id_member==""){
	echo $this->fnc->alert("Please Login Now");
	$this->fnc->redirect("../index.php");
	}
	}
	




}
?>