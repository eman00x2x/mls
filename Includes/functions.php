<?php

function debug($data) {
	
	echo "<pre>";
	print_r($data);
	exit();
	
}

function import($path,$data=null,$model=null) {

	if(file_exists($path)) {
		require_once($path);
	}else {
		$theFile1 = explode("\\",$path);
		$theFile = array_pop($theFile1);

		$html[] = " <h1 class='m-0 p-0'>File is Missing</h1> <p><br/>&mdash; <i>File</i> <b>$theFile</b> is missing in <b>".implode("\\",$theFile1)."</b> folder !</p> <hr />";
		
	}

	return implode("",$html);

}

function clean($str) {
	$inye = array("Ñ","ñ");
	$str = str_replace($inye,"&Ntilde;",$str);
	$str = str_replace($inye,"&ntilde;",$str);

	return stripslashes(trim($str));
}

function escape($str) {
	return addslashes(@trim($str));
}

function getMsg() {
	$html = @$_SESSION['msg'];
	$html .= $_SESSION['msg'] = null;

	return $html;
}

function sanitize($string, $force_lowercase = true, $anal = false) {
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                   "—", "–", ",", "<", ".", ">", "/", "?");
    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = preg_replace('/\s+/', "-", $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
    return ($force_lowercase) ?
        (function_exists('mb_strtolower')) ?
            mb_strtolower($clean, 'UTF-8') :
            strtolower($clean) :
        $clean;
}

function nicetrim($s, $MAX_LENGTH) {
// limit the length of the given string to $MAX_LENGTH char
// If it is more, it keeps the first $MAX_LENGTH-3 characters
// and adds "..."
// It counts HTML char such as &aacute; as 1 char.
//

	$str_to_count = html_entity_decode($s);
	if (strlen($str_to_count) <= $MAX_LENGTH) {
		return $s;
	}

	$s2 = substr($str_to_count, 0, $MAX_LENGTH - 3);
	$s2 .= "...";
	return htmlentities($s2);
}

/**
 * Converts milliseconds to formatted time or seconds.
 * @param int [$ms] The length of the media asset in milliseconds
 * @param bool [$seconds] Whether to return only seconds
 * @return mixed The formatted length or total seconds of the media asset
 */
function convertTime($ms, $seconds = false) {
    $total_seconds = ($ms / 1000);

    if($seconds) {
        return $total_seconds;
    } else {
        $time = '';

        $value = array(
            'hours' => 0,
            'minutes' => 0,
            'seconds' => 0
        );

        if($total_seconds >= 3600) {
            $value['hours'] = floor($total_seconds / 3600);
            $total_seconds = $total_seconds % 3600;

            $time .= $value['hours'] . ':';
        }

        if($total_seconds >= 60) {
            $value['minutes'] = floor($total_seconds / 60);
            $total_seconds = $total_seconds % 60;

            $time .= $value['minutes'] . ':';
        } else {
            $time .= '00:';
        }

        $value['seconds'] = floor($total_seconds);

        if($value['seconds'] < 10) {
            $value['seconds'] = '0' . $value['seconds'];
        }

        $time .= $value['seconds'];

        return $time;
    }

}

function convertMillions($num) {

    if($num >= 1000000) {
        return round($num / 1000000,3)."M";
    }else if($num >= 100000) {
        return round($num / 1000,2)."K";
    }else {
        return number_format($num,0);
    }
    
}

function strtohex($x) {
    $s='';
    foreach (str_split($x) as $c) $s.=sprintf("%02X",ord($c));
    return($s);
}