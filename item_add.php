<?php
include("config.php");
session_start();
$f0=$_SESSION['f0'];
$I_insert=$_POST['I_insert'];
$V_insert=$_POST['V_insert'];
$N_insert=$_POST['N_insert'];
$M_insert=$_POST['M_insert'];
if ($f0==false)
{
	$el[0] = new item;
	$el[0]->image='I_line_start.jpg';
	$el[0]->last_id="start";
	$el[0]->id=0;
	$n=1;
	$m=0;
	$el[] = new item;
	$el[1]->image=$I_insert;
	$el[1]->value=$V_insert;
	$el[1]->next_id="end";
	$el[1]->last_id=$el[0]->id;
	$el[1]->id=1;
	$el[0]->next_id=$el[1]->id;
	$f0=true;
}
else{
	$n=$_SESSION['n'];
	$m=$_SESSION['m'];
	$el=$_SESSION['el'];
	
	$n++;
	$el[]=new item;
	$el[$n]->image=$I_insert;
	$el[$n]->value=$V_insert;
	$el[$n]->id=$n;
	$nm=$N_insert;
	$el[$n]->last_id=$N_insert;
	$el[$n]->next_id=$el[$nm]->next_id;
	$el[$nm]->next_id=$el[$n]->id;
	$nm=$el[$n]->next_id;
	if ($nm!="end")
		$el[$nm]->last_id=$el[$n]->id;
};
$_SESSION['f0']=$f0;
$_SESSION['el']=$el;
$_SESSION['n']=$n;
$_SESSION['m']=$m;
header('Location: '.$index.'');
?>