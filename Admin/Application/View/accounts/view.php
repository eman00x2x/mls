<?php

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";
		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<h1 class='page-title'><span class='stamp stamp-md me-1'><i class='ti ti-users me-2'></i></span> Account Details</h1>";
			$html[] = "</div>";
			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='btn-list text-end'>";
					$html[] = "<div class='btn-group'>";
						$html[] = "<a href='javascript:window.location.reload()' class='btn btn-dark'><i class='ti ti-refresh me-1'></i> Reload</a>";
						$html[] = "<div class='btn-group'>";
							$html[] = "<span class='btn btn-primary dropdown-toggle' data-bs-toggle='dropdown'><i class='ti ti-cogs me-1'></i> Manage</span>";
							$html[] = "<div class='dropdown-menu'>";
								$html[] = "<a class='dropdown-item ajax' href='".url("AccountsController@edit",["id" => $data['account_id']])."' ><i class='ti ti-edit me-2'></i> Update Account</a>";
								$html[] = "<a class='dropdown-item ajax' href='".url("UsersController@add",["id" => $data['account_id']])."' ><i class='ti ti-user-plus me-2'></i> New User</a>";
								$html[] = "<a class='dropdown-item ajax' href='".url("ListingsController@index",["id" => $data['account_id']])."' ><i class='ti ti-building-estate me-2'></i> Manage Property Listings</a>";
								
								if(PREMIUM) {
									$html[] = "<span class='dropdown-item ajax cursor-pointer' data-bs-toggle='modal' data-bs-target='#accountModal' data-url='".url("AccountsController@subscriptionSelectionNew",["id" => $data['account_id']])."' ><i class='ti ti-plus me-2'></i> Add Subscription</span>";
								}
								
								if($data['account_type'] != "Administrator") {
									$html[] = "<a class='dropdown-item text-danger btn-delete' data-bs-toggle='offcanvas' aria-controls='offcanvasEnd' href='#offcanvasEnd'  data-url='".url("AccountsController@delete",["id" => $data['account_id']])."'><i class='ti ti-trash me-2'></i> Delete Account</a>";
								}
							$html[] = "</div>";
						$html[] = "</div>";
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

			$html[] = "<div class='col-lg-3 col-md-4 col-12'>";
				
				$html[] = "<div class='card mb-3'>";

					$html[] = "<div class='card-body'>";

						$html[] = "<div class='text-center bg-white'>";
							if($data['logo'] != "") {$html[] = "<span class='avatar photo-preview mb-1 w-100 mb-3' style='background-image: url(".$data['logo'].")'></span>";
							}else {$html[] = "<span class='avatar photo-preview mb-1 w-100 mb-3' style='background-image: url(".CDN."images/blank-profile.png)'></span>"; }

						$html[] = "</div>";

						$html[] = "<div class='mb-3 pb-3 border-bottom'>";
							$html[] = "<h6 class='mb-1 fw-bold'>Account Details</h6>";
							$html[] = "<div class='d-flex'>";
								$html[] = "<div class='me-3'><label class='text-muted'>Account Type</label></div>";
								$html[] = "<div class=''><span>".$data['account_type']."</span></div>";
							$html[] = "</div>";
							$html[] = "<div class='d-flex'>";
								$html[] = "<div class='me-3'><label class='text-muted'>Status</label></div>";
								$html[] = "<div class=''><span>".$data['status']."</span></div>";
							$html[] = "</div>";

							$html[] = "<div class='d-flex'>";
								$html[] = "<div class='me-3'><label class='text-muted'>Registration Date</label></div>";
								$html[] = "<div class=''><span>".date("F d, Y",$data['registration_date'])."</span></div>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='mb-3 pb-3 border-bottom'>";
							$html[] = "<h6 class='mb-1 fw-bold'>Account Holder</h6>";
							$html[] = "<div class='d-flex'>";
								$html[] = "<div class='me-3'><label class='text-muted'>Name</label></div>";
								$html[] = "<div class=''><span>".$data['firstname']." ".$data['lastname']."</span></div>";
							$html[] = "</div>";

							$html[] = "<div class='d-flex'>";
								$html[] = "<div class='me-3'><label class='text-muted'>Mobile Number</label></div>";
								$html[] = "<div class=''><span>".$data['mobile_number']."</span></div>";
							$html[] = "</div>";

							$html[] = "<div class='d-flex'>";
								$html[] = "<div class='me-3'><label class='text-muted'>Email</label></div>";
								$html[] = "<div class=''><span>".$data['email']."</span></div>";
							$html[] = "</div>";

							$html[] = "<div class='d-flex '>";
								$html[] = "<div class='me-3'><label class='text-muted'>Address</label></div>";
								$html[] = "<div class=''><span>".$data['address']."</span></div>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='mb-3 pb-3 border-bottom'>";
							$html[] = "<h6 class='mb-1 fw-bold'>Company Details</h6>";
							$html[] = "<div class='d-flex'>";
								$html[] = "<div class='me-3'><label class='text-muted'>Company Name</label></div>";
								$html[] = "<div class=''><span>".$data['company_name']."</span></div>";
							$html[] = "</div>";

							$html[] = "<div class='d-flex'>";
								$html[] = "<div class='me-3'><label class='text-muted'>TIN</label></div>";
								$html[] = "<div class=''><span>".$data['tin']."</span></div>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='mb-3 pb-3 border-bottom'>";
							$html[] = "<h6 class='mb-1 fw-bold'>Account Privileges</h6>";

							foreach($data['privileges'] as $privilege => $val) {
								$html[] = "<div class='d-flex'>";
									$html[] = "<div class='me-3'><label class='text-muted'>".ucwords(str_replace("_"," ",$privilege))."</label></div>";
									if(in_array($privilege, ["leads_DB","properties_DB"])) {
										$html[] = "<div class=''><span>".(isset($data['privileges'][$privilege]) ? "<span class='text-success'><i class='ti ti-check'></i></span>" : "<span class='text-danger'><i class='ti ti-ban'></i></span>")."</span></div>";
									}else {
										$html[] = "<div class=''><span>".$val."</span></div>";
									}
								$html[] = "</div>";
							}
						$html[] = "</div>";
				
						
					$html[] = "</div>";
				$html[] = "</div>";
				
			$html[] = "</div>";
			$html[] = "<div class='col-lg-9 col-md-8 col-12 '>";
			
				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-header'>";
						$html[] = "<h4 class='text-blue card-title mb-0'>Account Users</h4>";
					$html[] = "</div>";
				
					$html[] = "<div class='card-body'>";
						
						if($data['users']) { $c=0;
							$html[] = "<div style='max-height: 500px; overflow-x:auto;'>";
							$html[] = "<div class='table-responsive'>";
								
								$html[] = "<table class='table table-hover table-outline'>";
								$html[] = "<thead>";
									$html[] = "<tr>";
										$html[] = "<th class='text-center w-1'>#</th>";
										$html[] = "<th>Username</th>";
										$html[] = "<th>Name</th>";
										$html[] = "<th>Email</th>";
										$html[] = "<th>Date Created</th>";
										$html[] = "<th class='text-center'><i class='icon-settings'></i></th>";
									$html[] = "</tr>";
								$html[] = "</thead>";
								
								$html[] = "<tbody>";
								for($i=0; $i<count($data['users']); $i++) { $c++;
									
									$html[] = "<tr class='row_user_".$data['users'][$i]['user_id']."'>";
										$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
										$html[] = "<td class='align-middle'><a href='".url("UsersController@view",["id" => $data['users'][$i]['account_id'], "user_id" => $data['users'][$i]['user_id']])."' class='ajax text-inherit' title='User: ".$data['users'][$i]['username']."'>".$data['users'][$i]['username']."</a></td>";
										$html[] = "<td class='align-middle'><a href='".url("UsersController@view",["id" => $data['users'][$i]['account_id'], "user_id" => $data['users'][$i]['user_id']])."' class='ajax text-inherit' title='User: ".$data['users'][$i]['name']."'>".$data['users'][$i]['name']."</a></td>";
										$html[] = "<td class='align-middle'><a href='".url("UsersController@view",["id" => $data['users'][$i]['account_id'], "user_id" => $data['users'][$i]['user_id']])."'>".$data['users'][$i]['email']."</a></td>";
										$html[] = "<td class='align-middle'>".date("F d, Y",$data['users'][$i]['date_added'])."</td>";
										
										$html[] = "<td class='text-center'>";
											$html[] = "<div class='item-action dropdown'>";
												$html[] = "<span class='btn btn-outline-primary' data-bs-toggle='dropdown'><i class='ti ti-dots-vertical'></i></span>";
												$html[] = "<div class='dropdown-menu dropdown-menu-right'>";
													$html[] = "<a class='ajax dropdown-item' href='".url("UsersController@edit",["id" => $data['users'][$i]['account_id'], "user_id" => $data['users'][$i]['user_id']])."'><i class='ti ti-edit me-2'></i> Edit User Details</a>";
													if($data['users'][$i]['user_level'] != 1) {
														$html[] = "<span class='ajax dropdown-item text-white bg-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("UsersController@delete",["id" => $data['users'][$i]['account_id'], "user_id" => $data['users'][$i]['user_id']])."'><i class='ti ti-trash me-2'></i> Delete User</span>";
													}
												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</td>";
										
									$html[] = "</tr>";
									
								}
								$html[] = "</tbody>";
								$html[] = "</table>";
								
							$html[] = "</div>";
							$html[] = "</div>";
						}else {
							$html[] = "<p class='mt-3'>This account does not have users.</p>";
						}

					$html[] = "</div>";
				$html[] = "</div>";

				if(PREMIUM) {
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h4 class='text-blue card-title mb-0'>Account Subscriptions</h4>";
						$html[] = "</div>";
					
						$html[] = "<div class='card-body'>";
							
							if($data['subscriptions']) { $c=0;
								$html[] = "<div style='max-height: 500px; overflow-x:auto;'>";
									$html[] = "<div class='table-responsive'>";
										
										$html[] = "<table class='table table-hover table-outline'>";
										$html[] = "<thead>";
											$html[] = "<tr>";
												$html[] = "<th class='text-center w-1'>#</th>";
												$html[] = "<th>Subscription Date</th>";
												$html[] = "<th>Details</th>";
												$html[] = "<th>Subscription End</th>";
												$html[] = "<th></th>";
											$html[] = "</tr>";
										$html[] = "</thead>";
										
										$html[] = "<tbody>";
										for($i=0; $i<count($data['subscriptions']); $i++) { $c++;
											
											$html[] = "<tr class='row_subscription_".$data['subscriptions'][$i]['account_subscription_id']."'>";
												$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
												$html[] = "<td class='align-middle'>".date("F d, Y g:ia",$data['subscriptions'][$i]['subscription_start_date'])."</td>";
												$html[] = "<td class='align-middle' style='width:300px'>".$data['subscriptions'][$i]['name']." <span class='text-muted small d-block'>".$data['subscriptions'][$i]['details']."</span></td>";
												$html[] = "<td class='align-middle'>";
													if($data['subscriptions'][$i]['subscription_end_date'] > 0) {
														$html[] = "".date("F d, Y g:ia",$data['subscriptions'][$i]['subscription_end_date'])."";
													}else {
														$html[] = "Permanent";
													}
													
												$html[] = "</td>";
												$html[] = "<td class='align-middle'>";
													$html[] = "<span class='btn btn-outline-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("AccountSubscriptionController@delete",["id" => $data['subscriptions'][$i]['account_subscription_id']])."'><i class='ti ti-trash me-1'></i> Delete</span>";
												$html[] = "</td>";
											$html[] = "</tr>";
											
										}
										$html[] = "</tbody>";
										$html[] = "</table>";
										
									$html[] = "</div>";
								$html[] = "</div>";
							}else {
								$html[] = "<p class='mt-3'>This account does not have subscriptions.</p>";
							}

						$html[] = "</div>";
					$html[] = "</div>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h4 class='text-blue card-title mb-0'>Invoices</h4>";
						$html[] = "</div>";
					
						$html[] = "<div class='card-body'>";
							
							if($data['invoices']) { $c=0;
								$html[] = "<div style='max-height: 500px; overflow-x:auto;'>";
									$html[] = "<div class='table-responsive'>";
										
										$html[] = "<table class='table table-hover table-outline'>";
										$html[] = "<thead>";
											$html[] = "<tr>";
												$html[] = "<th class='text-center w-1'>#</th>";
												$html[] = "<th>Invoice Date</th>";
												$html[] = "<th>Details</th>";
												$html[] = "<th class='text-center'>Payment Gateway</th>";
												$html[] = "<th class='text-end'>Amount</th>";
												$html[] = "<th></th>";
											$html[] = "</tr>";
										$html[] = "</thead>";
										
										$html[] = "<tbody>";
										for($i=0; $i<count($data['invoices']); $i++) { $c++;
											
											$html[] = "<tr class='row_invoice_".$data['invoices'][$i]['invoice_id']."'>";
												$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
												$html[] = "<td class='align-middle'>".date("F d, Y",$data['invoices'][$i]['invoice_date'])."</td>";
												$html[] = "<td class='align-middle' style='width:300px !important'>".$data['invoices'][$i]['details']."</td>";
												$html[] = "<td class='align-middle text-center'>".$data['invoices'][$i]['payment_gateway']."</td>";
												$html[] = "<td class='align-middle text-end'>".number_format($data['invoices'][$i]['invoice_amount'],2)."</td>";
												$html[] = "<td class='align-middle'>";
													$html[] = "<span class='btn btn-outline-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("InvoicesController@delete",["id" => $data['invoices'][$i]['invoice_id']])."'><i class='ti ti-trash me-1'></i> Delete</span>";
												$html[] = "</td>";
											$html[] = "</tr>";
											
										}
										$html[] = "</tbody>";
										$html[] = "</table>";
										
									$html[] = "</div>";
								$html[] = "</div>";
								
							}else {
								$html[] = "<p class='mt-3'>This account does not have any invoice.</p>";
							}

						$html[] = "</div>";
					$html[] = "</div>";

				}
						
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";