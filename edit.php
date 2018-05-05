<?php
include('sys/func.php');
session_start();

if ($_SESSION['admin'] == 1) {
	$db = db();

	$name = $_POST['name'];
	$tel = $_POST['tel'];
	$mail = $_POST['mail'];
	$geo = $_POST['geo'];
	$timestart = $_POST['timestart'];
	$timestop = $_POST['timestop'];
	$vk = $_POST['vk'];
	$insta = $_POST['insta'];

	if ($name) mysqli_query($db, "UPDATE `main` SET `cont`='$name' WHERE `name`='name';");
	mysqli_query($db, "UPDATE `main` SET `cont`='$tel' WHERE `name`='tel';");
	mysqli_query($db, "UPDATE `main` SET `cont`='$mail' WHERE `name`='mail';");
	if ($geo) mysqli_query($db, "UPDATE `main` SET `cont`='$geo' WHERE `name`='geo';");
	mysqli_query($db, "UPDATE `main` SET `cont`='$timestart' WHERE `name`='timestart';");
	mysqli_query($db, "UPDATE `main` SET `cont`='$timestop' WHERE `name`='timestop';");
	mysqli_query($db, "UPDATE `main` SET `cont`='$vk' WHERE `name`='vk';");
	mysqli_query($db, "UPDATE `main` SET `cont`='$insta' WHERE `name`='insta';");
}

header("location: /");
?>