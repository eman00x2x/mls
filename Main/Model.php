<?php

namespace Main;

class Model extends \Library\Table {

	function __construct() {

		/* $this->table_name = "login";
		$this->init(); */

		unset($this->db_host);
		unset($this->db_name);
		unset($this->db_user);
		unset($this->db_pass);
		unset($this->db_prefix);

	}

	function getValidator() {
		return \Library\Factory::getValidator();
	}

	function getTables() {

		$result = $this->DBO->query("SHOW TABLES");

		if($this->DBO->numRows($result) > 0) {
			while($line = $this->DBO->FetchAssoc($result)) {
				$data[] = $line;
			}
			return $data;
		}else {return false;}

	}

	function getPrimaryKey() {

		$query = "SHOW KEYS FROM #__".$this->table." WHERE Key_name = 'PRIMARY'";
		$line = $this->DBO->queryUniqueValue($query);

		return $line['Column_name'];

	}

}
