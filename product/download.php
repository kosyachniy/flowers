<?php
include('../sys/func.php');
session_start();

if ($_SESSION['admin'] == 1) {
	$db = db();
	$id = $_GET['i'];

	move_uploaded_file($_FILES['name']['tmp_name'], '../load/products/' . $id . '.jpg');
}

header('location: ./?i=' . $id);
?>