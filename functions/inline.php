<?php

//inline mode
function answerInlineQuery($inline_query_id, $results, $cache_time = NULL, $is_personal = NULL, $next_offset = NULL, $switch_pm_text = NULL, $switch_pm_parameter = NULL)
{
	global $api;
	$options = array('http'=>array('method'=>"GET", 'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n", 'ignore_errors' => true));
	$context = stream_context_create($options);
	$results = json_encode($results);
	$args = array(
		'inline_query_id' => $inline_query_id,
		'results' => $results
		);
	if(isset($cache_time))
	{
		$args['cache_time'] = $cache_time;
	}
	if(isset($is_personal))
	{
		$args['is_personal'] = $is_personal;
	}
	if(isset($next_offset))
	{
		$args['next_offset'] = $next_offset;
	}
	if(isset($switch_pm_text))
	{
		$args['switch_pm_text'] = $switch_pm_text;
	}
	if(isset($switch_pm_parameter))
	{
		$args['switch_pm_parameter'] = $switch_pm_parameter;
	}
	$params = http_build_query($args);
	$r = file_get_contents("https://api.telegram.org/bot$api/answerInlineQuery?$params", false, $context);
	$rr = json_decode($r, true);
	return $rr;
}