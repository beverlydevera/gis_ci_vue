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

function sesdata($index){
	$_CI =& get_instance();
	return $_CI->session->userdata($index);
}

function checkLogin($type = false){
	$_CI =& get_instance();
	if ($type) {
		if (!empty($_CI->session->userdata('loggedin'))) {
			$status = getUser('status',array('user_id'=>sesdata('id')),'row')->status;
			if ($status == 0) {
				redirect(base_url('users/inactivestat'),'refresh');
			}else{
				redirect(base_url('dashboard/index'),'refresh');
			}
		}
	}else{
		if (empty($_CI->session->userdata('loggedin'))) {
			redirect(base_url('login'),'refresh');
		}
	}
}

function getUser($select = "*",$condition = array(),$type=false,$offset = array()){
	$_CI =& get_instance();
	$offset = checkOffset($offset);
	$qry  = array(
		'select'           => $select,
		'table'            => 'tbl_users',
		'condition'        => $condition,
		'type'             => $type,
		'limit' =>   $offset['limit'],
		'offset' =>  $offset['offset'],
	);     
	return	$_CI->Main->select($qry);
}

function userLogs($module,$ulog_title){
	$_CI =& get_instance();
	$datainsert = [
		"user_id" 	=> sesdata('id'),
		"module"	=> $module,
		"ulog_title"=> $ulog_title,
		"date_added"=> date("Y-m-d H:i:s")
	];
	$_CI->Main->insert("tbl_userlogs",$datainsert);
}