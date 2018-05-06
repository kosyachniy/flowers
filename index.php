<?php
$title = 'Заказ цветов';
include('sys/head.html');
?>

<div class="info" onclick="change();">↑ Нажми на лого ↑</div>

<style>
	form {width: 100%;}
	input, textarea {display: inline-block; width: 90%;}

	.mail {width: 40%;}
	.geo {width: 50%;}

	@media all and (max-width: 635px) {
		.mail, .geo {width: 90%; display: block;}
	}

	.note-title {
		font-size: 1.5rem;
		color: #cdfe29;
		font-weight: bold;
	}

	.note-title:visited {
		color: #cdfe29;
	}

	@media all and (max-width: 590px) {
		.note-title {margin-left: 1.5rem;}
	}
</style>

<?php
if ($_SESSION['admin'] == 1) {
	print '<div style="margin-left: 10%; width: 80%">
<h2>Панель администратора</h2>
<form action="edit.php" method="post">
	<input name="name" placeholder="Название компании" value="' . $set['name'] . '">
	<input name="tel" placeholder="Телефон" value="' . $set['tel'] . '">
	<input name="mail" placeholder="Почта" value="' . $set['mail'] . '" class="mail"> (На эту же почту будет приходить информация о заказах)<br>
	<input name="geo" placeholder="Местоположение" value="' . $set['geo'] . '" class="geo">
	с <input name="timestart" value="' . $set['timestart'] . '" style="width: 50px;"> до <input name="timestop" value="' . $set['timestop'] . '" style="width: 50px;">
	<input name="vk" placeholder="Ссылка на ВКонтакте" value="' . $set['vk'] . '">
	<input name="insta" placeholder="Ссылка на инстаграмм" value="' . $set['insta'] . '">
	<input type="submit" value="Сохранить" style="width: 93%;"><br><br>
	<a href="out.php" style="color: red; font-size: 1.8rem; text-decoration: underline;">Выйти из режима администратора</a><br>
</form><br><br>
<h4>Добавить товар</h4>
<form action="add.php" method="post">
	<input name="name" placeholder="Название" required>
	<input name="category" placeholder="Категория">
	<textarea name="descr" placeholder="Короткое описание"></textarea>
	<textarea name="cont" placeholder="Полное описание"></textarea>
	<input name="price" placeholder="Цена" required><br>
	Приоритет: <input name="priority" placeholder="Цена" value="50" style="width: 100px;">
	<input type="submit" value="Добавить" style="width: 93%;">
</form>
</div>'; 
}
?>

<script>
	place('.notes2', 3, 85, 20);
</script>

<div class="notes2">

<?php
$res = mysqli_query($db, "SELECT * FROM `products` GROUP BY `category` DESC");
while ($row2 = mysqli_fetch_array($res)) {
	if (strlen($row2['category'])) {
		$cat2 = mb_strtoupper_first($row2['category']);
	} else {
		$cat2 = 'Другое';
	}
	$cat = $row2['category'];

	print '<br><a href="product/?c=' . $cat . '" class="note-title">' . $cat2 . ' ></a><br>';

	$res2 = mysqli_query($db, "SELECT * FROM `products` WHERE `category` = '$cat' ORDER BY `priority` DESC LIMIT 3");
	while ($row = mysqli_fetch_array($res2)) {
		include('sys/middle.html');
	}

	print '<br>';

}
/*
$res = mysqli_query($db, "SELECT DISTINCT `category` FROM `products`");
while ($row = mysqli_fetch_array($res)) {
	print $row['category'];
}

$res = mysql_query($db, "SHOW COLUMNS FROM `products` WHERE `field` = 'category'");
while ($row = mysqli_fetch_array($res)) {
	print $row['category'];
}

$res = mysqli_query($db, "SELECT * FROM `products` ORDER BY `priority` DESC");
while ($row = mysqli_fetch_array($res)) {
	include('sys/middle.html');
}

$res = mysqli_query($db, "SELECT * FROM `products` ORDER BY `priority` DESC");
while ($row = mysqli_fetch_array($res)) {
	include('sys/middle.html');
}
*/
?>

</div>

<div style="width: 100%; height: 500px;">
	<a class="dg-widget-link" href="http://2gis.ru/n_novgorod/firm/2674541559940084/center/43.95288705825806,56.340401698160264/zoom/16?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=bigMap">Посмотреть на карте Нижнего Новгорода</a><div class="dg-widget-link"><a href="http://2gis.ru/n_novgorod/firm/2674541559940084/photos/2674541559940084/center/43.95288705825806,56.340401698160264/zoom/17?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=photos">Фотографии компании</a></div><div class="dg-widget-link"><a href="http://2gis.ru/n_novgorod/center/43.95289,56.339959/zoom/16/routeTab/rsType/bus/to/43.95289,56.339959╎Цветочка, букетная лавка?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=route">Найти проезд до Цветочка, букетная лавка</a></div><script charset="utf-8" src="https://widgets.2gis.com/js/DGWidgetLoader.js"></script><script charset="utf-8">new DGWidgetLoader({"width":640,"height":600,"borderColor":"#a3a3a3","pos":{"lat":56.340401698160264,"lon":43.95288705825806,"zoom":16},"opt":{"city":"n_novgorod"},"org":[{"id":"2674541559940084"}]});</script><noscript style="color:#c00;font-size:16px;font-weight:bold;">Виджет карты использует JavaScript. Включите его в настройках вашего браузера.</noscript>
</div>
<style>
	iframe {width: 100%;}
</style>

<?php
include('sys/foot.html');
?>