<?php
include('sys/func.php');
session_start();

if ($_SESSION['admin'] == 1) {
	$db = db();

	$name = $_POST['name'];
	$priority = $_POST['priority'];

	mysqli_query($db, "INSERT INTO `categories`(`name`, `priority`) VALUES ('$name', '$priority');");
}

header("location: /");
?>