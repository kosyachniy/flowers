<?php
$title = 'Заказ цветов';
include('/sys/head.html');

$id = $_GET['i'];

$res = mysqli_query($db, "SELECT * FROM `products` WHERE `id`='$id'");
while ($row = mysqli_fetch_array($res))
	print '<div class="note">
	<h1>' . $row['name'] . '</h1>
	<img src="/load/product/' . $id . '.jpg">
	<br>' . $row['descr'] . '
	<br><br>' . $row['cont'] . '
	<div onclick="basket(this);">Добавить в корзину (' . $row['price'] . ')</div>
</div>';

include('/sys/foot.html');
?>