<?php
require_once 'modules/getToken.php';

header('Content-Type: application/json; charset=UTF-8');

if(isset($_GET['token']) && strlen($_GET['token']) == 50){
	$obj = new getToken();
	if($obj->get($_GET['token']) == 1)
		$array = array('status' => 'true');
	if($obj->get($_GET['token']) == 0)
		$array = array('status' => 'expired token');
	echo json_encode($array);
}else{
	$array = array('status' => 'expired token');
	echo json_encode($array);
}
?>