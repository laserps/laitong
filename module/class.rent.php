<?php
class rent
{
	var $db;
	var $fnc;

	
	function rent($db,$fnc)
	{	
	  $this->fnc = $fnc; 
	  $this->db  = $db;

	} 

	function Add($data,$tbl,$page,$fielcheck=null){ 
		$this->db->insert($tbl, $data);
	    $last_id = $this->db->id();
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



	function dataList($tbl,$id=null,$limit,$fiel=null,$sort,$field_sort=null,$join=null,$key_search=null,$field_search=null)
	{
		$this->db->Pagelen = $limit;
			$where.='   tb_rent_temp.id_stock_rent = tb_stock.id_stock  and '; 
			$where.='   tb_rent_temp.status_rent ="0"  '; 
		if($key_search!=''){
			$where.= ' and '.$field_search.' like "%'.$key_search.'%"';
		}
			$where.= ' group by tb_rent_temp.id_stock_rent ';
		
		$cnt	=	$this->db->countRow($tbl, $where);
		
		$limit  =   $this->db->countRowPage(count($cnt));
		return $this->db->result($tbl.$join,$where,'tb_rent_temp.'.$this->check_field_sort($fiel,$field_sort).'  '.$this->check_sort($sort).'',$limit);
	}

	function dataList2($tbl,$id=null,$limit,$fiel=null,$sort,$field_sort=null,$join=null,$key_search=null,$field_search=null)
	{
		$this->db->Pagelen = $limit;
		if($key_search!=''){
			$where = ''.$tbl.'.'.$field_search.' like "%'.$key_search.'%" and status_product ="2"';
		}else{
			$where = ' status_product ="2" ';
		}
		
		$cnt	=	$this->db->countRow($tbl, $where);
		$limit  =   $this->db->countRowPage($cnt);
		return $this->db->result($tbl.$join,$where,''.$tbl.'.'.$this->check_field_sort($fiel,$field_sort).'  '.$this->check_sort($sort).'',$limit);
	}

	function check_sort($sort=null){
		if($sort==""){
			return " desc ";
		}
		else{
			return $sort;
		}
	}

	function check_link_sort($sort){
		if($sort==""){
			return "asc";
		}
		else if($sort=="desc"){
			return "asc";
		}
		else if($sort=="asc"){
			return "desc";
		}
	}

	function check_field_sort($fiel,$field_sort=null){
		if(empty($field_sort)){
			return $fiel;
		}else{
			return $field_sort;
		}
	}

	function check_icon_sort($sort,$fiel,$fiel_check){
		if( ($sort=="desc") and ($fiel==$fiel_check) ){
			return '<IMG SRC="images/icon_down.gif" WIDTH="21" HEIGHT="13" BORDER="0" title="เรียงลำดับ" style = "cursor:pointer;">';
		}
		else if( ($sort=="asc")and ($fiel==$fiel_check) ){
			return '<IMG SRC="images/icon_up.gif" WIDTH="21" HEIGHT="13" BORDER="0" title="เรียงลำดับ" style = "cursor:pointer;">';
		}else{
			return '';
		}

	}


}
?>