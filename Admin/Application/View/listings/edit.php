<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<input type='hidden' id='save_url' value='".url("ListingsController@saveUpdate", ["id" => $data['listing']['listing_id']])."' />";

$html[] = "<input type='hidden' id='photo_uploader' value='listings' />";
$html[] = "<form action='".url("ListingsController@uploadImages", ["id" => $data['listing']['account_id']])."' id='imageUploadForm' method='POST' enctype='multipart/form-data'>";
	$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
	$html[] = "<center>";
		$html[] = "<input type='file' name='ImageBrowse[]' id='ImageBrowse' multiple='multiple' accept='image/*' />";
	$html[] = "</center>";
$html[] = "</form>";

$html[] = "<form action='".url("ListingsController@uploadDocuments")."' id='DocsUploadForm' method='POST' enctype='multipart/form-data'>";
	$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
	$html[] = "<center>";
		$html[] = "<input type='file' name='DocsBrowse[]' id='DocsBrowse' multiple='multiple' accept='application/pdf' />";
	$html[] = "</center>";
$html[] = "</form>";

$html[] = "<div class='row g-0 justify-content-center mb-5 pb-5'>";
	$html[] = "<div class='col-lg-8 col-md-8 col-sm-12 col-12'>";

		$html[] = "<div class='page-header d-print-none text-white'>";
			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='row g-2 '>";
					$html[] = "<div class='col'>";
						$html[] = "<div class='page-pretitle'>Manage Property Listing of ".$data['account_name']['prefix']." ".$data['account_name']['firstname']." ".$data['account_name']['lastname']." ".$data['account_name']['suffix']."</div>";
						$html[] = "<h1 class='page-title'><span class='stamp stamp-md me-1'><i class='ti ti-home me-1'></i></span> Update Property Listing</h1>";
					$html[] = "</div>";
					$html[] = "<div class='col-auto ms-auto d-print-none'>";
						$html[] = "<div class='page-options text-end'>";
							$html[] = "<div class='btn-list'>";
								
								if($data['account_type'] != "Administrator") {
									$html[] = "<a class='ajax btn btn-dark' href='".url("AccountsController@view", ["id" => $data['account_id']])."'>";
										$html[] = "<span class='avatar avatar-sm' style='background-image: url(".$data['logo'].")'></span>";
										$html[] = $data['account_name']['prefix']." ".$data['account_name']['firstname']." ".$data['account_name']['lastname']." ".$data['account_name']['suffix']." account";
									$html[] = "</a>";
									$html[] = "<a class='btn btn-dark' href='".url("ListingsController@index",["id" => $data['listing']['account_id']])."' title='Listings'><i class='ti ti-list me-1'></i> Property Listings</a>";
								}else {
									$html[] = "<a class='btn btn-dark' href='".url("ListingsController@index")."' title='Listings'><i class='ti ti-list me-1'></i> Property Listings</a>";
								}

							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

		/** START PAGE BODY */
		$html[] = "<div class='page-body'>";
			$html[] = "<div class='container-xl'>";

				$arr = explode("/",$data['listing']['thumb_img']);
				$thumb_img = array_pop($arr);

				$html[] = "<form id='form' action='' method='POST'>";
					$html[] = "<input name='_method' id='_method' type='hidden' value='post' />";
					$html[] = "<input name='thumb_img' id='thumb_img' type='hidden' value='".$thumb_img."' />";
					$html[] = "<input name='account_id' id='account_id' type='hidden' value='".$data['listing']['account_id']."' />";
					$html[] = "<input name='duration' id='duration' type='hidden' value='".$data['listing']['duration']."' />";
					$html[] = "<input name='modified_at' id='modified_at' type='hidden' value='".date("Y-m-d H:i:s",DATE_NOW)."' />";
					$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header pt-4'>";
							$html[] = "<ul class='nav nav-tabs card-header-tabs' data-bs-toggle='tabs' role='tablist'>";
								$html[] = "<li class='nav-item' role='pressentation'><a href='#property_description' 	class='pb-3 fw-bold text-blue nav-link active' data-bs-toggle='tab' aria-selected='true'><i class='ti ti-file-description me-2'></i> Property Description</a></li>";
								$html[] = "<li class='nav-item' role='pressentation'><a href='#technical_description' 	class='pb-3 fw-bold text-blue nav-link' data-bs-toggle='tab' aria-selected='false'><i class='ti ti-ruler me-2'></i> Technical Details</a></li>";
								$html[] = "<li class='nav-item' role='pressentation'><a href='#payment_details' 		class='pb-3 fw-bold text-blue nav-link' data-bs-toggle='tab' aria-selected='false'><i class='ti ti-cash me-2'></i> Payment Details</a></li>";
								$html[] = "<li class='nav-item' role='pressentation'><a href='#images_list' 			class='pb-3 fw-bold text-blue nav-link' data-bs-toggle='tab' aria-selected='false'><i class='ti ti-photo me-2'></i> Images</a></li>";
								$html[] = "<li class='nav-item' role='pressentation'><a href='#docs_list' 				class='pb-3 fw-bold text-blue nav-link' data-bs-toggle='tab' aria-selected='false'><i class='ti ti-photo me-2'></i> Documents</a></li>";
								$html[] = "<li class='nav-item' role='pressentation'><a href='#settings'	 			class='pb-3 fw-bold text-blue nav-link' data-bs-toggle='tab' aria-selected='false'><i class='ti ti-settings-cog me-2'></i> Settings</a></li>";
							$html[] = "</ul>";
						$html[] = "</div>";
						
						$html[] = "<div class='card-body'>";
							$html[] = "<div class='tab-content'>";
								
								$html[] = "<div id='property_description' class='tab-pane active'>";
									
									/***** PROPERTY DESCRIPTION *****/
									
									$html[] = "<div class='row justify-content-center py-3'>";
										$html[] = "<div class='col-md-8 col-lg-8 col-12'>";


										$html[] = "<div class='d-flex gap-2 mb-3'>";
											$html[] = "<div class='form-group '>";
												$html[] = "<label class='form-label text-muted'>Offer</label>";
												$html[] = "<div class='input-icon'>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-tags'></i></span>";
													$html[] = "<select class='form-control' name='offer' id='offer'>";
														$offer_type = array("For Sale","For Rent", "Looking For");
														foreach($offer_type as $key => $val) {
															$sel = strtolower($val) == $data['listing']['offer'] ? "selected" : "";
															$html[] = "<option value='".strtolower($val)."' $sel>$val</option>";
														}
													$html[] = "</select>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
												$html[] = "</div>";
											$html[] = "</div>";

											$html[] = "<div class='form-group flex-grow-1'>";
												$html[] = "<label class='form-label text-muted'>Title</label>";
												$html[] = "<div class='input-icon mb-1'>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-writing'></i></span>";
													$html[] = "<input type='text' name='title' id='title' value='".clean($data['listing']['title'])."' class='form-control' placeholder='Title' />";
													
												$html[] = "</div>";
												$html[] = "<p class='p-0 text-info'>Do not include \"For Sale\", \"RFO\", \"Re-Sale\" in your title.</p>";
											$html[] = "</div>";
											
										$html[] = "</div>";
												
											$html[] = "<div class='form-group mb-3'>";
												$html[] = "<label class='form-label text-muted'>Description</label>";
												$html[] = "<textarea id='snow-container' name='long_desc' class='form-control'>".clean($data['listing']['long_desc'])."</textarea>";
											$html[] = "</div>";

										$html[] = "</div>";
									$html[] = "</div>";
									
								$html[] = "</div>";
								
								$html[] = "<div id='technical_description' class='tab-pane '>";
									/***** TECHNICAL DESCRIPTION *****/
										
									$html[] = "<div class='row py-3'>";
										$html[] = "<div class='col-lg-8 col-md-8 col-12 m-auto'>";

											$html[] = "<div class='row'>";
												$html[] = "<div class='col-lg-6 col-md-6'>";
										
													$html[] = "<div class='form-group mb-3'>";
														$html[] = "<label class='form-label text-muted'>Category</label>";
														$html[] = "<div class='input-icon mb-3'>";
															$html[] = "<span class='input-icon-addon'><i class='ti ti-building-store'></i></span>";
															$html[] = $model->categorySelection($data['listing']['category']);
															$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
														$html[] = "</div>";
													$html[] = "</div>";
												
												$html[] = "</div>";
												$html[] = "<div class='col-lg-6 col-md-6'>";

													$html[] = "<div class='form-group mb-3'>";
														$html[] = "<label class='form-label text-muted'>Property Type</label>";
														$html[] = "<div class='input-icon mb-3'>";
															$html[] = "<span class='input-icon-addon'><i class='ti ti-building-estate'></i></span>";
															$html[] = "<select class='form-control' name='type' id='type'>";
																$offer_type = array("Residential","Commercial");
																foreach($offer_type as $key => $val) {
																	$sel = $val == $data['listing']['type'] ? "selected" : "";
																	$html[] = "<option value='".$val."' $sel>$val</option>";
																}
															$html[] = "</select>";
															$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
														$html[] = "</div>";
													$html[] = "</div>";

												$html[] = "</div>";
											$html[] = "</div>";

											$html[] = "<div class='row'>";
												$html[] = "<div class='col-md-4 col-lg-4 col-12'>";
													$html[] = "<div class='form-group mb-3'>";
														$html[] = "<label class='form-label text-muted'>Bedroom</label>";
														$html[] = "<div class='input-icon mb-3'>";
															$html[] = "<span class='input-icon-addon'><i class='ti ti-bed-flat'></i></span>";
															$html[] = "<select class='form-select' name='bedroom' id='bedroom'>";
																$sel = "Studio" == $data['listing']['bedroom'] ? "selected" : (0 == $data['listing']['bedroom'] ? "selected" : "");
																$html[] = "<option value='0' $sel>No Bedroom</option>";
																$html[] = "<option value='Studio' $sel>Studio</option>";
																for($i=1; $i<11; $i++) {
																	$sel = $i == $data['listing']['bedroom'] ? "selected" : "";
																	$html[] = "<option value='$i' $sel>$i Bedroom</option>";
																}
															$html[] = "</select>";
															$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
														$html[] = "</div>";
													$html[] = "</div>";
												$html[] = "</div>";
												$html[] = "<div class='col-md-4 col-lg-4 col-12'>";
													$html[] = "<div class='form-group mb-3'>";
														$html[] = "<label class='form-label text-muted'>Bathroom</label>";
														$html[] = "<div class='input-icon mb-3'>";
															$html[] = "<span class='input-icon-addon'><i class='ti ti-bath'></i></span>";
															$html[] = "<select class='form-select' name='bathroom' id='bathroom'>";
																for($i=0; $i<11; $i++) {
																	$sel = $i == $data['listing']['bathroom'] ? "selected" : "";
																	$html[] = "<option value='$i' $sel>".($i == 0 ? "No" : $i)." Bathroom</option>";
																}
															$html[] = "</select>";
															$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
														$html[] = "</div>";
													$html[] = "</div>";
												$html[] = "</div>";
												$html[] = "<div class='col-md-4 col-lg-4 col-12'>";
													$html[] = "<div class='form-group mb-3'>";
														$html[] = "<label class='form-label text-muted'>Car Garage</label>";
														$html[] = "<div class='input-icon mb-3'>";
															$html[] = "<span class='input-icon-addon'><i class='ti ti-car-garage'></i></span>";
															$html[] = "<select class='form-select' name='parking' id='parking'>";
																for($i=0; $i<11; $i++) {
																	$sel = $i == $data['listing']['parking'] ? "selected" : "";
																	$html[] = "<option value='$i' $sel>".($i == 0 ? "No Garage" : $i." car slot")."</option>";
																}
															$html[] = "</select>";
															$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
														$html[] = "</div>";
													$html[] = "</div>";
												$html[] = "</div>";
											$html[] = "</div>";
											
											$html[] = "<div class='row'>";

												$tech_details = array("floor_area","lot_area");
												foreach($tech_details as $details) {
													$label = ucwords(str_replace("_"," ",$details));
													$html[] = "<div class='col-md-6 col-lg-6 col-12'>";
														$html[] = "<div class='mb-3'>";
															$html[] = "<label class='form-label text-muted'>$label</label>";
															$html[] = "<div class='input-icon mb-3'>";
																$html[] = "<input type='text' name='$details' id='$details' value='".$data['listing'][$details]."' class='form-control' placeholder='$label' />";
																$html[] = "<span class='input-icon-addon'><small>sq.m <i class='ti ti-ruler me-1'></i></small></span>";
															$html[] = "</div>";
														$html[] = "</div>";
													$html[] = "</div>";
												}

											$html[] = "</div>";

											$html[] = "<div class='form-group mb-3'>";
												$html[] = "<label class='form-label text-muted'>Tags</label>";
												$html[] = "<div class='input-icon mb-3'>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-building-cottage'></i></span>";
													$html[] = "<select class='form-select' name='tags[]' id='tags' multiple='multiple'>";
														/** Additional tags can be add in /includes/define.php */
														foreach(CONFIG['property_tags'] as $key => $val) {
															$sel = in_array($val, ($data['listing']['tags'] != "" ? $data['listing']['tags'] : [])) ? "selected" : "";
															$html[] = "<option value='$val' $sel>$val</option>";
														}
													$html[] = "</select>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
												$html[] = "</div>";
											$html[] = "</div>";

											$html[] = "<div class='form-group mb-3'>";
												$html[] = "<label class='form-label text-muted'>Address</label>";
												$html[] = $model->address->addressSelection($data['listing']['address']);
											$html[] = "</div>";

											$html[] = "<div class='mb-3 street-input'>";
												$html[] = "<label class='form-label text-muted'>Street</label>";
												$html[] = "<input type='text' name='address[street]' id='address_street' value='".$data['listing']['address']['street']."' class='form-control' />";
											$html[] = "</div>";

											$html[] = "<div class='mb-3 village-input'>";
												$html[] = "<label class='form-label text-muted'>Village / Building</label>";
												$html[] = "<input type='text' name='address[village]' id='address_village' value='".$data['listing']['address']['village']."' class='form-control' />";
											$html[] = "</div>";

										$html[] = "</div>";
									$html[] = "</div>";

									$html[] = "<div class='amenities-wrap mt-3'>";
										$html[] = "<div class='form-group'>";
											$html[] = "<label class='form-label text-muted'><i class='ti ti-home-shield me-2'></i> Features and Amenities</label>";
											
											$amenities = $model->amenities();
											$amenities_data = explode(",",$data['listing']['amenities']);
											
											$html[] = "<div class=' p-4 border  bg-yellow-lt text-dark'>";
												$html[] = "<div class='row'>";
													for($i=0; $i<count($amenities); $i++) {
													
														$check = in_array($amenities[$i],$amenities_data) ? "checked" : "";
													
														$html[] = "<div class='col-lg-3 col-md-4 col-sm-6 col-6'>";
															$html[] = "<label class='form-check cursor-pointer'>";
																$html[] = "<input type='checkbox' class='form-check-input' id='customCheck_$i' name='amenities[]' value='".$amenities[$i]."' $check>";
																$html[] = "<span class='form-check-label' for='customCheck_$i'>".$amenities[$i]."</span>";
															$html[] = "</label>";
														$html[] = "</div>";

													}
												$html[] = "</div>";
											$html[] = "</div>";
											
										$html[] = "</div>";
									$html[] = "</div>";
									
								$html[] = "</div>";
								
								$html[] = "<div id='payment_details' class='tab-pane '>";
									/***** PAYMNENT DETAILS *****/
								
									$html[] = "<div class='row justify-content-center py-3'>";
										$html[] = "<div class='col-md-8 col-lg-8 col-12'>";

											$html[] = "<div class='form-group mb-3'>";
												$html[] = "<label class='form-label text-muted'>Price</label>";
												$html[] = "<div class='input-icon mb-1'>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-currency-peso'></i></span>";
													$html[] = "<input type='number' name='price' id='price' value='".$data['listing']['price']."' step='0.05' class='form-control' placeholder='Price' />";
												$html[] = "</div>";
											$html[] = "</div>";

											$html[] = "<div class='form-group mb-4'>";
												$html[] = "<label class='form-label text-muted'>Reservation Fee / Option Money</label>";
												$html[] = "<div class='input-icon mb-1'>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-currency-peso'></i></span>";
													$html[] = "<input type='number' name='reservation' id='reservation' value='".$data['listing']['reservation']."' step='0.05' class='form-control' placeholder='Reservation' />";
												$html[] = "</div>";
												$html[] = "<span class='form-hint'>Option money is a payment made by a buyer to secure the exclusive right to purchase a property within a set timeframe</span>";
											$html[] = "</div>";

											$html[] = "<div class='form-group mb-4'>";
												$html[] = "<label class='form-label text-muted'>Option Money Days Durations</label>";
												$html[] = "<select name='payment_details[option_money_duration]' id='option_money_duration' class='form-select'>";
												    foreach(range(15, 90, 15) as $duration) {
														$sel = $duration == (isset($data['listing']['payment_details']['option_money_duration']) ? $data['listing']['payment_details']['option_money_duration'] : "") ? "selected" : "";
														$html[] = "<option value='$duration' $sel>$duration days</option>";
													}
												$html[] = "</select>";
												$html[] = "<span class='form-hint'>Duration of exclusive right to purchase</span>";
											$html[] = "</div>";

											$html[] = "<div class='form-group mb-4'>";
												$html[] = "<label class='form-label text-muted'>Mode of Payment</label>";
												$html[] = "<select name='payment_details[payment_mode]' id='payment_mode' class='form-select'>";
												    foreach(["Installment", "Cash"] as $mode) {
														$sel = $mode == (isset($data['listing']['payment_details']['payment_mode']) ? $data['listing']['payment_details']['payment_mode'] : "") ? "selected" : "";
														$html[] = "<option value='$mode' $sel>$mode</option>";
													}
												$html[] = "</select>";
												$html[] = "<span class='form-hint'>The mode of payment refers to the method or manner in which a financial transaction is completed, such as cash or installment payment.</span>";
											$html[] = "</div>";

											$html[] = "<div class='form-group mb-5'>";
												$html[] = "<label class='form-label text-muted'>Allocation of Taxes</label>";
												$html[] = "<select name='payment_details[tax_allocation]' id='tax_allocation' class='form-select'>";
													foreach(["Seller Agrees to Pay Capital Gains Tax and Buyer Pays Transfer Tax", "Buyer Pays Capital Gains Tax, Transfer Tax and Broker Commission"] as $schedule) {
														$sel = $schedule == (isset($data['listing']['payment_details']['tax_allocation']) ? $data['listing']['payment_details']['tax_allocation'] : "") ? "selected" : "";
														$html[] = "<option value='$schedule' $sel>$schedule</option>";
													}
												$html[] = "</select>";
												$html[] = "<span class='form-hint'>Agreement between the seller and the buyer regarding who is responsible for paying which taxes.</span>";
											$html[] = "</div>";

											$html[] = "<div class='form-group mb-4'>";
												$html[] = "<label class='form-check form-switch cursor-pointer'>";
													$html[] = "<input class='form-check-input' type='checkbox' name='payment_details[bank_loan]' value='1' id='bank_loan' ".((isset($data['listing']['payment_details']['bank_loan']) ? $data['listing']['payment_details']['bank_loan'] : 0) == 1 ? "checked" : "")." />";
													$html[] = "<span class='form-check-label' for='bank_loan'>Is the property eligible for a Bank loan?</span>";
												$html[] = "</label>";
											$html[] = "</div>";

											$html[] = "<div class='form-group mb-4'>";
												$html[] = "<label class='form-check form-switch cursor-pointer'>";
													$html[] = "<input class='form-check-input' type='checkbox' name='payment_details[pagibig_loan]' value='1' id='pagibig_loan' ".((isset($data['listing']['payment_details']['pagibig_loan']) ? $data['listing']['payment_details']['pagibig_loan'] : 0) == 1 ? "checked" : "")." />";
													$html[] = "<span class='form-check-label' for='pagibig_loan'>Is the property eligible for a Pag-IBIG housing loan?</span>";
												$html[] = "</label>";
											$html[] = "</div>";

											$html[] = "<div class='form-group mb-4'>";
												$html[] = "<label class='form-check form-switch cursor-pointer'>";
													$html[] = "<input class='form-check-input' type='checkbox' name='payment_details[assume_balance]' value='1' id='assume_balance' ".((isset($data['listing']['payment_details']['assume_balance']) ? $data['listing']['payment_details']['assume_balance'] : 0) == 1 ? "checked" : "")." />";
													$html[] = "<span class='form-check-label' for='assume_balance'>Will the buyer assume the remaining loan balance? \"Assume Balance\"</span>";
													$html[] = "<span class='form-hint'>Buyer takes over the seller's existing mortgage instead of getting a new one</span>";
												$html[] = "</label>";
											$html[] = "</div>";
																	
											
											/* $html[] = "<div class='form-group mb-3'>";
												$html[] = "<label class='form-label text-muted'>Monthly Down Payment</label>";
												$html[] = "<div class='input-icon mb-3'>";
														$html[] = "<span class='input-icon-addon'><i class='ti ti-currency-peso'></i></span>";
														$html[] = "<input type='number' name='monthly_downpayment' id='monthly_downpayment' value='".$data['listing']['monthly_downpayment']."' step='0.05' class='form-control' placeholder='Monthly Downpayment' />";
												$html[] = "</div>";
											$html[] = "</div>";
											
											$html[] = "<div class='form-group mb-3'>";
												$html[] = "<label class='form-label text-muted'>Monthly Amortization</label>";
												$html[] = "<div class='input-icon mb-3'>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-currency-peso'></i></span>";
													$html[] = "<input type='number' name='monthly_amortization' id='monthly_amortization' value='".$data['listing']['monthly_amortization']."' step='0.05' class='form-control' placeholder='Monthly Amortization' />";
												$html[] = "</div>";
											$html[] = "</div>"; */

										$html[] = "</div>";
									$html[] = "</div>";
									
								$html[] = "</div>";
								
								$html[] = "<div id='images_list' class='tab-pane '>";
									/***** IMAGES *****/
									
									$html[] = "<div class='row py-3'>";
										$html[] = "<div class='col-lg-8 col-md-8 col-12'>";

											$html[] = "<div class='card mb-3 bg-dark-lt'>";
												$html[] = "<div class='card-body'>";
													$html[] = "<div class='text-center'>";
														$html[] = "<p style='' class='p-0 m-0'>";
														$html[] = "<span class='photo-upload-loader'></span>";
														$html[] = "<span class='btn btn-dark btn-photo-browse'><i class='ti ti-upload me-2'></i> Upload Images</span></p>";
													$html[] = "</div>";
												$html[] = "</div>";
											$html[] = "</div>";
											
											$html[] = "<div class='upload-response'></div>";
											
											$html[] = "<div class='' style='max-height:520px; overflow-y:auto;'>";
												$html[] = "<div class='d-flex flex-wrap justify-content-center images-container m-0'>";
													
													if($data['listing']['images']) {
														for($i=0; $i<count($data['listing']['images']); $i++) {
														
															$html[] = "<div class='me-2 mb-3 image_".$data['listing']['images'][$i]['image_id']."'>";
																
																$html[] = "<input type='hidden' name='listing_image_filename[$i][width]' value='".$data['listing']['images'][$i]['width']."' />";
																$html[] = "<input type='hidden' name='listing_image_filename[$i][height]' value='".$data['listing']['images'][$i]['height']."' />";
																$html[] = "<input type='hidden' name='listing_image_filename[$i][name]' value='".$data['listing']['images'][$i]['filename']."' />";
																$html[] = "<div class='' style=\"background-image:url('".CDN."/images/listings/".$data['listing']['images'][$i]['filename']."'); background-repeat: no-repeat; background-size: cover; width:180px;height:180px; \"></div>";
																$html[] = "<div class='btn-group mt-2'>";
																	$html[] = "<span class='btn btn-outline-secondary btn-remove-image' title='Remove image' onclick=\"removeImage('.image_".$data['listing']['images'][$i]['image_id']."','".$data['listing']['images'][$i]['image_id']."','".$data['listing']['images'][$i]['filename']."','listings')\"><i class='ti ti-trash'></i></span>";
																	
																	if($thumb_img == $data['listing']['images'][$i]['filename']) {
																		$html[] = "<span class='btn btn-success btn-set-thumb-image' title='Set image as thumbnail' onclick=\"setImageThumb('.image_".$data['listing']['images'][$i]['image_id']."','".$data['listing']['images'][$i]['filename']."')\"><i class='ti ti-check'></i> Thumbnail</span>";
																	}else {
																		$html[] = "<span class='btn btn-outline-primary btn-set-thumb-image' title='Set image as thumbnail' onclick=\"setImageThumb('.image_".$data['listing']['images'][$i]['image_id']."','".$data['listing']['images'][$i]['filename']."')\"><i class='ti ti-click'></i> Thumbnail</span>";
																	}
																	
																$html[] = "</div>";
																
															$html[] = "</div>";
														}
													}
													
												$html[] = "</div>";
											$html[] = "</div>";
												
										$html[] = "</div>";

										$html[] = "<div class='col-lg-4 col-md-4 d-md-block d-none'>";

											$html[] = "<div class='card mb-3'>";

												$html[] = "<div class='card-status-top bg-azure'></div>";
												$html[] = "<div class='card-stamp'>";
													$html[] = "<div class='card-stamp-icon bg-azure'><i class='ti ti-info-circle'></i></div>";
												$html[] = "</div>";

												$html[] = "<div class='card-body'>";
													$html[] = "<p>Please read the following before uploading images</p>";
													$html[] = "<ul class='list-group'>";
														$html[] = "<li class='list-group-item'><i class='ti ti-arrow-badge-right me-2 text-danger'></i>Only .jpg, .png, .gif are allowed</li>";
														$html[] = "<li class='list-group-item'><i class='ti ti-arrow-badge-right me-2 text-danger'></i>Select 5 or less images per upload</li>";
														$html[] = "<li class='list-group-item'><i class='ti ti-arrow-badge-right me-2 text-danger'></i>Images less than 2MB file sizes are allowed</li>";
														$html[] = "<li class='list-group-item'><i class='ti ti-arrow-badge-right me-2 text-danger'></i>Resize your images before uploading</li>";
														$html[] = "<li class='list-group-item'><i class='ti ti-arrow-badge-right me-2 text-danger'></i>For website compatibility, only upload landscape images</li>";
													$html[] = "</ul>";
												$html[] = "</div>";
											$html[] = "</div>";

										$html[] = "</div>";
									$html[] = "</div>";

								$html[] = "</div>";

								$html[] = "<div id='docs_list' class='tab-pane '>";
									/***** DOCUMENTS *****/
									
									$html[] = "<div class='row py-3'>";
										$html[] = "<div class='col-lg-8 col-md-8 col-12'>";

											$html[] = "<div class='card mb-3 bg-dark-lt'>";
												$html[] = "<div class='card-body'>";
													$html[] = "<div class='text-center'>";
														$html[] = "<p style='' class='p-0 m-0'>";
														$html[] = "<span class='document-upload-loader'></span>";
														$html[] = "<span class='btn btn-dark btn-document-browse'><i class='ti ti-upload me-2'></i> Upload Documents</span></p>";
													$html[] = "</div>";
												$html[] = "</div>";
											$html[] = "</div>";
											
											$html[] = "<div class='upload-response mb-3'></div>";
											
											$html[] = "<div class='' style='max-height:520px; overflow-y:auto;'>";
												$html[] = "<ul class='list-group list-group-flush document_list'>";
													
													if($data['listing']['documents']) {
														for($i=0; $i<count($data['listing']['documents']); $i++) {
															$html[] = "<li class='list-group-item d-flex gap-3 justify-content-between align-items-center py-1 file_$i'>";
																$html[] = "<div class='flex-grow-1'>";
																	$html[] = "<input type='hidden' name='documents[]' id='document_$i' value='".$data['listing']['documents'][$i]."' />";
																	$html[] = "<span>".$data['listing']['documents'][$i]."</span>";
																$html[] = "</div>";
																$html[] = "<div class='btn-list'>";
																	$html[] = "<span class='btn btn-danger' data-number='$i' data-filename='".$data['listing']['documents'][$i]."' data-url='".url("ListingsController@removeDocument", $data['listing']['listing_id'], ["filename" => $data['listing']['documents'][$i]])."'><i class='ti ti-trash me-1'></i> Delete</span>";
																$html[] = "</div>";
															$html[] = "</li>";
														}
													}
													
												$html[] = "</ul>";
											$html[] = "</div>";
												
										$html[] = "</div>";

										$html[] = "<div class='col-lg-4 col-md-4 d-md-block d-none'>";

											$html[] = "<div class='card mb-3'>";

												$html[] = "<div class='card-status-top bg-azure'></div>";
												$html[] = "<div class='card-stamp'>";
													$html[] = "<div class='card-stamp-icon bg-azure'><i class='ti ti-info-circle'></i></div>";
												$html[] = "</div>";

												$html[] = "<div class='card-body'>";
													$html[] = "<p>Please read the following before uploading images</p>";
													$html[] = "<ul class='list-group'>";
														$html[] = "<li class='list-group-item'><i class='ti ti-arrow-badge-right me-2 text-danger'></i>Only .pdf file is allowed</li>";
														$html[] = "<li class='list-group-item'><i class='ti ti-arrow-badge-right me-2 text-danger'></i>Rename your pdf file before uploading</li>";
														$html[] = "<li class='list-group-item'><i class='ti ti-arrow-badge-right me-2 text-danger'></i>Select 5 or less pdf file per upload</li>";
														$html[] = "<li class='list-group-item'><i class='ti ti-arrow-badge-right me-2 text-danger'></i>Pdf files less than 3MB file sizes are allowed</li>";
													$html[] = "</ul>";
												$html[] = "</div>";
											$html[] = "</div>";

										$html[] = "</div>";
									$html[] = "</div>";

								$html[] = "</div>";

								$html[] = "<div id='settings' class='tab-pane '>";
									/***** SETTINGS *****/
									
									$html[] = "<div class='row justify-content-center py-3'>";
										$html[] = "<div class='col-md-8 col-lg-8 col-12'>";

											/* $html[] = "<div class='mb-3'>";
												$html[] = "<label class='form-label text-muted'>Posting Duration</label>";
												$html[] = "<div class='input-icon '>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-calendar'></i></span>";
													$html[] = "<select name='duration' id='duration' class='form-select'>";
														$durations = array(15, 30, 60, 90);
														foreach($durations as $days) {
															$sel = $days == $data['listing']['duration'] ? "selected" : "";
															$html[] = "<option value='".strtotime("+".$days, DATE_NOW)."' $sel>$days days</option>";
														}
													$html[] = "</select>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
												$html[] = "</div>";
											$html[] = "</div>"; */

											$html[] = "<div class='mb-5'>";		
												$html[] = "<label class='form-label text-muted'>Video (Youtube Url)</label>";
												$html[] = "<div class='input-group mb-3'>";
													$html[] = "<span class='input-group-text' id='basic-addon1'><i class='ti ti-brand-youtube'></i></span>";
													$html[] = "<input type='text' name='video' id='youtube_url' class='form-control' value='".$data['listing']['video']."' placeholder='https://www.youtube.com/watch?v=uiZVssPtPr4' aria-label='Youtube Url' aria-describedby='basic-addon1'>";
												$html[] = "</div>";
												$html[] = "<span class='form-hint'>Sample Youtube Url: <span class='p-2 border border-red fst-italic ms-2'>https://www.youtube.com/watch?v=uiZVssPtPr4</span></span>";
											$html[] = "</div>";

											$html[] = "<div class='mb-4'>";
												$html[] = "<label class='form-label text-muted'>Property Status</label>";
												$html[] = "<div class='input-icon '>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-status-change'></i></span>";
													$html[] = "<select name='status' id='status' class='form-select'>";
														$statuses = array(1=>"Available",2=>"Sold");
														foreach($statuses as $key => $val) {
															$sel = $key == $data['listing']['status'] ? "selected" : "";
															$html[] = "<option value='$key' $sel>$val</option>";
														}
													$html[] = "</select>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
												$html[] = "</div>";
											$html[] = "</div>";
											
												$html[] = "<div class='px-4 py-3 bg-yellow-lt border mb-5 sold-price-input d-none'>";
													$html[] = "<label class='form-label text-muted'>Sold Price</label>";
													$html[] = "<div class='input-icon mb-2'>";
														$html[] = "<span class='input-icon-addon'><i class='ti ti-currency-peso'></i></span>";
														$html[] = "<input type='number' name='sold_price' id='sold_price' value='".($data['listing']['sold_price'] == 0 ? $data['listing']['price'] : $data['listing']['sold_price'])."' class='form-control' placeholder='Sold Price' />";
													$html[] = "</div>";
													$html[] = "<span class='form-hint'>Please specify the amount at which the property was sold.</span>";
												$html[] = "</div>";
											

											$html[] = "<div class='form-group mb-3'>";
												$html[] = "<label class='form-check form-switch cursor-pointer'>";
													$html[] = "<input class='form-check-input' type='checkbox' name='foreclosed' value='1' id='foreclosure' ".($data['listing']['foreclosed'] == 1 ? "checked" : "")." />";
													$html[] = "<span class='form-check-label' for='foreclosure'>Is this property a foreclosure?</span>";
												$html[] = "</label>";
											$html[] = "</div>";
													
											$html[] = "<div class='form-group mb-4'>";
												$html[] = "<label class='form-check form-switch cursor-pointer'>";
													$html[] = "<input class='form-check-input cursor-pointer' name='is_website' type='checkbox' value='1' id='is_website' ".($data['listing']['is_website'] == 1 ? "checked" : "")."  />";
													$html[] = "<span class='form-check-label cursor-pointer' for='is_website'>Publish this property listing on the website.</span>";
												$html[] = "</label>";
											$html[] = "</div>";

											if(isset($_SESSION['user_logged']['privileges']['mls_access']) && $_SESSION['user_logged']['privileges']['mls_access'] >= 1) {
												$html[] = "<div class='form-group mb-2'>";
													$html[] = "<label class='form-check form-switch cursor-pointer'>";
														$html[] = "<input class='form-check-input cursor-pointer' name='is_mls' type='checkbox' value='1' id='is_mls' ".($data['listing']['is_mls'] == 1 ? "checked" : "")." />";
														$html[] = "<span class='form-check-label cursor-pointer' for='is_mls'>Display this property listing on the Multiple Listing Service (MLS)</span>";
													$html[] = "</label>";
												$html[] = "</div>";

												$html[] = "<div class='px-3 mb-4'>";

													$html[] = "<div class='form-group mb-2'>";
														$html[] = "<label class='form-check form-switch cursor-pointer'>";
															$html[] = "<input class='form-check-input cursor-pointer' name='is_mls_option[local_board]' type='checkbox' value='1' id='is_mls_local_board' ".((isset($data['listing']['is_mls_option']['local_board']) ? $data['listing']['is_mls_option']['local_board'] : 0) == 1 ? "checked" : "")." />";
															$html[] = "<span class='form-check-label cursor-pointer' for='mls_local_board'>Display this property listing on <b>Local Board's MLS</b></span>";
														$html[] = "</label>";
													$html[] = "</div>";

													$html[] = "<div class='form-group mb-2'>";
														$html[] = "<label class='form-check form-switch cursor-pointer'>";
															$html[] = "<input class='form-check-input cursor-pointer' name='is_mls_option[local_region]' type='checkbox' value='1' id='is_mls_local_region' ".((isset($data['listing']['is_mls_option']['local_region']) ? $data['listing']['is_mls_option']['local_region'] : 0) == 1 ? "checked" : "")." />";
															$html[] = "<span class='form-check-label cursor-pointer' for='mls_local_region'>Display this property listing on your <b>Local Board Region's MLS</b></span>";
														$html[] = "</label>";
													$html[] = "</div>";

													$html[] = "<div class='form-group mb-2'>";
														$html[] = "<label class='form-check form-switch cursor-pointer'>";
															$html[] = "<input class='form-check-input cursor-pointer' name='is_mls_option[all]' type='checkbox' value='1' id='is_mls_all' ".((isset($data['listing']['is_mls_option']['all']) ? $data['listing']['is_mls_option']['all'] : 0) == 1 ? "checked" : "")." />";
															$html[] = "<span class='form-check-label cursor-pointer' for='is_mls_all'>Display this property listing on <b>PAREB MLS Nation wide</b></span>";
														$html[] = "</label>";
													$html[] = "</div>";

												$html[] = "</div>";
											}

											$html[] = "<div class='mb-4'>";
												$html[] = "<label class='form-label text-muted'>Commission Sharing Details</label>";
												$html[] = "<div class='input-group mb-2'>";
													$html[] = "<span class='input-group-text'><i class='ti ti-percentage'></i></span>";
													/* $html[] = "<input type='number' name='com_share' id='com_share' value='".$data['listing']['other_details']["com_share"]."' step='0.5' class='form-control' placeholder='Commission Share' />"; */
													$html[] = "<select name='com_share' id='com_share' class='form-select'>";
														foreach(["25", "50", "75"] as $sharing) {
															$sel = $sharing == $data['listing']['other_details']["com_share"] ? "selected" : "";
															$html[] = "<option value='$sharing' $sel>$sharing</option>";
														}
													$html[] = "</select>";
												$html[] = "</div>";
												$html[] = "<span class='form-hint'>Please specify the percentage of commission you are prepared to distribute.</span>";
											$html[] = "</div>";

											$html[] = "<div class='mb-4'>";
												$html[] = "<label class='form-label text-muted'>What type of authority do you hold for this property?</label>";
												$html[] = "<div class='input-icon mb-3'>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-certificate'></i></span>";
													$html[] = "<select class='form-select' name='authority_type' id='authority_type'>";
														foreach(["N/A","Non-Exclusive Authority To Sell", "Exclusive Authority To Sell"] as $authority) {
															$sel = $data['listing']['other_details']["authority_type"] == $authority ? "selected" : "";
															$html[] = "<option value='$authority' $sel>".$authority."</option>";
														}
													$html[] = "</select>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
												$html[] = "</div>";
												$html[] = "<span class='form-hint'>The legal permission granted to an individual or entity to sell a property on behalf of the owner(s)</span>";
											$html[] = "</div>";

											$html[] = "<div class='mb-3'>";
												$html[] = "<label class='form-label text-muted'>Authority to Sell Expiration Date</label>";
												$html[] = "<div class='input-icon mb-2'>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-calendar'></i></span>";
													$html[] = "<input type='date' name='authority_to_sell_expiration' id='authority_to_sell_expiration' value='".(isset($data['listing']['other_details']["authority_to_sell_expiration"]) ? date("Y-m-d", $data['listing']['other_details']["authority_to_sell_expiration"]) : null)."' step='0.5' class='form-control' placeholder='Authority to Sell Expiration Date' />";
												$html[] = "</div>";
												$html[] = "<span class='form-hint'>Please specify the expiration date of your Authority to Sell for this property.</span>";
											$html[] = "</div>";

										$html[] = "</div>";
									$html[] = "</div>";
									
								$html[] = "</div>";
								
							$html[] = "</div>"; /*** TAB CONTENT END ***/
						$html[] = "</div>";
					$html[] = "</div>";
					
				$html[] = "</form>";
			
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='btn-save-container fixed-bottom bg-white py-3 border-top'>";
	$html[] = "<div class='row g-0 justify-content-center'>";
		$html[] = "<div class='col-lg-8 col-md-8 col-sm-12 col-12'>";

			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='text-end'>";
					$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy me-2'></i> Save Property Listing</span>";
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<script type='text/javascript'>";
	$html[] = "
	
	document.addEventListener('DOMContentLoaded', function () {
    	var el;
    	window.TomSelect && (new TomSelect(el = document.getElementById('tags'), {
    		copyClassesToDropdown: false,
    		dropdownParent: 'body',
    		controlInput: '<input>',
    		render:{
    			item: function(data,escape) {
    				if( data.customProperties ){
    					return '<div><span class=\"dropdown-item-indicator\">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
    				}
    				return '<div>' + escape(data.text) + '</div>';
    			},
    			option: function(data,escape){
    				if( data.customProperties ){
    					return '<div><span class=\"dropdown-item-indicator\">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
    				}
    				return '<div>' + escape(data.text) + '</div>';
    			},
    		},
    	}));
    });
	
	
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
				'".CDN."tabler/dist/css/tabler.min.css',
				'".CDN."tabler/dist/css/tabler-vendors.min.css?1695847769',
				'".CDN."css/site.style.css'
			]
		});
	});";
$html[] = "</script>";