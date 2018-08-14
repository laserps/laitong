<?php
class product
{
	var $db;
	var $fnc;

	
	function product($db,$fnc)
	{	
	  $this->fnc = $fnc; 
	  $this->db  = $db;

	} 

	function Add($data,$tbl,$page,$fielcheck=null){ 
		$this->db->insert($tbl, $data);

		$id     = $this->db->id();

		$data_content = array(
			"size"				=> $_POST['size'],
			"id_diamond"		=> $_POST['id_diamond'],
			"total_diamond"		=> $_POST['total_diamond'],
			"wage_fung"			=> $_POST['wage_fung'],
			"karat"				=> $_POST['karat'],
			"per_karat"			=> $_POST['per_karat'],
			"id_back_munk"		=> $_POST['id_back_munk'],
			"id_type_product"	=> $_POST['id_type_product'],
			"id_medicine"		=> $_POST['id_medicine'],
			"id_product"		=> $id
		);

		$this->db->insert("tb_content_product", $data_content);


		
		if( (count($_POST['id_special'])) >0){
				foreach($_POST['id_special'] as $id_special){
					$data_  = array("id_product"=> $id,"id_special"=> $id_special);
					$this->db->insert("tb_special_product", $data_);
				}
		}
		
		$this->fnc->redirect($page);
	}


	function Edit($data,$tbl,$page=null,$fiel_id,$id,$fielcheck=null){
		$this->db->update(''.$tbl.'', $data, array(''.$fiel_id.'' => $id));
		$this->db->delete("tb_special_product", " id_product = '".$id."' ");
		$data_content = array(
			"size"				=> $_POST['size'],
			"id_diamond"		=> $_POST['id_diamond'],
			"total_diamond"		=> $_POST['total_diamond'],
			"wage_fung"			=> $_POST['wage_fung'],
			"karat"				=> $_POST['karat'],
			"per_karat"			=> $_POST['per_karat'],
			"id_back_munk"		=> $_POST['id_back_munk'],
			"id_type_product"	=> $_POST['id_type_product'],
			"id_medicine"		=> $_POST['id_medicine'],
			"id_product"		=> $id
		);

		
		$this->db->update("tb_content_product", $data_content, " id_product = '".$id."' ");


		if( (count($_POST['id_special'])) >0){
				foreach($_POST['id_special'] as $id_special){
					$data_  = array("id_product"=> $id,"id_special"=> $id_special);
					$this->db->insert("tb_special_product", $data_);
				}
		}

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



	function dataList($tbl,$id=null,$limit=null,$fiel=null,$sort=null,$join=null,$fiel_search=null,$key_search=null)
	{
		if($limit!=""){
			$this->db->Pagelen = $limit;
		}
		
			
	
		if($key_search !=""){
			$where .= '  '.$tbl.'.'.$fiel_search.' like "%'.$key_search.'%"';
		}

		if($key_search == ""){
			$where .= '  '.$tbl.'.total_product >"0" ';
		}

		$cnt	=	$this->db->countRow($tbl, $where);
		if($limit!=""){
			$limit  =   $this->db->countRowPage($cnt);
		}
			$cnt	=	$this->db->countRow($tbl, $where);
			$limit  =   $this->db->countRowPage($cnt);
		
		/*if($key_search!=""){
			return $this->db->result($tbl.$join,$where,' id_product desc ','0,50');
		exit();
		}*/
		
		if($limit!=""){
			return $this->db->result($tbl.$join,$where,' id_product desc ',$limit);
		}else{
			return $this->db->result($tbl.$join);
		}
	}

	function dataList_search($tbl,$id=null,$limit=null,$fiel=null,$sort=null,$join=null,$fiel_search=null,$key_search=null)
	{
		if($limit!=""){
			$this->db->Pagelen = $limit;
		}
		
			
	
		if($key_search !=""){
			$where .= '  '.$tbl.'.'.$fiel_search.' like "%'.$key_search.'%"';
		}

	
		$cnt	=	$this->db->countRow($tbl, $where);
		if($limit!=""){
			$limit  =   $this->db->countRowPage($cnt);
		}
			$cnt	=	$this->db->countRow($tbl, $where);
			$limit  =   $this->db->countRowPage($cnt);
		if($key_search!=""){
			return $this->db->result($tbl.$join,$where,' id_product desc ','0,50');
		exit();
		}
		
		if($limit!=""){
			return $this->db->result($tbl.$join,$where,' id_product desc ',$limit);
		}else{
			return $this->db->result($tbl.$join);
		}
	}

	
	function dataList2($tbl,$id=null,$limit=null,$fiel=null,$sort=null,$join=null,$fiel_search=null,$key_search=null)
	{
		if($limit!=""){
			$this->db->Pagelen = $limit;
		}
		
			$where .= ' '.$tbl.'.id_stock_rent = "'.$id.'" and  '.$tbl.'.total_rent !="0" and tb_rent_temp.status_rent = "0" group by tb_rent_temp.id_product ';
	
		if($key_search !=""){
			$where .= '  and '.$tbl.'.'.$fiel_search.' like "%'.$key_search.'%"';
		}

		$cnt	=	$this->db->countRow($tbl, $where);
		if($limit!=""){
			$limit  =   $this->db->countRowPage($cnt);
		}
			$cnt	=	$this->db->countRow($tbl, $where);
			$limit  =   $this->db->countRowPage($cnt);
		if($limit!=""){
			return $this->db->result($tbl.$join,$where,' product_id_re asc ',$limit);
		}else{
			return $this->db->result($tbl.$join);
		}
	}




}
?>