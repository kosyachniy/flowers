<?php
include('sys/func.php');
session_start();

if ($_SESSION['admin'] == 1) {
	$db = db();
	$id = $_GET['i'];

	mysqli_query($db, "DELETE FROM `products` WHERE `id`='$id';");
}

header("location: /");
?>