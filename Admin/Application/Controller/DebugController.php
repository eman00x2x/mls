<?php

namespace Admin\Application\Controller;

class DebugController extends \Main\Controller {
	
	function __construct() {

	}
	
	function debug() {

		for($i=1; $i<=90; $i++) {

			$i += 9;

			for($x=0; $x<=15; $x++) {
			
				$balance = 100 - $i;

				if($x > 0) {
					$with_discount = " WITH " . $x . "% DISCOUNT";
				}else { $with_discount = ""; }
			
				$terms[ $i . "-" . $x . "-payment" ] = [
					"dp" => $i,
					"discount" => $x,
					"terms" => $i . "% DP" . $with_discount . " AND " .$balance . "% BALANCE"
				];
				
			}	
			
		}

		debug(json_encode($terms, JSON_PRETTY_PRINT));

	}
	
}