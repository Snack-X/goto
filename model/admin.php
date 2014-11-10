<?php

class adminModel {
	private $mysqli;
	private $config;

	public function __construct($mysqli, $config) {
		$this->mysqli = $mysqli;
		$this->config = $config;
	}

	public function hash($string) {
		return hash("sha512", $string);
	}

	public function upload_file($name, $path) {
		if(!is_uploaded_file($_FILES[$name]["tmp_name"])) {
			throw new Exception("file upload error");
		}

		$filename = time().uniqid("", true);
		$filename = md5($filename);

		$arr = explode(".", $_FILES[$name]["name"]);
		$extension = $arr[count($arr) - 1];

		$filename = $filename.".".$extension;

		mkdir($path, 0777, true);
		$destination = $path."/".$filename;

		rename($_FILES[$name]["tmp_name"], $destination);
		$this->fix_image_orientation($destination);

		return "/".$destination;
	}

	public function upload_multiple_files($name, $path) {
		$count = count($_FILES[$name]["name"]);
		$files = array();

		for($i = 0 ; $i < $count ; $i++) {
			if(!is_uploaded_file($_FILES[$name]["tmp_name"][$i])) {
				throw new Exception("file upload error");
			}

			$filename = time().uniqid("", true);
			$filename = md5($filename);

			$arr = explode(".", $_FILES[$name]["name"][$i]);
			$extension = $arr[count($arr) - 1];

			$filename = $filename.".".$extension;

			@mkdir($path, 0777, true);
			$destination = $path."/".$filename;

			rename($_FILES[$name]["tmp_name"][$i], $destination);
			$this->fix_image_orientation($destination);
			array_push($files, "/".$destination);
		}

		return $files;
	}

	private function fix_image_orientation($path) {
		if(!function_exists("exif_read_data")) return;
		if(!function_exists("gd_info")) return;

		$arr = explode(".", $path);
		$extension = strtolower($arr[count($arr) - 1]);

		switch($extension) {
		case "jpg": case "jpeg":
			$image = imagecreatefromjpeg($path);
			break;
		case "png":
			$image = imagecreatefrompng($path);
			break;
		default:
			return;
		}

		$exif = exif_read_data($path);

		if(empty($exif["Orientation"])) return;

		switch($exif["Orientation"]) {
		case 3:
			$image = imagerotate($image, 180, 0);
			break;
		case 6:
			$image = imagerotate($image, -90, 0);
			break;
		case 8:
			$image = imagerotate($image, 90, 0);
			break;
		}

		switch($extension) {
		case "jpg": case "jpeg":
			imagejpeg($image, $path, 100);
			break;
		case "png":
			imagepng($image, $path);
			break;
		default:
			return;
		}

		imagedestroy($image);
	}

	public function after_create($travel, $note) {
		if($this->config["twitter"]["enabled"] === true) {
			$this->_twitter($travel, $note);
		}
	}

	private function _twitter($travel, $note) {
		$twitter = new Twitter(
			$this->config["twitter"]["consumer_key"],
			$this->config["twitter"]["consumer_secret"]
		);
		$twitter->set_access_token($this->config["twitter"]["access_token"]);
		$twitter->set_access_secret($this->config["twitter"]["access_secret"]);

		$tweet = $this->_twitter_message($travel, $note);

		$twitter->update_tweet($tweet);
	}

	private function _twitter_message($travel, $note) {
		/*
		tweet message format
		 |
		 |--- checkin
		 | |
		 | |--- photo + content + checkin = "[pic] content (@ venue) http://go.to/aaa/111"
		 | |--- content + checkin         = "content (@ venue) http://go.to/aaa/111"
		 | |--- photo + checkin           = "[pic] (@ venue) http://go.to/aaa/111"
		 | `--- checkin                   = "(@ venue) http://go.to/aaa/111"
		 |
		 `--- note
		   |
		   |--- photo + content           = "[pic] content http://go.to/aaa/111"
		   |--- content                   = "content http://go.to/aaa/111"
		   `--- photo                     = "[pic] http://go.to/aaa/111"
		*/

		$data = unserialize($note["data"]["data"]);

		// photo attached?
		$tweet = "";
		if($data["image"] !== false) {
			$tweet = "[pic] ";
		}

		// content post prcocess
		$content = $data["content"];
		$content = Parsedown::instance()->text($content);
		$content = strip_tags($content);
		$content_len = mb_strlen($content, "UTF-8");

		// venue post process & target length
		if($note["data"]["type"] === "checkin") {
			$location = $data["venue"][2];
			$location_len = mb_strlen($location, "UTF-8");

			$target_len = 110 - strlen($tweet) - $location_len;

			$tweet .= "(@ ".$location.") ";
		}
		else if($note["data"]["type"] === "note") {
			$target_len = 110 - strlen($tweet);
		}

		// content process
		if($content_len >= $target_len) {
			$content_cut = mb_substr($content, 0, $target_len, "UTF-8");
			$content_cut = trim($content_cut);
			$content_cut .= "...";
		}
		else {
			$content_cut = trim($content);
		}

		$content_cut .= " ";

		if($content !== "") {
			$tweet .= $content_cut;
		}

		// venue process
		if($note["data"]["type"] === "checkin") {
			$tweet .= "(@ ".$location.") ";
		}

		// link
		$link = $this->config["global"]["base_url"]."/".$travel["data"]["link"]."/".$note["data"]["id"];
		$tweet .= $link;

		return $tweet;
	}
}