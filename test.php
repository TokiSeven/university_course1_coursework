<?php
session_start();
$el=$_SESSION['el'];
$curr=$el[0];
$n=count($el);
?>
<html>
<head>
</head>
<body>
<?php
$curr=$el[$curr->next_id];
echo $curr->type;
echo '<br>Наши элементы:<br>(Число элементов в массиве = '.$n.' )<br>';
$curr=$el[0];
for ($i=0;$i<=$n;$i++)
{
	echo '<br>'.$i.':';
	if ($el[$i]->type=="conn_op")
	{
		echo '<br>Id: '.$el[$i]->id.'<br>Next_up: '.$el[$i]->next_id_up.'<br>Next_down: '.$el[$i]->next_id_down.'<br>';
	} else
	{
		echo '<br>Id: '. $curr->id .'<br>Next: '. $el[$i]->next_id .'<br>';
	}
}
?>
</body>
</html>