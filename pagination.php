<?php
	/*
		Place code to connect to your DB here.
	*/
	include('connection.php');	// include your code to connect to DB.

	$tbl_name="question";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;

	/*
	   First get total number of rows in data table.
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT * FROM $tbl_name";
	$total_pages = mysqli_query($link, $query);
	$total_pages = mysqli_num_rows($total_pages);
	//echo $total_pages;

	/* Setup vars for query. */
	$targetpage = "pagination.php"; 	//your file name  (the name of this file)
	$limit = 1; 								//how many items to show per page
	$page = $_GET['page'];
	if($page)
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0

	/* Get data. */
	$sql = "SELECT * FROM $tbl_name rand LIMIT $start, $limit";
	$result =mysqli_query($link, $sql);

	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1

	/*
		Now we apply our rules and draw the pagination object.
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1)
			$pagination.= "<a href=\"$targetpage?page=$prev\">� previous</a>";
		else
			$pagination.= "<span class=\"disabled\">� previous</span>";

		//pages
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
				}
			}
		}

		//next button
		if ($page < $counter - 1)
			$pagination.= "<a href=\"$targetpage?page=$next\">next �</a>";
		else
			$pagination.= "<span class=\"disabled\">next �</span>";
		$pagination.= "</div>\n";
	}
	echo "<table border='1' >
<tr>

<td align=center><b>Question</b></td>

</tr>";
?>

	<?php

			$trt = 2 ;

		while($row = mysqli_fetch_array($result))
		{
			$question = $row['question'];
			$option1 = $row['option1'];
			$option2 = $row['option2'];
			$option3 = $row['option3'];
			$option4 = $row['option4'];
			$correctanswer = $row['correctanswer'];
			$num = $row['qno'];
			//numbering of questions
			 $ballin = $page * $adjacents;
			$_SESSION['new'] = $ballin - $trt;
			$trt--;

			
						if ($correctanswer == $option1){
			$opt1="checked";
			}
			else{
				$opt1="";
				}

				if ($correctanswer == $option2){
			$opt2="checked";
			}
			else{
				$opt2="";
				}

				if ($correctanswer == $option3){
			$opt3="checked";
			}
			else{
				$opt3="";
				}

				if ($correctanswer == $option4){
			$opt4="checked";
			}
			else{
				$opt4="";
				}



			echo "<tr>

			 <td> <textarea>{$_SESSION['new']}{$question} </textarea><br>

			<strong>A</strong> <input type='radio' name='response{$num}' '{$opt1}' value='$option1'>{$option1} <br>
		<strong>B</strong> <input type='radio' name='response{$num}' '{$opt2}' value='{$option2}'>{$option2} <br>
		<strong>C</strong> <input type='radio' name='response{$num}' '{$opt3}' value='{$option3}'>{$option3}<br>
			<strong>D</strong> <input type='radio' name='response{$num}' '{$opt4}' value='{$option4}'>{$option4} </td><br>
		<input name='correction' type='hidden' id='qn3' value='{$correctanswer}' />
		<input name='correct' type='hidden' id='qn3' value='{$option1}' />
		<input name='corrected' type='hidden' id='qn3' value='{$option2}' />
		<input name='correctsi' type='hidden' id='qn3' value='{$option3}' />
		<input name='correctss' type='hidden' id='qn3' value='{$option4}' />
			</tr>";
		// Your while loop here

		}
		echo "</table>";

	?>

<?=$pagination?>
