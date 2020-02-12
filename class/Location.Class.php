<?php
class Location{
	
	
	public function getLocation($address1){
		
		//$address = urlencode($address1.",".$address2);
		$address = urlencode($address1);
		$address = str_replace(" ", "+", $address);
		/*$getJSON = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";
		$contentJSON = file_get_contents($getJSON);*/

		$getJSON = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $getJSON);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$contentJSON = curl_exec($ch);	

		$geocode_array = json_decode($contentJSON, true);
		$lat = $geocode_array['results'][0]['geometry']['location']['lat'];
		$lon = $geocode_array['results'][0]['geometry']['location']['lng'];
		$geoPoints =   $lat.",".$lon;
		return $geoPoints;
	}
}
