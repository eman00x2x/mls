<?php

$doc = \Library\Factory::getDocument();
$doc->setTitle("Password Reset - Philproperties CRM");

$ref = explode("&",base64_decode($_REQUEST['ref']));
						
foreach($ref as $r) {
	$d = explode("=",$r);
	$data[@$d[0]] = @$d[1];
}

$html[] = "<input type='hidden' id='save_url' value='".constructUrl(null,null,null,"task=saveNewPassword")."' />";
$html[] = "<div class='row'>";
	$html[] = "<div class='col-md-6 col-sm-12  mx-auto'>";
	
		$html[] = "<div class='card'>";
			
			$html[] = "<div class='card-body p-6'>";
				$html[] = "<div class='card-status bg-blue'></div>";
				
				if(isset($data['user_id']) && isset($data['expires'])) {
					
					$date_now = strtotime(date("Y-m-d H:i:s"));
					$expire_date = strtotime($data['expires']);
					
					if($date_now <= $expire_date) {
						
						$html[] = "<div class='card-title'>Reset your password</div>";
						$html[] = "<div class='response'>";
							$html[] = getMsg();
						$html[] = "</div>";
						
						$html[] = "<form id='form' action='' method='POST'>";
							$html[] = "<input name='_method' id='_method' type='hidden' value='post' />";
							$html[] = "<input name='user_id' id='user_id' type='hidden' value='".$data['user_id']."' />";
							
							$html[] = "<div class='form-group'>";
								$html[] = "<label class='form-label'>New Password</label>";
								$html[] = "<input type='password' class='form-control' name='password' id='password'  placeholder='Enter password' autocomplete='off' required />";
							$html[] = "</div>";
							
							$html[] = "<div class='form-group'>";
								$html[] = "<label class='form-label'>Confirm Password</label>";
								$html[] = "<input type='password' class='form-control' name='cpassword' id='cpassword'  placeholder='Confirm password' autocomplete='off' required />";
							$html[] = "</div>";
						$html[] = "</form>";
						
						$html[] = "<div class='btn-list text-right'>";
							$html[] = "<a href='".constructUrl()."' class='ajax btn btn-outline-default text-gray' title='Philproperties CRM Login'>Login</a>";
							$html[] = "<span class='btn btn-outline-primary btn-save'><i class='fe fe-save'></i> Reset Password</span>";
						$html[] = "</div>";
						
					}else {
						$html[] = "<div class='card-title'>Link Expired</div>";
						$html[] = "<p>Your password reset link has expire. Please <a href='?task=forgot-password' title='Send Password Reset Link'>request another one</a> to reset your password.</p>";
					}
				}else {
					$html[] = "<div class='card-title'>Link Expired</div>";
					$html[] = "<p>Your password reset link has expire. Please <a href='?task=forgot-password' title='Send Password Reset Link'>request another one</a> to reset your password.</p>";
				}

			$html[] = "</div>";
		$html[] = "</div>";
		
	$html[] = "</div>";
$html[] = "</div>";