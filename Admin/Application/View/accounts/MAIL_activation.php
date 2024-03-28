<?php

$html[] = "<p>Hi ".$data['name']."</p>";
$html[] = "<p>Thank you for registering in ".CONFIG['site_name'].", your activation url can be found below.</p>";
$html[] = "<br/><a href='" . $data['url'] . "'>".$data['url']."</a><br/>";
$html[] = "<br/><p>Click or copy the url above to activate your account.</p>";