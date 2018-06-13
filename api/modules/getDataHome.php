<?php
require_once 'getConnect.php';

class getDataHome extends getConnect{
	public $light;

	function home(){
		$sql = "SELECT * FROM light";
		$query = $this->connect->query($sql);
		if($query){
			while($row = $query->fetch_assoc()){
				$array_temp[] = array('id_light' => $row['id_light'], 'status' => $row['status']);			
			}
			$this->light = array('home_device_name' => 'light','token' => 'true' ,'light_status' => $array_temp);
			return $this->light;
		}
	}
}
?> 