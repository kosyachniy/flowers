<?php
$title = 'Заказ цветов';
include('../sys/head.html');

$id = $_GET['i'];

function nl2p($string) {
	$paragraphs = '';

	foreach (explode("\n", $string) as $line) {
		if (trim($line)) {
			$paragraphs .= '<p>' . $line . '</p>';
		}
	}

	return $paragraphs;
}

$res = mysqli_query($db, "SELECT * FROM `products` WHERE `id`='$id'");
while ($row = mysqli_fetch_array($res)) {
	print '<div class="note">
	<h2>' . $row['name'] . '</h2>
	<div class="note-img"><img src="/load/products/' . $id . '.jpg"></div><div class="note-cont">';

	if ($row['descr']) print '<div>' . nl2p($row['descr']) . '</div>';
	if ($row['cont']) print '<div>' . nl2p($row['cont']) . '</div>';
?>

</div>
<script>
var x = <?=$row['id']?>;
if (getCookie('basket').split('-').indexOf(x.toString()) != -1) {
	document.write('<div onclick="basketoff(this, <?=$row['id']?>, <?=$row['price']?>);" class="button active">Добавлено в корзину (<?=$row['price']?>₽)</div>');
} else {
	document.write('<div onclick="basketon(this, <?=$row['id']?>, <?=$row['price']?>);" class="button">Добавить в корзину (<?=$row['price']?>₽)</div>');
}
</script>
</div>

<?php
}
include('../sys/foot.html');
?>