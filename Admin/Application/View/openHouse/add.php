<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<input type='hidden' id='save_url' value='".url("OpenHouseAnnouncementsController@saveNew")."' />";

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='row justify-content-center mb-5 pb-5'>";
		$html[] = "<div class='col-md-6 col-12'>";

			$html[] = "<div class='page-header d-print-none text-white'>";
				
				$html[] = "<div class='row g-2 '>";
					$html[] = "<div class='col'>";
						$html[] = "<div class='page-pretitle'></div>";
						$html[] = "<h1 class='page-title'><i class='ti ti-home-up me-2'></i> Open House Announcements</h1>";
					$html[] = "</div>";

					$html[] = "<div class='col-auto ms-auto d-print-none'>";
						$html[] = "<div class='d-none d-sm-inline'>";
							$html[] = "<div class='btn-list'>";
								
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";

			$html[] = "</div>";

			$html[] = "<div class='page-body'>";
				
				$html[] = "<form id='form' action='' method='POST'>";
					$html[] = "<input name='_method' id='_method' type='hidden' value='post' />";
					$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
					$html[] = "<input type='hidden' name='listing_id' id='listing_id' value='0' />";
					$html[] = "<input type='hidden' name='listing_title' id='listing_title' value='' />";
					$html[] = "<input type='hidden' name='attachment' id='attachment' value='' />";
					
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title text-blue mb-0'>Create Announcement</h3>";
						$html[] = "</div>";

						$html[] = "<div class='card-body'>";

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Subject</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='text' name='subject' id='subject' value='' class='form-control' />";
									$html[] = "<span class='form-hint'>Subject or title of Open House</span>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Address</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='text' name='content[address]' id='address' value='' class='form-control' />";
									$html[] = "<span class='form-hint'>The address where the Open House event is located</span>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Date and Time</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='datetime-local' name='content[date]' id='date' value='' class='form-control' />";
									$html[] = "<span class='form-hint'>Set the Open House date and time</span>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Other Details</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='text' name='content[details]' id='details' value='' class='form-control' />";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Attach Listing</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<span class='border d-block p-2 mb-1 rounded cursor-pointer listing-selection' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd'><i class='fs-12 text-muted'>Search Listing</i></span>";
									$html[] = "<span class='form-hint'>Select the listing that will have an Open House</span>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Publish Starting at</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='date' name='started_at' id='started_at' value='' class='form-control' />";
									$html[] = "<span class='form-hint'>Set publish date, open house announcement will end after 7 days</span>";
								$html[] = "</div>";
							$html[] = "</div>";

						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</form>";

			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";

	$html[] = "<div class='btn-save-container fixed-bottom bg-white py-3 border-top'>";
		$html[] = "<div class='row g-0 justify-content-center'>";
			$html[] = "<div class='col-lg-8 col-md-8 col-sm-12 col-12'>";

				$html[] = "<div class='text-end'>";
					$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy me-2'></i> Save Open House</span>";
				$html[] = "</div>";
				

			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";
