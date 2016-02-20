<?php
if (!isset($_SESSION['f1']))
	$_SESSION['f1']=false;
$f1=$_SESSION['f1'];
if ($f0==false)
{
	echo 'Начни собирать свою схему:<br>';
	echo '<table><tr><td><div class="element"><img src="image/I_line_start.jpg"><font>0</font></div></td>
	<td><div class="element"><img src="image/I_line_end.jpg"></div></td>
	</tr></table>';
	$n=0;
	$_SESSION['n']=$n;
}
else
{
	$k_global = 0;
	$k_item = 0;
	$k_conn = 0;
	$k_mine = 0;
	$n=$_SESSION['n'];
	$el=$_SESSION['el'];
	
	echo '<table><tr>';
	echo '<td><div class="element"><img src="image/'.$el[0]->image.'"><font>0</font></div></td>';
	$curr=$el[$el[0]->next_id];
	
	//Выводим данные в табличку
	$flag_echo=true;
	for (;$flag_echo;)
	{
		if ($curr->type=="item")
			echo_item($curr,$flag_echo,$k_item);
		else
			echo_conn($curr,$flag_echo,$k_conn);
	}
	//for down
	echo '<td><div class="element"><img src="image/I_line_end.jpg"></div></td></tr></table>';
}
?>