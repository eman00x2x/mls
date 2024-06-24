<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<input type='hidden' id='save_url' value='".url("OpenHouseAnnouncementsController@saveUpdate", ["id" => $data['announcement_id']])."' />";

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
					$html[] = "<input type='hidden' name='listing_id' id='listing_id' value='".$data['listing_id']."' />";
					$html[] = "<input type='hidden' name='listing_title' id='listing_title' value='".$data['listing_title']."' />";
					$html[] = "<input type='hidden' name='attachment' id='attachment' value='".$data['attachment']."' />";
					
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title text-blue mb-0'>Update Open House Announcement</h3>";
						$html[] = "</div>";

						$html[] = "<div class='card-body'>";

							if(in_array($_SESSION['user_logged']['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
								
								$html[] = "<div class='row mb-4'>";
									$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Posted By</label>";
									$html[] = "<div class='col-sm-9'>";
										$html[] = "<div class='d-flex text-reset gap-2'>";
											$html[] = "<span class='avatar avatar' style='background-image: url(".$data['account']['logo'].")'></span>";
											$html[] = "<div class=''>";
												$html[] = "<span class='d-block'>".$data['account']['account_name']['firstname']." ".$data['account']['account_name']['middlename']." ".$data['account']['account_name']['lastname']." ".$data['account']['account_name']['suffix']."</span>";
												$html[] = "<span class='d-block text-muted fs-12'>".$data['account']['profession']."</span>";
											$html[] = "</div>";
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";

							}

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Subject</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='text' name='subject' id='subject' value='".$data['subject']."' class='form-control' />";
									$html[] = "<span class='form-hint'>Subject or title of Open House</span>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Address</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='text' name='content[address]' id='address' value='".$data['content']['address']."' class='form-control' />";
									$html[] = "<span class='form-hint'>The address where the Open House event is located</span>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Date and Time</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='datetime-local' name='content[date]' id='date' value='".date("Y-m-d H:i:s", strtotime($data['content']['date']))."' class='form-control' />";
									$html[] = "<span class='form-hint'>Set the Open House date and time</span>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Other Details</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='text' name='content[details]' id='details' value='".$data['content']['details']."' class='form-control' />";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Attach Listing</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<span class='border d-block p-2 mb-1 rounded cursor-pointer listing-selection' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd'>".$data['listing_title']."</span>";
									$html[] = "<span class='form-hint'>Select the listing that will have an Open House</span>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Publish at</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<span class='d-block p-2'>".date("d M Y", $data['started_at'])."</span>";
								$html[] = "</div>";
							$html[] = "</div>";

							if(in_array($_SESSION['user_logged']['account_type'], ["Administrator"])) {

								$html[] = "<div class='row mb-3'>";
									$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Announcement End at</label>";
									$html[] = "<div class='col-sm-9'>";
										$html[] = "<input type='date' name='ended_at' id='ended_at' value='".date("Y-m-d", $data['ended_at'])."' class='form-control' />";
									$html[] = "</div>";
								$html[] = "</div>";

							}else {

								$html[] = "<div class='row mb-3'>";
									$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Announcement End</label>";
									$html[] = "<div class='col-sm-9'>";
										$html[] = "<span class='d-block p-2'>".date("d M Y", $data['ended_at'])."</span>";
									$html[] = "</div>";
								$html[] = "</div>";

							}

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
