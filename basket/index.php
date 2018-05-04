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
//print_r($basket);
// for ($i=0; $i<sizeof($basket); $i++) {
// 	print($basket[$i]);
// }

$res = mysqli_query($db, "SELECT * FROM `products`");
while ($row = mysqli_fetch_array($res)) {
	if (in_array($row['id'], $basket)) {
		include('../sys/middle.html');
	}
}
?>

</div>

<?php
include('../sys/foot.html');
?>