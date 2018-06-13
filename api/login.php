<?php
require_once 'modules/getDataLogin.php';

header('Content-Type: application/json; charset=UTF-8');

if(isset($_GET['username']) && isset($_GET['password'])){
	$login_obj = new getDataLogin();
	$login_obj->login($_GET['username'],$_GET['password']);

	if($login_obj->status == 'true'){
		$array_user_info = array('username'=>$login_obj->username,'email'=>$login_obj->email,'token'=>$login_obj->token);
		$array = array('status_login'=> $login_obj->status,'user_info'=>$array_user_info);
	}else{
		$array = array('status_login'=> $login_obj->status);
	}
	echo json_encode($array);
}else{
	echo "ERROR";
}
?>