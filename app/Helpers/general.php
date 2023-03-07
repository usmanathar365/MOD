<?php

use App\Models\Brands;
use App\Models\PaymentMethods;

if (!function_exists('timeago'))
{
	function timeago($date) {
	   $timestamp = strtotime($date);	
	   
	   $strTime = array("second", "minute", "hour", "day", "month", "year");
	   $length = array("60","60","24","30","12","10");

	   $currentTime = time();
	   if($currentTime >= $timestamp) {
			$diff     = time()- $timestamp;
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}

			$diff = round($diff);
			return $diff . " " . $strTime[$i] . "(s) ago ";
	   }
	}
}



if (!function_exists('get_brands'))
{
	function get_brands() {

		$brands = Brands::all(); 
		return $brands;
	}
}



if (!function_exists('get_payment_methods_count'))
{
	function get_payment_methods_count() {
		 $record = PaymentMethods::count();
		return $record;
	}
}





?>