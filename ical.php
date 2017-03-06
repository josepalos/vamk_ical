<?php
    require_once "iCalcreator/iCalcreator.php";
	require ""; //put the auth file here.

	$context = stream_context_create(array(
		'http' => array(
		    'header'  => "Authorization: Basic " . base64_encode("$username:$password")
		)
	));

	function get_events($url, $subjects){
		global $context;
		$calendar = new vcalendar();
		$calendar->setConfig("url", $url);
		$calendar->parse(FALSE, $context);

		$searchArray = array("SUMMARY" => $subjects);
		return $calendar->selectComponents($searchArray);
	}

	function parse_degree($data){
		$base_url = $data->{"base_url"};
		$degree_events = array();
		foreach($data->{"groups"} as $group => $subjects_array){
			$subjects_events = get_events($base_url.$group.".ics", $subjects_array);
			$degree_events = array_merge($degree_events, $subjects_events);
		}
		return $degree_events;
	}


    $path_to_json_data = "subjects.json";
    $json_raw_data = file_get_contents($path_to_json_data);
	$json_data = json_decode($json_raw_data);

	$calendar = new vcalendar();

    foreach ($json_data as $key => $value) {
		$degree_events = parse_degree($value);
		foreach($degree_events as $event){
			$calendar->setComponent($event);
		}
	}
    $calendar->returnCalendar();
?>
