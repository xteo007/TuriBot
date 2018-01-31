<?php

//inline mode
function answerInlineQuery($inline_query_id, $results, $cache_time = NULL, $is_personal = NULL, $next_offset = NULL, $switch_pm_text = NULL, $switch_pm_parameter = NULL, $response = false)
{
	$results = json_encode($results);
	$args = [
		'inline_query_id' => $inline_query_id,
		'results' => $results
		];
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

    if($response)
    {
        $rr = curlRequest("answerInlineQuery", $args);
    }
    else
    {
        jsonPayload("answerInlineQuery", $args);
        $rr = true;
    }

    return $rr;
}
