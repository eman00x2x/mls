<?php

$html[] = "<div class='row justify-content-center my-5'>";
    $html[] = "<div class='col-6'>";

        $html[] = "<pre>";
            ob_start();
            print_r($data);
            $content = ob_get_contents();
            ob_clean();

            $html[] = $content;
        $html[] = "</pre>";

    $html[] = "</div>";
$html[] = "</div>";