<?php

$config = array(
	"db" => array(
		"hostname" => "",
		"username" => "",
		"password" => "",
		"database" => ""
	),
	"global" => array(
		"base_url" => "" // leading protocol, no trailing slash (ex: "http://go.to")
	),
	"admin" => array(
		"id" => "",
		"password" => "" // use public_html/hash.php
	),
	"twitter" => array(
		"enabled"         => true, // false if you don't need twitter share
		"consumer_key"    => "",
		"consumer_secret" => "",
		"access_token"    => "",
		"access_secret"   => ""
	),
	"foursquare" => array(
		"client_id"     => "",
		"client_secret" => ""
	),
	"google" => array(
		"key" => "" // required for google static map
	),
	"ga" => array(
		"enabled" => true, // false if you don't need google analytics
		"key"     => ""
	)
);

date_default_timezone_set("Asia/Seoul");