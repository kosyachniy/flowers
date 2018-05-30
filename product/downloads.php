<?php
include('../sys/func.php');
session_start();

if ($_SESSION['admin'] == 1) {
	$db = db();
	$id = $_GET['i'];

	$dir = opendir('../load/img/');
	$d = 0;

	while ($nom = readdir($dir)) {
		if (($nom != ".") && ($nom != "..")) {
			$b = preg_replace("/[^0-9]/", '', substr($nom, 0, strpos($nom, '.')));
		
			if ($b > $d)
				$d = $b;
		}
	}

	closedir($dir);
	$d++;

	move_uploaded_file($_FILES['name']['tmp_name'], '../load/img/' . $d . '.jpg');

	$all = '';
	$res = mysqli_query($db, "SELECT * FROM `products` WHERE `id`='$id'");
	while ($row = mysqli_fetch_array($res)) {
		$all = $row['photos'];
	}

	$all .= ',' . $d;

	mysqli_query($db, "UPDATE `products` SET `photos`='$all' WHERE `id`='$id';");
}

header('location: ./?i=' . $id);
?>