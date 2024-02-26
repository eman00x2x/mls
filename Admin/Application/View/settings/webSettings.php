<?php

$html[] = "<input type='hidden' id='save_url' value='".url("SettingsController@saveUpdate")."' />";

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<div class='page-pretitle'></div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-building-estate me-2'></i> Web Settings</h1>";
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

		$html[] = "<div class='response'>";
			$html[] = getMsg();
		$html[] = "</div>";

		$html[] = "<div class='card'>";
            $html[] = "<div class='row g-0'>";
                $html[] = "<div class='col-12 col-md-3 border-end'>";
                    $html[] = "<div class='card-body'>";
                        $html[] = "<h4 class='subheader'>Settings</h4>";
                        $html[] = "<div class='list-group list-group-transparent'>";
                            $html[] = "<a href='".url("SettingsController@webSettings", ["page" => "common-settings"])."' class='list-group-item list-group-item-action d-flex align-items-center ".(url()->contains("/common-settings") 	? "active" : "")."'><i class='ti ti-settings me-2'></i> Common Settings</a>";
							$html[] = "<a href='".url("SettingsController@webSettings", ["page" => "analytics"])."' class='list-group-item list-group-item-action d-flex align-items-center 		".(url()->contains("/analytics") 		? "active" : "")."'><i class='ti ti-script me-2'></i> Analytics Script</a>";
                            $html[] = "<a href='".url("SettingsController@webSettings", ["page" => "head-script"])."' class='list-group-item list-group-item-action d-flex align-items-center 	".(url()->contains("/head-script") 		? "active" : "")."'><i class='ti ti-script me-2'></i> Header Script</a>";
                        $html[] = "</div>";
                    $html[] = "</div>";
                $html[] = "</div>";
                $html[] = "<div class='col-12 col-md-9'>";
                    
                    $html[] = "<div class='card-body'>";
						$html[] = "<div class='row'>";
							$html[] = "<div class='col-md-8 col'>";
							
								$html[] = "<form id='form' action='' method='POST'>";
									$html[] = "<input name='_method' id='_method' type='hidden' value='post' />";

									if(url()->contains("/common-settings")) {

										$html[] = "<input name='enable_kyc_verification' id='enable_kyc_verification' type='hidden' value='".$data['enable_kyc_verification']."' />";
										$html[] = "<input name='enable_premium' id='enable_premium' type='hidden' value='".$data['enable_premium']."' />";
										$html[] = "<input name='show_vat' id='show_vat' type='hidden' value='".$data['show_vat']."' />";
										$html[] = "<input name='enable_pin_access' id='enable_pin_access' type='hidden' value='".$data['enable_pin_access']."' />";
										$html[] = "<input name='chat_is_websocket' id='chat_is_websocket' type='hidden' value='".$data['chat_is_websocket']."' />";

										$html[] = "<h2 class='mb-4'>Contact Info</h2>";
										$html[] = "<div class='mb-5'>";
											$html[] = "<h3 class='card-title mt-4'>Customer Service Mobile Number</h3>";
											$html[] = "<p class='card-subtitle mb-2'>This contact will be shown to others publicly.</p>";
											$html[] = "<div class='row g-2'>";
												$html[] = "<div class='col-md'>";
													$html[] = "<input type='text' name='contact_info[mobile_number]' class='form-control' value='".$data['contact_info']['mobile_number']."' placeholder='Mobile Number' />";
												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</div>";

										$html[] = "<div class='mb-5'>";
											$html[] = "<h3 class='card-title mt-4'>Customer Service Email Address</h3>";
											$html[] = "<p class='card-subtitle mb-2'>This email address will be shown to others publicly.</p>";
											$html[] = "<div class='row g-2'>";
												$html[] = "<div class='col-md'>";
													$html[] = "<input type='text' name='contact_info[email]' class='form-control' value='".$data['contact_info']['email']."' placeholder='Email Address' />";
												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</div>";

										$html[] = "<div class='mb-5'>";
											$html[] = "<h3 class='card-title mt-4'>Office Address</h3>";
											$html[] = "<p class='card-subtitle mb-2'>The exact address of your organization office.</p>";
											$html[] = "<div class='row g-2'>";
												$html[] = "<div class='col-md'>";
													$html[] = "<textarea name='contact_info[office_address]' class='form-control' placeholder='Office Address' style='width:100%; height:200px;'>".$data['contact_info']['office_address']."</textarea>";
												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</div>";
									}

									if(url()->contains("/analytics")) {

										$html[] = "<input name='enable_kyc_verification' id='enable_kyc_verification' type='hidden' value='".$data['enable_kyc_verification']."' />";
										$html[] = "<input name='enable_premium' id='enable_premium' type='hidden' value='".$data['enable_premium']."' />";
										$html[] = "<input name='show_vat' id='show_vat' type='hidden' value='".$data['show_vat']."' />";
										$html[] = "<input name='enable_pin_access' id='enable_pin_access' type='hidden' value='".$data['enable_pin_access']."' />";
										$html[] = "<input name='chat_is_websocket' id='chat_is_websocket' type='hidden' value='".$data['chat_is_websocket']."' />";

										$html[] = "<h2 class='mb-4'>Analytics Script</h2>";
										$html[] = "<div class='mb-5 language-js highlighter-rouge'>";
											$html[] = "<p class='card-subtitle mb-2'>Please insert your analytics script, such as the following example, to monitor website traffic:</p>";
											$html[] = "<pre class='highlight'><code>";
												$html[] = htmlentities("<script async src=\"https://www.google-analytics.com/analytics.js\"></script>
<script>
	window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
	ga('create', 'UA-XXXXX-Y', 'auto');
	ga('send', 'pageview');
</script>
	");
											$html[] = "</code></pre>";
											$html[] = "<p class='card-subtitle mb-3'>Replace 'UA-XXXXX-Y' with your own Google Analytics tracking ID.</p>";
											$html[] = "<textarea name='analytics' class='form-control' placeholder='Analytics Script' style='width:100%; height:200px;'>".$data['analytics']."</textarea>";
										$html[] = "</div>";
									}

									if(url()->contains("/head-script")) {

										$html[] = "<input name='enable_kyc_verification' id='enable_kyc_verification' type='hidden' value='".$data['enable_kyc_verification']."' />";
										$html[] = "<input name='enable_premium' id='enable_premium' type='hidden' value='".$data['enable_premium']."' />";
										$html[] = "<input name='show_vat' id='show_vat' type='hidden' value='".$data['show_vat']."' />";
										$html[] = "<input name='enable_pin_access' id='enable_pin_access' type='hidden' value='".$data['enable_pin_access']."' />";
										$html[] = "<input name='chat_is_websocket' id='chat_is_websocket' type='hidden' value='".$data['chat_is_websocket']."' />";

										$html[] = "<h2 class='mb-4'>Header Script</h2>";
										$html[] = "<div class='mb-5'>";
											$html[] = "<p class='card-subtitle mb-2'>Please insert your custom script, such as the following example:</p>";
											$html[] = "<textarea name='header_script' class='form-control' placeholder='Header Script' style='width:100%; height:200px;'>".$data['header_script']."</textarea>";
											$html[] = "<div class='my-4'>";
												$html[] = "<p>Example META Pixel Snippet:</p>";
												$html[] = "<pre class='highlight'><code>";
													$html[] = htmlentities("<script>
	!function(f,b,e,v,n,t,s) {
		
		if(f.fbq)return;n=f.fbq=function(){
			n.callMethod ? n.callMethod.apply(n,arguments):n.queue.push(arguments)
		};

		if(!f._fbq) f._fbq=n; n.push=n; n.loaded=!0; n.version='2.0';
		n.queue=[]; t=b.createElement(e); t.async=!0;
		t.src=v; s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)

	}(window, document,'script', 'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', 'your-pixel-id-goes-here');
	fbq('track', 'PageView');
</script>
<noscript><img height=\"1\" width=\"1\" style=\"display:none\"src=\"https://www.facebook.com/tr?id=your-pixel-id-goes-here&ev=PageView&noscript=1\" /></noscript>");
												$html[] = "</code></pre>";
												$html[] = "<p class='card-subtitle mb-3'>Replace 'your-pixel-id-goes-here' with your actual Pixel ID provided by Facebook.</p>";
											$html[] = "</div>";
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