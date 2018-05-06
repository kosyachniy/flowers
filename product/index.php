<?php
$title = 'Заказ цветов';
include('../sys/head.html');
session_start();

if ($_SESSION['admin'] == 1) {
	print '
<style>
	form {width: 100%;}
	input, textarea {display: inline-block; width: 90%;}
	textarea {height: 250px;}
</style>';
}

$id = $_GET['i'];
$cat = $_GET['c'];

if ($cat) {
	print '<script>
	place(\'.notes2\', 3, 85, 20);
</script>

<div class="notes2">';

	$res2 = mysqli_query($db, "SELECT * FROM `products` WHERE `category` = '$cat' ORDER BY `priority` DESC");
	while ($row = mysqli_fetch_array($res2)) {
		include('../sys/middle.html');
	}

	print '</div>';
} else {
	$res = mysqli_query($db, "SELECT * FROM `products` WHERE `id`='$id'");
	while ($row = mysqli_fetch_array($res)) {
		print '<div class="note"><h2>' . $row['name'] . '</h2>';

		print '<div class="note-img"><img src="/load/products/' . $row['photo'] . '.jpg">';

		if ($_SESSION['admin'] == 1) {
			print '<br><form action="download.php?i=' . $id . '" method="post" enctype="multipart/form-data">
	<input type="file" name="name" style="width: 90%; font-size: 0.9rem;">
	<input type="submit" value="Загрузить" style="width: 90%;">
</form>';
	}

		print '</div><div class="note-cont">';

		if ($_SESSION['admin'] == 1) {
			print '<form action="edit.php?i=' . $id . '" method="post">
		<input name="name" placeholder="Название" value="' . $row['name'] . '"><br>
		<input name="category" placeholder="Категория" value="' . $row['category'] . '"><br>
		<textarea name="descr" placeholder="Короткое описание">' . $row['descr'] . '</textarea><br>
		<textarea name="cont" placeholder="Полное описание">' . $row['cont'] . '</textarea><br>';
		} else {
			print '<div>' . nl2p($row['descr']) . '</div><div>' . nl2p($row['cont']) . '</div>';
		}

		if ($_SESSION['admin'] == 1) {
			print '<input name="price" style="width: 100px;" value="' . $row['price'] . '">₽<br>
		Приоритет: <input name="priority" placeholder="Цена" value="' . $row['priority'] . '" style="width: 100px;">
		<input type="submit" value="Сохранить" style="width: 90%;"></form>';
		}

		print '</div>';

		if ($_SESSION['admin'] != 1) {
?>

<script>
var x = <?=$row['id']?>;
if (getCookie('basket').split('-').indexOf(x.toString()) != -1) {
	document.write('<div onclick="basketoff(this, <?=$row['id']?>, <?=$row['price']?>);" class="button active">Добавлено в корзину (<?=$row['price']?>₽)</div>');
} else {
	document.write('<div onclick="basketon(this, <?=$row['id']?>, <?=$row['price']?>);" class="button">Добавить в корзину (<?=$row['price']?>₽)</div>');
}
</script>

<?php
		}

		print '</div>';
	}
}

include('../sys/foot.html');
?>