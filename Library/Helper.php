<?php

namespace Library;

class Helper {

	static function socialMediadShareButtons(array $data = []) {
		
		$html[] = "<div class='social-medi-share-buttons'>";
			$html[] = "<span class='text-muted fs-12'>Share this post</span>";
			$html[] = "<div class='mt-1 d-flex gap-1'>";
				$html[] = "<a target='_blank' href='https://www.facebook.com/sharer/sharer.php?u=".$data['url']."'><img src='".CDN."images/social/facebook.png' /></a>";
				$html[] = "<a target='_blank' href='https://twitter.com/intent/tweet?text=".$data['title']."&url=".$data['url']."&via=TWITTER-HANDLE'><img src='".CDN."images/social/twitter.png' /></a>";
				$html[] = "<a target='_blank' href='https://www.linkedin.com/shareArticle?mini=true&url=".$data['url']."&title=".$data['title']."&summary=".$data['description']."&source=".$data['url']."'><img src='".CDN."images/social/linkedin.png' /></a>";
				$html[] = "<a target='_blank' href='https://pinterest.com/pin/create/button/?url=".$data['url']."&description=".$data['description']."&media=".$data['img']."'><img src='".CDN."images/social/pinterest.png' /></a>";
			$html[] = "</div>";
		$html[] = "</div>";

		return implode("", $html);
	}

	static function clean($str) {
		$inye = array("Ñ","ñ");
		$str = str_replace($inye,"&Ntilde;",$str);
		$str = str_replace($inye,"&ntilde;",$str);

		return stripslashes(trim($str));
	}

	static function escape($str) {
		return addslashes(@trim($str));
	}

	static function getMsg() {
		$html = @$_SESSION['msg'];
		$html .= $_SESSION['msg'] = null;

		return $html;
	}

	static function sanitize($string, $force_lowercase = true, $anal = false) {
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

	static function nicetrim($s, $MAX_LENGTH) {
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
	static function convertTime($ms, $seconds = false) {
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

	static function dateHelper($flag) {

		switch($flag) {
			case "today":
				$data['from'] = strtotime(date("Y-m-d"));
				$data['to'] = strtotime(date("Y-m-d"));
				break;
			case "this_month":
				$data['from'] = strtotime(date("Y-m-01"));
				$data['to'] = strtotime(date("Y-m-t"));
				break;
			case "this_week":
				$today_day_of_week = date("N");
				$data['from'] = strtotime(date("Y-m-d", strtotime("-" . ($today_day_of_week - 1) . " days")));
				$data['to'] = strtotime(date("Y-m-d", strtotime("+" . (7 - $today_day_of_week) . " days")));
				break;
			case "this_year":
				$data['from'] = strtotime(date("Y-01-01"));
				$data['to'] = strtotime(date("Y-12-31"));
				break;
		}
		return $data;
	}

	static function convertMillions($num) {

		if($num >= 1000000) {
			return round($num / 1000000,3)."M";
		}else if($num >= 100000) {
			return round($num / 1000,2)."K";
		}else {
			return number_format($num,0);
		}
		
	}

	static function strtohex($x) {
		$s='';
		foreach (str_split($x) as $c) $s.=sprintf("%02X",ord($c));
		return($s);
	}

	static function checkRemoteFile($url) {

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,$url);
		// don't download content
		curl_setopt($ch, CURLOPT_NOBODY, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($ch);
		curl_close($ch);

		if($result !== FALSE) {
			return true;
		} else {
			return false;
		}
		
	}

}