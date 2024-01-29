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
				$html[] = "<div class='card'>";

					$html[] = "<input type='hidden' name='last_message_id' id='last_message_id' value='0' />";
				
					$html[] = "<div class='card-body scrollable' style='height: 35rem'>";
						$html[] = "<div class='chat'>";
                        if($data['messages']) {
							$html[] = "<div class='chat-bubbles'>";
								for($i=0; $i<count($data['messages']); $i++) {
									$html[] = "<div  class='chat-item'>";
										
										if($data['messages'][$i]['user_id'] == $_SESSION['user_id']) {
											$html[] = "<div class='row align-items-end justify-content-end'>";
												$html[] = "<div class='col col-lg-6'>";
													$html[] = "<div class='chat-bubble chat-bubble-me'>";
														
														$html[] = "<div class='chat-bubble-title'>";
															$html[] = "<div class='row'>";
																$html[] = "<div class='col chat-bubble-author'>";
																	$html[] = $data['messages'][$i]['user']['name'];
																$html[] = "</div>";
																$html[] = "<div class='col-auto chat-bubble-date'>";
																	$html[] = date("F d, Y h:ia",$data['messages'][$i]['created_at']);
																$html[] = "</div>";
															$html[] = "</div>";
														$html[] = "</div>";

														$html[] = "<div class='chat-bubble-body'>";
															$html[] = "<p>".$data['messages'][$i]['details']."</p>";
														$html[] = "</div>";

													$html[] = "</div>";
												$html[] = "</div>";

												$html[] = "<div class='col-auto'>";
													$html[] = "<span class='avatar'></span>";
												$html[] = "</div>";
											$html[] = "</div>";
										}else {
											$html[] = "<div class='row align-items-end'>";
												$html[] = "<div class='col-auto'>";
													$html[] = "<span class='avatar'></span>";
												$html[] = "</div>";

												$html[] = "<div class='col col-lg-6'>";
													$html[] = "<div class='chat-bubble chat-bubble-me'>";
														
														$html[] = "<div class='chat-bubble-title'>";
															$html[] = "<div class='row'>";
																$html[] = "<div class='col chat-bubble-author'>";
																	$html[] = $data['messages'][$i]['user']['name'];
																$html[] = "</div>";
																$html[] = "<div class='col-auto chat-bubble-date'>";
																	$html[] = date("F d, Y h:ia",$data['messages'][$i]['created_at']);
																$html[] = "</div>";
															$html[] = "</div>";
														$html[] = "</div>";

														$html[] = "<div class='chat-bubble-body'>";
															$html[] = "<p>".$data['messages'][$i]['details']."</p>";
														$html[] = "</div>";

													$html[] = "</div>";
												$html[] = "</div>";
											$html[] = "</div>";
										}

									$html[] = "</div>";
								}
							$html[] = "</div>";
                        }
                        $html[] = "</div>";
                    $html[] = "</div>";

					$html[] = "<div class='card-footer'>";
						$html[] = "<div class='input-group input-group-flat'>";
							$html[] = "<input type='text' name='message' value='' class='form-control' placeholder='Type message' autocomplete='off' />'";
							$html[] = "<span class='input-group-text'>";
								$html[] = "<span class='btn btn-primary btn-send-message'><i class='ti ti-send'></i></span>";
							$html[] = "</span>";
						$html[] = "</div>";
					$html[] = "</div>";
					
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";