<?php
$title = 'Заказ цветов';
include('../sys/head.html');

$id = $_GET['i'];

$res = mysqli_query($db, "SELECT * FROM `products` WHERE `id`='$id'");
while ($row = mysqli_fetch_array($res)) {
	print '<div class="note">
	<h1>' . $row['name'] . '</h1>
	<div><img src="/load/products/' . $id . '.jpg"></div><div>';

	if ($row['descr']) print '<br>' . $row['descr'];

	if ($row['cont']) print '<br><br>' . $row['cont'];
/*
	print '<div class="note">
	<h1>' . $row['name'] . '</h1>
	<img src="/load/products/' . $id . '.jpg">';

	if ($row['descr']) print '<br>' . $row['descr'];

	if ($row['cont']) print '<br><br>' . $row['cont'];
*/
?>

</div>
<script>
var x = <?=$row['id']?>;
if (getCookie('basket').split('-').indexOf(x.toString()) != -1) {
	document.write('<div onclick="basketoff(this, <?=$row['id']?>, <?=$row['price']?>);" class="button active">Добавлено в корзину (<?=$row['price']?>₽)</div>');
} else {
	document.write('<div onclick="basketon(this, <?=$row['id']?>, <?=$row['price']?>);" class="button">Добавить в корзину (<?=$row['price']?>₽)</div>');
}
</script>
</div>

<?php
}
include('../sys/foot.html');
?>