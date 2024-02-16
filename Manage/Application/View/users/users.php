<?php

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<div class='page-pretitle'>Manage Your Account Users</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-users me-2'></i> Account Users</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='d-none d-sm-inline'>";
					$html[] = "<a class='ajax btn btn-dark' href='".url("UsersController@new")."'><i class='ti ti-user-plus me-2'></i> New User</a>";
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
                $html[] = "<div class='col-md-12 col-12 mb-5'>";

                    $html[] = "<div class='card'>";
                        $html[] = "<div class='card-body py-5'>";

                            $html[] = "<div class='row'>";
                                $html[] = "<div class='col-lg-3 col-md-3 col-12'>";

                                    $html[] = "<div class='list-group list-group-flush'>";
										if(isset($_SESSION['user_logged']['permissions']['account']['access'])) {
                                        	$html[] = "<a class='list-group-item list-group-item-action' href='".url("AccountsController@index")."'><i class='ti ti-user-circle me-2'></i> My Account</a>";
										}

										if(isset($_SESSION['user_logged']['permissions']['users']['access'])) {
										    $html[] = "<a class='list-group-item list-group-item-action' href='".url("UsersController@index", [ "id" => $_SESSION['user_logged']['account_id'] ])."'><i class='ti ti-users me-2'></i> Manage Users</a>";
										}

                                        $html[] = "<a class='list-group-item list-group-item-action' href='".url("UsersController@changePassword",["id" => $_SESSION['user_logged']['user_id']])."'><i class='ti ti-key me-2'></i> Change Password</a>";
                                    $html[] = "</div>";
                                
                                $html[] = "</div>";

                                $html[] = "<div class='col-lg-9 col-md-9 col-12'>";

									$html[] = "<div class='card border-0'>";
										$html[] = "<div class='card-header'>";
											$html[] = "<h4 class='text-blue card-title mb-0'><i class='ti ti-users me-2'></i> Users</h4>";
											$html[] = "<div class='card-actions'>";
												if((!isset($_SESSION['user_logged']['permissions']['users']['access']))) {
													$html[] = "<a href='".url("UsersController@new")."' class='btn btn-outline-primary'><i class='ti ti-user-plus me-2'></i> New User</a>";
												}
											$html[] = "</div>";
										$html[] = "</div>";
										$html[] = "<div class='card-body'>";

											if($data['users']) { $c=0;
												$html[] = "<div class='table-responsive'>";
													
													$html[] = "<table class='table table-hover table-outline'>";
													$html[] = "<thead>";
														$html[] = "<tr>";
															$html[] = "<th class='text-center w-1'>#</th>";
															$html[] = "<th>Name</th>";
															$html[] = "<th>Email</th>";
															$html[] = "<th>Date Added</th>";
															$html[] = "<th class='text-center'></th>";
														$html[] = "</tr>";
													$html[] = "</thead>";
													
													$html[] = "<tbody>";
													for($i=0; $i<count($data['users']); $i++) { $c++;
														
														$html[] = "<tr class='row_user_".$data['users'][$i]['user_id']."'>";
															$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
															$html[] = "<td class='align-middle'><a href='".url("UsersController@edit",["id" => $data['users'][$i]['account_id'], "user_id" => $data['users'][$i]['user_id']])."' class='ajax text-inherit' title='User: ".$data['users'][$i]['name']."'>".$data['users'][$i]['name']."</a></td>";
															$html[] = "<td class='align-middle'><a href='".url("UsersController@edit",["id" => $data['users'][$i]['account_id'], "user_id" => $data['users'][$i]['user_id']])."'>".$data['users'][$i]['email']."</a></td>";
															$html[] = "<td class='align-middle'>".date("F d, Y",$data['users'][$i]['date_added'])."</td>";
															
															$html[] = "<td class='text-center'>";
																if(isset($_SESSION['user_logged']['permissions']['users']['delete']) && $_SESSION['user_logged']['permissions']['users']['delete'] == true && $data['users'][$i]['user_level'] != 1) {
																	$html[] = "<span class='btn btn-outline-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("UsersController@delete",["id" => $data['users'][$i]['account_id'], "user_id" => $data['users'][$i]['user_id']])."'><i class='ti ti-trash me-2'></i> Delete User</span>";
																}
															$html[] = "</td>";
															
														$html[] = "</tr>";
														
													}
													$html[] = "</tbody>";
													$html[] = "</table>";
													
												$html[] = "</div>";
												
											}else {
												$html[] = "<p class='mt-3'>You do not have Users.</p>";
											}

										$html[] = "</div>";
									$html[] = "</div>";

                                $html[] = "</div>";
                            $html[] = "</div>";


                        $html[] = "</div>";
                    $html[] = "</div>";

                $html[] = "</div>";
            $html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";