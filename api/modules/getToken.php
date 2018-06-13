<?php
require_once 'getConnect.php';

class getToken extends getConnect{
	public $status = 1;

	function get($token){
		$sql = "SELECT * FROM token WHERE token='".$token."'";
		$query = $this->connect->query($sql);
		if($query){
		 	$row = $query->fetch_assoc();
		 	if($token == $row['token']){
		 		$date1 = date_create($row['date_create']);
				$date2 = date_create(date('d-m-Y'));
				if(date_diff($date1,$date2)->format("%a") <= 30){
					return $this->status;
				}
				else{
					$sql = "DELETE FROM token where token='".$token."'";
					$query = $this->connect->query($sql);
					if($query){
						$this->status = 0;
						return $this->status;
					}				
				}
			}else{
				$this->status = 0;
				return $this->status;
			}
		 }
	}
}
?>