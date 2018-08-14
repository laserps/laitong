<?php

class Database
{
	var $dsn;
	var $Pagelen = 10;
	var $end_page=3;
	var $Page;
	var $total;
	var $first_title = 'First';
	var $last_title  = 'Last';
	var $prev_title  = 'Back';
	var $go_title    = 'Next';

	
	function Database()
	{
		$this->_initialize();
		$db = parse_url($this->dsn);
		@mysql_connect($this->host, $this->user, $this->pass) or die($this->error_sql_log($this->error()));
		@mysql_query("set names {$db['fragment']}") or die($this->error());
		@mysql_select_db(substr($db['path'], 1)) or die($this->error());
	}
	
	function _initialize()
	{
		if(file_exists('include/config.inc.php') == true)
		{
			require 'include/config.inc.php';
		}else{
			require '../include/config.inc.php';
		}
		$this->host = $hostname;
		$this->user = $user;
		$this->pass = $password;
		$this->dsn  = $dsn;
		$this->Page = $_GET['p'];
	}
	
	function result($tbl, $where = NULL, $order = NULL, $limit = NULL, $field = '*')
	{
		$f = $this->_field($field);
		$w = (!is_null($where)) ? $this->_where($where) : '';
		$o = (!is_null($order)) ? $this->_order($order) : '';
		$l = (!is_null($limit)) ? $this->_limit($limit) : '';

		$sql = "SELECT {$f} FROM {$tbl} {$w} {$o} {$l}";
		//echo $sql;
		$res = $this->query($sql);
		$num = $this->num($res);
		
		if($num == 0)
		{
			return FALSE;
		}
		else
		{
			while($row = $this->fetch($res))
				$tmp[] = $row;
				
			return $tmp;
		}
	}	

	function record($tbl, $where = NULL, $field = '*')
	{
		$f = $this->_field($field);
		$w = (!is_null($where)) ? $this->_where($where) : '';

		$sql = "SELECT {$f} FROM {$tbl} {$w}";
		//echo $sql;
		$res = $this->query($sql);
		$num = $this->num($res);
		
		if($num == 0)
		{
			return FALSE;
		}
		else
		{
			$row = $this->fetch($res);
			return $row;
		}
	}	

	function query($sql)
	{
			//echo $sql;
		$_SESSION["get_query_total"] += 1;
		$this->get_query_total = $this->get_query_total+1;
		$res = mysql_query($sql) or die($this->error_sql_log($sql.'<br />'.$this->error()));
		return $res;
	}
	
	function countRow($tbl, $where = NULL, $order = NULL)
	{
		$w = (!is_null($where)) ? $this->_where($where) : '';
		$o = (!is_null($order)) ? $this->_order($order) : '';

		$sql = "SELECT COUNT(*) AS cnt FROM {$tbl} {$w} {$o}";
		//echo $sql;
		$res = $this->query($sql);
		$row = $this->fetch($res); 
		return $row->cnt;
	}

	function sum($tbl, $where = NULL, $order = NULL,$fiel=Null)
	{
		
		$w = (!is_null($where)) ? $this->_where($where) : '';
		$sql = "SELECT sum($tbl.$fiel) AS cnt FROM {$tbl} {$w} ";
		//echo $sql;
		$res = $this->query($sql);
		$row = $this->fetch($res); 
		return $this->checknull($row->cnt);		
	}

	function checknull($cnt){
	if($cnt==""){
	return "0";
	}else{
	return $cnt;
	}
	}

	
	function error()
	{
		return mysql_error();
	}

	function error_sql_log($s_data) {
		$s_error_text = "ERROR : MySql query failed\tIP : " . $_SERVER['REMOTE_ADDR'] . " \tDATE/TIME : " . date ( "d/m/Y H:I:s" ) . " h\r\n";
		$s_error_text .= "SQL ERROR : " . current(explode("<br />", $s_data)) . "\r\n";
		$s_error_text .= "MSG ERROR : " . end(explode("<br />", $s_data)) . "\r\n\r\n";
		$s_error = fopen("__log/sql_log.txt");
		fwrite($s_error,$s_error_text);
		fclose($s_error);
		return $s_data;
	}

	function id()
	{
		return mysql_insert_id();
	}
	
	function num($res)
	{
		return mysql_num_rows($res);
	}
	
	function fetch($res)
	{
		return mysql_fetch_object($res);
	}
	
	function insert($tbl, $data)
	{
		if(is_array($data))
		{
			foreach($data as $k => $v)
			{
				$field[] = $k;
				$value[] = $this->_escape($v); 
			}
			
			$insert = "(".implode(', ', $field).") VALUES (".implode(', ', $value).")";
		}
		else
		{
			$insert = " VALUES {$data}";
		}
		
		return $this->query("INSERT INTO {$tbl} {$insert}");
	}
	
	function update($tbl, $data, $where = NULL)
	{
		$w = (!is_null($where)) ? $this->_where($where) : '';
		
		if(is_array($data))
		{
			foreach($data as $k => $v)
			{
				$set[] = $k . ' = ' . $this->_escape($v); 
			}
			
			$update = implode(', ', $set);
		}
		else
		{
			$update = $data;
		}
		
		return $this->query("UPDATE {$tbl} SET {$update} {$w}");	
	}
	
	function delete($tbl, $where = NULL)
	{	
		$w = (!is_null($where)) ? $this->_where($where) : '';
		return $this->query("DELETE FROM {$tbl} {$w}");
	}
		
	function _field($field)
	{
		if(is_array($field))
		{
			$f = implode(', ', $field);
		}
		else
		{
			$f = $field;
		}
		
		return $f;
	}
	
	function _where($where)
	{
		$w = ' WHERE ';
		
		if(is_array($where))
		{
			foreach ($where as $k => $v)
			{
				if(!$this->_operator($k) && is_null($where[$k]))
					$k .= ' IS NULL';
				
				if(!is_null($v))
				{	
					if(!$this->_operator($k))
						$k .= ' =';
				
					$v = ' '.$this->_escape($v);
				}
				
				$tmp[] = $k . $v;
			}
			
			$w .= implode(' AND ', $tmp);
		}
		else
		{
			$w .= $where;
		}
		
		return $w;
	}
	
	function _order($order)
	{
		$o = ' ORDER BY ';
		
		if(is_array($order))
		{
			foreach($order as $k => $v)
				$tmp[] = $k.' '.$v;
			
			$o .= implode(', ', $tmp);
		}
		else
		{
			$o .= $order;
		}
		
		return $o;
	}
	
	function _limit($limit)
	{
		$l = ' LIMIT ';
		
		if(is_array($limit))
		{
			foreach($limit as $k => $v)
				$tmp[] = $k.', '.$v;
			
			$l .= implode(', ', $tmp);
		}
		else
		{
			$l .= $limit;
		}
		
		return $l;
	}

	function _operator($str)
	{
		$str = trim($str);
		if (!preg_match("/(\s|<|>|!|=|is null|is not null)/i", $str))
		{
			return FALSE;
		}

		return TRUE;
	}
	
	function _escape($str)
	{	
		switch(gettype($str))
		{
			case 'string'  : $str = "'".$str."'";
				break;
			case 'boolean' : $str = ($str === FALSE) ? 0 : 1;
				break;
			default        : $str = ($str === NULL) ? 'NULL' : $str;
				break;
		}		

		return $str;
	}



	function countRowPage($num)
	{
		$this->total = ceil($num / $this->Pagelen);
		
		if(empty($this->Page)) $this->Page = 1;
		
		$goto = ($this->Page - 1) * $this->Pagelen;
		
		$len = array($goto => $this->Pagelen);
		
		return $len;
	}

	function render($uri)
	{			
		$start = $this->Page - $this->Range;
		
		if($start <= 1) $start = 1;

		$end = $this->end_page;	

		
		if($end >= $this->total) $end = $this->total;

		$p = '';


	/// ก่อนหน้า
		if($this->Page > 1){
			$back = $this->Page - 1;
			$p .= '<a href="' . $uri . 'p=' . $back . '" title="' . $this->prev_title . '"  class="font1 linkC1">&laquo; Previous&nbsp;</a>';
		}else{
			$p .= '<span>&nbsp;</span>';
		}
	/// หน้าแรก
		if($this->Page > $this->end_page + 1){
			$p .= '<a href="' . $uri . 'p=1" title="' . $this->first_title . '"  class="font1 linkC1">1</a>';
		}
		if($this->Page > $this->end_page + 2){
			$p .= '<span>...</span>';
		}

	// แสดงหน้า
		$start = $this->Page - $this->end_page;
		if($this->Page <= $this->end_page){$start=1;}
		$stop= $this->Page + $this->end_page;
		if($stop>= $this->total ){$stop = $this->total;}
		for($i = $start; $i <= $stop; $i++)
		{
			if($i == $this->Page)
				$p .= '<span>|'. $i .'|</span>';
			else
				$p .= '<a href="' . $uri . 'p=' . $i . '" title="' . $i . '" class="font1 linkC1">|' . $i . '|</a>';
		}


	// สุดท้าย
		if($this->Page+$this->end_page < $this->total-1){
			$p .= '<span>...</span>';
		}
		if($this->Page< $this->total-$this->end_page){
			$p .= '<a href="' .$uri . 'p=' . $this->total . '" title="' . $this->last_title . '"  class="font1 linkC1">'.$this->total.'</a>';
		}

	/// ถัดไป
		if($this->Page < $this->total){
			$next = $this->Page + 1;
			$p .= '<a href="'. $uri . 'p=' . $next . '" title="' . $this->go_title . '"  class="font1 linkC1">&nbsp;Forward &raquo;</a>';
		}else{
			$p .= '<span>&nbsp;</span>';
		}

		
		$render = '<div class="pagination"><p >'. $p .'</p></div>';
		
		return $render;
	}

	function renderweb($uri)
	{			
		$start = $this->Page - $this->Range;
		
		if($start <= 1) $start = 1;

		$end = $this->end_page;	

		
		if($end >= $this->total) $end = $this->total;

		$p = '';


	/// ก่อนหน้า
		if($this->Page > 1){
			$back = $this->Page - 1;
			$p .= '<li><a href="' . $uri . 'p=' . $back . '" title="' . $this->prev_title . '"  class="font1 linkC1">&laquo; Previous&nbsp;</a></li>';
		}else{
			$p .= '';
		}
	/// หน้าแรก
		if($this->Page > $this->end_page + 1){
			$p .= '<li><a href="' . $uri . 'p=1" title="' . $this->first_title . '"  class="font1 linkC1">1</a></li>';
		}
		if($this->Page > $this->end_page + 2){
			$p .= '<li>...</li>';
		}

	// แสดงหน้า
		$start = $this->Page - $this->end_page;
		if($this->Page <= $this->end_page){$start=1;}
		$stop= $this->Page + $this->end_page;
		if($stop>= $this->total ){$stop = $this->total;}
		for($i = $start; $i <= $stop; $i++)
		{
			if($i == $this->Page)
				$p .= '<li>'. $i .'</li>';
			else
				$p .= '<li><a href="' . $uri . 'p=' . $i . '" title="' . $i . '" class="font1 linkC1">' . $i . '</a></li>';
		}


	// สุดท้าย
		if($this->Page+$this->end_page < $this->total-1){
			$p .= '<li>...</li>';
		}
		if($this->Page< $this->total-$this->end_page){
			$p .= '<li><a href="' .$uri . 'p=' . $this->total . '" title="' . $this->last_title . '"  class="font1 linkC1">'.$this->total.'</a></li>';
		}

	/// ถัดไป
		if($this->Page < $this->total){
			$next = $this->Page + 1;
			$p .= '<li><a href="'. $uri . 'p=' . $next . '" title="' . $this->go_title . '"  class="font1 linkC1">&nbsp;Forward &raquo;</a></li>';
		}else{
			$p .= '<li>&nbsp;</li>';
		}

		
		$render = '<li class="pageLink">'. $p .'</li>';
		
		return $render;
	}



}
?>