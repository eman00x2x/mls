<?php

namespace Library;

class Encrypt {

    private static $_instance = null;

    private $cipher = "AES-128-CTR";
	private $key_path = "../key";
	private $pseudo_bytes_path = "../pseudo_bytes";
	
	public static function getInstance () {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    function __construct() {}

    function encrypt($message) {
		return openssl_encrypt($message, $this->cipher, $this->getEncryptionKey(), 0, $this->getEncryptionIV());
	}

	function decrypt($message) {
		return openssl_decrypt($message, $this->cipher, $this->getEncryptionKey(), 0, $this->getEncryptionIV());
	}

	private function getEncryptionKey() {
		$file = fopen($this->key_path, "r");
		return fread($file, filesize($this->key_path));
	}

	private function getEncryptionIV() {
		$pseudo_bytes = fopen($this->pseudo_bytes_path, "r");
		return fread($pseudo_bytes, filesize($this->pseudo_bytes_path));
	}

}