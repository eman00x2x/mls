<?php

$api_name = "PAREB MLS API";
$insert_api_key = "<span class='insert-api-key'>[API_KEY]</span>";
$curl_note = "<p class='mt-0 pt-0'>/** for readability purposes only **/</p>";

$html[] = "<div class='container-xl'>";
    $html[] = "<div class='row g-0'>";

        $html[] = "<div class='col-lg-2 col-md-3 col-sm-12 col-12'>";
            
            $html[] = "<div class='sidebar sticky-top pt-3'>";

                $html[] = "<div class='d-flex gap-3 align-items-baseline pb-3 mb-3 border-bottom'>";
                    $html[] = "<div>";
                        $html[] = "<img src='".CDN."images/logo.png' style='width:50px;' />";
                    $html[] = "</div>";
                    $html[] = "<h1>".CONFIG['site_name']." API <small class='fw-normal fs-16'>v1</small></h1>";
                $html[] = "</div>";

                $html[] = "<div class='list-group list-group-flush'>";
                    $html[] = "<div class='list-group-item'>";
                        $html[] = "<h3 class='mb-1'>Getting Started</h3>";
                        $html[] = "<a href='#getting_started' class='d-block  ms-2 mb-1'>Get Started</a>";
                        $html[] = "<a href='#get_api_key' class='d-block  ms-2 mb-1'>Get API Key</a>";
                    $html[] = "</div>";

                    $html[] = "<div class='list-group-item'>";
                        $html[] = "<h3 class='mb-1'>Accounts</h3>";
                        $html[] = "<a href='#get_account' class='d-block  ms-2 mb-1'>Get Account</a>";
                    $html[] = "</div>";

                    $html[] = "<div class='list-group-item'>";
                        $html[] = "<h3 class='mb-1'>Property Listings</h3>";
                        $html[] = "<a href='#get_properties' class='d-block  ms-2 mb-1'>Get Properties</a>";
                        $html[] = "<a href='#get_property' class='d-block  ms-2 mb-1'>Get Property Details</a>";
                    $html[] = "</div>";
                $html[] = "</div>";

                $html[] = "<p class='mt-5 position-bottom'>&copy; ".CONFIG['site_name']." ".date("Y")."  All Rights reserved.</p>";
            $html[] = "</div>";

        $html[] = "</div>";
        $html[] = "<div class='col-lg-8 col-md-8 col-sm-12 col-12'>";
            $html[] = "<div class='content border-start border-2 p-5'>";
                
                /** GETTING STARTED */
                $html[] = "<div id='getting_started' class='py-5'>";
                    $html[] = "<h2 class='display-4'>Getting Started</h2>";
                    $html[] = "<p>This API provides data from the $api_name, and only registered members with privileges can access this information.</p>";
                    $html[] = "<p>The purpose of this API is to provide data from $api_name for members to use for their own purposes.</p>";
                    $html[] = "<p>This API requires an API_KEY for authentication.</p>";
                    $html[] = "<p>The API response is formatted as JSON.</p>";
                $html[] = "</div>";
                /** END GETTING STARTED */

                /** HEADER RESPONSE */
                $html[] = "<div class='py-5'>";
                    $html[] = "<h2>API Header Status Response</h2>";
                    $html[] = "<table class='table'>";
                    $html[] = "<tr>";
                        $html[] = "<td style='width:50px;'>200</td>";
                        $html[] = "<td>Request has been successful</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td>204</td>";
                        $html[] = "<td>No content.</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td>404</td>";
                        $html[] = "<td>Not found.</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td>500</td>";
                        $html[] = "<td>Server Busy</td>";
                    $html[] = "</tr>";
                    $html[] = "</table>";

                $html[] = "</div>";
                /** END HEADER RESPONSE */

                /** RESOURCE AND URI */
                $html[] = "<div class='py-5'>";
                    $html[] = "<h2>Resources and URIs</h2>";
                    $html[] = "<p>A RESTful API utilizes HTTP commands such as POST, GET, PUT, and DELETE to perform operations on a resource at the server. This resource is addressed by a URI, and what is returned by the server is a representation of that resource based on its current state. HTTP GET are commonly used in our services.</p>";
                    $html[] = "<p>Currently, only the GET command is allowed to perform operations on a resource at the server.</p>";

                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = 'curl -i 
    -H "Accept: application/json" 
    -H "X-API-KEY: '.$insert_api_key.'"
    '.API_V1;
                        $html[] = "</code>";
                    $html[] = "</pre>";
                    

                    $html[] = "<br/><h3>ENDPOINT</h3>";
                    $html[] = "<table class='table'>";
                    $html[] = "<thead>";
                        $html[] = "<tr>";
                            $html[] = "<th>Endpoint</th>";
                            $html[] = "<th>Info</th>";
                        $html[] = "</tr>";
                    $html[] = "</thead>";
                    $html[] = "<tr>";
                        $html[] = "<td>".API_V1."/account</td>";
                        $html[] = "<td>Data of your account profile</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td>".API_V1."/properties</td>";
                        $html[] = "<td>Data list of properties</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td>".API_V1."/property/:id</td>";
                        $html[] = "<td>Data of property, where the ID is the property ID; you can obtain this from the list.</td>";
                    $html[] = "</tr>";
                    $html[] = "</table>";

                    $html[] = "<h3 class='mt-5'>404 Error response</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = '{
  "message": "The requested resource could not be found. Please refer to the documentation",
  "url": "http://localhost/mls/api/documentation"
}';
                        $html[] = "</code>";
                    $html[] = "</pre>";

                    $html[] = "<h3 class='mt-5'>500 Error response</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = '{
  "message": "The server is currently busy processing your initial request. Please try again. If the error persists, please contact the system administrator.",
  "email": "'.CONFIG['contact_info']['email'].'"
}';
                        $html[] = "</code>";
                    $html[] = "</pre>";
                   
                $html[] = "</div>";
                /** END RESOURCE AND URI */

                /** GET API KEY */
                $html[] = "<div id='get_api_key' class='py-5'>";
                    $html[] = "<h2>Getting API KEY</h2>";
                    $html[] = "<p>To obtain an API key, you must be registered with $api_name and have purchased the API access privilege.</p>";
                    $html[] = "<ul>";
                        $html[] = "<li>Login to your account</li>";
                        $html[] = "<li>Click on your profile picture from the upper right corner, then select \"My Account\".</li>";
                        $html[] = "<li>Scroll to the bottom and click on \"Reveal API KEY\".</li>";
                    $html[] = "</ul>";

                    $html[] = "<p>You may use CURL, Javascript Fetch, Python Requests or make an HTTP request to retrieve data from the server.</p>";
                    $html[] = "<p>The API key can be passed as URI parameters or in the header named X-API-KEY</p>";

                    $html[] = "<h3>HTTP Request</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = 'GET '.API_V1.'/[RESOURCE]?api_key='.$insert_api_key;
                        $html[] = "</code>";
                    $html[] = "</pre>";

                    $html[] = "<h3>CURL Request</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = 'curl -i 
    -H "Accept: application/json" 
    -H "X-API-KEY: '.$insert_api_key.'"
    '.API_V1.'/[RESOURCE]';
                        $html[] = "</code>";
                    $html[] = "</pre>";

                $html[] = "</div>";
                /** END GET API KEY */


                /** GET ACCOUNT DATA */
                $html[] = "<div id='get_account' class='py-5'>";
                    $html[] = "<h2 class='display-4'>Accounts</h2>";
                    $html[] = "<h2>Get Account Data</h2>";
                    $html[] = "<p>Response contains your account and personal information.</p>";
                    $html[] = "<p>To get your account data:</p>";
                    
                    $html[] = "<div class='card border-0'>";
                        $html[] = "<div class='card-header'>";
                            $html[] = "<ul class='nav nav-tabs card-header-tabs nav-fill' data-bs-toggle='tabs' role='tablist'>";
                                $html[] = "<li class='nav-item' role='presentation'><a href='#curl_account_request' class='nav-link active' data-bs-toggle='tab' aria-selected='true' role='tab'>HTTP Request</a></li>";
                                $html[] = "<li class='nav-item' role='presentation'><a href='#http_account_request' class='nav-link' data-bs-toggle='tab' aria-selected='true' role='tab'>Curl</a></li>";
                            $html[] = "</ul>";
                        $html[] = "</div>";
                        $html[] = "<div class='card-body'>";
                            $html[] = "<div class='tab-content'>";
                                $html[] = "<div class='tab-pane active show' id='curl_account_request'>";
                                    $html[] = "<h3>HTTP Request</h3>";
                                    $html[] = "<pre>";
                                        $html[] = "<code>";
                                            $html[] = 'GET '.API_V1.'/account?api_key='.$insert_api_key;
                                        $html[] = "</code>";
                                    $html[] = "</pre>";
                                $html[] = "</div>";
                            $html[] = "</div>";

                            $html[] = "<div class='tab-content'>";
                                $html[] = "<div class='tab-pane' id='http_account_request'>";
                                    $html[] = "<h3>CURL Request</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = 'curl -i 
    -H "Accept: application/json" 
    -H "X-API-KEY: '.$insert_api_key.'"
    '.API_V1.'/account';
                        $html[] = "</code>";
                    $html[] = "</pre>";

                                $html[] = "</div>";
                            $html[] = "</div>";
                        $html[] = "</div>";
                    $html[] = "</div>";

                    $html[] = "<h3 class='mt-5'>Possible success response</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = '{
  "logo": "'.CDN.'images/accounts/4c8db409820f58a6bedde1e1eaa66d4e.jpg",
  "company_name": "",
  "profession": "",
  "real_estate_license_number": "",
  "board_location": {
    "region": "",
    "province": "",
    "municipality": ""
  },
  "local_board_name": "",
  "name": {
    "prefix": "",
    "firstname": "",
    "middlename": "",
    "lastname": "",
    "suffix": ""
  },
  "birthdate": "YYYY-MM-dd",
  "address": "",
  "mobile_number": "",
  "email": "",
  "tin": "",
  "privileges": {
    "max_post": 15,
    "max_users": 1,
    "mls_access": true,
    "chat_access": true,
    "featured_ads": 1,
    "handshake_limit": "1",
    "comparative_analysis_access": true,
    "api_access": true
  },
  "status": "active",
  "registered_at": 2147483647,
  "users": [
    {
      "name": "",
      "email": "",
      "status": "active",
      "created_at": 1698589128
    }
  ]
}';
                        $html[] = "</code>";
                    $html[] = "</pre>";


                $html[] = "</div>";
                /** END GET ACCOUNT DATA */

                /** GET PROPERTIES DATA */
                $html[] = "<div id='get_properties' class='py-5'>";
                    $html[] = "<h2 class='display-4'>Property Listings</h2>";
                    $html[] = "<h2>Get Properties</h2>";
                    $html[] = "<p>Response is the list of your posted properties</p>";
                    $html[] = "<p>To get your properties data:</p>";

                    $html[] = "<div class='card border-0'>";
                        $html[] = "<div class='card-header'>";
                            $html[] = "<ul class='nav nav-tabs card-header-tabs nav-fill' data-bs-toggle='tabs' role='tablist'>";
                                $html[] = "<li class='nav-item' role='presentation'><a href='#curl_properties_request' class='nav-link active' data-bs-toggle='tab' aria-selected='true' role='tab'>HTTP Request</a></li>";
                                $html[] = "<li class='nav-item' role='presentation'><a href='#http_properties_request' class='nav-link' data-bs-toggle='tab' aria-selected='true' role='tab'>Curl</a></li>";
                            $html[] = "</ul>";
                        $html[] = "</div>";
                        $html[] = "<div class='card-body'>";
                            $html[] = "<div class='tab-content'>";
                                $html[] = "<div class='tab-pane active show' id='curl_properties_request'>";
                                    $html[] = "<h3>HTTP Request</h3>";
                                    $html[] = "<pre>";
                                        $html[] = "<code>";
                                            $html[] = 'GET '.API_V1.'/properties?api_key='.$insert_api_key.'&page=:page';
                                        $html[] = "</code>";
                                    $html[] = "</pre>";
                                $html[] = "</div>";
                            $html[] = "</div>";

                            $html[] = "<div class='tab-content'>";
                                $html[] = "<div class='tab-pane' id='http_properties_request'>";
                                    $html[] = "<h3>CURL Request</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = 'curl -i 
    -H "Accept: application/json" 
    -H "X-API-KEY: '.$insert_api_key.'"
    '.API_V1.'/properties?page=:page';
                        $html[] = "</code>";
                    $html[] = "</pre>";

                                $html[] = "</div>";
                            $html[] = "</div>";
                        $html[] = "</div>";
                    $html[] = "</div>";

                    $html[] = "<div class='my-5'>";
                        $html[] = "<h3>URI Parameters</h3>";
                        $html[] = "<table class='table'>";
                        $html[] = "<theader>";
                            $html[] = "<tr>";
                                $html[] = "<th>Parameter</th>";
                                $html[] = "<th>Description</th>";
                                $html[] = "<th>Example</th>";
                            $html[] = "</theader>";
                        $html[] = "</tr>";
                        /* $html[] = "<tr>";
                            $html[] = "<td>api_key</td>";
                            $html[] = "<td>your api key</td>";
                            $html[] = "<td>394cf9fe9b88bcf2b-76032930840351b</td>";
                        $html[] = "</tr>"; */
                        $html[] = "<tr>";
                            $html[] = "<td>page</td>";
                            $html[] = "<td>the page number</td>";
                            $html[] = "<td>page=2</td>";
                        $html[] = "</tr>";
                        $html[] = "</table>";
                    $html[] = "</div><br/>";
                    
                    $html[] = "<h3 class='mt-5'>Possible success response</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = '{
  "rows": 6,
  "page": {
    "current": 1,
    "total": 1
  },
  "data": [
    {
      "id": 1099,
      "thumb_img": "'.CDN.'images/listings/7e12b9298c1869571ac20626b9bbb411.webp",
      "title": "Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City",
      "category": "House and Lot",
      "offer": "for sale",
      "price": 1500000,
      "is_mls": 1,
      "is_website": 1,
      "is_mls_option": {
        "local_board": 1,
        "local_region": 1,
        "all": 1
      },
      "status": "Active",
      "modified_at": 1710575599,
      "created_at": 1699019091
    }, {....}
  ]
}';
                        $html[] = "</code>";
                    $html[] = "</pre>";

                $html[] = "</div>";
                /** END PROPERTIES DATA */

                /** GET PROPERTY DATA */
                $html[] = "<div id='get_property' class='py-5'>";
                    $html[] = "<h2>Get Property Details</h2>";
                    $html[] = "<p>The response contains the selected data of the posted property</p>";
                    $html[] = "<p>To get your property data:</p>";

                    $html[] = "<div class='card border-0'>";
                        $html[] = "<div class='card-header'>";
                            $html[] = "<ul class='nav nav-tabs card-header-tabs nav-fill' data-bs-toggle='tabs' role='tablist'>";
                                $html[] = "<li class='nav-item' role='presentation'><a href='#curl_property_request' class='nav-link active' data-bs-toggle='tab' aria-selected='true' role='tab'>HTTP Request</a></li>";
                                $html[] = "<li class='nav-item' role='presentation'><a href='#http_property_request' class='nav-link' data-bs-toggle='tab' aria-selected='true' role='tab'>Curl</a></li>";
                            $html[] = "</ul>";
                        $html[] = "</div>";
                        $html[] = "<div class='card-body'>";
                            $html[] = "<div class='tab-content'>";
                                $html[] = "<div class='tab-pane active show' id='curl_property_request'>";
                                    $html[] = "<h3>HTTP Request</h3>";
                                    $html[] = "<pre>";
                                        $html[] = "<code>";
                                            $html[] = 'GET '.API_V1.'/properties/:id?api_key='.$insert_api_key;
                                        $html[] = "</code>";
                                    $html[] = "</pre>";
                                $html[] = "</div>";
                            $html[] = "</div>";

                            $html[] = "<div class='tab-content'>";
                                $html[] = "<div class='tab-pane' id='http_property_request'>";
                                    $html[] = "<h3>CURL Request</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = 'curl -i 
    -H "Accept: application/json" 
    -H "X-API-KEY: '.$insert_api_key.'"
    '.API_V1.'/properties/:id';
                        $html[] = "</code>";
                    $html[] = "</pre>";

                                $html[] = "</div>";
                            $html[] = "</div>";
                        $html[] = "</div>";
                    $html[] = "</div>";
                    
                    $html[] = "<h3 class='mt-5'>Possible success response</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = '{
  "id": 15234,
  "thumb_img": "'.CDN.'images/listings/7e12b9298c1869571ac20626b9bbb411.webp",
  "title": "Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City",
  "foreclosed": 0,
  "category": "House and Lot",
  "offer": "for sale",
  "floor_area": 300,
  "lot_area": 412,
  "bedroom": 5,
  "bathroom": 5,
  "address": {
    "barangay": "New Alabang Village",
    "municipality": "Muntinlupa City",
    "province": "Metro Manila",
    "region": "NCR",
    "street": "",
    "village": ""
  },
  "price": 1500000,
  "reservation": 20000,
  "payment_details": {
    "option_money_duration": "15",
    "payment_mode": "Installment",
    "tax_allocation": "Seller Agrees to Pay Capital Gains Tax and Buyer Pays Transfer Tax",
    "bank_loan": false,
    "pagibig_loan": false,
    "assume_balance": false
  },
  "video": "https://www.youtube.com/watch?v=jwyBh01Pwrw",
  "tags": [
    "New"
  ],
  "amenities": [
    "Club House",
    "24 Hours Security",
    "Guard House",
    "Gated Community",
    "CCTV Cameras",
    "Near Malls",
    "Near Hospitals",
    "Near Public Markets",
    "Near in Churches",
    "Near in Schools"
  ],
  "status": "Active",
  "long_desc": "<p>5 bedrooms with toilet and bath</p>\r\n<ul>\r\n<li>walk in closet in bedrooms upstairs</li>\r\n<li>ensuite in all bedrooms</li>\r\n<li>bathtub in master&rsquo;s bedroom</li>\r\n<li>airconditioning in 4 rooms and living area</li>\r\n<li>hot and cold water system</li>\r\n</ul>\r\n<p>25m frontage</p>\r\n<p>Built 2010</p>\r\n<p>3 elevated under cover garage</p>\r\n<p>High ceiling</p>\r\n<p>Open plan concept</p>\r\n<p>Balcony at rear</p>\r\n<p>Pantry room</p>\r\n<p>Big garden</p>\r\n<p>SP: 35 M gross</p>\r\n<p>Clean title</p>\r\n<p>RFS: family migrating to Australia</p>",
  "authority_type": "Non-Exclusive Authority To Sell",
  "com_share": "1.5%",
  "modified_at": 1711119103,
  "created_at": 1699019091,
  "car_spaces": 2,
  "images": [
    {
      "url": "'.CDN.'images/listings/7e12b9298c1869571ac20626b9bbb411.webp"
    },
    {
      "url": "'.CDN.'images/listings/7e12b9298c1869571ac20626b9bbb412.webp"
    },
    {
      "url": "'.CDN.'images/listings/7e12b9298c1869571ac20626b9bbb413.webp"
    },
    {
      "url": "'.CDN.'images/listings/7e12b9298c1869571ac20626b9bbb414.webp"
    }, {....}
  ]
}';
                        $html[] = "</code>";
                    $html[] = "</pre>";

                $html[] = "</div>";
                /** END PROPERTIES DATA */

            $html[] = "</div>";
        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";
