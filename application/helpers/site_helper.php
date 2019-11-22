<?php

if (!function_exists('response_json')) {
	function response_json($data = array())
	{
		$_CI = &get_instance();
		$_CI->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

function pdie($data = array(), $type = false)
{
	echo "<pre>";
	var_dump($data);
	echo "</pre>";
	if ($type) {
		die();
	}
}

function jsondata()
{
	return json_decode(trim(file_get_contents('php://input')), true);
}

function generateRand(){
	$abc = '';
	$seed = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
    shuffle($seed);
	foreach (array_rand($seed, 5) as $k) $abc .= $seed[$k];
	
	return $abc;
}

function checkOffset($data = array()){
	if (!empty($data)) {
		$result = array('limit'=> $data['limit'],'offset' => $data['offset']);
	}else{
		$result = array('limit'=> "",'offset' =>"");
	}
	return $result;

}