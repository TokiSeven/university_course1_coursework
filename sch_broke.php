<?php
include("config.php");
session_start();
unset($_SESSION['f0']);
unset($_SESSION['el']);
unset($_SESSION['n']);
unset($_SESSION['m']);
session_destroy();
header('Location: '.$index.'');
?>