<?php
header('Content-type: text/html; charset=utf-8');
session_start();

function db($name='main') {
	$db = mysqli_connect('mysql.hostinger.ru', 'u489860185_main', 'asdrqwerty09', 'u489860185_'.$name);
	if (mysqli_connect_errno()) print 'Ошибка 1. '.mysqli_connect_errno();
	mysqli_query($db, 'SET names "utf8"');
	return $db;
}
?>