<?php
header('Content-type: text/html; charset=utf-8');
session_start();

function db($name='main') {
	$db = mysqli_connect('mysql.hostinger.ru', 'u489860185_main', 'asdrqwerty09', 'u489860185_'.$name);
	if (mysqli_connect_errno()) print 'Ошибка 1. '.mysqli_connect_errno();
	mysqli_query($db, 'SET names "utf8"');
	return $db;
}

function user($type) {
	$ip = $_SERVER['REMOTE_ADDR'];
	$cookie = $_COOKIE['user'];

	if ($_SESSION['auth'] != 2 && $_SESSION['auth'] != 1) {
		if ($cookie == '') {
			// Сообщение при первом входе в день
			if ($_SESSION['auth'] != 1 && $_SESSION['auth'] != 2) {
				$_SESSION['access'] = 11;
				$_SESSION['auth'] = 1;
				$_SESSION['user'] = $ip;
			}
		}
		else {
			$u = mysqli_query($db, "SELECT * FROM `user` WHERE `user`='$cookie'");
			if ($u)
				while ($a=mysqli_fetch_array($u))
					if ($_COOKIE['password'] == $a['pas']) {
						$_SESSION['access'] = $a['admin'];
						$_SESSION['user'] = $cookie;
						$_SESSION['auth'] = 2;
						$_SESSION['fio'] = $a['nam'] . ' ' . $a['fam'];
					}
		}
	}

	if ($_SESSION['access'] > 12)
		print 'Ошибка 2. Вы заблокированы.';
	else {
		if ($_SESSION['auth'] == 2) {
			if ($type == 1)
				return $_SESSION['user'];
			elseif ($type == 3)
				return $_SESSION['user'] . ' <a href="/sys/php/out.php">Выйти</a>';
			elseif ($type == 4)
				return 'Вы сейчас в пользователе ' . $_SESSION['user'];
			elseif ($type == 5)
				return $_SESSION['access'];
			elseif ($type == 6)
				return $_SESSION['fio'];
		}
		else {
			if ($type == 1)
				return $ip;
			elseif ($type == 2)
				return 'Гость';
			elseif ($type == 3)
				return 'Гость <a href="/set/login/">Войти</a>';
			elseif ($type == 4)
				return 'Вы не вошли';
			elseif ($type == 5)
				return $_SESSION['access'];
		}
	}
}
?>