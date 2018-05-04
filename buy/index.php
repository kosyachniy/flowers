<?php
$title = 'Заказ цветов';
include('sys/head.html');
?>

<div class="info" onclick="change();">↑ Нажми на лого ↑</div>

<?php
if ($_SESSION['admin'] == 1) {
	$res = mysqli_query($db, "SELECT * FROM `main`");
	while ($row = mysqli_fetch_array($res)) {
		$set[$row['name']] = $row['cont'];
	}

	print '<div style="margin-left: 10%; width: 80%">
<h1>Панель администратора</h1>
<form action="edit.php" method="post">
	<input name="tel" placeholder="Телефон" value="' . $set['tel'] . '">
	<input name="mail" placeholder="Почта" value="' . $set['mail'] . '" style="width: 50%;"> (На эту же почту будет приходить информация о заказах)
	<input name="geo" placeholder="Местоположение" value="' . $set['geo'] . '">
	с <input name="timestart" value="' . $set['timestart'] . '" style="width: 50px;"> до <input name="timestop" value="' . $set['timestop'] . '" style="width: 50px;">
	<input name="vk" placeholder="Ссылка на ВКонтакте" value="' . $set['vk'] . '">
	<input name="insta" placeholder="Ссылка на инстаграмм" value="' . $set['insta'] . '">
	<input type="submit" value="Сохранить">
	<a href="out.php" style="color: red;">Выйти</a>
</form>
</div>'; 
}
?>

<script>
	place('.notes2', 3, 85, 20);
</script>

<div class="notes2">

<?php
$res = mysqli_query($db, "SELECT * FROM `products` ORDER BY `id` DESC");
while ($row = mysqli_fetch_array($res)) {
	include('sys/middle.html');
}
?>

</div>

<?php
include('sys/foot.html');
?>