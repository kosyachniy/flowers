<?php
$title = 'Заказ цветов';
include('../sys/head.html');

$id = $_GET['i'];

$res = mysqli_query($db, "SELECT * FROM `products` WHERE `id`='$id'");
while ($row = mysqli_fetch_array($res)) {
	print '<div class="note">
	<h1>' . $row['name'] . '</h1>
	<img src="/load/products/' . $id . '.jpg">';

	if ($row['descr']) print '<br>' . $row['descr'];

	if ($row['cont']) print '<br><br>' . $row['cont'];

	print '<script>
$.cookie(\'name\', \'value\', { expires: 7, path: \'/\' });
alert(getCookie(\'basket\'));
var x = ' . $row['id'] . ';
if (getCookie(\'basket\').split(\',\').indexOf(x.toString()) != -1) {
	document.write(\'<div onclick="basketoff(this, ' . $row['id'] . ');" class="active">Добавлено в корзину (' . $row['price'] . '₽)</div>\');
} else {
	document.write(\'<div onclick="basketon(this, ' . $row['id'] . ');">Добавить в корзину (' . $row['price'] . '₽)</div>\');
}
</script>
</div>';
}

include('../sys/foot.html');
?>