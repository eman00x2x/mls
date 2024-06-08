<?php

namespace Library {
	class Database extends Configuration {

		var $query;
		var $link;
		var $error;

		function dbConnect() {

			// Get the main settings from the attributes
			$host 	= $this->db_host;
			$db 	= $this->db_name;
			$user 	= $this->db_user;
			$pass 	= $this->db_pass;

			$this->link = mysqli_connect($host, $user, $pass);

			// Connect to the database
			$this->selectDb($db);
			register_shutdown_function(array(&$this, 'close'));
			
			
			/* unset($this->db_host); */
			unset($this->db_name);
			unset($this->db_user);
			unset($this->db_pass);
			#unset($this->db_prefix);

		}

		function query($sql) {

			mysqli_query($this->link,"SET NAMES 'utf8'");
			mysqli_query($this->link,"SET CHARACTER SET 'utf8'");

			$this->query = $sql;
			$sql = str_replace('#_',$this->db_prefix,$sql);
			$result = mysqli_query($this->link,$sql) or die($this->dbError($this->error));
			
			return $result;
			
		}

		function fetchAssoc($result) {
			return mysqli_fetch_assoc($result);
		}

		function fetchArray($result, $resultType = MYSQL_NUM) {
			return mysqli_fetch_array($result, $resultType);
		}

		function queryUniqueValue($sql) {
			$result = $this->query($sql);
			$line = $this->fetchAssoc($result);
			return $line;
		}

		function fetchRow($result) {
			return mysqli_fetch_row($result);
		}

		function freeResult($result) {
			return mysqli_free_result($result);
		}

		function affectedRows() {
			return mysqli_affected_rows();
		}

		function numRows($result) {
			return mysqli_num_rows($result);
		}

		function selectDb($db_name) {
			return mysqli_select_db($this->link,$db_name);
		}

		function insertId() {
			return mysqli_insert_id($this->link);
		}

		function fetchFields($result) {
			return mysqli_fetch_fields($result);
		}

		function numFields($result) {
			return mysqli_num_fields($result);
		}

		function close() {
			mysqli_close($this->link);
		}

		function mysql_escape_string($string) {
			return mysqli_real_escape_string($this->link,$string);
		}

		function dbError($error) {
			$this->error = "<table cellpadding='3' cellspacing='1' style='font-size:12px;text-align:left;background-color:#000000;' align='center'>
				<tr><th colspan='2' style='color:#FF0000;background-color:#F5F5F5;'>Error</th></tr>
				<tr><td style='text-align:right;background-color:#F5F5F5;'>Query</td>
					<td style='text-align:right;background-color:#F5F5F5;'>".$this->query."</td></tr>
				<tr><td style='text-align:right;background-color:#F5F5F5;'>Error Message</td>
					<td style='text-align:left;background-color:#F5F5F5;'>".mysqli_error($this->link)."</td></tr>
			</table>";

			/* response()->httpCode(500);
			$this->error = json_encode([
				"message" => "The server is currently busy processing your initial request. Please try again. If the error persists, please contact the system administrator.",
				"email" => CONFIG['contact_info']['email']
			]); */

			return $this->error;
		}

	}
}
