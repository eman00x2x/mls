<?php

namespace Library;

class Table {

	public $DBO;
	public $pagina;
	
	public $table;
	public $select;
	public $join;
	public $where;
	public $and;
	public $orderby;
	public $groupby;

	public $primary_key;
	public $fields;
	public $column = [];
	public $rows = 0;
	public $results = [];
	
	public $total_pages = 0;

	public $page = [
		"adjacents" => null,
		"limit" => 20,
		"current" => null,
		"uri" => [],
		"target" => null,
		"starting_number" => null
	];

	public $pagination;


	function init() {

		$this->DBO = \Library\Factory::getDBO();
		$this->pagina = \Library\Factory::getPagination();
		
		unset($this->db_host);
		unset($this->db_name);
		unset($this->db_user);
		unset($this->db_pass);
		unset($this->db_prefix);
		unset($this->query);
		unset($this->link);
		unset($this->error);

	}

	function select($select) {
		$this->select = $select;
		return $this;
	}

	function from($from) {
		$this->from = $from;
		return $this;
	}

	function join($join) {
		$this->join = $join;
		return $this;
	}

	function where($where) {
		if($where == null ) { return $this; }
		$this->where = " WHERE ".$where;
		return $this;
	}

	function and($and) {
		if($and == null ) { return $this; }
		$this->and = " AND ".$and;
		return $this;
	}

	function orderBy($order_by) {
		if($order_by == null ) { return $this; }
		$this->orderby = " ORDER BY ".$order_by;
		return $this;
	}

	function groupBy($group_by) {
		if($group_by == null ) { return $this; }
		$this->groupby = " GROUP BY ".$group_by;
		return $this;
	}

	function initiateFields($result) {
		$finfo = $this->DBO->fetchFields($result);
		$this->fields = [];

		foreach($finfo as $key => $val) {
			$n = $finfo[$key]->name;
			$this->fields[] = $finfo[$key]->name;
			/* $this->column[$n] = null; */
		}

	}

	function stripQuotes($data) {

		foreach($data as $key => $val) {
			$val = clean($val);
			if(!is_null($val)) {
				json_decode($val);
				if(json_last_error() === JSON_ERROR_NONE) {
					$val = json_decode($val, true);
				}
			}
			$this->column[$key] = $val;
		}

		return $this->column;

	}

	function getById() {

		$query = "SELECT ".($this->select != "" ? $this->select : "*")." FROM #__".$this->table." ".$this->join." WHERE ".$this->primary_key." = ".$this->column[$this->primary_key]." ".$this->and." ".$this->groupby." ".$this->orderby;
		$result = $this->DBO->query($query);

		$this->initiateFields($result);

		if($this->DBO->numRows($result) > 0) {
			$line = $this->DBO->FetchAssoc($result);
			return $this->stripQuotes($line);
		}else {return false;}

	}

	function getList() {

		$this->setPagina($this->page['current'], $this->page['limit']);

		$query = "SELECT ".($this->select != "" ? $this->select : "*")." FROM #__".$this->table." ".$this->join." ".$this->where." ".$this->and." ".$this->groupby." ".$this->orderby;
		$query .= " LIMIT ". $this->page['starting_number'] .",". $this->page['limit'];
		$result = $this->DBO->query($query);

		$this->initiateFields($result);

		if($this->DBO->numRows($result) > 0) {

			$query = "SELECT ".($this->select != "" ? $this->select : "*").", COUNT(".$this->primary_key.") AS total_row FROM #__".$this->table." ".$this->join." ".$this->where." ".$this->and." ".$this->groupby." ".$this->orderby;
			$line = $this->DBO->queryUniqueValue($query);
			$this->rows = $line['total_row'];

			while($line = $this->DBO->FetchAssoc($result)) {
				$this->results[] = $this->stripQuotes($line);
			} 
			
			$this->total_pages = ceil($this->rows/$this->page['limit']);
			$this->pagination = $this->pagina->build($this, $this->page['target'],$this->page['uri']);
			
			return $this->results;
		}else {return false;}

	}

	function insert() {

		$query = "SELECT ".($this->select != "" ? $this->select : "*")." FROM #__".$this->table." LIMIT 1 ";
		$this->initiateFields($this->DBO->query($query));

		foreach($this->fields as $name) {
			if($name != $this->primary_key && (isset($this->column[$name]) && $this->column[$name] != "")) {
				$data[$name] = $this->DBO->mysql_escape_string($this->column[$name]);
				$fields[] = $name;
			}
		}

		unset($data[$this->primary_key]);
		$query = "INSERT INTO #__".$this->table."(".$this->primary_key.",".implode(",",$fields).")
		VALUES(null,'".implode("','",$data)."')";
		$this->DBO->query($query);
		return $this->DBO->insertId();

	}

	function update() {

		$query = " UPDATE #__".$this->table." SET ";

		foreach($this->fields as $name) {
			if($name != $this->primary_key && (isset($this->column[$name]) && $this->column[$name] != "")) {
				$set[] = $name." = '".$this->DBO->mysql_escape_string($this->column[$name])."'";
			}
		}

		$query .= implode(", ",$set);
		$query .= " WHERE ".$this->primary_key." = ".$this->column[$this->primary_key]."";
		$query = $query;
		$this->DBO->query($query);

	}

	function delete($id=null,$field=null) {

		if(!is_null($id)) {
			$query = "DELETE FROM #__".$this->table." WHERE $field = '$id'";
			$this->DBO->query($query);
		}else {
			$query = "DELETE FROM #__".$this->table."";
			$this->DBO->query($query);
		}

	}

	function execute($query) {

		$result = $this->DBO->query($query);

		$this->initiateFields($result);

		if($this->DBO->numRows($result) > 0) {

			while($line = $this->DBO->FetchAssoc($result)) {
				$this->results[] = $this->stripQuotes($line);
			} 
			
			return $this->results;
		}else {return false;}
		

	}

	function setPagina($page,$limit = 2,$adjacents = 1) {

		/* $this->page['limit'] = $limit; */
		$this->page['adjacents'] = $adjacents;
		$this->page['current'] = (in_array($page, range(0, 10000)) ? $page : 10000000);

		if($this->page['current']) {
			$this->page['starting_number'] = ($this->page['current'] - 1) * $limit; 
		} else {
			$this->page['starting_number'] = 0;			
		}

	}

}

