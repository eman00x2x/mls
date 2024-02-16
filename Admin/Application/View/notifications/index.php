<?php

$html[] = "<div class='container-xl'>";
$html[] = "<div class='row justify-content-center'>";
	$html[] = "<div class='col-sm-10 col-md-6 col-12'>";

		$html[] = "<div class='page-header d-print-none text-white'>";
			$html[] = "<div class='container-xl'>";

				/* $html[] = "<div class='row g-2 '>";
					$html[] = "<div class='col'>";
						$html[] = "<div class='page-pretitle'></div>";
						$html[] = "<h1 class='page-title'><i class='ti ti-message me-2'></i> Notifications</h1>";
					$html[] = "</div>";

					$html[] = "<div class='col-auto ms-auto d-print-none'>";
						$html[] = "<div class='d-none d-sm-inline'>";
							$html[] = "<div class='btn-list'>";
								
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>"; */

			$html[] = "</div>";
		$html[] = "</div>";

		$html[] = "<div class='page-body'>";
			$html[] = "<div class='container-xl'>";

				$html[] = "<div class='response'>";
					$html[] = getMsg();
				$html[] = "</div>";

				$html[] = "<div class='card'>";
					$html[] = "<div class='card-body scrollable'>";
						if($data) {			
							$html[] = "<div class='table-responsive'>";
								$html[] = "<table class='table table-striped '>";
								$html[] = "<tr>";
									$html[] = "<th>Notifications</th>";
								$html[] = "</tr>";
								for($i=0; $i<count($data); $i++) {
									$html[] = "<tr>";
										$html[] = "<td>";
											$html[] = "<div class='row align-items-center'>";
												$html[] = "<div class='col-auto'>";
													$html[] = "<span class='status-dot ".($data[$i]['status'] == 1 ? "status-dot-animated bg-green" : "bg-dark")." d-block'></span>";
												$html[] = "</div>";
												$html[] = "<div class='col text-truncate'>";
													$html[] = "<div class='data-open-notification cursor-pointer' data-url='".url("NotificationsController@updateNotification", ["id" => $data[$i]['notification_id']])."'>";
														$html[] = "<span class='text-body d-block '>".$data[$i]['content']['title']."</span>";
														$html[] = "<div class='d-block text-muted text-truncate mt-n1'>";
															$html[] = $data[$i]['content']['message'];
														$html[] = "</div>";
													$html[] = "</div>";
												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</td>";
									$html[] = "</tr>";
								}
								$html[] = "</table>";
							$html[] = "</div>";			
						}
					$html[] = "</div>";
				$html[] = "</div>";

				if(!empty($model)) {
					$html[] = $model->pagination;
				}

			$html[] = "</div>";
		$html[] = "</div>";
		
	$html[] = "</div>";
$html[] = "</div>";
$html[] = "</div>";