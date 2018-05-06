<?php
include('sys/func.php');
session_start();

if ($_SESSION['admin'] == 1) {
	$db = db();

	$name = $_POST['name'];
	$descr = $_POST['descr'];
	$cont = $_POST['cont'];
	$price = $_POST['price'];
	$priority = $_POST['priority'];
	$category = strtolower($_POST['category']);

	mysqli_query($db, "INSERT INTO `products`(`name`, `descr`, `cont`, `price`, `priority`, `category`) VALUES ('$name', '$descr', '$cont', '$price', '$priority', '$category');");
	$id = mysqli_insert_id($db);

	copy('load/products/0.jpg', 'load/products/' . $id . '.jpg');
}

header("location: /");
?>