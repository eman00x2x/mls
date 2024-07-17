<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<input type='hidden' id='save_url' value='".url("HandshakesController@saveUpdate", ["id" => $data['handshake_id']])."' />";

$html[] = "<div class='row g-0 justify-content-center mb-5 pb-5'>";
	$html[] = "<div class='col-lg-8 col-md-8 col-sm-12 col-12'>";

		$html[] = "<div class='page-header d-print-none text-white'>";
			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='row g-2 '>";
					$html[] = "<div class='col'>";
						$html[] = "<div class='page-pretitle'>Manage Property Listing </div>";
						$html[] = "<h1 class='page-title'><span class='stamp stamp-md me-1'><i class='ti ti-home me-1'></i></span> Update Handshake Listing</h1>";
					$html[] = "</div>";
					$html[] = "<div class='col-auto ms-auto d-print-none'>";
						$html[] = "<div class='page-options text-end'>";
							$html[] = "<div class='btn-list'>";
								
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

		/** START PAGE BODY */
		$html[] = "<div class='page-body'>";
			$html[] = "<div class='container-xl'>";

				$thumb_img = "";
				if($data['listing']['thumb_img'] != "") {
					$arr = explode("/", $data['listing']['thumb_img']);
					$thumb_img = array_pop($arr);
				}

				$html[] = "<form id='form' action='' method='POST'>";
					$html[] = "<input name='_method' id='_method' type='hidden' value='post' />";
					$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header pt-4'>";
							$html[] = "<ul class='nav nav-tabs card-header-tabs' data-bs-toggle='tabs' role='tablist'>";
								$html[] = "<li class='nav-item' role='pressentation'><a href='#property_description' 	class='pb-3 fw-bold text-blue nav-link active' data-bs-toggle='tab' aria-selected='true'><i class='ti ti-file-description me-2'></i> Property Description</a></li>";
								$html[] = "<li class='nav-item' role='pressentation'><a href='#payment_details' 		class='pb-3 fw-bold text-blue nav-link' data-bs-toggle='tab' aria-selected='false'><i class='ti ti-cash me-2'></i> Payment Details</a></li>";
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
														$html[] = "<input type='text' value='".ucwords($data['listing']['offer'])."' class='form-control fw-bold' placeholder='offer' readonly />";
													$html[] = "</div>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
												$html[] = "</div>";

												$html[] = "<div class='form-group flex-grow-1'>";
													$html[] = "<label class='form-label text-muted'>Title</label>";
													$html[] = "<div class='input-icon mb-1'>";
														$html[] = "<span class='input-icon-addon'><i class='ti ti-writing'></i></span>";
														$html[] = "<input type='text' value='".clean($data['listing']['title'])."' class='form-control' placeholder='Title' readonly />";
														
													$html[] = "</div>";
												$html[] = "</div>";
												
											$html[] = "</div>";
												
											$html[] = "<div class='form-group mb-3'>";
												$html[] = "<label class='form-label text-muted'>Description</label>";
												$html[] = "<textarea id='snow-container' name='requestor_listing_details[long_desc]' class='form-control'>".clean($data['requestor_listing_details']['long_desc'])."</textarea>";
												$html[] = "<span class='form-hint mt-3'>Please note that contact numbers, email addresses, names, and links are automatically removed.</span>";
											$html[] = "</div>";

										$html[] = "</div>";
									$html[] = "</div>";
									
								$html[] = "</div>";
								
								$html[] = "<div id='payment_details' class='tab-pane '>";
									/***** PAYMNENT DETAILS *****/
								
									$html[] = "<div class='row justify-content-center py-3'>";
										$html[] = "<div class='col-md-8 col-lg-8 col-12'>";

											$html[] = "<div class='mb-5'>";		
												$html[] = "<label class='form-label text-muted'>Listing posted until</label>";
												$html[] = "<div class='input-group mb-3'>";
													$html[] = "<span class='input-group-text' id='basic-addon1'><i class='ti ti-calendar'></i></span>";
													$html[] = "<input type='text' class='form-control' value='".date("d M Y", $data['listing']['duration'])."' readonly>";
												$html[] = "</div>";
											$html[] = "</div>";

											$html[] = "<div class='form-group mb-3'>";
												$html[] = "<label class='form-label text-muted'>Selling Price / TCP</label>";
												$html[] = "<div class='input-icon mb-1'>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-currency-peso'></i></span>";
													$html[] = "<input type='number' name='requestor_listing_details[price]' id='price' value='".$data['requestor_listing_details']['price']."' step='0.05' class='form-control' placeholder='Price' />";
												$html[] = "</div>";
												$html[] = "<span class='form-hint'>Original Price ".number_format($data['listing']['price'], 2)."</span>";
											$html[] = "</div>";

											$html[] = "<div class='form-group mb-4'>";
												$html[] = "<label class='form-label text-muted'>Reservation Fee / Option Money</label>";
												$html[] = "<div class='input-icon mb-1'>";
													$html[] = "<span class='input-icon-addon'><i class='ti ti-currency-peso'></i></span>";
													$html[] = "<input type='number' name='requestor_listing_details[reservation]' id='reservation' value='".$data['requestor_listing_details']['reservation']."' step='0.05' class='form-control' placeholder='Reservation' />";
												$html[] = "</div>";
												$html[] = "<span class='form-hint'>Option money is a payment made by a buyer to secure the exclusive right to purchase a property within a set timeframe. <span class='fw-bold d-block'>Original Option Money ".number_format($data['listing']['reservation'], 2)."</span></span>";
											$html[] = "</div>";

											$html[] = "<div class='form-group mb-4 brokerage-options'>";
												$html[] = "<label class='form-label text-muted'>Option Money Days Durations</label>";
												$html[] = "<input type='text' value='".(isset($data['listing']['payment_details']['option_money_duration']) ? $data['listing']['payment_details']['option_money_duration']." Days" : "Not Specified")."' step='0.05' class='form-control' placeholder='Allocation of Taxes' readonly />";
												$html[] = "<span class='form-hint'>Duration of exclusive right to purchase</span>";
											$html[] = "</div>";

											$html[] = "<div class='form-group mb-4 brokerage-options'>";
												$html[] = "<label class='form-label text-muted'>Mode of Payment</label>";
												$html[] = "<input type='text' value='".(isset($data['listing']['payment_details']['payment_mode']) ? $data['listing']['payment_details']['payment_mode'] : "Not Specified")."' step='0.05' class='form-control' placeholder='Allocation of Taxes' readonly />";
												$html[] = "<span class='form-hint'>The mode of payment refers to the method or manner in which a financial transaction is completed, such as cash or installment payment.</span>";
											$html[] = "</div>";

											$html[] = "<div class='form-group mb-5 brokerage-options'>";
												$html[] = "<label class='form-label text-muted'>Allocation of Taxes</label>";
												$html[] = "<input type='text' value='".(isset($data['listing']['payment_details']['tax_allocation']) ? $data['listing']['payment_details']['tax_allocation'] : "Not Specified")."' step='0.05' class='form-control' placeholder='Allocation of Taxes' readonly />";
												$html[] = "<span class='form-hint'>Agreement between the seller and the buyer regarding who is responsible for paying which taxes.</span>";
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
				'advlist lists charmap print preview anchor',
				'searchreplace visualblocks code fullscreen',
				'insertdatetime media table paste code wordcount'
			],
			toolbar: 'bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat code ',
			content_css: [
				'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
				'".CDN."tabler/dist/css/tabler.min.css',
				'".CDN."tabler/dist/css/tabler-vendors.min.css?1695847769',
				'".CDN."css/site.style.css'
			]
		});
	});";
$html[] = "</script>";