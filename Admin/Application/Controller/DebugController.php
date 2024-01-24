<?php

namespace Admin\Application\Controller;

class DebugController extends \Application\Controller {
	
	function __construct() {}
	
	function debugPayment() {
	
		
		$sales_data = \Library\Server::api("GET","sales","getBySalesId&sales_id=2890");
		$lot_owners_data = getDeveloperMarketingRate($sales_data['developer']);
		
		echo "<pre>";
		print_r($lot_owners_data);
		exit();
		
	}
	
}