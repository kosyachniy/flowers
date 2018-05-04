<?php
header('Content-type: text/html; charset=utf-8');
session_start();
?>

<style>
body, div, form {vertical-align: top;}
input {background-color: #fff; border: 1px solid #000; height: 50px; font-size: 45px; margin: 0px; padding: 0px;}
</style>
<div style="width: 100%; text-align: center; height: 49%; padding-top: 20%; font-size: 50px; font-family: \'Lato\', sans-serif;">

<?php
if ($_SESSION['admin']==2)
	{
	print '<font color="red">Неверный пароль!</font><br>';
	$_SESSION['admin']=0;
	}
  elseif ($_SESSION['admin']==1)
	print '<font color="greemn">Вы вошли!</font><br>';
  else
	print 'Пароль:';
?>

<form action="admin.php" method="post">
		<input name="pass" type="password" autofocus>
		<input type="submit" value="Войти">
	</form>
</div>