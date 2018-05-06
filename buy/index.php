<?php
$title = 'Оформление заказа';
include('../sys/head.html');
?>

<style>
	table, form {width: 100%;}
	input {display: inline-block;}
	textarea, input {width: 90%;}
	td {padding: 5px;}
</style>

<div style="margin-left: 10%; width: 80%">
<h2>Заказ</h2>

<table>
	<tr style="background-color: #cdfe29; color: #000;">
		<td>
			Наименование
		</td>
		<td>
			Цена
		</td>
	</tr>

<?php
$basket = explode('-', $_COOKIE['basket']);
$sum = 0;

$res = mysqli_query($db, "SELECT * FROM `products`");
while ($row = mysqli_fetch_array($res)) {
	if (in_array($row['id'], $basket)) {
		print '<tr><td>' . $row['name'] . '</td><td>' . $row['price'] . '</td></tr>';
		$sum += $row['price'];
	}
}

print '</table>
<h4>Общая сумма заказа: ' . $sum . '₽</h4>
<form action="/order/index.php" method="post">
	<input name="name" placeholder="Ваше имя" required>
	<input name="surname" placeholder="Ваша фамилия">
	<input name="tel" placeholder="Номер телефона" required>
	<input name="geo" placeholder="Адрес доставки""><br>
	<input name="times" placeholder="Дата и время доставки" required><br>
	Ваш комментарий нам:<br>
	<textarea name="descr"></textarea>
	<input type="submit" value="Заказать" style="width: 93%; margin-bottom: 15px;"><br>
</form>
</div>'; 
?>


<?php
include('../sys/foot.html');
?>