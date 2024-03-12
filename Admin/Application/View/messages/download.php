<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-header d-print-none html-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<div class='page-pretitle'></div>";
				$html[] = "<h1 class='page-title text-white'><i class='ti ti-message me-2'></i> Thread Script</h1>";
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

		$html[] = "<div class='row'>";
			$html[] = "<div class='col-8'>";
				
				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-body ' style='height:500px; overflow: auto; word-wrap: normal; break-word: keep-all;'>";
						$html[] = "<div class='downloadable-content-container'>";

							$text[] = "** ---------------------";
							$text[] = "** Server Time Zone ".date_default_timezone_get()."";
							$text[] = "** ---------------------";
							$text[] = "** Thread Started at ".date("Y-m-d g:ia", $data['thread']['created_at'])."";
							$text[] = "** ---------------------";
							$text[] = "** Thread Started By";
							$text[] = "** - Name: ".$data['thread']['created_by']['name']."";
							$text[] = "** - Email: ".$data['thread']['created_by']['email']."";
							$text[] = "** - Photo: ".$data['thread']['created_by']['photo']."";
							
							$text[] = "** ---------------------";
							$text[] = "** Participants Account";
							foreach($data['thread']['accounts'] as $key => $account) {
								$text[] = "** - ".$data['thread']['accounts'][$key]['name']."";
							}

							if($data['thread']['messages']) {
								$text[] = "** ---------------------";
								$text[] = "** Messages";
								for($i=0; $i<count($data['thread']['messages']); $i++) {
									$text[] = "** - ".date("Y-m-d g:ia", $data['thread']['messages'][$i]['created_at'])." ".$data['thread']['messages'][$i]['sender']['name'].": <span class='message-container-".$data['thread']['messages'][$i]['message_id']."'>".$data['thread']['messages'][$i]['content']."</span>";
								}
							}else {
								$text[] = "** Thread does not have messages.";
							}

							$html[] = implode("<br/>", $text);

						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";

				$html[] = "<input type='hidden' id='save_url' value='".url("MessagesController@createDownloadFile")."' />";
				$html[] = "<form id='form' method='POST'>";
					$html[] = "<input type='hidden' name='_method' value='POST' />";
					$html[] = "<input type='hidden' name='thread_id' value='".$data['thread']['thread_id']."' />";
					$html[] = "<input type='hidden' name='created_at' value='".$data['thread']['created_at']."' />";
					$html[] = "<input type='hidden' name='encrypted_messages' id='encrypted_messages' value='' />";
				$html[] = "</form>";

				$html[] = "<span class='btn btn-primary btn-save d-none'><i class='ti ti-download me-1'></i> Create download link</span>";

			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";