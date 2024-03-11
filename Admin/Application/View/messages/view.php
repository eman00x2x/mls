<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";


$html[] = "<form action='".url("MessagesController@uploadAttachment")."' id='pdfUploadForm' method='POST' enctype='multipart/form-data'>";
	$html[] = "<center>";
		$html[] = "<input type='file' name='ImageBrowse[]' id='PdfBrowse' accept='application/pdf' />";
	$html[] = "</center>";
$html[] = "</form>";

$html[] = "<form action='".url("MessagesController@uploadAttachment")."' id='imageUploadForm' method='POST' enctype='multipart/form-data'>";
	$html[] = "<center>";
		$html[] = "<input type='file' name='ImageBrowse[]' id='ImageBrowse' multiple='multiple' accept='image/jpg,image/jpeg,image/gif,image/png' />";
	$html[] = "</center>";
$html[] = "</form>";

$html[] = "<div class='modal' id='serverErrorModal' tabindex='-1' aria-hidden='true' aria-labelledby='serverErrorModal'>";
	$html[] = "<div class='modal-dialog modal-fullscreen'>";
		$html[] = "<div class='modal-content'>";
			$html[] = "<div class='modal-body'>";
				$html[] = "<div class='text-start'>";
					$html[] = "<h3>Error!</h3>";
					$html[] = "<p>There was a problem connecting to \"Message Server\", Please notiify the System Administrator about this problem. <br/>{Message Server Closed} <br/> Try reloading this page, it might help you to connect to Message Server.</p>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='container-xl'>";
$html[] = "<div class='row justify-content-center'>";
	$html[] = "<div class='col-sm-10 col-md-6 col-12'>";

		$html[] = "<div class='page-header d-print-none text-white'>";
			$html[] = "<div class='container-xl'>";

				$html[] = "<div class='row g-2 '>";
					$html[] = "<div class='col'>";
						$html[] = "<div class='page-pretitle'></div>";
						$html[] = "<h1 class='page-title'><i class='ti ti-message me-2'></i> Messages</h1>";
					$html[] = "</div>";

					$html[] = "<div class='col-auto ms-auto d-print-none'>";
						$html[] = "<div class='d-none d-sm-inline'>";
							$html[] = "<div class='btn-list'>";
								/* $html[] = "<a class='ajax btn btn-dark' href='".url("MessagesController@addListing")."'><i class='ti ti-user-plus me-2'></i> New Listing</a>"; */
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";

			$html[] = "</div>";
		$html[] = "</div>";

		$html[] = "<div class='page-body'>";
			$html[] = "<div class='container-xl'>";

				$html[] = "<div class='d-flex text-white mb-2 justify-content-between'>";
					foreach($data['participants'] as $account_data) {
						if($account_data['account_id'] != $_SESSION['user_logged']['account_id']) {
							$html[] = "<div class='d-flex gap-2'>";
								$html[] = "<span class='avatar avatar-lg' style='background-image: url(".$data['participants'][$account_data['account_id']]['logo'].")'></span>";
								$html[] = "<div class=''>";
									$html[] = "<span class='d-block'>Account of ".$data['participants'][$account_data['account_id']]['firstname']." ".$data['participants'][$account_data['account_id']]['lastname']."</span>";
									$html[] = "<span class='d-block'>".$data['participants'][$account_data['account_id']]['profession']."</span>";
								$html[] = "</div>";
							$html[] = "</div>";
						}
					}

					$html[] = "<div class=''>";
						$html[] = "<span class=''><i class='ti ti-dots-vertical'></i></span>";
					$html[] = "</div>";
				$html[] = "</div>";

				$html[] = "<div class='card'>";

					$html[] = "<div class='card-body scrollable' style='height: 35rem'>";
						$html[] = "<div class='chat'>";
							$html[] = "<div class='chat-bubbles'>";
								
								
							$html[] = "</div>";
						$html[] = "</div>";

					$html[] = "</div>";

					$html[] = "<input type='hidden' name='first_message_id' id='first_message_id' class='first_message_id' value='0' />";
					$html[] = "<input type='hidden' name='last_message_id' id='last_message_id' class='last_message_id' value='0' />";

					if(isset($data['thread']['thread_id'])) {
						$thread_id = $data['thread']['thread_id'];
					}else {
						$thread_id = 0;
					}

					$html[] = "<form id='form' action='' method='POST'>";
						
						$html[] = "<input type='hidden' name='participants' id='participants' class='participants' value='".json_encode($data['participants_id'])."' />";
						$html[] = "<input type='hidden' name='thread_id' id='thread_id' class='thread_id' value='$thread_id' />";
						$html[] = "<input type='hidden' name='type' id='type' value='text' />";

						$html[] = "<div class='card-footer'>";

							$html[] = "<div class='upload-container d-flex gap-2 mb-2'></div>";

							$html[] = "<div class='upload-response mb-1 '></div>";
							$html[] = "<div class='upload-loader mb-1 '></div>";

							$html[] = "<div class='input-group input-group-flat'>";
								$html[] = "<span class='input-group-text'>";
									$html[] = "<span class='link-secondary ms-2 cursor-pointer btn-browse-pdf' title='Upload PDF File' data-bs-toggle='tooltip' data-bs-original-title='Upload PDF File' aria-label='Upload File'><i class='ti ti-file-type-pdf'></i></span>";
									$html[] = "<span class='link-secondary ms-2 cursor-pointer btn-browse-image' title='Upload Photo' data-bs-toggle='tooltip' data-bs-original-title='Upload Photo' aria-label='Upload Photo'><i class='ti ti-photo-plus'></i></span>";
								$html[] = "</span>";
								$html[] = "<input type='text' name='message' id='message' value='' class='form-control' placeholder='Type message' autocomplete='off' maxlength='2000' />";
								$html[] = "<span class='input-group-text'>";
									$html[] = "<span class='btn btn-primary btn-send btn-send-message'><i class='ti ti-send'></i></span>";
								$html[] = "</span>";
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</form>";
					
				$html[] = "</div>";
					
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";
$html[] = "</div>";