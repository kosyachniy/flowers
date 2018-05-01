<?php
$title = 'Заказ цветов';
include('sys/head.html');
?>

<script>
	place('.notes2', 3, 85, 20);
</script>

<div class="notes2">

<?php
$res = mysqli_query($db, "SELECT * FROM `products` ORDER BY `id` DESC");
while ($row = mysqli_fetch_array($res))
	print '<a href="product/?i=' . $row['id'] . '"><div style="background-image: url(load/products/' . $row['id'] . '.jpg">
	<div style="background: url(sys/back2.jpg) repeat; opacity: 0.8; position: relative; width: 100%; height: 70px; top: 230px;"></div>
	<div class="back" style="background: none; position: relative; top: -70px;">
		<table>
			<tr>
				<td style="font-size: 1.2rem;">' . $row['name'] . '</td>
				<td style="color: #cdfe29;">' . $row['price'] . '₽</td>
			</tr>
		</table>
	</div>
</div></a>';
?>

</div>

<?php
include('sys/foot.html');
?>