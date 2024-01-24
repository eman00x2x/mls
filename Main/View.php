<?php

namespace Main;

class View {

	static $basePath;

	static function setBasePath($path) {
		self::$basePath = $path;
	}

	static function getTemplate($path,$data,$model,$real_path) {
		if(!is_null($real_path)) {
			return import($real_path,$data,$model);
		}

		if(self::$basePath == "") {
			$base = ROOT;
		}else {
			$base = self::$basePath;
		}

		return import($base."/Application/View/".$path,$data,$model);
	}

}
