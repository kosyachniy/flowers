<?php
include('../sys/func.php');
session_start();

if ($_SESSION['admin'] == 1) {
	$db = db();
	$id = $_GET['id'];
	$ix = $_GET['i'];

	$res = mysqli_query($db, "SELECT * FROM `products` WHERE `id`='$id'");
	while ($row = mysqli_fetch_array($res)) {
		$all = explode(',', $row['photos']);
	}

	$new = array();

	for ($i=0; $i<sizeof($all); $i++) {
		if ($ix != $i) {
			array_push($new, $all[$i]);
		}
	}
	$oxx = implode(',', $new);

	mysqli_query($db, "UPDATE `products` SET `photos`='$oxx' WHERE `id`='$id';");
}

header('location: ./?i=' . $id);
?>