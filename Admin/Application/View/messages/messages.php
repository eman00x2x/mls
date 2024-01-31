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
									$html[] = "<th>Subject</th>";
									$html[] = "<th>From Account</th>";
									$html[] = "<th>Date</th>";
									$html[] = "<th class='text-center'><i class='icon-settings'></i></th>";
								$html[] = "</tr>";
							$html[] = "</thead>";
							
							$html[] = "<tbody>";
							for($i=0; $i<count($data['threads']); $i++) { $c++;

								$html[] = "<tr class='row_listings_".$data['threads'][$i]['thread_id']."'>";
									$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
									$html[] = "<td class='align-middle'><a href='".url("MessagesController@view",["thread_id" => $data['threads'][$i]['thread_id']])."'>".$data['threads'][$i]['subject']."</a></td>";
									
                                    $html[] = "<td>";
                                        for($x=0; $x<count($data['threads'][$i]['participants']); $x++) {
                                            if($data['threads'][$i]['participants'][$x]['account']['account_id'] != $_SESSION['account_id']) {
                                                $html[] = "<div class='d-flex gap-2'>";
                                                	$html[] = "<div class='btn border border-1 rounded-2'>";
                                                		$html[] = "<span class='avatar avatar-sm me-2' style='background-image: url(".$data['threads'][$i]['participants'][$x]['account']['logo'].")'></span>";
                                                		$html[] = "<span class='d-block float-end lh-base'>".$data['threads'][$i]['participants'][$x]['account']['firstname']." ".$data['threads'][$i]['participants'][$x]['account']['lastname']."</span>";
													$html[] = "</div>";
                                                    $html[] = "<span class='d-block '><span class='d-block text-muted small'>Started by:</span> ".$data['threads'][$i]['participants'][$x]['name']."</span>";
                                                $html[] = "</div>";
                                            }
                                        }
                                    $html[] = "</td>";
                                    
                                    $html[] = "<td class='align-middle'>".date("F d, Y g:ia",$data['threads'][$i]['created_at'])."</td>";
									
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