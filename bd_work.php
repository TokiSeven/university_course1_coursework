<?php
if (isset($_SESSION['flag_work']))
	$flag_work = $_SESSION['flag_work'];
else
	$flag_work = false;

$el = $_SESSION['el'];
$curr = $el[0];

$flag_gl2 = true;
$flag_ud = true;
$flag_gl3 = true;

if (count($el))
	while ($flag_gl2)
		check_work($curr, $flag_gl2, $flag_ud, $flag_gl3);

$flag_work = $flag_gl3;

if ($flag_work)
	echo '<p style="color:green;">Работает!</p>';
else
	echo '<p style="color:red;">Не работает!</p>';

$_SESSION['flag_work'] = $flag_work;
?>