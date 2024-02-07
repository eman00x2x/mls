<?php

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
										$html[] = date("M d, Y h:ia",$data['messages'][$i]['created_at']);
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
							$html[] = "<div class='chat-bubble-body'>";
								$html[] = "<p>".$data['messages'][$i]['message']."</p>";
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
										$html[] = "<i class='ti ti-time'></i> ".date("M d, Y h:ia",$data['messages'][$i]['created_at']);
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
							$html[] = "<div class='chat-bubble-body'>";
								$html[] = "<p>".$data['messages'][$i]['message']."</p>";
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";
			}
		$html[] = "</div>";
	}

	$html[] = "<input type='hidden' class='last_message_id' value='".$data['messages'][($i-1)]['message_id']."' />";
	