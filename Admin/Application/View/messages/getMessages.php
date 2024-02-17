<?php

	for($i=0; $i<count($data['messages']); $i++) {

		$content = $data['messages'][$i]['content'];

		if($content['type'] == 'text') {
			$message = "<p>".$data['messages'][$i]['content']['message']."</p>";
		}else {

			$links = $data['messages'][$i]['content']['info']['links'];

			$message[] = "<div class='images_container row'>";
				for($x=0; $ix<count($links); $x++) {
					$message[] = "<div class='col-auto'>";
						$message[] = "<div class='avatar avatar-lg' style='background-image: url(".$links[$x].")'></div>";
					$message[] = "</div>";
				}
			$message[] = "</div>";

		}

		$html[] = "<div  class='chat-item'>";
			
			if($data['messages'][$i]['user_id'] == $_SESSION['user_logged']['user_id']) {
				$html[] = "<div class='row align-items-end justify-content-end'>";
					$html[] = "<div class='col col-lg-6'>";
						$html[] = "<div class='chat-bubble chat-bubble-me'>";
							
							$html[] = "<div class='chat-bubble-title'>";
								$html[] = "<div class='row'>";
									$html[] = "<div class='col chat-bubble-author'>";
										$html[] = $data['messages'][$i]['user']['name'];
									$html[] = "</div>";
									$html[] = "<div class='col-auto chat-bubble-date'>";
										$html[] = "<span class='fs-11'>".date("M d, Y h:ia",$data['messages'][$i]['created_at'])."</span>";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
							$html[] = "<div class='chat-bubble-body'>";
								$html[] = $message;
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
					$html[] = "<div class='col-auto'>";
						$html[] = "<span class='avatar' style='background-image: url(".$data['messages'][$i]['user']['photo'].")'></span>";
					$html[] = "</div>";
				$html[] = "</div>";
			}else {
				$html[] = "<div class='row align-items-end'>";
					$html[] = "<div class='col-auto'>";
						$html[] = "<span class='avatar' style='background-image: url(".$data['messages'][$i]['user']['photo'].")'></span>";
					$html[] = "</div>";
					$html[] = "<div class='col col-lg-6'>";
						$html[] = "<div class='chat-bubble chat-bubble-me'>";
							
							$html[] = "<div class='chat-bubble-title'>";
								$html[] = "<div class='row'>";
									$html[] = "<div class='col chat-bubble-author'>";
										$html[] = $data['messages'][$i]['user']['name'];
									$html[] = "</div>";
									$html[] = "<div class='col-auto chat-bubble-date'>";
										$html[] = "<span class='fs-11'>".date("M d, Y h:ia",$data['messages'][$i]['created_at'])."</span>";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
							$html[] = "<div class='chat-bubble-body'>";
								$html[] = $message;
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";
			}
		$html[] = "</div>";
	}

	$html[] = "<input type='hidden' class='last_message_id' value='".$data['messages'][($i-1)]['message_id']."' />";
	
