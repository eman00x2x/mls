<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<input type='hidden' id='save_url' value='".url("SettingsController@saveUpdate")."' />";

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<div class='page-pretitle'></div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-building-estate me-2'></i> System Settings</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='d-none d-sm-inline'>";
					$html[] = "<div class='btn-list'>";
						
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body mb-5 pb-5'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='card'>";
            $html[] = "<div class='row g-0'>";
                $html[] = "<div class='col-12 col-md-3 border-end'>";
                    $html[] = "<div class='card-body'>";
                        $html[] = "<h4 class='subheader'>Settings</h4>";
                        $html[] = "<div class='list-group list-group-transparent'>";
                            $html[] = "<a href='".url("SettingsController@index", ["page" => "system-settings"])."' class='list-group-item list-group-item-action d-flex align-items-center ".(url()->contains("/system-settings") 	? "active" : "")."'><i class='ti ti-settings-cog me-2'></i> System Settings</a>";
                            $html[] = "<a href='".url("SettingsController@index", ["page" => "data-privacy"])."' class='list-group-item list-group-item-action d-flex align-items-center 	".(url()->contains("/data-privacy") 	? "active" : "")."'><i class='ti ti-lock-square me-2'></i> Data Privacy Content</a>";
                            $html[] = "<a href='".url("SettingsController@index", ["page" => "terms"])."' class='list-group-item list-group-item-action d-flex align-items-center 			".(url()->contains("/terms") 			? "active" : "")."'><i class='ti ti-script me-2'></i> Terms of Service Content</a>";
                            $html[] = "<a href='".url("SettingsController@index", ["page" => "refund-policy"])."' class='list-group-item list-group-item-action d-flex align-items-center 	".(url()->contains("/refund-policy") 	? "active" : "")."'><i class='ti ti-receipt-refund me-2'></i> Refund Policy Content</a>";
                        $html[] = "</div>";
                    $html[] = "</div>";
                $html[] = "</div>";
                $html[] = "<div class='col-12 col-md-9'>";
                    
                    $html[] = "<div class='card-body'>";
						$html[] = "<div class='row'>";
							$html[] = "<div class='col-md-8 col'>";
							
								$html[] = "<form id='form' action='' method='POST'>";
									$html[] = "<input name='_method' id='_method' type='hidden' value='post' />";
									$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";

									if(url()->contains("/system-settings")) {
										$html[] = "<h2 class='mb-4'>System Settings</h2>";

										$html[] = "<div class='mb-5 border rounded-3 p-5'>";
											$html[] = "<h3 class='card-title'>Website Name</h3>";
											$html[] = "<p class='card-subtitle'>Please provide the name of your website, this will appear to all content including Terms and Condition and Data Privacy.</p>";
											$html[] = "<div class='row g-2'>";
												$html[] = "<div class='col-md'>";
													$html[] = "<input type='text' name='site_name' class='form-control' value='".$data['site_name']."' placeholder='Email website name' />";
												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</div>";

										$html[] = "<div class='mb-5 border rounded-3 p-5'>";
											$html[] = "<label class='form-check form-switch cursor-pointer mb-0'>";
												$html[] = "<h3 class='card-title' style='margin-left:-40px;'>KYC Verification</h3>";
												$html[] = "<p class='card-subtitle' style='margin-left:-40px;'>Upon activation of KYC Verification, users will be prompted to authenticate their identity by submitting a <b>Real Estate Broker identification document</b> along with a corresponding self-portrait. This step ensures compliance with regulatory standards and enhances the security and credibility of our platform.</p>";
											
												$html[] = "<input type='checkbox' name='enable_kyc_verification' class='form-check-input' value='1' ".($data['enable_kyc_verification'] == 1 ? "checked" : "")." />";
												$html[] = "<span class='form-check-label'>Enable KYC Verification</span>";
											$html[] = "</label>";
										$html[] = "</div>";

										$html[] = "<div class='mb-5 border rounded-3 p-5'>";
											$html[] = "<label class='form-check form-switch cursor-pointer mb-0'>";
												$html[] = "<h3 class='card-title' style='margin-left:-40px;'>Enable WebSocket Chat Based</h3>";
												$html[] = "<p class='card-subtitle' style='margin-left:-40px;'>If WebSocket chat functionality is activated, users gain the ability to engage in real-time communication via chat while seamlessly receiving messages as they are transmitted.</p>";
												$html[] = "<pre style='margin-left:-40px;'>";
													$html[] = "Utilize PuTTY to access SSH on the web server for running the WebSocket server.<br/>file path: ".ROOT."Manage/webSocketServer.php";
												$html[] = "</pre>";
											
												$html[] = "<input type='checkbox' name='chat_is_websocket' class='form-check-input' value='1' ".($data['chat_is_websocket'] == 1 ? "checked" : "")." />";
												$html[] = "<span class='form-check-label'>Enable WebSocket</span>";
											$html[] = "</label>";
										$html[] = "</div>";

										$html[] = "<div class='mb-5 border rounded-3 p-5'>";
											$html[] = "<label class='form-check form-switch cursor-pointer mb-0'>";
												$html[] = "<h3 class='card-title' style='margin-left:-40px;'>Premium (Account Privileges)</h3>";
												$html[] = "<p class='card-subtitle' style='margin-left:-40px;'>If you choose to activate the premium feature, users will have the option to purchase premium privileges to augment their account functionality.</p>";
											
												$html[] = "<input type='checkbox' name='enable_premium' class='form-check-input' value='1' ".($data['enable_premium'] == 1 ? "checked" : "")." />";
												$html[] = "<span class='form-check-label'>Enable Premium Purchase</span>";
											$html[] = "</label>";
										$html[] = "</div>";

										$html[] = "<div class='mb-5 border rounded-3 p-5'>";
											$html[] = "<label class='form-check form-switch cursor-pointer mb-0'>";
												$html[] = "<h3 class='card-title' style='margin-left:-40px;'>VAT Computation</h3>";
												$html[] = "<p class='card-subtitle' style='margin-left:-40px;'>Include Value Added Tax (VAT) on all purchases.</p>";
												
												$html[] = "<input type='checkbox' name='show_vat' class='form-check-input' value='1' ".($data['show_vat'] == 1 ? "checked" : "")." />";
												$html[] = "<span class='form-check-label'>Include VAT Computation</span>";
											$html[] = "</label>";
										$html[] = "</div>";

										/* $html[] = "<div class='mb-5 border rounded-3 p-5'>";
											$html[] = "<label class='form-check form-switch cursor-pointer mb-0'>";
												$html[] = "<h3 class='card-title' style='margin-left:-40px;'>PIN Based Access</h3>";
												$html[] = "<p class='card-subtitle' style='margin-left:-40px;'>If PIN-based access is enabled, users experiencing issues can contact our customer service team and provide their PIN for verification. Upon successful authentication, our representatives will assist users in resolving any account-related issues they encounter.</p>";
												
												$html[] = "<input type='checkbox' name='enable_pin_access' class='form-check-input' value='1' ".($data['enable_pin_access'] == 1 ? "checked" : "")." />";
												$html[] = "<span class='form-check-label'>Enable PIN Based Access</span>";
											$html[] = "</label>";
										$html[] = "</div>"; */

										$html[] = "<div class='mb-5 border rounded-3 p-5'>";
											$html[] = "<h3 class='card-title'>Email Address Responder</h3>";
											$html[] = "<p class='card-subtitle'>Please provide the email address designated as the responder for sending email notifications to users.</p>";
											$html[] = "<div class='row g-2'>";
												$html[] = "<div class='col-md'>";
													$html[] = "<input type='text' name='email_address_responder' class='form-control' value='".$data['email_address_responder']."' placeholder='Email Address Responder' />";
												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</div>";

										/* $html[] = "<div class='mb-5 border rounded-3 p-5'>";
											$html[] = "<h3 class='card-title'>Property Tags</h3>";
											$html[] = "<p class='card-subtitle'>Please specify the tags that can be used to categorize or assign attributes to a property.<br/>Tags must be separated by commas.</p>";
											$html[] = "<div class='row g-2'>";
												$html[] = "<div class='col-md'>";
													$html[] = "<textarea name='property_tags' class='form-control' placeholder='Property Tags' style='width:100%; height:200px;'>".implode(", ",$data['property_tags'])."</textarea>";
												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</div>"; */

										$html[] = "<div class='mb-5 border rounded-3 p-5'>";
											$html[] = "<h3 class='card-title'>Default Privileges</h3>";
											$html[] = "<p class='card-subtitle'>Customize default account privileges to restrict user access, incentivizing premium subscriptions and enhancing service offerings</p>";
											
											foreach(ACCOUNT_PRIVILEGES as $privileges => $val) {
												$html[] = "<div class='row g-2 mb-3'>";
													$html[] = "<label class='col-form-label col-3 mb-0 text-end pe-3'>".ucwords(str_replace("_"," ",$privileges))."</label>";
													$html[] = "<div class='col'>";
														$html[] = "<input type='text' name='privileges[$privileges]' class='form-control' value='".(isset($data['privileges'][$privileges]) ? $data['privileges'][$privileges] : null)."' placeholder='".DEFINITION[$privileges]."' />";
														$html[] = "<small class='form-hint'>".DEFINITION[$privileges]."</small>";
													$html[] = "</div>";
												$html[] = "</div>";
											}
												
											
										$html[] = "</div>";
									}

									if(url()->contains("/data-privacy")) {

										$html[] = "<input name='enable_kyc_verification' id='enable_kyc_verification' type='hidden' value='".$data['enable_kyc_verification']."' />";
										$html[] = "<input name='enable_premium' id='enable_premium' type='hidden' value='".$data['enable_premium']."' />";
										$html[] = "<input name='show_vat' id='show_vat' type='hidden' value='".$data['show_vat']."' />";
										$html[] = "<input name='enable_pin_access' id='enable_pin_access' type='hidden' value='".$data['enable_pin_access']."' />";
										$html[] = "<input name='chat_is_websocket' id='chat_is_websocket' type='hidden' value='".$data['chat_is_websocket']."' />";

										$html[] = "<h2 class='mb-4'>Data Privacy Content</h2>";
										$html[] = "<div class='mb-5'>";
											$html[] = "<p class='card-subtitle mb-2'>Please insert your data privacy content to ensure compliance with regulations and protect user privacy.</p>";
											$html[] = "<textarea id='snow-container' name='data_privacy' class='form-control'>".$data['data_privacy']."</textarea>";
										$html[] = "</div>";
									}

									if(url()->contains("/terms")) {

										$html[] = "<input name='enable_kyc_verification' id='enable_kyc_verification' type='hidden' value='".$data['enable_kyc_verification']."' />";
										$html[] = "<input name='enable_premium' id='enable_premium' type='hidden' value='".$data['enable_premium']."' />";
										$html[] = "<input name='show_vat' id='show_vat' type='hidden' value='".$data['show_vat']."' />";
										$html[] = "<input name='enable_pin_access' id='enable_pin_access' type='hidden' value='".$data['enable_pin_access']."' />";
										$html[] = "<input name='chat_is_websocket' id='chat_is_websocket' type='hidden' value='".$data['chat_is_websocket']."' />";

										$html[] = "<h2 class='mb-4'>Terms of Service Content</h2>";
										$html[] = "<div class='mb-5'>";
											$html[] = "<p class='card-subtitle mb-2'>Please insert your terms of service content to outline the terms and conditions governing the use of our services.</p>";
											$html[] = "<textarea id='snow-container' name='terms' class='form-control'>".$data['terms']."</textarea>";
										$html[] = "</div>";
									}

									if(url()->contains("/refund-policy")) {

										$html[] = "<input name='enable_kyc_verification' id='enable_kyc_verification' type='hidden' value='".$data['enable_kyc_verification']."' />";
										$html[] = "<input name='enable_premium' id='enable_premium' type='hidden' value='".$data['enable_premium']."' />";
										$html[] = "<input name='show_vat' id='show_vat' type='hidden' value='".$data['show_vat']."' />";
										$html[] = "<input name='enable_pin_access' id='enable_pin_access' type='hidden' value='".$data['enable_pin_access']."' />";
										$html[] = "<input name='chat_is_websocket' id='chat_is_websocket' type='hidden' value='".$data['chat_is_websocket']."' />";

										$html[] = "<h2 class='mb-4'>Refund Policy Content</h2>";
										$html[] = "<div class='mb-5'>";
											$html[] = "<p class='card-subtitle mb-2'>Please insert your refund policy content outlining the terms and conditions regarding refunds for products or services.</p>";
											$html[] = "<textarea id='snow-container' name='refund_policy' class='form-control'>".$data['refund_policy']."</textarea>";
										$html[] = "</div>";
									}

								$html[] = "</form>";

							$html[] = "</div>";
						$html[] = "</div>";
                    $html[] = "</div>";

                $html[] = "</div>";
            $html[] = "</div>";
        $html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='btn-save-container fixed-bottom bg-white py-3 border-top'>";
	$html[] = "<div class='row g-0 justify-content-center'>";
		$html[] = "<div class='col-lg-8 col-md-8 col-sm-12 col-12'>";

			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='text-end'>";
					$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy me-2'></i> Save Settings</span>";
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<script type=\"text/javascript\">
	$(document).ready(function() {
		tinymce.remove();
				
		tinymce.init({
			selector: 'textarea#snow-container',
			height: 500,
			menubar: false,
			plugins: [
				'advlist autolink lists link charmap print preview anchor',
				'searchreplace visualblocks code fullscreen',
				'insertdatetime media table paste code wordcount'
			],
			toolbar: 'link | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat code ',
			content_css: [
				'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
				'".WEBDOMAIN."/css/style.css'
			]
		});
	});
</script>";