<form name="scheme" method="post" action="<?php echo $item_add; ?>">
	Что вставляем?
	<select name="I_insert" size="1">
		<option value="I_line-g.jpg">Провод</option>
		<option value="I_light.jpg">Лампа</option>
		<option value="I_em.jpg">Электромагнит</option>
		<option value="I_resistor.jpg">Резистор</option>
		<option value="I_reostat.jpg">Реостат</option>
		<option value="I_batarei.jpg">Гальванический элемент</option>
		<option value="I_key.jpg">Ключ</option>
	</select>
	<br>
	Выберите узел, после которого предмет вставляется (n):
	<select name="N_insert">
		<?php
		if ($f0==false)
			echo '<option value="0">0(n)</option>';
		else
		{
			$n=$_SESSION['n'];
			$el=$_SESSION['el'];
			for ($i=0;$i<=$n;$i++)
				if ($el[$i]->type=="item" || $el[$i]->type=="conn_cl")
					echo '<option value="'.$i.'">'.$i.'(n)</option>';
		};
		?>
	</select>
	<br><br>
	<input type="submit" value="Вставить">
</form>
<hr>

<?php
$f0=$_SESSION['f0'];
if ($f0==true)
{
	//create a connection
	echo '
	<form action="'.$item_edit.'" name="soed" method="POST">
		После какого объекта создать параллельное соединение?<br>Id элемента (n)
		<select name="N_insert">
			';
			$n=$_SESSION['n'];
			$el=$_SESSION['el'];
			for ($i=0;$i<=$n;$i++)
				if ($el[$i]->type=="item" || $el[$i]->type=="conn_cl")
					echo '<option value="'.$i.'">'.$i.'(n)</option>';
			echo '
		</select>
		<br><br>
		<input type="submit" value="Создать параллельное соединение">
	</form>
	<hr>';
	//delete item
	echo '<form action="'.$item_delete.'" name="delete" method="POST">';
	echo 'Какой элемент удалить?<br>Id элемента (n)';
	echo '<select name="N_delete">';
	$n=$_SESSION['n'];
	$el=$_SESSION['el'];
	for ($i=1;$i<=$n;$i++)
		if ($el[$i]->type == "item" && $el[$i-2]->type != "conn_op" && $el[$i-3]->type != "conn_op")
			echo '<option value="'.$i.'">'.$i.'(n)</option>';
	echo '</select>';
	echo '<br><br>
	<input type="submit" value="Удалить элемент">
	</form>
	<hr>';
	//delete connection
	echo '<form action="'.$conn_delete.'" name="delete_conn" method="POST">';
	echo 'Какое соединение удалить?<br>Id начала (цифра перед разветвлителем) (n)';
	echo '<select name="N_delete">';
	$n=$_SESSION['n'];
	$el=$_SESSION['el'];
	for ($i=1;$i<=$n;$i++)
		if ($el[$i]->type=="conn_op")
			echo '<option value="'.$i.'">'.$i.'(n)</option>';
	echo '</select>';
	echo '<br><br>
	<input type="submit" value="Удалить соединение">
	</form>
	<hr>';
}
	?>

<form name="broke" action="<?php echo $sch_broke; ?>">
	<input type="submit" value="Сбросить цепь" method="POST">
</form>