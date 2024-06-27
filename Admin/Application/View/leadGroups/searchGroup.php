<?php

if($data) {

	$html[] = "<table class='table table-hover'>";
	for($i=0; $i<count($data); $i++) {
		$html[] = "<tr>";
			$html[] = "<td>".$data[$i]['name']."</td>";
			$html[] = "<td>";
				$html[] = "<span class='btn btn-sm btn-success btn-selected' data-id='".$data[$i]['lead_group_id']."' data-name='".$data[$i]['name']."'>Select</span>";
			$html[] = "</td>";
		$html[] = "</tr>";
	}
	$html[] = "</table>";

}else {
	$html[] = "<p>No groups</p>";
}
