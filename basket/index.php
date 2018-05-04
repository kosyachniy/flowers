<?php
$title = 'Заказ цветов';
include('../sys/head.html');
?>

<div class="info" onclick="change();">↑ Нажми на лого ↑</div>

<script>
	place('.notes2', 3, 85, 20);
</script>

<div class="notes2">

<?php
$basket = explode('-', $_COOKIE['basket']);
$empty = true;

$res = mysqli_query($db, "SELECT * FROM `products`");
while ($row = mysqli_fetch_array($res)) {
	if (in_array($row['id'], $basket)) {
		include('../sys/middle.html');
		$empty = false;
	}
}

print '</div>';

if ($empty) {
	print '<div style="margin: -20px 0 20px 10%;"><h2>Корзина пуста!</h2></div>';
} else {
	print '<a href="/buy"><div class="act">Заказать</div></a>';
}

include('../sys/foot.html');
?>