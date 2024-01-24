<?php

namespace Admin\Application\Controller;

class InvoicesController extends \Main\Controller {

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
	}
	
	function index() {}
	
	function view($id) {}
	
	function add() {}
	
	function edit($id) {}
	
	function saveNew() {}
	
	function saveUpdate($id) {}
	
	function delete($id) {

		$invoice = $this->getModel("Invoice");
		$invoice->column['invoice_id'] = $id;
		$data['invoice'] = $invoice->getById();

		if($data) {
			if(isset($_REQUEST['delete'])) {
				$response = $invoice->deleteInvoice($id);

				$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);
				return json_encode(
					array(
						"status" => 1,
						"message" => getMsg()
					)
				);
			}

		}else {
			$this->getLibrary("Factory")->setMsg("Inovoice not found.","warning");
		}

		$this->setTemplate("invoices/delete.php");
		return $this->getTemplate($data);
	
	}
	
}