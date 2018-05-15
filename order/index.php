<?php
$title = 'Заказ';
include('../sys/head.html');

$re = $_COOKIE['basket'];
$basket = explode('-', $re);
$text = '<style>
td {padding: 5px;}
</style>
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
$times = $_POST['times'];
$descr = $_POST['descr'];
$geo = $_POST['geo'];
$tel = $_POST['tel'];

mysqli_query($db, "INSERT INTO `orders`(`name`, `surname`, `basket`, `price`, `time`, `times`, `descr`, `geo`, `tel`) VALUES ('$name', '$surname', '$re', '$sum', '$time', '$times', '$descr', '$geo', '$tel');");
$id = mysqli_insert_id($db);

$text .= '</table>
<h4>Общая сумма заказа: ' . $sum . ' руб.</h4>
'. $surname . ' ' . $name . ' (' . $tel . ')<br>
Адрес: ' . $geo . '<br>
Время: ' . $times . '<br>';
if ($descr) {
	$text .= 'Комментарий:<br>' . $descr;
}

mail($set['mail'], 'Заказ №' . $id, $text, 'Content-type: text/html;\r\n');

print '<script>
deleteCookie("basket");
setCookie("basket", "", 14);
</script>
<div style="margin: 10px 0 10px 10%;">
	<h2>Ваш заказ <b>№' . $id . '</b> оформлен!</h2>
	<h4>Оплата заказа после доставки.<br>
	По всем вопросам: <a href="tel:' . $set['tel'] . '">' . $set['tel'] . '</a></h4>
</div>';

include('../sys/foot.html')
?>