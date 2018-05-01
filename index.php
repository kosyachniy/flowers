<?php
$title = 'Заказ цветов';
include('sys/main.html');
?>

<script>
	place('.note', 4, 85, 10, 15)
</script>

<div class="info" onclick="change(this);">↑ Нажми на лого ↑</div>

<div class="note">

<?php
include('sys/func.php');
$db = db('');
$res = mysqli_query($db, "SELECT * FROM `usl`");
while ($row = mysqli_fetch_array($res))
	print '<div>' . $row['name'] . '</div>';
?>

</div>

</body>
</html>