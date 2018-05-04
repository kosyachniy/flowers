<?php
$title = 'Поиск';
include('../sys/head.html');
?>

<script>
	place('.notes2', 3, 85, 20);
</script>

<div class="notes2">

<?php
$req = mb_strtolower($_GET['i'], 'UTF-8');

$res = mysqli_query($db, "SELECT * FROM `products` ORDER BY `id` DESC");
while ($row = mysqli_fetch_array($res)) {
	if (stripos(' ' . $row['name'], $req)) {
		$d = '';
		include('../sys/middle.html');
	}
}
?>

</div>

<?php
include('../sys/foot.html');
?>