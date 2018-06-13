<?php
require_once 'modules/getRemoteHome.php';

header('Content-Type: application/json; charset=UTF-8');

if(isset($_GET['namedevice']) && isset($_GET['id']) && isset($_GET['status']) && isset($_GET['token'])){
	if(strlen($_GET['token']) == 50){
		$remote_obj = new getRemoteHome();
		$sql = "SELECT * FROM token where token='".$_GET['token']."'";
		$query = $remote_obj->connect->query($sql);
		if($query){
			$row = $query->fetch_assoc();
			if($row['token'] == $_GET['token']){
				$date1 = date_create($row['date_create']);
				$date2 = date_create(date('d-m-Y'));
				if(date_diff($date1,$date2)->format("%a") <= 30){
					$id = (int) $_GET['id'];
					if(is_int($id) && $_GET['namedevice'] == 'light'){
						if($_GET['status'] == '0' || $_GET['status'] == '1'){
							$remote_obj->OnOffLight($_GET['id'],$_GET['status']);
							if($remote_obj->error != 'cannot find device'){
								if($remote_obj->light_status == 1){
									$array = array('status' => 'true', 'token' => 'true', 'light_changed' => 'on','id_light' => $remote_obj->id_light,'light_status' => $remote_obj->light_status);
								}
								if($remote_obj->light_status == 0){
									$array = array('status' => 'true', 'token' => 'true','light_changed' => 'off','id_light' => $remote_obj->id_light,'light_status' => $remote_obj->light_status);
								}
								echo json_encode($array);
							}else{
								echo json_encode(array('status' => $remote_obj->error));
							}
						}else{
							echo "ERROR";	
						}
					}else{
						echo "ERROR";
					}
				}else{
					$sql = "DELETE FROM token where token='".$_GET['token']."'";
					$query = $remote_obj->connect->query($sql);
					if($query){
						echo json_encode(array('status' => 'false', 'token' => 'expired token' ,'home_device_name' => 'light','light_status' => ''));	
					}				
				}
			}else{
				echo json_encode(array('status' => 'false', 'token' => 'expired token'));
			}
		}	
	}else{
		echo json_encode(array('status' => 'false', 'token' => 'cannot access'));
	}
}else{
	echo "ERROR";
}
?>