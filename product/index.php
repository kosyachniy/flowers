<?php
$title = 'Заказ цветов';
include('../sys/head.html');
session_start();

print '<style> .note div {color: #000; display: inline-block; vertical-align: top;}</style>';

if ($_SESSION['admin'] == 1) {
	print '
<style>
	form {width: 100%;}
	input, textarea {display: inline-block; width: 90%;}
	textarea {height: 250px;}
</style>';
}

$id = $_GET['i'];

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
    <select name="category" required>
    <option disabled>Выберите категорию</option>';

    $res2 = mysqli_query($db, "SELECT * FROM `categories` ORDER BY `priority` DESC");
    while ($row2 = mysqli_fetch_array($res2)) {
        print ' <option value="'. $row2['id'] . '"';
        if ($row2['id'] == $row['category']) {
			print ' selected';
		}
		print '>' . $row2['name'] . '</option>';
    }

print '</select><br>
		<textarea name="descr" placeholder="Короткое описание">' . $row['descr'] . '</textarea><br>
		<textarea name="cont" placeholder="Полное описание">' . $row['cont'] . '</textarea><br>';
		} else {
			print '<div style="color: #000;">' . nl2p($row['descr']) . '</div><div>' . nl2p($row['cont']) . '</div>';
		}

		if ($_SESSION['admin'] == 1) {
			print '<input name="price" style="width: 100px;" value="' . $row['price'] . '">₽<br>
		Приоритет: <input name="priority" value="' . $row['priority'] . '" style="width: 100px;">
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

include('../sys/foot.html');
?>