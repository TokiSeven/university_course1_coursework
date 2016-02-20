<?php
//clases (start)
class item{
	var $image;
	var $value;
	var $id;
	var $next_id;
	var $last_id;
	var $type="item";
}
class parallel_connection_open{
	var $last_id;
	var $next_id_up;
	var $next_id_down;
	var $id;
	var $type="conn_op";
}
class parallel_connection_close{
	var $next_id;
	var $last_id_up;
	var $last_id_down;
	var $id;
	var $type="conn_cl";
}
class array_key{
	var $id;
	var $isOn;
	var $id_el;
}
//clases (end)

//function (start)
function echo_item(&$curr,&$flag,&$k_item)
{
	global $el;
	echo '<td><div class="element"><img src="image/'.$curr->image.'"><font>'.$curr->id.'</font></div></td>';
	if ($curr->next_id=="end")
		$flag=false;
	else
		$curr=$el[$curr->next_id];
	$k_item++;
}
function echo_up_down(&$curr,&$k_conn)
{
	for (;$curr->type!="conn_cl";)
		if ($curr->type=="item")
			echo_item($curr,$flag_echo,$k_conn);
		else
			echo_conn($curr,$flag_echo,$k_conn);
}
function echo_conn(&$curr,&$flag,&$k_conn)
{
	global $el;
	if ($curr->type=="conn_op")
	{
		echo '<td><div class="element"><img src="image/I_line-g.jpg"><font>'.$curr->id.'</font></div></td><td><table><tr><td rowspan="2"><img src="image/l_line-v.jpg" class="line-v"></td>';
		$curr=$el[$curr->next_id_up];
		echo_up_down($curr,$k_conn);
	}
	if ($curr->type=="conn_cl")
	{
		$nm=$curr->id - 1;
		$curr=$el[$nm];
		$curr=$el[$curr->next_id_down];
		echo '</td><td rowspan="2" style="position:relative;"><img src="image/l_line-v.jpg" class="line-v"></td><tr>';
		echo_up_down($curr,$k_conn);
		echo '</tr></table><td><div class="element"><img src="image/I_line-g.jpg"><font>'.$curr->id.'</font></div></td></td>';
		if ($curr->next_id=="end")
			$flag=false;
		else
			$curr=$el[$curr->next_id];
	}
}
function delete_conn($nm1)
{
	$el = $_SESSION['el'];
	global $el;
	$nm2 = $nm1 + 1;
	$el[$nm1]->type = "delete";
	$el[$nm2]->type = "delete";
	$i = $el[$nm1]->next_id_up;
	for (;$i != $nm2;)
		if ($el[$i]->type == "item")
		{
			$el[$i]->type = "delete";
			$i = $el[$i]->next_id;
		}
		else
		{
			delete_conn($i);
			$i = $el[$i + 1]->next_id;
		}
	$i = $el[$nm1]->next_id_down;
	for (;$i != $nm2;)
		if ($el[$i]->type == "item")
		{
			$el[$i]->type = "delete";
			$i = $el[$i]->next_id;
		}
		else
		{
			delete_conn($i);
			$i = $el[$i + 1]->next_id;
		}
}
function check_item(&$curr, &$flag_gl2, &$flag_ud, &$flag_gl3)
{
	global $el;
	if ($curr->image == "I_key.jpg")
			$flag_ud = false;
	if ($flag_ud)
	{
		if ($curr->next_id != "end")
			$curr = $el[$curr->next_id];
		else
		{
			$flag_gl2 = false;
			$flag_gl3 = true;
		}
	}
	else
	{
		if ($curr->last_id != "start")
			$curr = $el[$curr->last_id];
		else
		{
			$flag_gl2 = false;
			$flag_gl3 = false;
		}
	}
}
function check_work_conn(&$curr, &$flag_gl2, &$flag_ud, &$flag_gl3)
{
	global $el;
	$n1_local = $curr->id;
	$n2_local = $curr->id + 1;
	$curr = $el[$curr->next_id_up];
	for (;$curr->id != $n2_local && $curr->id != $n1_local;)
		check_work($curr, $flag_gl2, $flag_ud, $flag_gl3);
	if ($curr->id == $n2_local && $flag_ud)
	{
		if ($curr->next_id != "end")
			$curr = $el[$curr->next_id];
		else
		{
			$flag_gl2 = false;
			$flag_gl3 = true;
		}
	}
	else
		if ($curr->id == $n1_local && !$flag_ud)
		{
			$flag_ud = true;
			$curr = $el[$curr->next_id_down];
			for (;$curr->id != $n2_local && $curr->id != $n1_local;)
				check_work($curr, $flag_gl2, $flag_ud, $flag_gl3);
			if ($curr->id == $n2_local)
			{
				if ($curr->next_id != "end")
					$curr = $el[$curr->next_id];
				else
				{
					$flag_gl2 = false;
					$flag_gl3 = true;
				}
			}
			else
			{
				if ($curr->last_id != "start")
					$curr = $el[$curr->last_id];
				else
				{
					$flag_gl2 = false;
					$flag_gl3 = false;
				}
			}
		}
}
function check_work(&$curr, &$flag_gl2, &$flag_ud, &$flag_gl3)
{
	global $el;
	if ($curr->type == "item")
	{
		check_item($curr, $flag_gl2, $flag_ud, $flag_gl3);
	}
	else
	{
		if ($curr->type == "conn_op")
			check_work_conn($curr, $flag_gl2, $flag_ud, $flag_gl3);
		else
			if ($curr->type == "conn_cl" && !$flag_ud)
			{
				$curr = $el[$curr->id - 1];
				if ($curr->last_id != "start")
					$curr = $el[$curr->last_id];
				else
				{
					$flag_gl2 = false;
					$flag_gl3 = false;
				}
			}
	}
}
//function (end)

//includes (start)
$bd_center = "bd_center.php";
$bd_left = "bd_left.php";
$bd_right = "bd_right.php";
$bd_work = "bd_work.php";
$item_add = "item_add.php";
$item_delete = "item_delete.php";
$conn_delete = "conn_delete.php";
$item_edit = "item_edit.php";
$sch_broke = "sch_broke.php";
$sch_close = "sch_close.php";
$index = "index.php";
//includes (end)
?>