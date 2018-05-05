<?php
$title = 'Заказ';
include('../sys/head.html');
session_start();

$re = $_COOKIE['basket'];
$basket = explode('-', $re);
$text = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Demystifying Email Design</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
	<table><tr style="background-color: #cdfe29;"><td>Наименование</td><td>Цена</td></tr>';

$res = mysqli_query($db, "SELECT * FROM `products`");
while ($row = mysqli_fetch_array($res)) {
	if (in_array($row['id'], $basket)) {
		$text .= '<tr><td>' . $row['name'] . '</td><td>' . $row['price'] . '</td></tr>';
		$sum += $row['price'];
	}
}

$name = $_POST['name'];
$surname = $_POST['surname'];
$time = time();
$timestart = $_POST['timestart'];
$timestop = $_POST['timestop'];
$geo = $_POST['geo'];
$tel = $_POST['tel'];

mysqli_query($db, "INSERT INTO `orders`(`name`, `surname`, `basket`, `price`, `time`, `timestart`, `timestop`, `geo`, `tel`) VALUES ('$name', '$surname', '$re', '$sum', '$time', '$timestart', '$timestop', '$geo', '$tel');");
$id = mysqli_insert_id($db);

$text .= '</table>
<h4>Общая сумма заказа: ' . $sum . '₽</h4>
'. $surname . ' ' . $name . ' (' . $tel . ')<br>
Адрес: ' . $geo . ' (c ' . $timestart . ' до ' . $timestop . ')
</body>
</html>';

mail($set['mail'], 'Заказ №' . $id, $text);

$_COOKIE['basket'] = '';

print '<div style="margin: 10px 0 10px 10%;"><h2>Ваш заказ <b>№' . $id . '</b> оформлен!</h2></div>';

include('../sys/foot.html')
?>