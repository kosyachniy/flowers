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
	<textarea name="descr" placeholder="Короткое описание"></textarea>
	<textarea name="cont" placeholder="Полное описание"></textarea>
	<input name="price" placeholder="Цена" required>
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
$res = mysqli_query($db, "SELECT * FROM `products` ORDER BY `id` DESC");
while ($row = mysqli_fetch_array($res)) {
	include('sys/middle.html');
}
?>

</div>

<?php
include('sys/foot.html');
?>