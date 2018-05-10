<?php
header('Content-type: text/html; charset=utf-8');
session_start();

function db($name='main') {
	$db = mysqli_connect('mysql.hostinger.ru', 'u869945297_main', 'asdrqwerty09', 'u869945297_'.$name);
	if (mysqli_connect_errno()) print 'Ошибка 1. '.mysqli_connect_errno();
	mysqli_query($db, 'SET names "utf8"');
	return $db;
}

function nl2p($string) {
	$paragraphs = '';

	foreach (explode("\n", $string) as $line) {
		if (trim($line)) {
			$paragraphs .= '<p>' . $line . '</p>';
		}
	}

	return $paragraphs;
}

function mb_strtoupper_first($str, $encoding = 'UTF8') {
	return mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding) . mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
}
?>