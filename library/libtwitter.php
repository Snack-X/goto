<?php

require_once "liboauth.php";

class Twitter {
	protected $oauth;

	public function __construct($consumer_key, $consumer_secret) {
		$this->oauth = new OAuth($consumer_key, $consumer_secret);
	}

	public function set_access_token($access_token) {
		$this->oauth->set_access_token($access_token);
	}

	public function set_access_secret($access_secret) {
		$this->oauth->set_access_secret($access_secret);
	}

	public function get_request_token() {
		$url = "https://api.twitter.com/oauth/request_token";
		$result = $this->oauth->request($url);

		$arr = array();
		parse_str($result, $arr);

		return $arr;
	}

	public function get_access_token($oauth_verifier) {
		$url = "https://api.twitter.com/oauth/access_token";
		$post_param = array("oauth_verifier" => $oauth_verifier);
		$result = $this->oauth->request($url, $post_param);

		$arr = array();
		parse_str($result, $arr);

		return $arr;
	}

	public function update_tweet($content) {
		$url = "https://api.twitter.com/1.1/statuses/update.json";
		$postfields = "status=".rawurlencode($content);

		$result = $this->oauth->request($url, NULL, $postfields);

		$result = json_decode($result);

		return $result;
	}
}