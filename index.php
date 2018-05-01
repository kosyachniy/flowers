<?php
$title = 'Заказ цветов';
include('sys/main.html');
?>

<script>
	place('.notes2', 4, 85, 10)
</script>

<div class="info" onclick="change(this);">↑ Нажми на лого ↑</div>

<div class="notes2">

<?php
include('sys/func.php');
$db = db();
$res = mysqli_query($db, "SELECT * FROM `products`");
while ($row = mysqli_fetch_array($res))
	print '<a href="product/' . $row['id'] . '"><div style="background-image: url(load/products/' . $row['id'] . '.jpg">
	<div class="back">
		<table>
			<tr>
				<td>' . $row['name'] . '</td>
				<td>' . $row['price'] . '</td>
			</tr>
		</table>
	</div>
</div></a>';
?>

</div>

</body>
</html>