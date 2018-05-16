<?php
include('../sys/func.php');
session_start();

if ($_SESSION['admin'] == 1) {
	$db = db();

	$pay = $_POST['pay'];

	if ($pay) mysqli_query($db, "UPDATE `main` SET `cont`='$pay' WHERE `name`='pay';");
}

header('location: ./');
?>