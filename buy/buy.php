<?php
include('../sys/func.php');
session_start();
$db = db();

$basket = explode('-', $_COOKIE['basket']);
$text = '<table><tr style="background-color: #cdfe29;"><td>Наименование</td><td>Цена</td></tr>';

$res = mysqli_query($db, "SELECT * FROM `products`");
while ($row = mysqli_fetch_array($res)) {
	if (in_array($row['id'], $basket)) {
		$text .= '<tr><td>' . $row['name'] . '</td><td>' . $row['price'] . '</td></tr>';
		$sum += $row['price'];
	}
}

$text .= '</table>
<h4>Общая сумма заказа: ' . $sum . '₽</h4>
'. $_POST['surname'] . ' ' . $_POST['name'] . ' (' . $_POST['tel'] . ')<br>
Адрес: ' .$_POST['geo'] . ' (c ' . $_POST['timestart'] . ' до ' . $_POST['timestop'] . ')';

$res = mysqli_query($db, "SELECT * FROM `main` WHERE `name`='mail");
while ($row = mysqli_fetch_array($res)) {
	$mail = $row['cont'];
}

mail($mail, 'Заказ', $text);

header("location: /");
?>