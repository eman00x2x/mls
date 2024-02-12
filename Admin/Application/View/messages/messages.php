<?php

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

		$html[] = "<div class='response'>";
			$html[] = getMsg();
		$html[] = "</div>";

		$html[] = "<div class='row'>";
			$html[] = "<div class='col-12'>";
				$html[] = "<div class='box-container mb-3'>";
				
					$html[] = "<div class='search-box'>";
						$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search' data-url='".url("MessagesController@index")."' />";
						$html[] = "<a href='".url("MessagesController@index")."' class='clearFilter'>CLEAR FILTER</a>";
					$html[] = "</div>";

					if($data['threads']) { $c=$model->page['starting_number'];
						$html[] = "<div class='table-responsive'>";
							
							$html[] = "<table class='table table-hover table-outline'>";
							$html[] = "<thead>";
								$html[] = "<tr>";
									$html[] = "<th class='text-center w-1'>#</th>";
									$html[] = "<th>Participants</th>";
									$html[] = "<th>Last Message</th>";
									$html[] = "<th>Date Started</th>";
									$html[] = "<th class='text-center'><i class='icon-settings'></i></th>";
								$html[] = "</tr>";
							$html[] = "</thead>";
							
							$html[] = "<tbody>";
							for($i=0; $i<count($data['threads']); $i++) { $c++;

								$html[] = "<tr class='row_listings_".$data['threads'][$i]['thread_id']."'>";
									$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
									
                                    $html[] = "<td><a href='".url("MessagesController@conversation", ["participants" => base64_encode(json_encode($data['threads'][$i]['participants']))])."'>";
                                        for($x=0; $x<count($data['threads'][$i]['accounts']); $x++) {
                                            if($data['threads'][$i]['accounts'][$x]['account_id'] != $_SESSION['account_id']) {
                                                $html[] = "<div class='d-flex gap-2'>";
                                                	$html[] = "<span class='avatar me-2' style='background-image: url(".$data['threads'][$i]['accounts'][$x]['logo'].")'></span>";
                                                	$html[] = "<span class='align-middle d-block float-end lh-base'>".$data['threads'][$i]['accounts'][$x]['firstname']." ".$data['threads'][$i]['accounts'][$x]['lastname']." <br/> ".$data['threads'][$i]['accounts'][$x]['profession']."</span>";
                                                $html[] = "</div>";
                                            }
                                        }
                                    $html[] = "</a></td>";
                                    
                                    $html[] = "<td class='align-middle cursor-pointer' onclick='window.location.href=\"".url("MessagesController@conversation", ["participants" => base64_encode(json_encode($data['threads'][$i]['participants']))])."\"'>";
									if($data['last_message']) {
										if($data['last_message']['user_id'] == $_SESSION['user_id']) {
											$html[] = "<span class=''>me: ".nicetrim($data['last_message']['message'], 50)."</span>";
										}else {
											$html[] = "<span class=''>".$data['last_message']['from']['name'].": ".nicetrim($data['last_message']['message'], 50)."</span>";
										}

										$html[] = "<span class='fs-11 d-block text-muted'>".date("M d, Y g:ia",$data['last_message']['created_at'])."</span>";
									}

									$html[] = "</td>";
                                    $html[] = "<td class='align-middle'>".date("M d, Y g:ia",$data['threads'][$i]['created_at'])."</td>";
									
									$html[] = "<td class='text-center'>";
                                        $html[] = "<div class='btn-list'>";
                                            $html[] = "<span class='btn btn-danger btn-delete ' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("MessagesController@saveDeletedThread",["thread_id" => $data['threads'][$i]['thread_id']])."'><i class='ti ti-trash me-2'></i> Delete</span>";
                                        $html[] = "</div>";
									$html[] = "</td>";
									
								$html[] = "</tr>";
								
							}
							$html[] = "</tbody>";
							$html[] = "</table>";
							
						$html[] = "</div>";
						
					}else {
						$html[] = "<p class='mt-3'>You do not have property listing.</p>";
					}
					
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";