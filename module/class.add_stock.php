<?php
class add_stock
{
	var $db;
	var $fnc;

	
	function add_stock($db,$fnc)
	{	
	  $this->fnc = $fnc; 
	  $this->db  = $db;

	} 

	function Add($data,$id_product=null,$tbl,$page,$fielcheck=null){ 
		$this->db->insert($tbl, $data);
		$rs_product = $this->db->record("tb_product","id_product='".$_POST['id_product']."'");
		$total = $rs_product->total_product + $_POST['tottal_add_stock'];
		$data_update = array("total_product"=>$total);
		$this->db->update("tb_product", $data_update, " id_product='".$_POST['id_product']."'  ");

		$this->fnc->redirect($page);
	}




	function Edit($data,$id_color,$tbl,$page=null,$fiel_id,$id,$fielcheck=null){
			$this->db->delete('tb_color_type_product', array('id_type_product' => $id));
			$this->db->update(''.$tbl.'', $data, array(''.$fiel_id.'' => $id));
			if(!empty($id_color)){
			foreach($id_color as $color){
				$data_insert_color = array('id_type_product'=>$id,'id_color'=>$color);
				$this->db->insert("tb_color_type_product",$data_insert_color);
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