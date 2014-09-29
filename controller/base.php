<?php

class baseController {
	var $config;

	public function __construct($config) {
		$this->config = $config;
	}

	public function render($file, $variables = array()) {
		extract($variables);

		ob_start();
		include "../view/{$file}.php";
		$output = ob_get_clean();

		// HTML minify
		// http://stackoverflow.com/a/5324014
		$re = "%(?>[^\S ]\s*| \s{2,})(?=[^<]*+(?:<(?!/?(?:textarea|pre|script)\b)[^<]*+)*+(?:<(?>textarea|pre|script)\b| \z))%Six";
		$output_min = preg_replace($re, "", $output);

    	echo $output_min;
	}

	public function redirect($src) {
		header("Location: ".$src);
		echo "<script>location.href='".$src."'</script>";
		die;
	}

	public function back() {
		echo "<script>history.go(-1)</script>";
		die;
	}

	public function post($name) {
		return trim($_POST[$name]);
	}
}