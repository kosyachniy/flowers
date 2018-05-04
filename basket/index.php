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
	
/*
	print '<a href="product/?i=' . $row['id'] . '"><div style="background-image: url(../load/products/' . $row['id'] . '.jpg); display: none;" id="' . $row['id'] .'">
	<div style="background: url(../sys/back2.jpg) repeat; opacity: 0.8; position: relative; width: 100%; height: 70px; top: 230px;"></div>
	<div class="back" style="background: none; position: relative; top: -70px;">
		<table>
			<tr>
				<td style="font-size: 1.2rem;">' . $row['name'] . '</td>
				<td style="color: #cdfe29;">' . $row['price'] . '₽</td>
			</tr>
		</table>
	</div>
</div></a>';
*/
?>

</div>

<script>
	var basket = getCookie('basket').split('-');
	for (var i in basket) {
		if (basket[i]) {
			document.getElementById(basket[i]).style.display = 'inline-block';
		}
	}
</script>

<?php
include('../sys/foot.html');
?>