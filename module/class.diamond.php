<?php
class diamond
{
	var $db;
	var $fnc;

	
	function diamond($db,$fnc)
	{	
	  $this->fnc = $fnc; 
	  $this->db  = $db;

	} 

	function Add($data,$tbl,$page,$fielcheck=null){ 
		$this->db->insert($tbl, $data);
		$this->fnc->redirect($page);
	}


	function Edit($data,$tbl,$page=null,$fiel_id,$id,$fielcheck=null){
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


}
?>