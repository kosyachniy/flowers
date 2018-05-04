<?php
session_start();
$_SESSION['admin'] = 0;
header("location: /");
?>