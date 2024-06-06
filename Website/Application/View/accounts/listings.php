<?php

function currentUrl($data, array $uri = []) {
	return url("AccountsController@profile", ["id" => $data['account_id'], "name" => sanitize($data['account_name']['firstname']."-".$data['account_name']['lastname']) ], $uri);
}

$html[] = "<div class='page-body mt-0'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='pb-5 my-4'>";

            if($data['logo'] != "") { $logo = $data['logo'];
			}else { $logo = CDN."images/blank-profile.png"; }

            $html[] = "<div class='card mb-3 d-md-none d-block'>";
                $html[] = "<div class='card-body text-center'>";
                    $html[] = "<div class='mb-3 ' >";
                        $html[] = "<span class='avatar avatar-xxl rounded' style='background-image: url(".$logo.")'></span>";
                    $html[] = "</div>";
                    $html[] = "<div class='card-title mb-0'>".$data['account_name']['firstname']." ".$data['account_name']['lastname']." ".$data['account_name']['suffix']."</div>";
                    $html[] = "<div class='text-secondary'>".$data['profession']."</div>";

                    $html[] = "<a href='".currentUrl($data)."' class='stretched-link'></a>";
                $html[] = "</div>";
            $html[] = "</div>";
			
			$html[] = "<div class='row g-4 justify-content-center'>";
                $html[] = "<div class='col-md-3 col-lg-3 d-none d-lg-block'>";

                    $html[] = "<div class='card mb-3'>";
                        $html[] = "<div class='card-body text-center'>";
                            $html[] = "<div class='mb-3 '>";
                                $html[] = "<span class='avatar avatar-xxl rounded' style='background-image: url(".$logo.")'></span>";
                            $html[] = "</div>";
                            $html[] = "<div class='card-title mb-0'>".$data['account_name']['firstname']." ".$data['account_name']['lastname']." ".$data['account_name']['suffix']."</div>";
                            $html[] = "<div class='text-secondary'>".$data['profession']."</div>";
                            
                            $html[] = "<a href='".currentUrl($data)."' class='stretched-link'></a>";
                        $html[] = "</div>";
                    $html[] = "</div>";

                    $html[] = "<div class='sidebar bg-white p-4 border'>";

                        $html[] = "<div class='filter-box'>";

                            $html[] = "<div class='d-flex justify-content-between align-items-center'>";
                                $html[] = "<h3>Filter Results</h3>";
                                $html[] = "<a href='".currentUrl($data)."' class='text-decoration-none'><i class='ti ti-trash'></i> Clear filter</a>";
                            $html[] = "</div>";

                            $html[] = "<form id='filter-form' action='' method='POST'>";

                                $html[] = "<div class='mb-4'>";
                                    $html[] = "<div class='form-label'>Offer</div>";
                                    $html[] = "<select name='offer' id='offer' class='form-select'>";
                                        foreach(["for sale", "for rent"] as $offer) {
                                            $sel = isset($model->page['uri']['offer']) && $model->page['uri']['offer'] == $offer ? "selected" : "";
                                            $html[] = "<option value='".$offer."' $sel>".ucwords($offer)."</option>";
                                        }
                                    $html[] = "</select>";
                                $html[] = "</div>";

                                $html[] = "<div class='mb-4'>";
                                    $html[] = "<div class='form-label text-muted'>Address</div>";
                                    $html[] = $model->address;
                                    $html[] = "</div>";

                                $html[] = "<div class='mb-4'>";
                                    $html[] = "<div class='form-label'>Category</div>";
                                    $html[] = $model->categorySelection((isset($model->page['uri']['category']) ? $model->page['uri']['category'] : null));
                                $html[] = "</div>";

                                $html[] = "<div class='form-label'>Price</div>";
                                $html[] = "<div class='mb-4'>";
                                    $html[] = "<select name='price' id='price' class='form-select'>";
                                        
                                        if($model->page['uri']['offer'] == "for rent") {
                                            $price_range = explode(",", "0 - Below 10000, 10000 - 20000, 20001 - 40000, 40001 - 60000, 60001 - 100000, 100001 - 1000000, 1000001 and above - 00");
                                        }else {
                                            $price_range = explode(",", "0 - Below 1000000, 1000001 - 3000000, 3000001 - 6000000, 6000001 - 10000000, 10000001 - 15000000, 15000001 - 25000000, 25000001 - 35000000, 35000001 - 45000000, 45000001 - 50000000, 50000001 - 80000000, 80000001 - 100000000, 100000001 - 120000000, 120000001 - 140000000, 140000001 - 160000000, 160000001 - 180000000, 180000001 - 200000000, 200000001 - 230000000, 230000001 - 260000000, 260000001 - 290000000, 310000001 - 350000000, 350000001 and above - 00");
                                        }
                                    
                                        $html[] = "<option value=''></option>";
                                        foreach($price_range as $range) {

                                            $price_val = trim(str_replace(["Below", "and above", " "],["","", ""], $range));
                                            $sel = isset($model->page['uri']['price']) && $model->page['uri']['price'] == $price_val ? "selected" : "";

                                            $price = explode(" - ", str_replace(["sqm", "Below", "and above"],"", $range));

                                            $r1 = ($price[0] == "0" ? "Below" : "&#8369;".number_format($price[0],0)." - ");
                                            $r2 = ($price[1] == "00" ? "and above " : "&#8369;".number_format($price[1],0)."");

                                            $html[] = "<option value='".$price_val."' $sel>".$r1." ".$r2."</option>";
                                        }
                                    $html[] = "</select>";
                                $html[] = "</div>";

                                $html[] = "<div class='d-flex gap-2'>";
                                    $html[] = "<div class='mb-4'>";
                                        $html[] = "<div class='form-label'>Land Area</div>";
                                        $html[] = "<select name='lot_area' id='lot_area' class='form-select'>";
                                            $html[] = "<option value=''></option>";
                                            foreach(["0 - Below 100sqm", "101sqm - 200sqm", "201sqm - 300sqm", "301sqm - 400sqm", "401sqm - 500sqm", "501sqm - 1000sqm", "1001sqm - 2000sqm", "2001sqm - 5000sqm", "5001sqm - 10000sqm", "10001sqm and above - 00",] as $range) {
                                                
                                                $land_area = trim(str_replace(["Below", "and above", "sqm", " "],["","", "", ""], $range));
                                                $sel = isset($model->page['uri']['lot_area']) && $model->page['uri']['lot_area'] == $land_area ? "selected" : "";

                                                $area = explode(" - ", str_replace(["sqm", "Below", "and above"],"", $range));
                                                $r1 = ($area[0] == 0 ? "Below" : number_format($area[0],0)."sqm");
                                                $r2 = ($area[1] == "00" ? "above " : number_format($area[1],0)."sqm");

                                                $html[] = "<option value='".$land_area."' $sel>".$r1." - ".$r2."</option>";
                                            }
                                        $html[] = "</select>";
                                    $html[] = "</div>";

                                    $html[] = "<div class='mb-4'>";
                                        $html[] = "<div class='form-label'>Floor Area</div>";
                                        $html[] = "<select name='floor_area' id='floor_area' class='form-select'>";
                                            $html[] = "<option value=''></option>";
                                            foreach(["0 - Below 100sqm", "101sqm - 200sqm", "201sqm - 300sqm", "301sqm - 400sqm", "401sqm - 500sqm", "501sqm - 1000sqm", "1001sqm - 2000sqm", "2001sqm - 5000sqm", "5001sqm - 10000sqm", "10001sqm and above - 00",] as $range) {
                                                
                                                $floor_area = trim(str_replace(["Below", "and above", "sqm", " "],["","", "", ""], $range));
                                                $sel = isset($model->page['uri']['floor_area']) && $model->page['uri']['floor_area'] == $floor_area ? "selected" : "";
                                                
                                                $area = explode(" - ", str_replace(["sqm", "Below", "and above"],"", $range));
                                                $r1 = ($area[0] == 0 ? "Below" : number_format($area[0],0)." sqm");
                                                $r2 = ($area[1] == "00" ? "above " : number_format($area[1],0)." sqm");
                                                $html[] = "<option value='".$floor_area."' $sel>".$r1." - ".$r2."</option>";
                                            }

                                        $html[] = "</select>";
                                    $html[] = "</div>";
                                $html[] = "</div>";

                                $html[] = "<div class='d-flex gap-2'>";
                                    $html[] = "<div class='mb-4'>";
                                        $html[] = "<div class='form-label'>Bedroom</div>";
                                        $html[] = "<select name='bedroom' id='bedroom' class='form-select'>";
                                            $html[] = "<option value=''></option>";
                                            foreach(["Studio", "1 Bedroom", "2 Bedroom", "3 Bedroom", "4 Bedroom", "5 Bedroom", "6 and more Bedroom"] as $room) {
                                                $bedroom_val = trim(str_replace(["Bedroom", "and more"],["",""], $room));
                                                $sel = isset($model->page['uri']['bedroom']) && $model->page['uri']['bedroom'] == $bedroom_val ? "selected" : "";
                                                $html[] = "<option value='".$bedroom_val."' $sel>$room</option>";
                                            }

                                        $html[] = "</select>";
                                    $html[] = "</div>";

                                    $html[] = "<div class='mb-4'>";
                                        $html[] = "<div class='form-label'>Bathroom</div>";
                                        $html[] = "<select name='bathroom' id='bathroom' class='form-select'>";
                                            $html[] = "<option value=''></option>";
                                            foreach(["1 Bathroom", "2 Bathroom", "3 Bathroom", "4 Bathroom", "5 Bathroom", "6 and more Bathroom"] as $room) {
                                                $bathroom = trim(str_replace(["Bathroom", "and more"],["",""], $room));
                                                $sel = isset($model->page['uri']['bathroom']) && $model->page['uri']['bathroom'] == $bathroom ? "selected" : "";
                                                $html[] = "<option value='".$bathroom."' $sel>$room</option>";
                                            }
                                        $html[] = "</select>";
                                    $html[] = "</div>";

                                    $html[] = "<div class='mb-4'>";
                                        $html[] = "<div class='form-label'>Garage</div>";
                                        $html[] = "<select name='parking' id='parking' class='form-select'>";
                                            $html[] = "<option value=''></option>";
                                            foreach(["1 Car Space", "2 Car Space", "3 Car Space", "4 Car Space", "5 Car Space", "6 and more Car Space"] as $space) {
                                                $parking = trim(str_replace(["Car Space", "and more"],["",""], $space));
                                                $sel = isset($model->page['uri']['parking']) && $model->page['uri']['parking'] == $parking ? "selected" : "";
                                                $html[] = "<option value='".$parking."' $sel>$space</option>";
                                            }
                                        $html[] = "</select>";
                                    $html[] = "</div>";
                                $html[] = "</div>";

                                $html[] = "<div class='form-label'>Features & Amenities</div>";
                                $html[] = "<div class='mb-4'>";
                                    $html[] = "<div class='overflow-auto border p-3 bg-white' style='min-height:100px; max-height:200px;'>";
                                        foreach($model->amenities() as $amenities) {
                                            $checked = isset($model->page['uri']['amenities']) && in_array($amenities, $model->page['uri']['amenities']) ? "checked" : "";										
                                            $html[] = "<label class='form-check cursor-pointer'>";
                                                $html[] = "<input type='checkbox' class='form-check-input' name='amenities[]' value='$amenities' $checked />";
                                                $html[] = "<span class='form-check-label'>$amenities</span>";
                                            $html[] = "</label>";
                                        }
                                    $html[] = "</div>";
                                $html[] = "</div>";

                                $html[] = "<div class='form-label'>Tags</div>";
                                $html[] = "<div class='mb-4'>";
                                    $html[] = "<div class='overflow-auto border p-3 bg-white' style='min-height:100px; max-height:200px;'>";
                                        foreach(PROPERTY_TAGS as $tag) {
                                            $checked = isset($model->page['uri']['tags']) && in_array($tag, $model->page['uri']['tags']) ? "checked" : "";										
                                            $html[] = "<label class='form-check cursor-pointer $checked'>";
                                                $html[] = "<input type='checkbox' class='form-check-input' name='tags[]' value='$tag' $checked />";
                                                $html[] = "<span class='form-check-label'>$tag</span>";
                                            $html[] = "</label>";
                                        }
                                    $html[] = "</div>";
                                $html[] = "</div>";

                                $html[] = "<div class='form-label'>Include Foreclosure Property?</div>";
                                $html[] = "<div class='mb-4'>";
                                    $html[] = "<label class='form-check form-switch cursor-pointer'>";
                                        $html[] = "<input type='checkbox' name='foreclosed' id='foreclosed'  value='1' class='form-check-input'>";
                                        $html[] = "<span class='form-check-label form-check-label-on'>Yes</span>";
                                        $html[] = "<span class='form-check-label form-check-label-off'>No</span>";
                                    $html[] = "</label>";
                                    $html[] = "<div class='small text-secondary'>If Yes, results will include foreclosure properties</div>";
                                $html[] = "</div>";
                            $html[] = "</form>";

                            $html[] = "<div class='btn-filter-container mt-5 sticky-bottom'>";
                                $html[] = "<div class='pb-4' style='background-color: #FFF; margin-bottom: -15px !important;'>";
                                    $html[] = "<span class='btn btn-primary w-100 btn-filter'><i class='ti ti-filter me-1'></i> Filter Result</span>";
                                $html[] = "</div>";
                            $html[] = "</div>";

                        $html[] = "</div>";
                    
                    $html[] = "</div>";
                $html[] = "</div>";

                $html[] = "<div class='col-md-10 col-lg-9'>";

                    $html[] = "<div class='px-2'>";
                        /** PAGE ADS */
                        $html[] = "<div class='mb-4'>";
                            $html[] = "<div class='d-none PROPERTY_LIST_TOP'>";
                                $html[] = "<a href='#' target='_blank'>";
                                    $html[] = "<div class='card bg-dark-lt rounded-0  d-print-none banner-container d-flex align-items-center justify-content-center gap-2' style='height:250px;'>";
                                        $html[] = "<div class='loader'></div>";
                                        $html[] = "<p>Loading Ads</p>";
                                    $html[] = "</div>";
                                $html[] = "</a>";
                            $html[] = "</div>";
                        $html[] = "</div>";

                        $html[] = "<div class='mb-2 d-flex align-items-baseline justify-content-between'>";

                            $html[] = "<div class=''>";
                                $html[] = "<p>There are a total of (".$model->rows.") results</p>";
                            $html[] = "</div>";
                            
                            $html[] = "<div class='btn-group'>";
                                $html[] = "<div class='btn-group dropstart'>";
                                    $html[] = "<span class='btn btn-outline-secondary dropdown-toggle' id='btn-sort' data-bs-toggle='dropdown' aria-expanded='false'><i class='ti ti-sort-descending me-1'></i> Sort</span>";
                                    $html[] = "<ul class='dropdown-menu' aria-labelledby='btn-sort'>";

                                        $uri = function(array $uri) use ($model) {
                                            $r = $model->page['uri'];
                                            unset($r['offer']);

                                            foreach($uri as $k => $v) {
                                                $r[$k] = $v;
                                            }
                                            
                                            return $r;
                                        };

                                        $html[] = "<li><a href='".currentUrl($data, $uri(["sort" => "last_modified", "order" => "ASC"]) )."' class='dropdown-item'>Newest</a></li>";
                                        $html[] = "<li><a href='".currentUrl($data, $uri(["sort" => "last_modified", "order" => "DESC"]) )."' class='dropdown-item'>Oldest</a></li>";
                                        $html[] = "<li><a href='".currentUrl($data, $uri(["sort" => "price", "order" => "ASC"]) )."' class='dropdown-item'>By Price</a></li>";
                                        $html[] = "<li><a href='".currentUrl($data, $uri(["sort" => "lot_area", "order" => "ASC"]) )."' class='dropdown-item'>By Land Area</a></li>";
                                        $html[] = "<li><a href='".currentUrl($data, $uri(["sort" => "floor_area", "order" => "ASC"]) )."' class='dropdown-item'>By Floor Area</a></li>";
                                        $html[] = "<li><a href='".currentUrl($data, $uri(["sort" => "match_score", "order" => "DESC"]) )."' class='dropdown-item'>By Relevance</a></li>";
                                        $html[] = "<li><a href='".currentUrl($data, $uri(["sort" => "post_score", "order" => "DESC"]) )."' class='dropdown-item'>By Rank</a></li>";
                                    $html[] = "</ul>";
                                $html[] = "</div>";

                                $html[] = "<span class='btn btn-outline-secondary btn-filter-toggle d-md-block d-lg-none' data-bs-toggle='offcanvas' href='#offcanvasEnd' role='button' aria-controls='offcanvasEnd'><i class='ti ti-filter me-1'></i> Filter</span>";
                            $html[] = "</div>";

                        $html[] = "</div>";

                        /** LISTING LIST */
                        $html[] = $model->list;

                        if(!empty($model)) {
                            $html[] = "<div class='mt-4'>";
                                $html[] = $model->pagination;
                            $html[] = "</div>";
                        }
                    $html[] = "</div>";

                $html[] = "</div>";
		    $html[] = "</div>";

		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";
