<?php

$html[] = "<div class='offcanvas-header'>";
	$html[] = "<h2 class='offcanvas-title' id='offcanvasEndLabel'>Message Deletion</h2>";
	$html[] = "<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
$html[] = "</div>";

$html[] = "<div class='offcanvas-body'>";

	$html[] = "<div class='response-body'>";
		$html[] = "<p>Are you sure do you want to delete the selected message?</p>";
	$html[] = "</div>";

	$html[] = "<div class='deletion-response'></div>";

	$html[] = "<div class='btn-delete-controls'>";
		$html[] = "<div class='btn-list'>";
			$html[] = "<span class='btn text-dark bg-transparent' data-bs-dismiss='offcanvas'><i class='ti ti-x me-2'></i> Cancel</span>";
			$html[] = "<span data-url='".url("MessagesController@saveDeletedThread",["id" => $data['id']], ["delete" => "true"])."' data-url-proceed='".url("MessagesController@index")."' class='btn btn-danger btn-continue-delete'><i class='ti ti-trash me-2'></i> Continue Deletion</span>";
		$html[] = "</div>";
	$html[] = "</div>";

$html[] = "</div>";