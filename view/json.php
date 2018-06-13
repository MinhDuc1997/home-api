<?php
header('Content-Type: application/json; charset=UTF-8');

$url = file_get_contents('https://techitvn.com/home/api/myhome.php?token=yP4MLTibSaIg9MO7j7TsA3YeB3aiQKlgkEfGbo6thx9hvUD7LB');
echo $url;
?>
