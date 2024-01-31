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

	$html[] = "<input type='hidden' name='last_message_id' id='last_message_id' value='".$data['messages'][$i]['message_id']."' />";
	