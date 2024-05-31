<?php

if($data) {

    $html[] = "<div class='container'>";
    for($i=0; $i<count($data); $i++) {
        $html[] = "<div class='row justify-content-center align-content-center mb-3 border-bottom pb-2 row_".$data[$i]['note_id']."'>";
            $html[] = "<div class='col-auto'>";
                $html[] = "<span class='btn btn-danger btn-sm btn-delete-note' data-id='".$data[$i]['note_id']."'><i class='ti ti-trash'></i> </span>";
            $html[] = "</div>";
            
            $html[] = "<div class='col'>";
                $html[] = "<p class='mb-0 pb-0 content content_".$data[$i]['note_id']."' data-id='".$data[$i]['note_id']."'>".$data[$i]["content"]."</p>";
                $html[] = "<div class='text-secondary'>";
                    $html[] = "<span class='small'>".date("d M Y h:i A", $data[$i]['created_at'])."</span>";
                $html[] = "</div>";
            $html[] = "</div>";
        $html[] = "</div>";
    }
    $html[] = "</div>";

}