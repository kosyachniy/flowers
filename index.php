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

	print '<form action="edit.php" method="post">
	<input name="tel" placeholder="Телефон" value="' . $set['tel'] . '">
	<input name="mail" placeholder="Почта" value="' . $set['mail'] . '"> (На эту же почту будет приходить информация о заказах)
	<input name="geo" placeholder="Местоположение" value="' . $set['geo'] . '">
	с <input name="timestart" value="' . $set['timestart'] . '"> до <input name="timestop" value="' . $set['timestop'] . '">
	<input name="vk" placeholder="Ссылка на ВКонтакте" value="' . $set['vk'] . '">
	<input name="insta" placeholder="Ссылка на инстаграмм" value="' . $set['insta'] . '">
	<input type="submit" value="Сохранить">
	<a href="out.php" color="red">Выйти</a>
</form>'; 
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