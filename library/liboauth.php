<?php

require_once "libcurl.php";

class OAuth {
	protected $consumer_key = "";
	protected $consumer_secret = "";
	protected $access_token = "";
	protected $access_secret = "";
	protected $signature_method = "HMAC-SHA1";
	protected $version = "1.0";

	public function __construct($consumer_key, $consumer_secret) {
		$this->consumer_key = $consumer_key;
		$this->consumer_secret = $consumer_secret;
	}

	public function get_consumer_key() {
		return $this->consumer_key;
	}

	public function set_access_token($access_token) {
		$this->access_token = $access_token;
	}

	public function set_access_secret($access_secret) {
		$this->access_secret = $access_secret;
	}

	public function nonce($length = 10, $salt = "") {
		$nonce = "";
		$charset = "abcdefghijklmnopqrstuvwxyz0123456789";
		$l = strlen($charset);

		while(strlen($nonce) < $length) $nonce .= $charset[rand() % $l];

		return $nonce.$salt;
	}

	public function signature($oauth_array, $url, $post_param = NULL) {
		$base_method = "POST";

		$base_url = $url;

		$base_param = array();
		foreach($oauth_array as $k => $v) $base_param[] = $k."=".rawurlencode($v);
		$base_param = join("&", $base_param);

		if($post_param !== NULL) $base_param .= "&".$post_param;

		$base_sigstr = join("&", array(
			rawurlencode($base_method),
			rawurlencode($base_url),
			rawurlencode($base_param)
		));

		$base_sigkey = join("&", array(
			rawurlencode($this->consumer_secret),
			rawurlencode($this->access_secret)
		));

		return base64_encode(hash_hmac("sha1", $base_sigstr, $base_sigkey, true));
	}

	public function request($url, $oauth_param = NULL, $post_param = NULL) {
		$oauth_header = array();
		$oauth_header["oauth_consumer_key"] = $this->consumer_key;
		$oauth_header["oauth_nonce"] = $this->nonce(20, md5(time()));
		$oauth_header["oauth_signature_method"] = $this->signature_method;
		$oauth_header["oauth_timestamp"] = time();
		$oauth_header["oauth_token"] = $this->access_token;
		$oauth_header["oauth_version"] = "1.0";

		if($oauth_param !== NULL) {
			foreach($oauth_param as $k => $v) {
				$oauth_header[$k] = $v;
			}
		}
		uksort($oauth_header, "strcmp");

		$oauth_header["oauth_signature"] = $this->signature($oauth_header, $url, $post_param);
		uksort($oauth_header, "strcmp");

		$http_header = "";
		foreach($oauth_header as $k => $v) {
			if($http_header !== "") $http_header .= ", ";
			$http_header .= $k."=\"".rawurlencode($v)."\"";
		}
		$http_header = "OAuth ".$http_header;

		$curl = new CurlRequest();
		$curl->add_header("Authorization", $http_header);

		if($post_param !== NULL) {
			$curl->post_value($post_param);
		}

		$result = $curl->request($url);

		return $result;
	}
}