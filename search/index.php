<?php
$title = 'Поиск';
include('../sys/head.html');
?>

<script>
	place('.notes2', 3, 85, 20);
</script>

<div class="notes2">

<?php
$req = $_GET['i'];

print '<div style="margin: 0 0 20px 0;"><h2>Результаты поиска "' . $req . '"</h2></div><br>';

$req = mb_strtolower($req, 'UTF-8');

$res = mysqli_query($db, "SELECT * FROM `products` ORDER BY `id` DESC");
while ($row = mysqli_fetch_array($res)) {
	if (stripos(' ' . mb_strtolower($row['name'], 'UTF-8'), $req) || stripos(' ' . mb_strtolower($row['descr'], 'UTF-8'), $req) || stripos(' ' . mb_strtolower($row['cont'], 'UTF-8'), $req) || ($row['price'] == $req)) {
		include('../sys/middle.html');
	}
}
?>

</div>

<?php
include('../sys/foot.html');
?>