<?php
require_once 'getConnect.php';

class getDataLogin extends getConnect{
	public $username;
	public $email;
	public $token;
	public $status;

	function generateRandomString($length) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';//dataString
	    $charactersLength = strlen($characters);
	    $randomString = '';//newString
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];//random number to 0 to length, example: $characters[2]
	    }
	    return $randomString;
	}

	function login($user,$pass){
		$pass = hash('sha256', $pass);
		$sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
		$query = $this->connect->query($sql);
		if($query){
			$row = $query->fetch_assoc();
			if($row['username'] == $user && $row['password']==$pass){
				$this->status = 'true';
				$this->username = $row['username'];
				$this->email = $row['email'];
				if($this->generateRandomString(50)){
					$this->token = $this->generateRandomString(50);
					$token = $this->token;
					$id_user = $row['id_user'];
					$today = date('d-m-Y');
					$sql = "INSERT INTO token(token,user_id,date_create) VALUES('$token','$id_user','$today')";
					$this->connect->query($sql);
				}
			}else{
				$this->status = 'false';
			}
		}else{
			return 0;
		}
	}
}
?>
