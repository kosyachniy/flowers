<?php
include('../sys/func.php');
session_start();

if ($_SESSION['admin'] == 1) {
	$db = db();
	$id = $_GET['i'];

	$dir = opendir('../load/products/');
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

	move_uploaded_file($_FILES['name']['tmp_name'], '../load/products/' . $d . '.jpg');

	mysqli_query($db, "UPDATE `products` SET `photo`='$d' WHERE `id`='$id';");
}

header('location: ./?i=' . $id);
?>