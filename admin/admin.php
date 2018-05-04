<?php
include ('../sys/func.php');
session_start();
$db = db();

$i = md5($_POST['pass']);

$res = mysqli_query($db,"SELECT * FROM `main` WHERE `name`='pass'");
while ($row = mysqli_fetch_array($res)) {
	if ($row['cont'] == $i) {
		$_SESSION['admin'] = 1;
		header("location: /");	
	} else { 
		$_SESSION['admin'] = 2;
    	header("location: ./");
	}
}
?>