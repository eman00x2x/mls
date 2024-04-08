<?php

$api_name = "PAREB MLS API";
$insert_api_key = "<span class='insert-api-key'>[API_KEY]</span>";
$curl_note = "<p class='mt-0 pt-0'>/** for readability purposes only **/</p>";

$html[] = "<div class='container-xl'>";
    $html[] = "<div class='row g-0'>";

        $html[] = "<div class='col-lg-2 col-md-3 col-sm-12 col-12'>";
            
            $html[] = "<div class='sidebar' style='position:relative;'>";
                $html[] = "<div class='sticky-top'>";
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
                            $html[] = "<h3 class='mb-1'>Properties</h3>";
                            $html[] = "<a href='#get_properties' class='d-block  ms-2 mb-1'>Get Properties</a>";
                            $html[] = "<a href='#get_property' class='d-block  ms-2 mb-1'>Get Property Details</a>";
                        $html[] = "</div>";

                    $html[] = "</div>";
                $html[] = "</div>";
            $html[] = "</div>";

        $html[] = "</div>";
        $html[] = "<div class='col-lg-8 col-md-8 col-sm-12 col-12'>";
            $html[] = "<div class='content border-start border-2 p-5'>";
                
                /** GETTING STARTED */
                $html[] = "<div id='getting_started' class='py-5'>";
                    $html[] = "<h2 class='display-4'>Getting Started</h2>";
                    $html[] = "<p>This API provides a data from $api_name and only registered members and has a privilege can access this informations.</p>";
                    $html[] = "<p>The purpose of this API is to provide a data from $api_name to use on members own purpose.</p>";
                    $html[] = "<p>This API requires API_KEY to authenticate.</p>";
                    $html[] = "<p>The API response is formatted as JSON.</p>";
                $html[] = "</div>";
                /** END GETTING STARTED */

                /** HEADER RESPONSE */
                $html[] = "<div class='py-5'>";
                    $html[] = "<h2>API Header Status Response</h2>";
                    $html[] = "<table class='table'>";
                    $html[] = "<tr>";
                        $html[] = "<td>200</td>";
                        $html[] = "<td>Request has been successful</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td>204</td>";
                        $html[] = "<td>No content.</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td>400</td>";
                        $html[] = "<td>Bad Request. Request failed. Wrong or missing parameters, wrong api_key.</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td>403</td>";
                        $html[] = "<td>Forbidden. Once the shipments processed at DELASIA Office, you cannot update or delete the resource.</td>";
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
                    $html[] = "<p>A RESTful API utilises HTTP commands POST, GET, PUT, and DELETE in order to perform an operation on a resource at the server. This resource is addressed by a URI; and what is returned by the server is a representation of that resource depending on its current state. HTTP POST and GET commonly used in our services.</p>";
                    $html[] = "<p>For the meantime only GET command is allowed to perform an operation on a resource at the server.</p>";

                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = 'curl -i 
    -H "Accept: application/json" 
    -H "X-API-KEY: '.$insert_api_key.'"
    '.API_V1;
                        $html[] = "</code>";
                    $html[] = "</pre>";
                    

                    $html[] = "<h3>ENDPOINT</h3>";
                    $html[] = "<ul>";
                        $html[] = "<li>".API_V1."/account - data of your account profile</li>";
                        $html[] = "<li>".API_V1."/properties - data list of properties</li>";
                        $html[] = "<li>".API_V1."/property/{id} - data of property, where id is the property id, you can get this from the list</li>";
                    $html[] = "</ul>";
                
                $html[] = "</div>";
                /** END RESOURCE AND URI */

                /** GET API KEY */
                $html[] = "<div id='get_api_key' class='py-5'>";
                    $html[] = "<h2>Getting API KEY</h2>";
                    $html[] = "<p>To get an API KEY, you must be registered to $api_name, and purchased the API access privilege.</p>";
                    $html[] = "<ul>";
                        $html[] = "<li>Login to your account</li>";
                        $html[] = "<li>Click your picture from the upper right corner and click \"My Account\"</li>";
                        $html[] = "<li>Scroll to the bottom</li>";
                        $html[] = "<li>and click reveal API KEY</li>";
                    $html[] = "</ul>";

                    $html[] = "<p>You may use CURL or request via HTTP to retrieved a data at the server</p>";

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
                    $html[] = "<p>/account response is your account and personal information.</p>";
                    $html[] = "<p>To get your account data:</p>";
                    
                    $html[] = "<h3>HTTP Request</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = 'GET '.API_V1.'/account?api_key='.$insert_api_key;
                        $html[] = "</code>";
                    $html[] = "</pre>";

                    $html[] = "<h3>CURL Request</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = 'curl -i 
    -H "Accept: application/json" 
    -H "X-API-KEY: '.$insert_api_key.'"
    '.API_V1.'/account';
                        $html[] = "</code>";
                    $html[] = "</pre>";

                    $html[] = "<h3 class='mt-5'>Possible success response</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = '{
  "logo": "'.CDN.'images/accounts/4c8db409820f58a6bedde1e1eaa66d4e.jpg",
  "company_name": "",
  "profession": "",
  "real_estate_license_number": "",
  "board_region": {
    "region": "",
    "province": "",
    "municipality": ""
  },
  "local_board_name": "",
  "account_name": {
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
                    $html[] = "<h2 class='display-4'>Properties</h2>";
                    $html[] = "<h2>Get Properties</h2>";
                    $html[] = "<p>/properties response is the list of your posted properties</p>";
                    $html[] = "<p>To get your account data:</p>";
                    
                    $html[] = "<h3>HTTP Request</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = 'GET '.API_V1.'/properties?api_key='.$insert_api_key;
                        $html[] = "</code>";
                    $html[] = "</pre>";

                    $html[] = "<h3>CURL Request</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = 'curl -i 
    -H "Accept: application/json" 
    -H "X-API-KEY: '.$insert_api_key.'"
    '.API_V1.'/properties';
                        $html[] = "</code>";
                    $html[] = "</pre>";

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
                    $html[] = "<h2>Get Properties</h2>";
                    $html[] = "<p>/properties/:id response is the posted property selected data</p>";
                    $html[] = "<p>To get your account data:</p>";
                    
                    $html[] = "<h3>HTTP Request</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = 'GET '.API_V1.'/properties/:id?api_key='.$insert_api_key;
                        $html[] = "</code>";
                    $html[] = "</pre>";

                    $html[] = "<h3>CURL Request</h3>";
                    $html[] = "<pre>";
                        $html[] = "<code>";
                            $html[] = 'curl -i 
    -H "Accept: application/json" 
    -H "X-API-KEY: '.$insert_api_key.'"
    '.API_V1.'/properties/:id';
                        $html[] = "</code>";
                    $html[] = "</pre>";

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
