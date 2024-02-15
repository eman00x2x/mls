<?php

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<h1 class='page-title'><i class='ti ti-user-circle me-2'></i> Accounts</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='btn-list'>";
					$html[] = "<span class='d-none d-sm-inline'>";
						$html[] = "<a class='ajax btn btn-dark' href='".url("AccountsController@add")."'><i class='ti ti-user-plus me-2'></i> New Account</a>";
					$html[] = "</span>";
					$html[] = "<a class='ajax btn btn-primary ajax' href='".url("AccountsController@index",null,["showall" => true])."' ><i class='ti ti-users me-2'></i> Show All Accounts</a>";
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
			$html[] = "<div class='col-12'>";
				$html[] = "<div class='box-container mb-3'>";
				
					$html[] = "<div class='search-box'>";
						$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search Account Name' data-url='".url("AccountsController@index")."' />";
						$html[] = "<a href='".url("AccountsController@index")."' class='clearFilter'>CLEAR FILTER</a>";
					$html[] = "</div>";

					if($data) { $c=$model->page['starting_number'];
						$html[] = "<div class='table-responsive'>";
							
							$html[] = "<table class='table table-hover table-outline'>";
							$html[] = "<thead>";
								$html[] = "<tr>";
									$html[] = "<th class='text-center w-1'>#</th>";
									$html[] = "<th class='w-1'></th>";
									$html[] = "<th>Name</th>";
									$html[] = "<th>Account Type</th>";
									$html[] = "<th>Email</th>";
									$html[] = "<th>Status</th>";
									$html[] = "<th>Registration Date</th>";
									$html[] = "<th class='text-center'><i class='icon-settings'></i></th>";
								$html[] = "</tr>";
							$html[] = "</thead>";
							
							$html[] = "<tbody>";
							for($i=0; $i<count($data); $i++) { $c++;
								
								$html[] = "<tr>";
									$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
									$html[] = "<td class='align-middle'><div class='avatar' style='background-image: url(".$data[$i]['logo'].")'></div></td>";
									$html[] = "<td class='align-middle'><a href='".url("AccountsController@view",["id" => $data[$i]['account_id']])."' class='ajax text-inherit'>";
										if($data[$i]['company_name'] == "") {
											$html[] = "(".$data[$i]['firstname']." ".$data[$i]['lastname'].")";
										}else {
											$html[] = $data[$i]['company_name']." <small class='text-muted'>(".$data[$i]['firstname']." ".$data[$i]['lastname'].")</small>";
										}
										
									$html[] = "</a></td>";
									$html[] = "<td class='align-middle'><a href='".url("AccountsController@view",["id" => $data[$i]['account_id']])."'>".$data[$i]['account_type']."</a></td>";
									$html[] = "<td class='align-middle'><a href='".url("AccountsController@view",["id" => $data[$i]['account_id']])."'>".$data[$i]['email']."</a></td>";
									$html[] = "<td class='align-middle'>".($data[$i]['status'] == 'active' ? "<span class='text-success '>Active</span>" : "<span class='text-danger'>Banned</span>")."</td>";
									$html[] = "<td class='align-middle'>".date("F d, Y", $data[$i]['registration_date'])."</td>";
									
									$html[] = "<td class='text-center'>";
									
										$html[] = "<div class='item-action dropdown'>";
										
											$html[] = "<span class='btn btn-outline-primary btn-md' data-bs-toggle='dropdown'><i class='ti ti-dots-vertical'></i></span>";
											
											$html[] = "<div class='dropdown-menu dropdown-menu-right'>";
												$html[] = "<a class='ajax dropdown-item' href='".url("AccountsController@edit",["id" => $data[$i]['account_id']])."'><i class='ti ti-edit me-2'></i> Update Account</a>";
												if($data[$i]['account_type'] != "Administrator") {
													$html[] = "<span class='dropdown-item text-light bg-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("AccountsController@delete",["id" => $data[$i]['account_id']])."'><i class='ti ti-trash me-2'></i> Delete Account</span>";
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

		if(!empty($model)) {
			$html[] = $model->pagination;
		}

	$html[] = "</div>";
$html[] = "</div>";