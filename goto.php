<?php

require_once "config.php";
foreach(glob("../library/*.php") as $filename) include_once $filename;
require_once "../controller/base.php";

$mysqli = new Mysqli(
	$config["db"]["hostname"],
	$config["db"]["username"],
	$config["db"]["password"],
	$config["db"]["database"]
) or die("DB connection error!");

$mysqli->query("SET NAMES utf8");

session_start();