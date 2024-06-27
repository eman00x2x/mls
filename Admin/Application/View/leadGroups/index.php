<?php


$html[] = "<div class='p-3'>";

    $html[] = "<div class='d-flex justify-content-between'>";
        $html[] = "<h3>Lead Groups</h3>";
        $html[] = "<div class=''>";
            $html[] = "<a href='".url("LeadGroupsController@add")."' class='btn btn-sm btn-primary'><i class='ti ti-plus fs-12 me-1'></i> New</a>";
        $html[] = "</div>";
    $html[] = "</div>";

    $html[] = "<div class='' style='height:auto; overflow-y: auto;'>";

        $html[] = "<div class='list-group'>";
            $html[] = "<a href='".url("LeadsController@index", null, ["id" => 0])."' class='list-group-item text-decoration-none'><i class='ti ti-raquo'></i> Ungroup</a>";
            if($data) {
                for($i=0; $i<count($data); $i++) {
                    $html[] = "<a href='".url("LeadsController@index", null, ["id" => $data[$i]['lead_group_id']])."' class='list-group-item text-decoration-none'>".$data[$i]['name']."</a>";
                }
            }
        $html[] = "</div>";
       
    $html[] = "</div>";
$html[] = "</div>";