<?php
include("config.php");
session_start();
$f1=$_SESSION['f1'];
if ($f1==false)
	$f1=true;
else
	$f1=false;
$_SESSION['f1']=$f1;
header('location: '.$index.'');
?>