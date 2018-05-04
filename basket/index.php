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
$res = mysqli_query($db, "SELECT * FROM `products`");
while ($row = mysqli_fetch_array($res)) {
	$d = 'display: none;" id="' . $row['id'] . '"';
	include('../sys/middle.html');
}
?>

</div>

<script>
	var basket = getCookie('basket').split('-');
	for (var i in basket) {
		if (basket[i]) {
			var x = document.getElementById(basket[i]);
			if (x)
				x.style.display = 'inline-block';
		}
	}
</script>

<?php
include('../sys/foot.html');
?>