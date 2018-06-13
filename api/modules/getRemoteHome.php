<?php
require_once 'getConnect.php';

class getRemoteHome extends getConnect{
	public $light_status;
	public $id_light;
	public $error;

	function OnOffLight($id_light,$status){
		$sql = "UPDATE light SET status=$status WHERE id_light=$id_light";
		$query = $this->connect->query($sql);
		if($query){
			$sql = "SELECT * FROM light WHERE id_light=$id_light";
			$query = $this->connect->query($sql);
			if($query){
				$row = $query->fetch_assoc();
				if($row['id_light'] == $id_light){
					$this->light_status = $row['status'];
					$this->id_light = $row['id_light'];
				}else{
					$this->error = "cannot find device";
				}
			}
			
		}else{
			echo 'false';
		}
	}
}
?>