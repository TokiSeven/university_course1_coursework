<?php
include("config.php");
session_start();
$N_del=$_POST['N_delete'];
$n=$_SESSION['n'];
$el=$_SESSION['el'];
$nm = $N_del;

if ($el[$nm]->next_id!="end")
{
	$num_last=$el[$nm]->last_id;
	$num_next=$el[$nm]->next_id;
	$el[$num_last]->next_id=$el[$num_next]->id;
	$el[$num_next]->last_id=$el[$num_last]->id;
}
else
{
	$num_last=$el[$nm]->last_id;
	$el[$num_last]->next_id="end";
}

$el[$nm]->type="delete";

$_SESSION['n']=$n;
$_SESSION['el']=$el;

header('Location: '.$index.'');
?>