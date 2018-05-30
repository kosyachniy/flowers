<?php
$title = 'Заказ цветов';
include('../sys/head.html');
session_start();
?>
<style> .note div {color: #000; display: inline-block; vertical-align: top;}</style>
<style>
body {
	margin:0;
}

.image1 {
	margin:30px; 
	cursor:pointer;
	max-height:100px;
}

.popup {
	position: fixed;
	height:100%;
	width:100%;
	top:0;
	left:0;
	display:none;
	text-align:center;
}

.popup_bg {
	background:rgba(0,0,0,0.4);
	position:fixed;
	z-index:1;
	height:100%;
	width:100%;
}


.popup_img {
	position: relative;
	margin:0 auto;
	z-index:2;
	max-height:94%;
	max-width:94%;
	margin:1% 0 0 0;
}
</style>
<SCRIPT type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></SCRIPT>
<script>
$(document).ready(function() { // Ждём загрузки страницы
	
	$(".image1").click(function(){	// Событие клика на маленькое изображение
	  	var img = $(this);	// Получаем изображение, на которое кликнули
		var src = img.attr('src'); // Достаем из этого изображения путь до картинки
		$("body").append("<div class='popup'>"+ //Добавляем в тело документа разметку всплывающего окна
						 "<div class='popup_bg'></div>"+ // Блок, который будет служить фоном затемненным
						 "<img src='"+src+"' class='popup_img' />"+ // Само увеличенное фото
						 "</div>"); 
		$(".popup").fadeIn(800); // Медленно выводим изображение
		$(".popup_bg").click(function(){	// Событие клика на затемненный фон	   
			$(".popup").fadeOut(800);	// Медленно убираем всплывающее окно
			setTimeout(function() {	// Выставляем таймер
			  $(".popup").remove(); // Удаляем разметку всплывающего окна
			}, 800);
		});
	});
	
});
</script>
<?php

if ($_SESSION['admin'] == 1) {
	print '
<style>
	form {width: 100%;}
	input, textarea {display: inline-block; width: 90%;}
	textarea {height: 250px;}
</style>';
}

$id = $_GET['i'];

	$res = mysqli_query($db, "SELECT * FROM `products` WHERE `id`='$id'");
	while ($row = mysqli_fetch_array($res)) {
		print '<div class="note"><h2>' . $row['name'] . '</h2>';

		print '<div class="note-img"><img src="/load/products/' . $row['photo'] . '.jpg">';

		if ($_SESSION['admin'] == 1) {
			print '<br><form action="download.php?i=' . $id . '" method="post" enctype="multipart/form-data">
	<input type="file" name="name" style="width: 90%; font-size: 0.9rem;">
	<input type="submit" value="Загрузить" style="width: 90%;">
</form>';
	
	}

		print '</div><div class="note-cont">';

		if ($_SESSION['admin'] == 1) {
			if (strlen($row['photos'])) {
				print '<style>.img {display: inline-block; width: auto!important; margin: 0!important; text-align: center!important;}</style><br><center>';
				$mas = explode(',', $row['photos']);
				for ($i=1; $i<sizeof($mas); $i++) {
					print '<div class="img"><img src="/load/img/' . $mas[$i] . '.jpg" style="height: 70px; width: auto; margin: 5px"><br><a href="del.php?id=' . $id . '&i=' . $i . '" style="color: red;">Удалить</a></div>';
				}
				print '</center><br>';
			}
			print '<form action="downloads.php?i=' . $id . '" method="post" enctype="multipart/form-data">
	<input type="file" name="name" style="width: 90%; font-size: 0.9rem;">
	<input type="submit" value="Загрузить" style="width: 90%;">
</form><br><br><form action="edit.php?i=' . $id . '" method="post">
		<input name="name" placeholder="Название" value="' . $row['name'] . '"><br>
    <select name="category" required>
    <option disabled>Выберите категорию</option>';

    $res2 = mysqli_query($db, "SELECT * FROM `categories` ORDER BY `priority` DESC");
    while ($row2 = mysqli_fetch_array($res2)) {
        print ' <option value="'. $row2['id'] . '"';
        if ($row2['id'] == $row['category']) {
			print ' selected';
		}
		print '>' . $row2['name'] . '</option>';
    }

print '</select><br>
		<textarea name="descr" placeholder="Короткое описание">' . $row['descr'] . '</textarea><br>
		<textarea name="cont" placeholder="Полное описание">' . $row['cont'] . '</textarea><br>';
		} else {
			if (strlen($row['photos'])) {
				print '<style>.note-cont img {display: inline-block; height: 70px; width: auto; margin: 5px;}</style><br><center>';
				$mas = explode(',', $row['photos']);
				for ($i=1; $i<sizeof($mas); $i++) {
					print '<img src="/load/img/' . $mas[$i] . '.jpg" class="image1">';
				}
				print '</center><br>';
			}
			print '<div style="color: #000;">' . nl2p($row['descr']) . '</div><div>' . nl2p($row['cont']) . '</div>';
		}

		if ($_SESSION['admin'] == 1) {
			print '<input name="price" style="width: 100px;" value="' . $row['price'] . '">₽<br>
		Приоритет: <input name="priority" value="' . $row['priority'] . '" style="width: 100px;">
		<input type="submit" value="Сохранить" style="width: 90%;"></form>';
		}

		print '</div>';

		if ($_SESSION['admin'] != 1) {
?>

<script>
var x = <?=$row['id']?>;
if (getCookie('basket').split('-').indexOf(x.toString()) != -1) {
	document.write('<div onclick="basketoff(this, <?=$row['id']?>, <?=$row['price']?>);" class="button active">Добавлено в корзину (<?=$row['price']?> руб.)</div>');
} else {
	document.write('<div onclick="basketon(this, <?=$row['id']?>, <?=$row['price']?>);" class="button">Добавить в корзину (<?=$row['price']?> руб.)</div>');
}
</script>

<?php
		}

		print '</div>';
	}

include('../sys/foot.html');
?>