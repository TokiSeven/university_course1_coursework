<?php
    header("Content-Type: text/html; charset=utf-8");
	include("config.php");
	session_start();
	if (!isset($_SESSION['f0']))
	{
		$_SESSION['f0']=false;
	}
	$f0=$_SESSION['f0'];
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="main">
	<div id="text">
		<a href="http://vk.com/tokiseven">Рябцев Владимир Дмитриевич<br></a>
		<a href="http://miem.hse.ru/edu/itvt/">Департамент компьютерной инженерии (ранее - ФИТиВТ)<br></a>
		ИВТ-11<br>
		Курсовая работа:<br>
		"Программа для проверки работоспособности электросхем"<br>
	</div>
	<div id="work">
		<?php include($bd_work) ?>
	</div>
	<div id="left_right">
		<div id="left"><?php include($bd_left) ?></div>
		<div id="right"><?php include($bd_right) ?></div>
	</div>
	<div id="clear"></div>
	<div id="center"><?php include($bd_center) ?></div>
</div>
</body>
</html>