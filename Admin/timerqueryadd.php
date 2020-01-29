<?php

session_start();

include("connection.php");
$time = $_POST['timer'];
$subject =  $_POST['subject'];

$query = "UPDATE `test` SET timer= '".$time."' WHERE subject='".$subject."'";
$result = mysqli_query($link, $query)  or die (mysqli_error($link));
//$num_row = mysqli_num_rows($result);



 ?>
