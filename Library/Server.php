<?php

namespace Library;

class Server {

	static function api($server=null,$method,$request,$data=null) {

		if($server != null) {
			if($server == "") {
				$server = "pRO";
			}else {
				$server = "&server=".$server;
			}
		}
		
		$url = "https://divine-pride.net/api/$request?apiKey=421132af6ab28ceee281c080991735da".$server;

		$handle = curl_init($url);
		
		switch($method) {
			
			case 'POST':
				curl_setopt($handle, CURLOPT_POST, true);
				curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($data));
				break;
			
			default:
			
		}
		
		curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
		
		/* Get the HTML or whatever is linked in $url. */
		$response = curl_exec($handle);
		
		if( !$response ) { 
			trigger_error(curl_error($handle)); 
			echo "The Server is Offline. Please consult your Network Administrator.";
			exit();
		} 
		
		/* Check http code. */
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		
		curl_close($handle);
		
		if($httpCode != 200) {
			$response = array("message"=>"Not found!");
		}
		
		return @json_decode($response,TRUE);
	}
	
}