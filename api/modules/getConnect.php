<?php
class getConnect{
	public $connect;

	function __construct(){
		require_once '../config.php';
		$this->connect = $con;
	}
}
?> 