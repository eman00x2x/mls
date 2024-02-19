<?php

namespace Main\Model;

class ArticleModel extends \Main\Model {

	private $category = [
		"News", "Promo", "Tips", "Events"
	];

	function __construct() {
		$this->table = "articles";
		$this->primary_key = "article_id";
		$this->init();
	}

	function setCategory($new_category) {
		$this->category += $new_category;
		return $this->category;
	}

	function getCategory() {
		return $this->category;
	}

	function getByName() {
		$query = "SELECT ".($this->select == "" ? "*" : $this->select)." FROM #__articles WHERE name = '".$this->column['name']."' ".$this->and;
		$result = $this->DBO->query($query);

		$this->initiateFields($result);

		if($this->DBO->numRows($result) > 0) {
			$line = $this->DBO->fetchAssoc($result);
			return $this->stripQuotes($line);
		}else {return false;}
	}

	function saveNew($data) {

		$v = $this->getValidator();

		$v->validateGeneral($data['title'],"Title");
		$v->validateGeneral($data['content'],"Content");

		if($v->foundErrors()) {
			return array(
				"status" => 2,
				"type" => "error",
				"message" => "<h4 class='font-weight-bold'>Error</h4> * ".$v->listErrors('<br/> * ')
			);
		}else {

			if(isset($data['title'])) {
				$data['name'] = sanitize($data['title']);
			}

			foreach($data as $key => $val) {
				$this->column[$key] = $val;
			}

			$id = $this->insert();

			return array(
				"status" => 1,
				"type" => "success",
				"id" => $id,
				"message" => "Successfully saved"
			);

		}
	}

	function save($id,$data) {

		$this->column[$this->primary_key] = $id;

		if(($this->getById()) !== false) {

			$v = $this->getValidator();

			$v->validateGeneral($data['content'],"Content");

			if($v->foundErrors()) {
				return array(
					"status" => 2,
					"type" => "error",
					"message" => "Please correct the following: ".$v->listErrors(', ')
				);
			}else {

				foreach($data as $key => $val) {
					$this->column[$key] = $val;
				}

				$this->update();

				return array(
					"status" => 1,
					"type" => "success",
					"message" => "Successfully saved"
				);

			}
		}

	}

	function deleteArticle($id,$column = "article_id") {

		$this->delete($id,$column);

		return array(
			"status" => 1,
			"type" => "success",
			"message" => "Successfully Deleted"
		);

	}

}
