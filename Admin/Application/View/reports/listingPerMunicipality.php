<?php

$html[] = "<table class='table'>";
$html[] = "<thead>";
    $html[] = "<tr>";
        $html[] = "<th>Municipality</th>";
        $html[] = "<th class='text-center'>Total</th>";
    $html[] = "</tr>";
$html[] = "</thead>";

$html[] = "<tbody>";
    if($data) {
        for($i=0; $i < count($data); $i++) {
            $html[] = "<tr>";
                $html[] = "<td><span class='cursor-pointer text-municipality'>".$data[$i]['municipality']."</span></td>";
                $html[] = "<td class='text-center'>".$data[$i]['total_listing']."</td>";
            $html[] = "</tr>";
        }
    }
$html[] = "</tbody>";
$html[] = "</table>";