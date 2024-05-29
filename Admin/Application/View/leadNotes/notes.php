<?php

if($data) {
    for($i=0; $i<count($data); $i++) {
        $html[] = "<div class='mb-2'>";
            
            $html[] = "<p class='mb-0 pb-0 content content_".$data[$i]['note_id']."' data-id='".$data[$i]['note_id']."'>".$data[$i]["content"]."</p>";
            
            $html[] = "<div class='d-flex'>";
                $html[] = "<div class=''>";
                    $html[] = "<span class='btn btn-danger btn-sm'><i class='ti ti-trash'></i> Delete</span>";
                $html[] = "</div>";

                $html[] = "<div class=''>";
                    $html[] = "<span>".date("d M Y", $data[$i]['created_at'])."</span>";
                $html[] = "</div>";
            $html[] = "</div>";

        $html[] = "</div>";
    }
}