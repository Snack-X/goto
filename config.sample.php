<?php

$config = array(
	"db" => array(
		"hostname" => "",
		"username" => "",
		"password" => "",
		"database" => ""
	),
	"global" => array(
		"base_url" => "" // leading protocol, no trailing slash
	),
	"admin" => array(
		"id" => "",
		"password" => "" // use public_html/hash.php
	),
	"twitter" => array(
		"consumer_key"    => "",
		"consumer_secret" => "",
		"access_token"    => "",
		"access_secret"   => ""
	),
	"foursquare" => array(
		"client_id"     => "",
		"client_secret" => ""
	)
);

date_default_timezone_set("Asia/Seoul");