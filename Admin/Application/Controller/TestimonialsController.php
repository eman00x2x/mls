<?php

namespace Admin\Application\Controller;

class TestimonialsController extends \Main\Controller {

	public $doc;
	public $session;

	function __construct() {
		$this->setTempalteBasePath(ROOT."/Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");
	}

	function index($account_id = 1) {

		$this->doc->setTitle("Testimonials");

		if(isset($_REQUEST['search'])) {
			$filters[] = " (title LIKE '%".$_REQUEST['search']."%'))";
			$uri['search'] = $_REQUEST['search'];
		}

		$filters[] = "";

		$testimonials = $this->getModel("Testimonial");
		$testimonials->where(" account_id = $account_id ");
		$data = $testimonials->getList();

		$testimonials->page['limit'] = 20;
		$testimonials->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$testimonials->page['target'] = url("TestimonialsController@index");
		$testimonials->page['uri'] = (isset($uri) ? $uri : []);

		$this->setTemplate("testimonials/index.php");
		return $this->getTemplate($data);

	}

	function add($account_id = null) {

		$this->doc->setTitle("New Client Testimonials");

		$data['account_id'] = 1;

		if(!is_null($account_id)) {
			$account = $this->getModel("Account");
			$account->column['account_id'] = $account_id;
			$data = $account->getById();
		}
		
		$this->setTemplate("testimonials/add.php");
		return $this->getTemplate($data);

	}

	function edit($id, $account_id = 1) {

		$this->doc->setTitle("Update Client Testimonials");

		$testimonials = $this->getModel("Testimonial");
		$testimonials->column['testimonial_id'] = $id;
		$testimonials->where(" account_id = $account_id ");
		$data = $testimonials->getById();

		if($data) {
			$this->setTemplate("testimonials/edit.php");
			return $this->getTemplate($data);
		}

		$this->response(404);

	}

	function saveNew() {

		parse_str(file_get_contents('php://input'), $_POST);

		$_POST['created_at'] = DATE_NOW;

		$testimonials = $this->getModel("Testimonial");
		$response = $testimonials->saveNew($_POST);

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));

	}

	function saveUpdate($id) {
		
		parse_str(file_get_contents('php://input'), $_POST);

		$testimonials = $this->getModel("Testimonial");
		$response = $testimonials->save($id, $_POST);
		
		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));
		
	}

	function delete($id, $account_id = 1) {

		$testimonials = $this->getModel("Testimonial");
		$testimonials->column['testimonial_id'] = $id;
		$testimonials->where(" account_id = $account_id ");
		$data = $testimonials->getById();
		
		if($data) {

			if(isset($_REQUEST['delete'])) {

				$testimonials->deleteTestimonials($id);

				$this->getLibrary("Factory")->setMsg("Testimonial permanently deleted!","success");
				return json_encode(
					array(
						"status" => 1,
						"message" => getMsg()
					)
				);

			}

		}else {
			$this->getLibrary("Factory")->setMsg("Testimonial not found.","warning");
		}

		$this->setTemplate("testimonials/delete.php");
		return $this->getTemplate($data);

	}
}