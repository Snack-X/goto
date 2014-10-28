<?php

class Validator {
	public static function valid_date($year, $month, $day) {
		if($year < 2014) return false;
		if($month < 1 || $month > 12) return false;
		if($day < 1) return false;

		$is_leap = ($year & 3) === 0 && (($year % 25) !== 0 || ($year & 15) === 0);

		if(in_array($month, array(1, 3, 5, 7, 8, 10, 12)) && $day > 31) return false;
		else if(in_array($month, array(4, 6, 9, 11)) && $day > 30) return false;
		else if($is_leap && $day > 29) return false;
		else if($day > 28) return false;

		return true;
	}
}