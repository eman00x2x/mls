<?php

$html[] = "<table class='table'>";
$html[] = "<thead>";
    $html[] = "<tr>";
        $html[] = "<th>Barangay</th>";
        $html[] = "<th>Total</th>";
    $html[] = "</tr>";
$html[] = "</thead>";

$html[] = "<tbody>";
    if($data) {
        for($i=0; $i < count($data); $i++) {
            $html[] = "<tr>";
                $html[] = "<td>".$data[$i]['barangay']."</td>";
                $html[] = "<td>".$data[$i]['total_listing']."</td>";
            $html[] = "</tr>";
        }
    }
$html[] = "</tbody>";
$html[] = "</table>";