<?php

 if($data) {
	
	$html[] = "<a href='#' class='nav-link px-0' data-bs-toggle='dropdown' tabindex='-1' aria-label='Show notifications'>";
		$html[] = "<i class='ti ti-bell'></i> <span class='badge bg-red'></span>";
	$html[] = "</a>";

	$html[] = "<div class='dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card'>";

		$html[] = "<div class='card'>";

			$html[] = "<div class='card-header py-2 d-flex justify-content-between'>";
				$html[] = "<h3 class='card-title'>Notifications</h3>";
				$html[] = "<a href='".url("NotificationsController@index")."' class='text-white'>Show all</a>";
			$html[] = "</div>";

			$html[] = "<div class='list-group list-group-flush list-group-hoverable'>";

                for($i=0; $i<count($data); $i++) {
                    $html[] = "<div class='list-group-item'>";
                        $html[] = "<div class='row align-items-center'>";
                        	$html[] = "<div class='col-auto'>";
								$html[] = "<span class='status-dot status-dot-animated bg-green d-block'></span>";
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
                    $html[] = "</div>";
                }
            
			$html[] = "</div>";
			
		$html[] = "</div>";
	$html[] = "</div>";
}