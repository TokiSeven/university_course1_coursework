<?php
include("config.php");
session_start();

$N_insert=$_POST['N_insert'];
$n=$_SESSION['n'];
$el=$_SESSION['el'];

$nm=-1;
$nm=$N_insert;
	$el[]=new parallel_connection_open;
	$el[]=new parallel_connection_close;
	$n++;
	$n++;
	$pa_op=$n-1;
	$pa_cl=$n;
	$el[]=new item;
	$el[]=new item;
	$n++;
	$n++;
	$it_up=$n-1;
	$it_do=$n;
	$el[$pa_op]->last_id=$nm;
	$el[$pa_cl]->next_id=$el[$nm]->next_id;
	$el[$nm]->next_id=$pa_op;
	$el[$pa_op]->next_id_up=$it_up;
	$el[$pa_op]->next_id_down=$it_do;
	$el[$pa_cl]->last_id_up=$it_up;
	$el[$pa_cl]->last_id_down=$it_do;
	$el[$pa_op]->id=$pa_op;
	$el[$pa_cl]->id=$pa_cl;
	$el[$it_up]->id=$it_up;
	$el[$it_do]->id=$it_do;	
	$el[$it_up]->next_id=$el[$pa_cl]->id;
	$el[$it_up]->last_id=$el[$pa_op]->id;
	$el[$it_do]->next_id=$el[$pa_cl]->id;
	$el[$it_do]->last_id=$el[$pa_op]->id;
	$el[$it_up]->image="I_line-g.jpg";
	$el[$it_do]->image="I_line-g.jpg";


$_SESSION['n']=$n;
$_SESSION['m']=$m;
$_SESSION['el']=$el;

header('Location: '.$index.'');
?>