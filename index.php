<?php
$title = 'Заказ цветов';
include('sys/main.html');
?>

<script>
	place('.notes2', 3, 85, 20);
</script>

<div class="notes2">

<?php
$res = mysqli_query($db, "SELECT * FROM `products` ORDER BY `id` DESC");
while ($row = mysqli_fetch_array($res))
	print '<a href="product/' . $row['id'] . '"><div style="background-image: url(load/products/' . $row['id'] . '.jpg">
	<div class="back">
		<table>
			<tr>
				<td>' . $row['name'] . '</td>
				<td>' . $row['price'] . '₽</td>
			</tr>
		</table>
	</div>
</div></a>';
?>

</div>

</body>
</html>