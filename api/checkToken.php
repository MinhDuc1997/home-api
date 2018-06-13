<?php
function check_token($token){
	$url_request = 'https://techitvn.com/home/api/token.php?token='.$token;
	$data = file_get_contents($url_request);
	$json = json_decode($data);
	return $json->status;
}
?>