<?php

$html[] = "<input type='hidden' id='save_url' value='".url("MessagesController@saveNewThread")."' />";

$html[] = "<div class=''>";

    $html[] = "<h2 class='modal-title border-bottom pb-2'>Send Message</h2>";
    $html[] = "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";

	$html[] = "<form id='form' action='' method='POST'>";
		$html[] = "<input type='hidden' name='created_by' value='".$_SESSION['account_id']."' />";
		$html[] = "<input type='hidden' name='created_at' value='".DATE_NOW."' />";
		$html[] = "<input type='hidden' name='accounts' value='[".$data['account_id'].",".$_SESSION['account_id']."]' />";
		$html[] = "<input type='hidden' name='participants' value='[".$_SESSION['user_id']."]' />";
		$html[] = "<input type='hidden' name='user_id' value='".$_SESSION['user_id']."' />";

		$html[] = "<div class='row align-items-center'>";
			$html[] = "<div class='col-md-4 col-12'>";
				$html[] = "<div class='d-flex gap-2 mb-3'>";
					$html[] = "<span class='avatar avatar-lg' style='background-image: url(".$data['logo'].")'></span>";
					$html[] = "<div class=''>";
						$html[] = "<span class='d-block'>".$data['firstname']." ".$data['lastname']."</span>";
						$html[] = "<span class='d-block'>".$data['profession']."</span>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
			$html[] = "<div class='col-md-8 col-12'>";
				$html[] = "<div class='mb-3'>";
					$html[] = "<label class='form-label'>Subject</label>";
					$html[] = "<input type='text' name='subject' class='form-control cursor-not-allowed' value='RE: ".$_REQUEST['name']."' readonly='true' />";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

		$html[] = "<div class='mb-3'>";
		    $html[] = "<textarea class='form-control' name='message' placeholder='Write your message'></textarea>";
		$html[] = "</div>";
	$html[] = "</form>";

    $html[] = "<div class='d-flex gap-2 justify-content-between'>";
        $html[] = "<span class='btn btn-light' data-bs-dismiss='modal'><i class='ti ti-x me-2'></i> Cancel</span>";
        $html[] = "<span class='btn btn-primary btn-create-thread btn-save'><i class='ti ti-send me-2'></i> Send Message</span>";
    $html[] = "</div>";

$html[] = "</div>";