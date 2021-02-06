<?php

if(!function_exists('hex_to_rgb')) {
	function hexToRgb($hexCode) {
		list($r, $g, $b) = sscanf($hexCode, "#%02x%02x%02x");
		return "$r, $g, $b";
	}
}

if(!function_exists('mountDateWithHourAndMinute')) {
	function mountDateWithHourAndMinute($date, $hour, $minute) {
		return $date . ' '. (int)$hour . ':' . $minute;
	}
}

if(!function_exists('extractHourAndMinutesFromTime'))
{
	function extractHourAndMinutesFromTime($timeString)
	{
		$time = explode(':', $timeString);

		return [
			'hour' => $time[0],
			'minutes' => $time[1],
			'seconds' => isset($time[2]) ?: 0
		];
	}
}

if(!function_exists('company'))
{
    function company()
    {
        return auth()->user()->company;
    }
}

if(!function_exists('current_user'))
{
    function current_user()
    {
        return auth()->user();
    }
}

if(!function_exists('company_id')) {
	function company_id() {
		return auth()->user()->company_id;
	}
}


if(!function_exists('cache_key'))
{
    function cache_key()
    {
        if(cache('key_'.auth()->user()->id))
            return cache('key_'.auth()->user()->id);

        return null;
    }
}


if(!function_exists('current_route'))
{
    function current_route($route = [])
    {

        return in_array(request()->route()->getName(), $route);
    }
}

if(!function_exists('get_current_route'))
{
    function get_current_route()
    {

        return request()->route()->getName();
    }
}

if(!function_exists('image_upload'))
{
    function image_upload($file, $dir, $request)
    {

        $imageName = time().'.'.$request->file->getClientOriginalExtension();

        $request->file->move(public_path('uploads/' . $dir), $imageName);

        return [
            'image' => 'uploads/' . $dir . '/' . $imageName
        ];
    }
}

if(!function_exists('remove_file'))
{
    function remove_file($file)
    {
        return \File::delete($file);
    }
}
