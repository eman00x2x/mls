<?php



$html[] = "<div class='row'>";
	$html[] = "<div class='col-md-6 col-sm-12  mx-auto'>";
	
		$html[] = "<input type='hidden' id='save_url' value='".url("LoginController@sendPasswordResetLink")."' />";
	
		$html[] = "<div class='card'>";
			$html[] = "<div class='card-body p-6'>";
				$html[] = "<div class='card-status bg-blue'></div>";
				$html[] = "<div class='card-title'>Verify your account</div>";
				
				$html[] = "<div class='response'>";
					$html[] = getMsg();
				$html[] = "</div>";
				
				$html[] = "<form id='form' >";
					$html[] = "<input name='_method' id='_method' type='hidden' value='post' />";
					$html[] = "<div class='form-group'>";
						$html[] = "<label class='form-label'>Registered Email</label>";
						$html[] = "<input type='email' class='form-control' name='email'  placeholder='Enter registered email' autocomplete='off' required />";
					$html[] = "</div>";
				$html[] = "</form>";
					
				$html[] = "<div class='btn-list text-right'>";
					$html[] = "<a href='".url("LoginController@login")."' class='ajax btn btn-outline-default text-gray' title='Philproperties CRM Login'>Login</a>";
					$html[] = "<span class='btn btn-outline-primary btn-save'><i class='fe fe-send'></i> &nbsp; Send Password Reset Link</span>";
				$html[] = "</div>";
				
			$html[] = "</div>";
		$html[] = "</div>";
		
	$html[] = "</div>";
$html[] = "</div>";