<?php
include ('../sys/func.php');
session_start();

$i = md5($_POST['pass']);

$db=db('');
$res = mysqli_query($db,"SELECT * FROM `data` WHERE `name`='pass'");
while ($row = mysqli_fetch_array($res))
	if ($row['cont'] == $i) {
		$_SESSION['admin'] = 1;
		header("location: /");	
	} else { 
		$_SESSION['admin'] = 2;
    	header("location: ./");
	}
?>