<?php
include('sys/func.php');
session_start();

if ($_SESSION['admin'] == 1) {
	$db = db();

    $res2 = mysqli_query($db, "SELECT * FROM `categories`");
    while ($row = mysqli_fetch_array($res2)) {
    	$id = $row['id'];
        $i = $_POST[$id];
        if ($i > 0) {
		mysqli_query($db, "UPDATE `categories` SET `priority`='$i' WHERE `id`='$id';");
        } else {
        	mysqli_query($db, "DELETE FROM `categories` WHERE `id`='$id';");
        }
    }
}

header("location: /");
?>