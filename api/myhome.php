<?php
require_once 'modules/getDataHome.php';
require_once 'checkToken.php';

header('Content-Type: application/json; charset=UTF-8');

if(isset($_GET['token']) && strlen($_GET['token']) == 50){
	$home_obj = new getDataHome();

	if(check_token($_GET['token']) == 'true'){
		echo json_encode($home_obj->home());
	}else{
		echo json_encode(array('home_device_name' => 'light', 'token' => 'expired token','light_status' => ''));
	}
}else{
	echo json_encode(array('home_device_name' => 'light', 'token' => 'cannot access', 'light_status' => ''));
}

?>