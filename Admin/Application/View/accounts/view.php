<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";
		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<h1 class='page-title'><span class='stamp stamp-md me-1'><i class='ti ti-users me-2'></i></span> Account Details</h1>";
			$html[] = "</div>";
			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='btn-list text-end'>";
					$html[] = "<div class='btn-group'>";

						if(in_array($data['account_type'], ["Customer Service"])) {
							$html[] = "<span class='btn btn-dark btn-locked'><i class='ti ti-lock me-1'></i> Locked Account</span>";
						}

						$html[] = "<a href='javascript:window.location.reload()' class='btn btn-dark'><i class='ti ti-refresh me-1'></i> Reload</a>";
						$html[] = "<div class='btn-group'>";
							$html[] = "<span class='btn btn-primary dropdown-toggle' data-bs-toggle='dropdown'><i class='ti ti-cogs me-1'></i> Manage</span>";
							$html[] = "<div class='dropdown-menu'>";

								$html[] = "<a class='dropdown-item ajax' href='".url("AccountsController@edit",["id" => $data['account_id']])."' ><i class='ti ti-edit me-2'></i> Update Account</a>";
								
								if(isset($_SESSION['user_logged']['permissions']['users']['access'])) {
									$html[] = "<a class='dropdown-item ajax' href='".url("UsersController@add",["id" => $data['account_id']])."' ><i class='ti ti-user-plus me-2'></i> New User</a>";
								}

								if(!in_array($data['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {

									if(isset($_SESSION['user_logged']['permissions']['properties']['access'])) {
										$html[] = "<a class='dropdown-item ajax' href='".url("ListingsController@index",["id" => $data['account_id']])."' ><i class='ti ti-building-estate me-2'></i> Manage Property Listings</a>";
									}

									if(PREMIUM) {
										if(isset($_SESSION['user_logged']['permissions']['premiums']['process_subscription'])) {
											$html[] = "<span class='dropdown-item ajax cursor-pointer' data-bs-toggle='modal' data-bs-target='#accountModal' data-url='".url("PremiumsController@premiumSelection",["id" => $data['account_id']])."' ><i class='ti ti-plus me-2'></i> Add Subscription</span>";
										}
									}
								
									if($data['account_type'] != "Administrator" && (isset($_SESSION['user_logged']['permissions']['accounts']['delete']) && $_SESSION['user_logged']['permissions']['accounts']['delete'])) {
										$html[] = "<a class='dropdown-item text-danger btn-delete' data-bs-toggle='offcanvas' aria-controls='offcanvasEnd' href='#offcanvasEnd'  data-url='".url("AccountsController@delete",["id" => $data['account_id']])."'><i class='ti ti-trash me-2'></i> Delete Account</a>";
									}

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

		$html[] = "<div class='row'>";

			$html[] = "<div class='col-lg-3 col-md-4 col-12'>";
				
				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-body'>";

						$html[] = "<div class='text-center bg-white'>";
							if($data['logo'] != "") {$html[] = "<span class='avatar photo-preview mb-1 w-100 mb-3' style='background-image: url(".$data['logo'].")'></span>";
							}else {$html[] = "<span class='avatar photo-preview mb-1 w-100 mb-3' style='background-image: url(".CDN."images/blank-profile.png)'></span>"; }
						$html[] = "</div>";

						$html[] = "<div class='card-title'>Account</div>";

						$html[] = "<div class='mb-2'><span class='text-muted me-1 fs-12'><i class='ti ti-layout-board me-1'></i> Account Type:</span> <strong>".$data['account_type']."</strong></div>";
						$html[] = "<div class='mb-2'><span class='text-muted me-1 fs-12'><i class='ti ti-status-change me-1'></i> Status:</span> <strong>".$data['status']."</strong></div>";
						$html[] = "<div class='mb-2'><span class='text-muted me-1 fs-12'><i class='ti ti-calendar me-1'></i> Registration Date:</span> <strong>".date("d M Y",$data['registered_at'])."</strong></div>";
					$html[] = "</div>";
				$html[] = "</div>";
				
				if(!in_array($data['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-body'>";
							$html[] = "<div class='card-title'>Real Estate Practitioner Info</div>";

							if(!in_array($data['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
								$html[] = "<div class='mb-2'><span class='text-muted me-1 fs-12'><i class='ti ti-desk me-1'></i> Profession:</span> <strong>".$data['profession']."</strong></div>";
								$html[] = "<div class='mb-2'><span class='text-muted me-1 fs-12'><i class='ti ti-id me-1'></i> PRC License ID Number:</span> <strong>".$data['real_estate_license_number']."</strong></div>";
								$html[] = "<div class='mb-2'><span class='text-muted me-1 fs-12'><i class='ti ti-binary me-1'></i> TIN:</span> <strong>".$data['tin']."</strong></div>";
							}

							if(isset($data['brokers']['broker_prc_license_id']) && $data['brokers']['broker_prc_license_id'] == $data['real_estate_license_number']) {
								$html[] = "<div class='card-title mt-5'>Real Estate Broker License</div>";
								$html[] = "<div class='mb-2'><span class='text-muted me-1 fs-12'><i class='ti ti-id me-1'></i></span> <strong>".$data['brokers']['broker_prc_license_id']."</strong></div>";
							}

						$html[] = "</div>";
					$html[] = "</div>";
				}

				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-body'>";
						$html[] = "<div class='card-title'>Account Holder</div>";

						if(!in_array($data['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
							$html[] = "<div class='mb-2'><span class='text-muted me-1 fs-12'><i class='ti ti-building-store me-1'></i> Company Name:</span> <strong>".$data['company_name']."</strong></div>";
						}

						$html[] = "<div class='mb-2'><span class='text-muted me-1 fs-12'><i class='ti ti-user me-1'></i> Name:</span> <strong>".$data['account_name']['prefix']." ".$data['account_name']['firstname']." ".$data['account_name']['lastname']." ".$data['account_name']['suffix']."</strong></div>";
						
						if(!in_array($data['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
							if($data['birthdate']) {
								$html[] = "<div class='mb-2'><span class='text-muted me-1 fs-12'><i class='ti ti-calendar me-1'></i> Birth Date:</span> <strong>".date("d M Y",strtotime($data['birthdate']))."</strong></div>";
							}
							$html[] = "<div class='mb-2'><span class='text-muted me-1 fs-12'><i class='ti ti-phone me-1'></i> Mobile Number:</span> <strong>".$data['mobile_number']."</strong></div>";
						}

						$html[] = "<div class='mb-2'><span class='text-muted me-1 fs-12'><i class='ti ti-mail me-1'></i> Email:</span> <strong>".$data['email']."</strong></div>";

						if(!in_array($data['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
							$html[] = "<div class='mb-2'><span class='text-muted me-1 fs-12'><i class='ti ti-address-book me-1'></i> Address:</span> <strong>".$data['street']." ".$data['city']." ".$data['province']."</strong></div>";
						}
					$html[] = "</div>";
				$html[] = "</div>";
				
				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-body'>";
						$html[] = "<div class='card-title'>Account Privileges</div>";

						foreach($data['privileges'] as $privilege => $val) {
							$html[] = "<div class='d-flex justify-content-between border-bottom p-2'>";
								$html[] = "<div class='me-3'><label class='text-muted'>".ucwords(str_replace("_"," ",$privilege))."</label></div>";
								if(in_array($privilege, ["comparative_analysis_access", "chat_access", "mls_access", "api_access"])) {
									$html[] = "<div class='text-center' style='width:30px;'><span>".($data['privileges'][$privilege] >= 1 ? "<span class='text-success'><i class='ti ti-check'></i></span>" : "<span class='text-danger'><i class='ti ti-ban'></i></span>")."</span></div>";
								}else {
									$html[] = "<div class='text-center' style='width:30px;'><span class='fw-bold'>".$val."</span></div>";
								}
							$html[] = "</div>";
						}
						
					$html[] = "</div>";
				$html[] = "</div>";
				
			$html[] = "</div>";
			$html[] = "<div class='col-lg-9 col-md-8 col-12 '>";
			
				if(isset($_SESSION['user_logged']['permissions']['users']['access'])) {
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
											$html[] = "<th>Name</th>";
											$html[] = "<th>User Type</th>";
											$html[] = "<th>Date Created</th>";
											$html[] = "<th class='text-center'><i class='icon-settings'></i></th>";
										$html[] = "</tr>";
									$html[] = "</thead>";
									
									$html[] = "<tbody>";
									for($i=0; $i<count($data['users']); $i++) { $c++;
										
										$html[] = "<tr class='row_user_".$data['users'][$i]['user_id']."'>";
											$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
											$html[] = "<td class='align-middle'>";
												$html[] = "<div class='d-flex py-1 align-items-center'>";
													$html[] = "<span class='avatar me-2' style='background-image:url(".$data['users'][$i]['photo'].")'></span>";
													$html[] = "<div class='flex-fill'>";
														$html[] = "<div class='font-weight-medium'>";
															$html[] = "<a class='text-reset text-decoration-none' href='".url("UsersController@view",["id" => $data['users'][$i]['account_id'], "user_id" => $data['users'][$i]['user_id']])."' class='ajax text-inherit' title='User: ".$data['users'][$i]['name']."'>".$data['users'][$i]['name']."</a>";
														$html[] = "</div>";
														$html[] = "<div class='text-secondary'>";
															$html[] = "<a class='text-reset text-decoration-none' href='".url("UsersController@view",["id" => $data['users'][$i]['account_id'], "user_id" => $data['users'][$i]['user_id']])."'>".$data['users'][$i]['email']."</a>";
														$html[] = "</div>";
													$html[] = "</div>";
												$html[] = "</div>";
											$html[] = "</td>";

											$html[] = "<td class='align-middle'><a class='text-reset text-decoration-none' href='".url("UsersController@view",["id" => $data['users'][$i]['account_id'], "user_id" => $data['users'][$i]['user_id']])."'>".($data['users'][$i]['user_level'] == 1 ? "Account Holder" : "Regular User")."</a></td>";
											$html[] = "<td class='align-middle'>".date("F d, Y",$data['users'][$i]['created_at'])."</td>";
											
											$html[] = "<td class='text-center'>";
												$html[] = "<div class='item-action dropdown'>";
													$html[] = "<span class='btn btn-outline-primary' data-bs-toggle='dropdown'><i class='ti ti-dots-vertical'></i></span>";
													$html[] = "<div class='dropdown-menu dropdown-menu-right'>";
														
														$html[] = "<a class='ajax dropdown-item' href='".url("UsersController@edit",["id" => $data['users'][$i]['account_id'], "user_id" => $data['users'][$i]['user_id']])."'><i class='ti ti-edit me-2'></i> Edit User Details</a>";
														
														if($data['users'][$i]['user_level'] != 1 && isset($_SESSION['user_logged']['permissions']['users']['delete'])) {
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
				}

				if(PREMIUM && !in_array($data['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
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
												$html[] = "<td class='align-middle' style='width:100px'>".date("F d, Y g:ia",$data['subscriptions'][$i]['subscription_start_at'])."</td>";
												$html[] = "<td class='align-middle' style='width:350px'>".$data['subscriptions'][$i]['name']." <span class='text-muted small d-block'>".$data['subscriptions'][$i]['details']."</span></td>";
												$html[] = "<td class='align-middle'>";
													if($data['subscriptions'][$i]['subscription_end_at'] > 0) {
														$html[] = "".date("F d, Y g:ia",$data['subscriptions'][$i]['subscription_end_at'])."";
													}else {
														$html[] = "Permanent";
													}
													
												$html[] = "</td>";
												$html[] = "<td class='align-middle'>";
													$html[] = "<div class='btn-list'>";
														$html[] = "<span class='btn btn-outline-primary btn-update_subscription_status' data-id='".$data['subscriptions'][$i]['account_subscription_id']."' data-url='".url("AccountSubscriptionController@updateStatus", ["id" => $data['subscriptions'][$i]['account_subscription_id']])."'><i class='ti ti-lock-access me-2'></i> <span class='text-label'>".($data['subscriptions'][$i]['subscription_status'] == 1 ? "Deactivate": "Activate")."</span></span>";
														/* $html[] = "<span class='btn btn-outline-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("AccountSubscriptionController@delete",["id" => $data['subscriptions'][$i]['account_subscription_id']])."'><i class='ti ti-trash me-1'></i> Delete</span>"; */
													$html[] = "</div>";
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
							$html[] = "<h4 class='text-blue card-title mb-0'>Transactions</h4>";
						$html[] = "</div>";
					
						$html[] = "<div class='card-body'>";
							
							if($data['transaction']) { $c=0;
								$html[] = "<div style='max-height: 500px; overflow-x:auto;'>";
									$html[] = "<div class='table-responsive'>";
										
										$html[] = "<table class='table table-hover table-outline'>";
										$html[] = "<thead>";
											$html[] = "<tr>";
												$html[] = "<th class='text-center w-1'>#</th>";
												$html[] = "<th>Transaction Date</th>";
												$html[] = "<th>Premium</th>";
												$html[] = "<th class='text-center'>Payment Source</th>";
												$html[] = "<th class='text-end'>Amount</th>";
												/* $html[] = "<th></th>"; */
											$html[] = "</tr>";
										$html[] = "</thead>";
										
										$html[] = "<tbody>";
										for($i=0; $i<count($data['transaction']); $i++) { $c++;
											
											$html[] = "<tr class='row_transaction_".$data['transaction'][$i]['transaction_id']."'>";
												$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
												$html[] = "<td class='align-middle'><a class='d-block text-dark' style='text-decoration: none' href='".url("TransactionsController@view", ["id" => $data['transaction'][$i]['transaction_id']])."'>".date("F d, Y",$data['transaction'][$i]['created_at'])."</a></td>";
												$html[] = "<td class='align-middle' style='width:400px !important'><a class='d-block text-dark' style='text-decoration: none' href='".url("TransactionsController@view", ["id" => $data['transaction'][$i]['transaction_id']])."'>".$data['transaction'][$i]['premium_description']."</a></td>";
												$html[] = "<td class='align-middle text-center'><a class='d-block text-dark' style='text-decoration: none' href='".url("TransactionsController@view", ["id" => $data['transaction'][$i]['transaction_id']])."'>".strtoupper($data['transaction'][$i]['payment_source'])."</a></td>";
												$html[] = "<td class='align-middle text-end'><a class='d-block text-dark' style='text-decoration: none' href='".url("TransactionsController@view", ["id" => $data['transaction'][$i]['transaction_id']])."'>&#8369;".number_format($data['transaction'][$i]['premium_price'],2)."</a></td>";
												/* $html[] = "<td class='align-middle'>";
													$html[] = "<span class='btn btn-outline-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("TransactionsController@delete",["id" => $data['transaction'][$i]['transaction_id']])."'><i class='ti ti-trash me-1'></i> Delete</span>";
												$html[] = "</td>"; */
											$html[] = "</tr>";
											
										}
										$html[] = "</tbody>";
										$html[] = "</table>";
										
									$html[] = "</div>";
								$html[] = "</div>";
								
							}else {
								$html[] = "<p class='mt-3'>This account does not have any transaction.</p>";
							}

						$html[] = "</div>";
					$html[] = "</div>";

				}
						
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";