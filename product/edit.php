<?php
include('../sys/func.php');
session_start();

if ($_SESSION['admin'] == 1) {
	$db = db();
	$id = $_GET['i'];

	$name = $_POST['name'];
	$descr = $_POST['descr'];
	$cont = $_POST['cont'];
	$price = $_POST['price'];

	if ($name) mysqli_query($db, "UPDATE `products` SET `name`='$name' WHERE `id`='$id';");
	if ($descr) mysqli_query($db, "UPDATE `products` SET `descr`='$descr' WHERE `id`='$id';");
	if ($cont) mysqli_query($db, "UPDATE `products` SET `cont`='$cont' WHERE `id`='$id';");
	if ($price) mysqli_query($db, "UPDATE `products` SET `price`='$price' WHERE `id`='$id';");
}

header('location: ./?i=' . $id);
?>