<?php

$html[] = "<h1 style='margin-bottom: 2rem;' class='mb-5'>New Lead</h1>";

$html[] = "<div style='display: flex; gap: 0.5rem; justify-content: space-between !important;'>";

	$html[] = "<p>".$data['name']." inquired about <a href='".rtrim(WEBDOMAIN, "/")."".url("ListingsController@view", ["name" => $data['listing_name']])."'>".$data['title']."</a> posted in ".CONFIG['site_name'].". you can also view this message in your account.</p><br/>";

	$html[] = "<table style='width:100%;'>";
	$html[] = "<tr>";
		$html[] = "<td style='width:100px !important;'>Name</td>";
		$html[] = "<td>".$data['name']."</td>";
	$html[] = "</tr>";
	$html[] = "<tr>";
		$html[] = "<td>Mobile Number</td>";
		$html[] = "<td>".$data['mobile_no']."</td>";
	$html[] = "</tr>";
	$html[] = "<tr>";
		$html[] = "<td>Email Address</td>";
		$html[] = "<td>".$data['email']."</td>";
	$html[] = "</tr>";
	$html[] = "<tr>";
		$html[] = "<td>Message</td>";
		$html[] = "<td>".$data['message']."</td>";
	$html[] = "</tr>";
	$html[] = "</table>";

$html[] = "</div><br/>";