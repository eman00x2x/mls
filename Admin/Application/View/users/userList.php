<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='row g-0'>";
	$html[] = "<div class='col-12'>";

		$html[] = "<div class='page-header d-print-none text-white'>";
			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='row g-2 '>";
					$html[] = "<div class='col'>";
						$html[] = "<h1 class='page-title '><i class='ti ti-users me-2'></i> Account Users</h1>";
					$html[] = "</div>";
					$html[] = "<div class='col-auto ms-auto d-print-none'>";
						$html[] = "<div class='btn-list text-end'>";
							$html[] = "<a class='ajax btn btn-dark' href='".url("UsersController@add")."'><i class='ti ti-user-plus me-2'></i> New User</a>";
							$html[] = "<a class='ajax btn btn-primary' href='".url("UsersController@index",null,["showall" => true])."' ><i class='ti ti-users me-2'></i> Show All Users</a>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

		$html[] = "<div class='page-body'>";
			$html[] = "<div class='container-xl'>";

				$html[] = "<div class='box-container mb-3'>";
				
					$html[] = "<div class='search-box mb-3'>";
						$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search Users' data-url='".url("UsersController@index")."' />";
						$html[] = "<a href='".url("UsersController@index")."' class='clearFilter'>CLEAR FILTER</a>";
					$html[] = "</div>";

					if($data) { $c=0;
						$html[] = "<div class='table-responsive'>";
							
							$html[] = "<table class='table table-hover table-outline'>";
							$html[] = "<thead>";
								$html[] = "<tr>";
									$html[] = "<th class='text-center w-1'>#</th>";
									$html[] = "<th>Name</th>";
									$html[] = "<th>Email</th>";
									$html[] = "<th>Date Added</th>";
									$html[] = "<th class='text-center'><i class='icon-settings'></i></th>";
								$html[] = "</tr>";
							$html[] = "</thead>";
							
							$html[] = "<tbody>";
							for($i=0; $i<count($data); $i++) { $c++;
								
								$html[] = "<tr class='row_user_".$data[$i]['user_id']."'>";
									$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
									$html[] = "<td class='align-middle'><a href='".url("UsersController@view",["id" => $data[$i]['user_id']])."' class='ajax text-inherit' title='User: ".$data[$i]['name']."'>".$data[$i]['name']."</a></td>";
									$html[] = "<td class='align-middle'><a href='".url("UsersController@view",["id" => $data[$i]['user_id']])."'>".$data[$i]['email']."</a></td>";
									$html[] = "<td class='align-middle'>".date("F d, Y",$data[$i]['date_added'])."</td>";
									
									$html[] = "<td class='text-center'>";
									
										$html[] = "<div class='item-action dropdown'>";
										
											$html[] = "<span class='btn btn-outline-primary' data-bs-toggle='dropdown'><i class='ti ti-dots-vertical'></i></span>";
											
											$html[] = "<div class='dropdown-menu dropdown-menu-right'>";
												$html[] = "<a class='ajax dropdown-item' href='".url("UsersController@edit",["id" => $data[$i]['user_id']])."' title='Update User Account: ".$data[$i]['username']."'><i class='ti ti-edit me-2'></i> Edit User Details</a>";
												if($data[$i]['user_id'] != $_SESSION['user_logged']['user_id'] || $data[$i]['user_level'] != 1) {
													$html[] = "<span class='ajax dropdown-item text-white bg-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("UsersController@delete",["id" => $data[$i]['account_id'], "user_id" => $data[$i]['user_id']])."'><i class='ti ti-trash me-2'></i> Delete User</span>";
												}
											$html[] = "</div>";
											
										$html[] = "</div>";
									
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

if(!empty($model)) {
	$html[] = $model->pagination;
}