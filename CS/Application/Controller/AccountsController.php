<?php

namespace CS\Application\Controller;

class AccountsController extends \Admin\Application\Controller\AccountsController {

    function __construct() {
        parent::__construct();
		$this->setTempalteBasePath(ROOT."Admin");
	}
	
	function index() {
		
		if(isset($this->session['cs']['pin'])) {
			redirect(url("AccountsController@view", ["id" => $this->session['cs']['account_id']]));
		}

		return $this->pinLocked();
    }

	function view($account_id) {

		$this->doc->addScriptDeclaration("
			document.addEventListener('DOMContentLoaded', function() {
				document.querySelector('.btn-locked').addEventListener('click', function() {
					fetch('".url("AccountsController@lockedAccount")."')
						.then( () => {
							window.location = '".url("AccountsController@index")."';
						});
				});
			});
		");

		$pin = isset($this->session['cs']['pin']) ? $this->session['cs']['pin'] : 0;

		$account = $this->getModel("Account");
		$account->column['account_id'] = $account_id;
		$account->and(" pin = '".$pin."' AND account_type NOT IN('Administrator', 'Customer Service', 'Web Admin') ");
		$data = $account->getById();
		
		if($data) {
			return parent::view($account_id);
		}else {
			redirect(url("AccountsController@index"));
		}

	}

	function pinLocked() {

		$this->setTempalteBasePath(ROOT."CS");

		$this->doc->addScriptDeclaration("

			document.addEventListener('DOMContentLoaded', function() {
				var inputs = document.querySelectorAll('[data-code-input]');
				// Attach an event listener to each input element
				for(let i = 0; i < inputs.length; i++) {
					inputs[i].addEventListener('input', function(e) {
						// If the input field has a character, and there is a next input field, focus it
						if(e.target.value.length === e.target.maxLength && i + 1 < inputs.length) {
							inputs[i + 1].focus();
						}
					});
					inputs[i].addEventListener('keydown', function(e) {
						// If the input field is empty and the keyCode for Backspace (8) is detected, and there is a previous input field, focus it
						if(e.target.value.length === 0 && e.keyCode === 8 && i > 0) {
							inputs[i - 1].focus();
						}
					});
				}

				document.querySelector('.btn-unlock').addEventListener('click', function() {

					html = \"<div class='bg-white border mt-3 p-3 mb-3 alert d-flex gap-3'><div class='loader'></div> <p>Please wait while unlocking the account...</p></div>\";
					document.querySelector('.response').innerHTML = html;

					form = document.getElementById('form');
					formData = new FormData(form);

					fetch('".url("AccountsController@verifyPin")."',{
						method: 'POST', 
						body: new URLSearchParams(formData).toString(),
						headers: {
							'Content-type': 'application/x-www-form-urlencoded'
						}
					})
						.then( response => response.json() )
						.then( data => {
							if(data.status == 2) {
								document.querySelector('.response').innerHTML = data.message;
							}else {
								window.location = '".CS."accounts/' + data.account_id;
							}
						});
				});

			});

		");
		
		$this->setTemplate("accounts/pinLocked.php");
		return $this->getTemplate();

	}

	function verifyPin() {

		parse_str(file_get_contents('php://input'), $_POST);

		$pin = implode("", $_POST['pin']);

		$account = $this->getModel("Account");
		$account->column['pin'] = $pin;
		$account->and(" account_type NOT IN('Administrator', 'Customer Service', 'Web Admin') ");
		$data = $account->getByPin();

		if($data) {

			$_SESSION['user_logged']['cs']['pin'] = $pin;
			$_SESSION['user_logged']['cs']['account_id'] = $data['account_id'];

			$this->getLibrary("Factory")->setMsg("<br/>PIN accepted, unlocking account", "success");

			echo json_encode([
				"status" => 1,
				"account_id" => $data['account_id'],
				"message" => getMsg()
			]);
		}else {

			unset($_SESSION['user_logged']['cs']['pin']);
			unset($_SESSION['user_logged']['cs']['account_id']);

			$this->getLibrary("Factory")->setMsg("PIN invalid!", "error");

			echo json_encode([
				"status" => 2,
				"message" => getMsg()
			]);
		}

		exit();
	}

	function lockedAccount() {
		unset($_SESSION['user_logged']['cs']['pin']);
		unset($_SESSION['user_logged']['cs']['account_id']);
		exit();
	}

}