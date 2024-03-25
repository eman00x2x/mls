<?php

namespace Admin\Application\Controller;

class MessagesController extends \Main\Controller {

	public $doc;
	public $session;
	
	private $ws_client;
	private $websocketAddress = "ws://localhost:8980/mls/Manage/webSocketServer.php";

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();

		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");
	}
	
	function index() {

		$this->doc->setTitle("Messages");
		
		$deleted_thread = $this->getModel("DeletedThread");
		$deleted_thread->select(" GROUP_CONCAT(thread_id) as thread_ids ");
		$deleted_thread->column['account_id'] = $this->session['account_id'];
		$data['deletedThreads'] = $deleted_thread->getByAccountId();
		
		if(isset($_REQUEST['search'])) {
			$filters[] = " (subject LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}
		
		$filters[] = " JSON_CONTAINS(participants, '".$this->session['account_id']."', '$')";
		
		if($data['deletedThreads']['thread_ids']) {
			$filters[] = " thread_id NOT IN(".$data['deletedThreads']['thread_ids'].")";
		}

		if(isset($filters)) {
			$clause[] = implode(" AND ",$filters);
		}

		$thread = $this->getModel("Thread");
		$thread->where(isset($clause) ? implode("",$clause) : null)
		->orderBy(" created_at DESC ");

		$thread->page['limit'] = 20;
		$thread->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$thread->page['target'] = url("MessagesController@index");
		$thread->page['uri'] = (isset($uri) ? $uri : []);

		$data['threads'] = $thread->getList();
		
		if($data['threads']) {

			$messages_list = [];

			$account = $this->getModel("Account");
			$message = $this->getModel("Message");
			$user = $this->getModel("User");

			for($i=0; $i<count($data['threads']); $i++) {

				for($x=0; $x<count($data['threads'][$i]['participants']); $x++) {
					
					$account->select(" account_id, logo, CONCAT(JSON_UNQUOTE(JSON_EXTRACT(account_name, '$.firstname')),' ',JSON_UNQUOTE(JSON_EXTRACT(account_name, '$.lastname'))) as name, profession, message_keys ");
					$account->column['account_id'] = $data['threads'][$i]['participants'][$x];
					$accountData = $account->getById();

					if($accountData['account_id'] == $this->session['account_id']) {
						$a = $this->session['account_id'];
					}else {
						$a = "recipient";
					}

					$data['threads'][$i]['accounts'][ $a ] = $accountData;

				}

				$user->select(" account_id, user_id, photo, name, email ");
				$user->column['user_id'] = $data['threads'][$i]['created_by'];
				$data['threads'][$i]['created_by'] = $user->getById();

				$message->select(" message_id, thread_id, user_id, content, iv, created_at ");
				$data['threads'][$i]['last_message'] = $message->getLastMessage($data['threads'][$i]['thread_id']);

				if($data['threads'][$i]['last_message']) {
					$data['threads'][$i]['last_message']['user_message'] = $data['threads'][$i]['last_message']['content'];

					$user->column['user_id'] = $data['threads'][$i]['last_message']['user_id'];
					$data['threads'][$i]['last_message']['sender'] = $user->getById();
					$data['threads'][$i]['last_message']['publicKey'] = $data['threads'][$i]['accounts']['recipient']['message_keys']['publicKey'];
					$data['threads'][$i]['last_message']['privateKey'] = $data['threads'][$i]['accounts'][ $this->session['account_id'] ]['message_keys']['privateKey'];
					
					unset($data['threads'][$i]['last_message']['content']);
					unset($data['threads'][$i]['last_message']['user_id']);
					unset($data['threads'][$i]['accounts'][ $this->session['account_id'] ]['message_keys']);
					unset($data['threads'][$i]['accounts']['recipient']['message_keys']);
					unset($data['threads'][$i]['accounts'][ $data['threads'][$i]['last_message']['sender']['account_id'] ]['message_keys']);

					$messages_list[] = $data['threads'][$i]['last_message'];
				}

			}

			$last_messages = json_encode($messages_list);
			$this->doc->addScriptDeclaration("			const last_messages = $last_messages;");

		}

		$this->doc->addScript(CDN."js/encryption.js");
		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			( async => {
				for (let key in last_messages) {
					if (last_messages.hasOwnProperty(key)) {

						let thread_id = last_messages[key].thread_id;

						$('.last-message-container_' + thread_id).html(\"<img src='".CDN."images/loader.gif' /> decrypting... \");

						decrypt(last_messages[key], last_messages[key].publicKey, last_messages[key].privateKey)
						.then( response => {
							$('.last-message-container_' + thread_id).text( (response.message).substring(0, 47) + '...' );
						});
					}
				}
			})();
		"));
		

		$this->setTemplate("messages/messages.php");
		return $this->getTemplate($data,$thread);

	}

	function getThreadInfoByParticipants($participants) {

		/** should match each participants and vise-versa [1,4] OR [4,1] */

		$participants = json_decode($participants, true);

		if(!is_array($participants)) {
			$this->response(404);
		}

		if(count($participants) == 2) {
			$thread = $this->getModel("Thread");
			$thread->where(" (participants->>'$[0]' = ".$participants[0]." AND participants->>'$[1]' = ".$participants[1].") OR (participants->>'$[0]' = ".$participants[1]." AND participants->>'$[1]' = ".$participants[0].") ");
			$data = $thread->getList();

			return $data[0];
		}

		return false;

	}

	function conversation($participants) {

		$participants = base64_decode($participants);
		$thread = $this->getModel("Thread");
		$data['thread'] = $thread->getByParticipants($participants);

		$this->doc->addScript(CDN."js/chat-attachment-uploader.js");
		$this->doc->addScript(CDN."js/encryption.js");
		$this->chatScript();

		$this->doc->setTitle("Conversation");

		$unset_account_data = explode(",","account_type,preferences,privileges,uploads");
		$unset_user_data = explode(",","user_id,password,user_level,permissions,two_factor_authentication,two_factor_authentication_aps");

		try {
			
			$account = $this->getModel("Account");
			$participants = json_decode($participants, true);
			
			if(!is_array($participants)) {
				throw new \Exception('Invalid Participant ids');
			}

			foreach($participants as $participant_account_id) {
				$account->column['account_id'] = $participant_account_id;
				$data['participants'][$participant_account_id] = $account->getById();

				foreach($unset_account_data as $column) {
					unset($data['participants'][$participant_account_id][$column]);
				}
			}

		}catch (Exception $e) {
			$this->response(404);
		}

		$data['participants_id'] = $participants;

		if($data['thread']) {

			$message = $this->getModel("Message");
			$message->DBO->query("UPDATE #__messages SET is_read = 1 WHERE thread_id = ".$data['thread']['thread_id']." AND user_id != ".$this->session['user_id']."");

		}

		$this->setTemplate("messages/view.php");
		return $this->getTemplate($data);

		
	}

	function getKeys($participants) {

		$participants = base64_decode($participants);
		$account = $this->getModel("Account");
		$participants = json_decode($participants, true);

		foreach($participants as $participant_account_id) {
			$account->column['account_id'] = $participant_account_id;
			$data['participants'][$participant_account_id] = $account->getById();

			if($participant_account_id == $this->session['account_id']) {
				$privateKey = $data['participants'][$participant_account_id]['message_keys']['privateKey'];
			}else {
				$publicKey = $data['participants'][$participant_account_id]['message_keys']['publicKey'];
			}

		}

		echo json_encode([
			"publicKey" => $publicKey,
			"privateKey" => $privateKey
		]);

		exit();

	}

	function messageStream($participants, $lastMessageId = 0) {

		header('Content-Type: text/event-stream; charset=utf-8');
		header('Cache-Control: no-cache');

		$response = $this->messageCollections($participants, $lastMessageId);

		if($response['data']['messages']) {

			$count = count($response['data']['messages']);

			echo "data: " . json_encode($response) . "\n";
			echo "id: ".$response['data']['messages'][($count - 1)]['message_id']. "\n\n";
		}

		exit();

	}

	function getMessages($participants, $lastMessageId = 0) {

		$response = $this->messageCollections($participants, $lastMessageId);
		echo json_encode($response);
		exit();

	}

	private function messageCollections($participants, $lastMessageId = 0) {

		$thread = $this->getModel("Thread");
		$data['thread'] = $thread->getByParticipants(base64_decode($participants));

		if($data['thread']) {

			$message = $this->getModel("Message");
			
			if(isset($_REQUEST['age']) && $_REQUEST['age'] == "old") {
				$filter[] = " message_id < $lastMessageId ";
			}else {
				if($lastMessageId > 0) {
					$filter[] = " message_id > $lastMessageId ";
				}
			}

			$message->page['limit'] = 5;

			$filter[] = " thread_id = ".$data['thread']['thread_id'];

			$message->where( implode(" AND ", $filter) );

			$data['messages'] = $message->execute(" SELECT * 
				FROM (SELECT message_id, u.user_id, u.photo, u.name as user_name, content as user_message, m.created_at as user_sent_time, iv FROM #__messages m JOIN #__users u ON m.user_id=u.user_id ".$message->where." ORDER BY m.created_at DESC LIMIT 5) as sub 
				ORDER BY user_sent_time ASC
			");

			$account = $this->getModel("Account");
			$account->select("account_id, message_keys");
			$participants = json_decode(base64_decode($participants), true);

			$data['participants'] = [];

			foreach($participants as $participant_account_id) {
				$account->column['account_id'] = $participant_account_id;
				$response = $account->getById();
	
				if($participant_account_id == $this->session['account_id']) {
					$data['participants']['me']['keys']['privateKey'] = $response['message_keys']['privateKey'];
					$data['participants']['me']['keys']['publicKey'] = $response['message_keys']['publicKey'];
				}else {
					$data['participants']['you']['keys']['privateKey'] = $response['message_keys']['privateKey'];
					$data['participants']['you']['keys']['publicKey'] = $response['message_keys']['publicKey'];
				}

			}

			return [
				"status" => 1,
				"type" => "success",
				"thread_id" => $data['thread']['thread_id'],
				"data" => $data
			];
			
		}

		return false;

	}

	function saveNewMessage() {

		parse_str(file_get_contents('php://input'), $_POST);

		$thread = $this->getModel("Thread");
		$data['thread'] = $thread->getByParticipants($_POST['participants']);

		if($data['thread']) {
			$thread_id = $data['thread']['thread_id'];
		}else {
			$thread = $this->getModel("Thread");
            $response = $thread->saveNew(array(
				"participants" => $_POST['participants'],
				"created_by" => $this->session['user_id'],
				"created_at" => DATE_NOW
			));

			$thread_id = $response['id'];
			$data['thread']['participants'] = json_decode($_POST['participants']);
		}

		$message = $this->getModel("Message");
		
		$message_response = $message->saveNew([
			"user_id" => $this->session['user_id'],
			"thread_id" => $thread_id,
			"content" =>  $_POST['content'],
			"is_read" => 0,
			"iv" => $_POST['iv'],
			"created_at" => DATE_NOW
		]);

		if (($key = array_search($this->session['account_id'], $data['thread']['participants'])) !== false) {
			unset($data['thread']['participants'][$key]);
		}

		$recipient_account_id = implode("", $data['thread']['participants']);
		$notification = $this->getModel("Notification");
		$notification->saveNew(
			array(
				"account_id" => $recipient_account_id,
				"status" => 1,
				"created_at" => DATE_NOW,
				"content" => array(
					"title" => $this->session['name'],
					"message" => "Sent you a message",
					"url" => MANAGE."threads/".base64_encode($_POST['participants'])
				)
			)
		);

		echo json_encode([
			"status" => 1,
			"type" => "success",
			"id" => $message_response['id'],
			"thread_id" => $thread_id,
			"data" => [
				"thread_id" => $thread_id,
				"iv" => $_POST['iv'],
				"user_id" => $this->session['user_id'],
				"photo" => $this->session['photo'],
				"user_name" => $this->session['name'],
				"user_message" => $_POST['content'],
				"user_sent_time" => DATE_NOW
			]
		]);

		exit();
	}
	
	function saveDeletedThread($id) {
		
		if($id) {
			if(isset($_REQUEST['delete'])) {
				$thread = $this->getModel("Thread");
				$thread->save($id, array(
					"status" => 0
				));

				$deleted_thread = $this->getModel("DeletedThread");
				$response = $deleted_thread->saveNew(array(
					"account_id" => $this->session['account_id'],
					"user_id" => $this->session['user_id'],
					"thread_id" => $id,
					"deleted_by" => $this->session['name'],
					"deleted_at" => DATE_NOW
				));

				$data['id'] = $response['id'];

				$this->getLibrary("Factory")->setMsg("Message deleted!.","success");
				return json_encode(
					array(
						"status" => 1,
						"message" => getMsg()
					)
				);

			}else {
				$data['id'] = $id;
				$this->setTemplate("messages/removeThread.php");
				return $this->getTemplate($data);
			}
		}

		$this->response(404);
		
	}

	function downloadThreadMessages($id) {

		$this->doc->setTitle("Download Thread Scripts");

		$thread = $this->getModel("Thread");
		$thread->column['thread_id'] = $id;
		$data['thread'] = $thread->getById();

		if($data['thread']) {

			$messages_list = [];

			$account = $this->getModel("Account");
			$message = $this->getModel("Message");
			$user = $this->getModel("User");

			for($x=0; $x<count($data['thread']['participants']); $x++) {
				
				$account->select(" account_id, logo, CONCAT(firstname,' ',lastname) as name, profession, message_keys ");
				$account->column['account_id'] = $data['thread']['participants'][$x];
				$accountData = $account->getById();

				if($accountData['account_id'] == $this->session['account_id']) {
					$a = $this->session['account_id'];
				}else {
					$a = "recipient";
				}

				$data['thread']['accounts'][ $a ] = $accountData;

			}

			$data['thread']['publicKey'] = $data['thread']['accounts']['recipient']['message_keys']['publicKey'];
			$data['thread']['privateKey'] = $data['thread']['accounts'][ $this->session['account_id'] ]['message_keys']['privateKey'];

			$user->select(" photo, name, email ");
			$user->column['user_id'] = $data['thread']['created_by'];
			$data['thread']['created_by'] = $user->getById();

			$message->page['limit'] = 1000000;
			$message->select(" message_id, user_id, content, iv, created_at ");
			$data['thread']['messages'] = $message->getList();

			if($data['thread']['messages']) {

				for($i=0; $i<count($data['thread']['messages']); $i++) {
					$data['thread']['messages'][$i]['user_message'] = $data['thread']['messages'][$i]['content'];
					$user->column['user_id'] = $data['thread']['messages'][$i]['user_id'];
					$data['thread']['messages'][$i]['sender'] = $user->getById();

				}

				$messages = json_encode($data['thread']['messages']);

				$this->doc->addScriptDeclaration("
					const messages = $messages;
					const publicKey = JSON.parse('".json_encode($data['thread']['publicKey'])."');
					const privateKey = JSON.parse('".json_encode($data['thread']['privateKey'])."');
				");

				$this->doc->addScript(CDN."js/encryption.js");
				$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
					( async => {
						decryptThreadMessages()
						.then(() => {
							$('#encrypted_messages').val( btoa($('.downloadable-content-container').text()) );
							$('.btn-save').removeClass('d-none');
						});
					})();

					async function decryptThreadMessages() {
						for (let key in messages) {
							if (messages.hasOwnProperty(key)) {

								let message_id = messages[key].message_id;

								$('.message-container-' + message_id).html(\"<img src='".CDN."images/loader.gif' /> decrypting... \");

								await decrypt(messages[key], publicKey, privateKey)
								.then( response => {
									let text = '';

									text += response.message;

									if(response.info.length > 0) {
										for(let i = 0; i < response.info.length; i++) {
											text += ' ' + response.info[i] + ' ';
										}
									}

									$('.message-container-' + message_id).text( text );
								});
							}
						}
					}
				"));
			
			}


			$this->setTemplate("messages/download.php");
			return $this->getTemplate($data);

		}

		$this->response(404);

	}

	function createDownloadFile() {

		if(isset($_POST['encrypted_messages'])) {

			$messages = base64_decode($_POST['encrypted_messages']);
			$thread_id = $_POST['thread_id'];
			$created_at = $_POST['created_at'];

			$local_path = "../Cdn/public/threads/";
			$files = glob($local_path.'*'); // get all file names
			foreach($files as $file){ // iterate files
				if(is_file($file)) {
					unlink($file); // delete file
				}
			}

			$filename = "mls_thread_messages_".$thread_id."".date("Ymd",$created_at).".txt";
			$file_url = CDN."public/threads/$filename";

			$handle = fopen("../Cdn/public/threads/".$filename, "w");
			fwrite($handle, str_replace("** ","\n", $messages));
			fclose($handle);

			$this->getLibrary("Factory")->setMsg("Your Thread Script is ready to download. <a href='".url("MessagesController@downloadMessages", null, ["url" => $file_url])."'>Click here to download</a>", "success");

			return json_encode([
				"status" => 1,
				"message" => getMsg()
			]);

		}

	}

	function downloadMessages() {

		$url = $_GET['url'];
		$filename = basename($url);
		$local_path = "../Cdn/public/threads/";

		header("Content-Description: File Transfer");
		header('Content-Type: application/octet-stream');
		header("Content-disposition: attachment; filename=\"" . $filename . "\""); 
		header('Expires: 0');
    	header('Cache-Control: must-revalidate');
    	header('Pragma: public');
		header("Content-length: ".filesize($local_path."/".$filename));

		readfile($url); 
		exit();

	}

	function uploadAttachment() {

		if(!isset($_FILES) || empty($_FILES['ImageBrowse'])) {
			$this->getLibrary("Factory")->setMsg("There was an error uploading your file. Only images and pdf's less than 5MB file sizes are allowed, Please check your file before uploading.","error");
			return json_encode([
				"status" => 2,
				"message" => getMsg()
            ]);
		}

		$message = $this->getModel("Message");
		return $message->uploadAttachment($_FILES['ImageBrowse']);
	}

	function removeAttachment($filename) {
		$message = $this->getModel("Message");
		return $message->removeAttachment($filename);
	}

	function scrapeUrl() {

		header("Content-type: text/html; charset=utf-8");

		parse_str(file_get_contents('php://input'), $_POST);

			// Extract HTML using curl
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $_POST["url"]);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			
			$data = curl_exec($ch);
			curl_close($ch);

			if($data) {

				$url = trim(parse_url($_POST["url"], PHP_URL_SCHEME).'://'.parse_url($_POST["url"], PHP_URL_HOST), '/');

				// Load HTML to DOM Object
				$dom = new \DOMDocument();
				@$dom->loadHTML($data);
				
				$docs_info = [];
				
				// Parse DOM to get Title
				$nodes = $dom->getElementsByTagName('title');

				$string = $nodes->item(0)->nodeValue;
				$docs_info['title'] = htmlentities(utf8_decode($string));

				// Parse DOM to get Meta Description
				$metas = $dom->getElementsByTagName('meta');
				
				for ($i = 0; $i < $metas->length; $i ++) {
					$meta = $metas->item($i);
					if ($meta->getAttribute('name') == 'description') {
						$docs_info['description'] = htmlentities(utf8_decode($meta->getAttribute('content')));
					}else if($meta->getAttribute('property') == 'og:image') {
						$docs_info['image'] = $meta->getAttribute('content');
					}else if($meta->getAttribute('itemprop') == 'image') {
						$docs_info['image'] = $meta->getAttribute('content');
					}
				}

				if(isset($docs_info['image'])) {
					if(filter_var($docs_info['image'], FILTER_VALIDATE_URL) === false) {
						$docs_info['image'] = $url.'/'.$docs_info['image'];
					}
				}

				if(!isset($docs_info['image'])) {
					$xpath = new \DOMXPath($dom);    
					$images = $xpath->query ('//img/@src');
					$img = [];
					foreach ( $images as $image) {

						$src = trim($image->nodeValue, '/');
						$docs_info['image'] = $src;

						if(filter_var($src, FILTER_VALIDATE_URL) === false) {
							$docs_info['image'] = $url.'/'.$src;
						}

						
						break;
					}
				}

				echo json_encode($docs_info);
			}else { echo json_encode([]); }

		exit();

	}

	function webSocketChatScript() {

		/** 
		 * Run the websocket server first before using this
		 * webSocketServer.php
		 * 
		 * */

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

			$(document).ready(function() {

				thread_id = parseInt($('#thread_id').val());
				participants = $('#participants').val();
				
				websocket.onopen = function(ev) { // connection is open 
					console.log(' Server Open ');
				}

				websocket.onmessage = function(event) {
					var response	= JSON.parse(event.data);

					collections = {
						'data': {
							'messages': [
								response.data
							]
						}
					};

					if(thread_id == collections.data.messages[0].thread_id) {
						prepareMessages()
							.then( () => { 
								showMessages() ;
								scrollToBottom('.card-body');
								refreshFsLightbox();
							}); 
					}

				};

				websocket.onerror	= function(ev) {
					console.log('Error Occurred - ' + ev.data);
					$('#serverErrorModal').show({
						backdrop: 'static',
						keyboard: false
					});
				};

				websocket.onclose 	= function(ev) {
					console.log('Connection Closed');
					$('#serverErrorModal').show({
						backdrop: 'static',
						keyboard: false
					});
				};

				getLatestMessages();

			});

		"));

	}

	function ajaxChatScript() {

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

			let listenToServer = function() {
				
				eventSource = new EventSource(MANAGE + 'message/stream/' + btoa(participants) + '/0');
				eventSource.addEventListener('message', function(event) {

					collections = JSON.parse(event.data);
					count = collections.data.messages.length;
					collectionLastMessageId = collections.data.messages[ (count - 1) ].message_id;

					if(collectionLastMessageId > lastMessageId) {
						prepareMessages()
						.then( () => { 
							showMessages();
							refreshFsLightbox();
							scrollToBottom('.card-body');
						});
					}

				});
				
			}, eventSource;

			$(document).ready(function() {
				
				div = $('.card-body');
				thread_id = parseInt($('#thread_id').val());
				participants = $('#participants').val();

				getLatestMessages()
					.then( () => {
						setTimeout( (() => {
							listenToServer();
						}), 1000);
						scrollToBottom('.card-body');
					});


				$('.scrollable').on( 'scroll', function() {
					let scrollTop = $(this).scrollTop();
					if (scrollTop + $(this).innerHeight() >= this.scrollHeight) {
						
					}else if(scrollTop <= 0) {
						/* scroll reaced the top position */
						getOldestMessages();
					}else {
						/* do nothing while scrolling */
					}
				});

			});

		"));

	}

	function chatScript() {

		if(CONFIG['chat_is_websocket'] == 1) {
			$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			const wsUri = '".$this->websocketAddress."?name=" . (str_replace(" ","+",$this->session['name'])) ."';
			const websocket = new WebSocket(wsUri);"));
		}

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			const user_id = ".$this->session['user_id'].";
			const is_websocket = ".CONFIG['chat_is_websocket'].";

			const scrollToBottom = (id) => {
				const element = document.querySelector(id);
				element.scrollTop = element.scrollHeight;
			};

			let div;
			let thread_id;
			let participants;
			let lastMessageId = 0;
			let firstMessageId = 0;

			/* data fetch from the server  */
			let collections;
			
			/* decrypted messages  */
			let messages = [];

			/* text link from decrypted messages */
			let links = [];

			/* messages to transform */
			let messageToTransform = [];

			let privateKey;
			let publicKey;

		"));

		if(CONFIG['chat_is_websocket'] == 1) {
			$this->webSocketChatScript();
		}else {
			$this->ajaxChatScript();
		}

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

			$(document).on('click', '.btn-send-message', function() { sendMessage(); });
			$( document ).on( 'keydown', '#message', function( e ) { if(e.which == 13){ $('.btn-send-message').trigger('click'); } });

			function getOldestMessages() {
				loadMessages( firstMessageId )
				.then( () => {  prepareMessages( 'old' )
					.then( () => { showMessages( 'old' ); refreshFsLightbox(); }); 
				});
			}

			async function getLatestMessages() {

				loadMessages( lastMessageId )
				.then( () => {  prepareMessages()
					.then( () => { showMessages(); refreshFsLightbox(); }); 
				});

				
			}

			function showMessages( message_age = 'new' ) {

				for (let key in messages) {
					if (messages.hasOwnProperty(key)) { 

						if(message_age == 'old') {
							$('.chat-bubbles').prepend(buildMessage(messages[key]));
						}else {
							$('.chat-bubbles').append(buildMessage(messages[key]));
						}
					}
				}

				messages = [];
				links = [];
				getUrlInfo();

			}

			async function prepareMessages( message_age = 'new' ) {

				let last_id = 0;
				let count = (collections.data.messages).length;

				if(count > 0) {

					firstMessageId = collections.data.messages[0].message_id;
					$('#first_message_id').val(firstMessageId);

					last_id = collections.data.messages[ (count - 1) ].message_id;
					if(last_id > lastMessageId) {
						lastMessageId = last_id;
						$('#last_message_id').val(lastMessageId);
					}

					if(message_age == 'old') {
						(collections.data.messages).reverse();
					}

					await decryptMessages(collections.data);

					collections = {};
				}

			}

			async function loadMessages(messageId) {

				let uri = '';
				if(messageId == firstMessageId) {
					uri = '?age=old';

					$('.chat-bubbles').prepend(\"<div class='message-loader-container text-center'><img src='".CDN."images/loader.gif' /></div>\");
				}

				collections = await fetch(MANAGE + 'threads/' + btoa(participants) + '/getMessages/' + messageId + uri)
					.then(response => response.json())
					.then(data => {
						$('.message-loader-container').remove();
						return data;
					});

			}

			function sendMessage() {

				const formData = new FormData();
				
				let type = $('#type').val();
				let message = $('#message').val();

				$('#message').prop('disabled', true);

				if((type == 'text' && message != '') || (type == 'image') || (type == 'pdf')) {

					$('.btn-send').removeClass('btn-send-message');

					if($(\"input[name='info[links][]']\") !== undefined) {
						$(\"input[name='info[links][]']\").each(function() {
							links.push($(this).val());
						});
					}

					textContainedLinks(message);

					if (Array.isArray(links) || links.length) {
						formData.append('info', links);
					}

					formData.append('participants', participants);

					fetch(MANAGE + 'threads/getKeys/' + btoa(participants))
						.then(response => {
							return response.json();
						}) .then(data => {

							publicKey = data.publicKey;
							privateKey = data.privateKey;

							encrypt(JSON.stringify({
								'type': type,
								'message': censore(message),
								'info': links
							}), publicKey, privateKey).then(
								data => {

									formData.append('content', data.encrypted);
									formData.append('iv', data.iv);

									fetch('".url("MessagesController@saveNewMessage")."', { 
										method: 'POST', 
										body: new URLSearchParams(formData).toString(),
										headers: {
											'Content-type': 'application/x-www-form-urlencoded'
										}  
									})
										.then(response => response.json())
											.then(response => {

												if(is_websocket == 1) {
													websocket.send(JSON.stringify(response));
												}else {
													decrypt(response.data, publicKey, privateKey)
													.then(data => {

														response.data.user_message = data;
														$('.chat-bubbles').append(buildMessage(response.data));
														
														links = [];
														getUrlInfo();

														refreshFsLightbox();
														scrollToBottom('.card-body');

													});
												}

												$('#message').val('');

												$('#thread_id').val(response.data['thread_id']);
												thread_id = response.data['thread_id'];

												$('.last_message_id').val(response.id);
												lastMessageId = response.id;

												$('#message').prop('disabled', false);
												$('.btn-send').addClass('btn-send-message');
												
											});

								}
							);
						});
				}

			}

			async function decryptMessages(data) {

				if(data !== false) {
				
					const message_data = data.messages;
					let count = Object.keys(message_data).length;

					if(count > 0) {

						for (let key in message_data) {
							if (message_data.hasOwnProperty(key)) {

								if(publicKey == undefined && privateKey == undefined) {
									if(user_id == message_data[key].user_id) {
										publicKey = data.participants.you.keys.publicKey;
										privateKey = data.participants.me.keys.privateKey;
									}else {
										publicKey = data.participants.me.keys.publicKey;
										privateKey = data.participants.you.keys.privateKey;
									}
								}

								await decrypt(message_data[key], publicKey, privateKey)
								.then( message => {
									messages.push({
										user_id: message_data[key].user_id,
										photo: message_data[key].photo,
										user_name: message_data[key].user_name,
										user_message: message,
										user_sent_time: message_data[key].user_sent_time
									});
								});

							}
						}

					}

				}

			}

			function buildMessage(response) {

				const time = timeSince(response.user_sent_time);

				if(response.user_id == user_id) {

					html = \"<div class='row align-items-end justify-content-end '>\";
						html += \"<div class='col col-lg-8'>\";
							html += \"<div class='chat-bubble chat-bubble-me'>\";
								
								html += \"<div class='chat-bubble-title'>\";
									html += \"<div class='chat-bubble-author'>\";
										html += response.user_name;
									html += \"</div>\";
								html += \"</div>\";
								html += \"<div class='chat-bubble-body'>\";
									html += formatMessage(response.user_message);
								html += \"</div>\";
							html += \"</div>\";

						html += \"</div>\";
						html += \"<div class='col-auto'>\";
							html += \"<span class='avatar' style='background-image: url(\"+response.photo+\")'></span>\";
						html += \"</div>\";
					html += \"</div>\";

					html += \"<div class='text-end' style='margin-top: -0.9rem; margin-right: 3.5rem;'>\";
						html += \"<span class='text-muted fs-11'>\";
							html += time;
						html += \"</span>\";
					html += \"</div>\";
	
				}else {

					html = \"<div class='row align-items-end'>\";
						html += \"<div class='col-auto'>\";
							html += \"<span class='avatar' style='background-image: url(\"+response.photo+\")'></span>\";
						html += \"</div>\";
						html += \"<div class='col col-lg-8'>\";
							html += \"<div class='chat-bubble'>\";
								
								html += \"<div class='chat-bubble-title'>\";
									html += \"<div class='chat-bubble-author'>\";
										html += response.user_name;
									html += \"</div>\";
								html += \"</div>\";
								html += \"<div class='chat-bubble-body'>\";
									html += formatMessage(response.user_message);
								html += \"</div>\";
							html += \"</div>\";
						html += \"</div>\";
					html += \"</div>\";

					html += \"<div class='text-start' style='margin-top: -0.9rem; margin-left: 3.5rem;'>\";
						html += \"<span class='text-muted fs-11'>\";
							html += time;
						html += \"</span>\";
					html += \"</div>\";

				}

				return html;
			}

			function formatMessage(data) {

				let html = '';

				if(data.type == 'image') {

					const image_info = data.info;
					const total_size = image_info.length;
					let column;

					if(total_size == 1) {
						column = 12;
					}else {
						column = 6;
					}

					html += \"<div class=''>\";
						html += \"<div class='row'>\";
							for (let key in image_info) {
								if (image_info.hasOwnProperty(key)) {
									html += \"<div class='col-md-\" + column + \" mb-2'>\";
										html += \"<a data-fslightbox='gallery' href='\" + image_info[key] + \"'>\";
											html += \"<img src='\" + image_info[key] + \"' class='img-fluid' />\";
										html += \"</a>\";
									html += \"</div>\";
								}
							}
						html += \"</div>\";
					html += \"</div>\";

					return html;
				}

				if(data.type == 'text') {

					const link_info = data.info;

					if(link_info.length > 0) {
						for (let key in link_info) {
							if (link_info.hasOwnProperty(key)) {

								const d = new Date();
								let time = d.getTime();
								let container = Math.floor(Math.random() * 10000) * (new Date().getTime());

								messageToTransform.push({
									container: container,
									link: link_info[key]
								});

								html += \"<a class='text-decoration-none' style='color: inherit' href='\" + link_info[key] + \"' target='_blank'>\";
									html += \"<div class='link_container wrapper_\" + container + \"'>\";
										html += \"<div class='link-media w-100'></div> \";
										html += \"<div class='my-2'>\";
											html += \"<span class='link-title d-block fw-bold fs-14'></span>\";
											html += \"<span class='link-url fst-italic fs-12'></span>\";
										html += \"</div>\";
									html += \"</div>\";
								html += \"</a>\";
								

							}
						}
					}

					html += '<p>' + textContainedLinks(data.message) + '</p>';
					return html;
				}

				if(data.type == 'pdf') {
					filename = data.info[0].replace(/^.*[\\/]/, '');
					
					html += \"<div class='border rounded p-2 bg-white'>\";
						html += \"<a href='\" + data.info[0] + \"' target='_blank' class='text-decoration-none text-inherit'>\";
							html += \"<div class='d-flex gap-2'>\";
								html += \"<div class='avatar avatar-xl'>\";
									html += \"<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-file-type-pdf' width='100' height='100' viewBox='0 0 24 24' stroke-width='1.5' stroke='#597e8d' fill='none' stroke-linecap='round' stroke-linejoin='round'>\";
										html += \"<path stroke='none' d='M0 0h24v24H0z' fill='none'/>\";
										html += \"<path d='M14 3v4a1 1 0 0 0 1 1h4' />\";
										html += \"<path d='M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4' />\";
										html += \"<path d='M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6' />\";
										html += \"<path d='M17 18h2' />\";
										html += \"<path d='M20 15h-3v6' />\";
										html += \"<path d='M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z' />\";
									html += \"</svg>\";
								html += \"</div>\";
								html += \"<div class='lh-2 overflow-hidden'>\";
									html += \"<div class='overflow-hidden text-dark'>\";
										html += filename;
									html += \"</div>\";
								html += \"</div>\";
							html += \"</div>\";
						html += \"</a>\";
					html += \"</div>\";

					return html;

				}

			}

			function getUrlInfo() {
				
				if(messageToTransform.length > 0) { 

					const formData = new FormData();
					const urls = messageToTransform.reverse();

					messageToTransform = [];

					for(let i = 0; i < urls.length; i++) {

						formData.append('url', urls[i].link);

						fetch('".url("MessagesController@scrapeUrl")."', { 
								method: 'POST', 
								body: new URLSearchParams(formData).toString(),
								headers: {
									'Content-type': 'application/x-www-form-urlencoded'
								}  
							})
						.then( response => response.json() )
						.then( data => {

							container = urls[i].container;

							if(data != '') { 
								if(data.image != undefined) {
									$('.wrapper_' + container + ' .link-media').addClass('avatar');
									$('.wrapper_' + container + ' .link-media').css({
										'height': '200px',
										'background-image': 'url(' + data.image + ')'
									});
								}
								
								$('.wrapper_' + container + ' .link-title').text(data.title);

								if(data.description != undefined) {
									$('.wrapper_' + container + ' .link-url').text(data.description);
								}else {
									$('.wrapper_' + container + ' .link-url').text( urls[i].link );
								}

								$('.wrapper_' + container).addClass('p-2');

								/* scrollToBottom('.card-body'); */
							}

						});

					}

				}

			}

			function textContainedLinks(text) {
				
				var urlRegex = /((?:(http|https|Http|Https|rtsp|Rtsp):\/\/(?:(?:[a-zA-Z0-9\$\-\_\.\+\!\*\'\(\)\,\;\?\&\=]|(?:\%[a-fA-F0-9]{2})){1,64}(?:\:(?:[a-zA-Z0-9\$\-\_\.\+\!\*\'\(\)\,\;\?\&\=]|(?:\%[a-fA-F0-9]{2})){1,25})?\@)?)?((?:(?:[a-zA-Z0-9][a-zA-Z0-9\-]{0,64}\.)+(?:(?:aero|arpa|asia|a[cdefgilmnoqrstuwxz])|(?:biz|b[abdefghijmnorstvwyz])|(?:cat|com|coop|c[acdfghiklmnoruvxyz])|d[ejkmoz]|(?:edu|e[cegrstu])|f[ijkmor]|(?:gov|g[abdefghilmnpqrstuwy])|h[kmnrtu]|(?:info|int|i[delmnoqrst])|(?:jobs|j[emop])|k[eghimnrwyz]|l[abcikrstuvy]|(?:mil|mobi|museum|m[acdghklmnopqrstuvwxyz])|(?:name|net|n[acefgilopruz])|(?:org|om)|(?:pro|p[aefghklmnrstwy])|qa|r[eouw]|s[abcdeghijklmnortuvyz]|(?:tel|travel|t[cdfghjklmnoprtvwz])|u[agkmsyz]|v[aceginu]|w[fs]|y[etu]|z[amw]))|(?:(?:25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[1-9][0-9]|[1-9])\.(?:25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[1-9][0-9]|[1-9]|0)\.(?:25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[1-9][0-9]|[1-9]|0)\.(?:25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[1-9][0-9]|[0-9])))(?:\:\d{1,5})?)(\/(?:(?:[a-zA-Z0-9\;\/\?\:\@\&\=\#\~\-\.\+\!\*\'\(\)\,\_])|(?:\%[a-fA-F0-9]{2}))*)?(?:\b|$)/gi;
				return text.replace(urlRegex, function(url) {
					links.push(url);
					return \"<a target='_blank' href='\" + url + \"'>\" + url + \"</a>\";
				});

			}

			function censore(string) {

				var badWords = [
					/* english words */
					'4r5e', '5h1t', '5hit', 'a55', 'anal', 'anus', 'ar5e', 'arrse', 'arse', 'ass', 'ass-fucker', 'asses', 'assfucker', 'assfukka', 'asshole', 'assholes', 'asswhole', 'a_s_s', 'b!tch', 'b00bs', 'b17ch', 'b1tch', 'ballbag', 'balls', 'ballsack', 'bastard', 'beastial', 'beastiality', 'bellend', 'bestial', 'bestiality', 'bi+ch', 'biatch', 'bitch', 'bitcher', 'bitchers', 'bitches', 'bitchin', 'bitching', 'bloody', 'blow job', 'blowjob', 'blowjobs', 'boiolas', 'bollock', 'bollok', 'boner', 'boob', 'boobs', 'booobs', 'boooobs', 'booooobs', 'booooooobs', 'breasts', 'buceta', 'bugger', 'bum', 'bunny fucker', 'butt', 'butthole', 'buttmuch', 'buttplug', 'c0ck', 'c0cksucker', 'carpet muncher', 'cawk', 'chink', 'cipa', 'cl1t', 'clit', 'clitoris', 'clits', 'cnut', 'cock', 'cock-sucker', 'cockface', 'cockhead', 'cockmunch', 'cockmuncher', 'cocks', 'cocksuck', 'cocksucked', 'cocksucker', 'cocksucking', 'cocksucks', 'cocksuka', 'cocksukka', 'cok', 'cokmuncher', 'coksucka', 'coon', 'cox', 'crap', 'cum', 'cummer', 'cumming', 'cums', 'cumshot', 'cunilingus', 'cunillingus', 'cunnilingus', 'cunt', 'cuntlick', 'cuntlicker', 'cuntlicking', 'cunts', 'cyalis', 'cyberfuc', 'cyberfuck', 'cyberfucked', 'cyberfucker', 'cyberfuckers', 'cyberfucking', 'd1ck', 'damn', 'dick', 'dickhead', 'dildo', 'dildos', 'dink', 'dinks', 'dirsa', 'dlck', 'dog-fucker', 'doggin', 'dogging', 'donkeyribber', 'doosh', 'duche', 'dyke', 'ejaculate', 'ejaculated', 'ejaculates', 'ejaculating', 'ejaculatings', 'ejaculation', 'ejakulate', 'f u c k', 'f u c k e r', 'f4nny', 'fag', 'fagging', 'faggitt', 'faggot', 'faggs', 'fagot', 'fagots', 'fags', 'fanny', 'fannyflaps', 'fannyfucker', 'fanyy', 'fatass', 'fcuk', 'fcuker', 'fcuking', 'feck', 'fecker', 'felching', 'fellate', 'fellatio', 'fingerfuck', 'fingerfucked', 'fingerfucker', 'fingerfuckers', 'fingerfucking', 'fingerfucks', 'fistfuck', 'fistfucked', 'fistfucker', 'fistfuckers', 'fistfucking', 'fistfuckings', 'fistfucks', 'flange', 'fook', 'fooker', 'fuck', 'fucka', 'fucked', 'fucker', 'fuckers', 'fuckhead', 'fuckheads', 'fuckin', 'fucking', 'fuckings', 'fuckingshitmotherfucker', 'fuckme', 'fucks', 'fuckwhit', 'fuckwit', 'fudge packer', 'fudgepacker', 'fuk', 'fuker', 'fukker', 'fukkin', 'fuks', 'fukwhit', 'fukwit', 'fux', 'fux0r', 'f_u_c_k', 'gangbang', 'gangbanged', 'gangbangs', 'gaylord', 'gaysex', 'goatse', 'God', 'god-dam', 'god-damned', 'goddamn', 'goddamned', 'hardcoresex', 'hell', 'heshe', 'hoar', 'hoare', 'hoer', 'homo', 'hore', 'horniest', 'horny', 'hotsex', 'jack-off', 'jackoff', 'jap', 'jerk-off', 'jism', 'jiz', 'jizm', 'jizz', 'kawk', 'knob', 'knobead', 'knobed', 'knobend', 'knobhead', 'knobjocky', 'knobjokey', 'kock', 'kondum', 'kondums', 'kum', 'kummer', 'kumming', 'kums', 'kunilingus', 'l3i+ch', 'l3itch', 'labia', 'lust', 'lusting', 'm0f0', 'm0fo', 'm45terbate', 'ma5terb8', 'ma5terbate', 'masochist', 'master-bate', 'masterb8', 'masterbat*', 'masterbat3', 'masterbate', 'masterbation', 'masterbations', 'masturbate', 'mo-fo', 'mof0', 'mofo', 'mothafuck', 'mothafucka', 'mothafuckas', 'mothafuckaz', 'mothafucked', 'mothafucker', 'mothafuckers', 'mothafuckin', 'mothafucking', 'mothafuckings', 'mothafucks', 'mother fucker', 'motherfuck', 'motherfucked', 'motherfucker', 'motherfuckers', 'motherfuckin', 'motherfucking', 'motherfuckings', 'motherfuckka', 'motherfucks', 'muff', 'mutha', 'muthafecker', 'muthafuckker', 'muther', 'mutherfucker', 'n1gga', 'n1gger', 'nazi', 'nigg3r', 'nigg4h', 'nigga', 'niggah', 'niggas', 'niggaz', 'nigger', 'niggers', 'nob', 'nob jokey', 'nobhead', 'nobjocky', 'nobjokey', 'numbnuts', 'nutsack', 'orgasim', 'orgasims', 'orgasm', 'orgasms', 'p0rn', 'pawn', 'pecker', 'penis', 'penisfucker', 'phonesex', 'phuck', 'phuk', 'phuked', 'phuking', 'phukked', 'phukking', 'phuks', 'phuq', 'pigfucker', 'pimpis', 'piss', 'pissed', 'pisser', 'pissers', 'pisses', 'pissflaps', 'pissin', 'pissing', 'pissoff', 'poop', 'porn', 'porno', 'pornography', 'pornos', 'prick', 'pricks', 'pron', 'pube', 'pusse', 'pussi', 'pussies', 'pussy', 'pussys', 'rectum', 'retard', 'rimjaw', 'rimming', 's hit', 's.o.b.', 'sadist', 'schlong', 'screwing', 'scroat', 'scrote', 'scrotum', 'semen', 'sex', 'sh!+', 'sh!t', 'sh1t', 'shag', 'shagger', 'shaggin', 'shagging', 'shemale', 'shi+', 'shit', 'shitdick', 'shite', 'shited', 'shitey', 'shitfuck', 'shitfull', 'shithead', 'shiting', 'shitings', 'shits', 'shitted', 'shitter', 'shitters', 'shitting', 'shittings', 'shitty', 'skank', 'slut', 'sluts', 'smegma', 'smut', 'snatch', 'son-of-a-bitch', 'spac', 'spunk', 's_h_i_t', 't1tt1e5', 't1tties', 'teets', 'teez', 'testical', 'testicle', 'tit', 'titfuck', 'tits', 'titt', 'tittie5', 'tittiefucker', 'titties', 'tittyfuck', 'tittywank', 'titwank', 'tosser', 'turd', 'tw4t', 'twat', 'twathead', 'twatty', 'twunt', 'twunter', 'v14gra', 'v1gra', 'vagina', 'viagra', 'vulva', 'w00se', 'wang', 'wank', 'wanker', 'wanky', 'whoar', 'whore', 'willies', 'willy', 'xrated', 'xxx',
					/* tagalog words */
					'amputa','animal ka','bilat','binibrocha','bobo','bogo','boto','brocha','tangi','tang ina','ina mo','burat','bwesit','bwisit','demonyo ka','engot','etits','gaga','gagi','gago','habal','hayop ka','hayup','hinampak','hinayupak','hindot','hindutan','hudas','iniyot','inutel','inutil','iyot','kagaguhan','kagang','kantot','kantotan','kantut','kantutan','kaululan','kayat','kiki','kikinginamo','kingina','kupal','leche','leching','lechugas','lintik','nakakaburat','nimal','ogag','olok','pakingshet','pakshet','pakyu','peste ka','pesteng yawa','poke','poki','pokpok','poyet','pu\'keng','pucha','puchanggala','puchangina','puke','puki','pukinangina','puking','punyeta','puta','putang','putang ina','putangina','putanginamo','putaragis','putragis','puyet','ratbu','shunga','sira ulo','siraulo','suso','susu','tae','taena','tamod','tanga','tangina','taragis','tarantado','tete','teti','timang','tinil','tite','titi','tungaw','ulol','ulul','ungas'
				];
				
				var regex = new RegExp(badWords.join('|'), 'gi');
				return string.replace(regex, function (match) {
					/* replace each letter with a star */
					var stars = '';
					for (var i = 0; i < match.length; i++) {
						stars += '*';
					}
					return stars;
				});

			}

		"));

	}

}