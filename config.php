<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try{
	$con = new mysqli('localhost','root','','home');
}catch(Exception $e){
	echo 'Cannot connect to database';
}
?>
