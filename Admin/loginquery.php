<?php

session_start();

include("connection.php");
$Uname =  mysqli_real_escape_string($link, $_POST['username']);
$password = mysqli_real_escape_string($link, $_POST['password']);

$query1 = "SELECT * From `admin` WHERE username = '".$Uname."' LIMIT 1";
$result1 = mysqli_query($link, $query1) or die (mysqli_error($link));
$rownum1 = mysqli_num_rows($result1);
$row1 = mysqli_fetch_row($result1);
if($rownum1 > 0){
  $ids = $row1[0];


$query = "SELECT * From `admin` WHERE id = '".$ids."' AND password ='".md5($ids.md5($password))."'";
$result = mysqli_query($link, $query) or die (mysqli_error($link));
$rownum = mysqli_num_rows($result);
$row = mysqli_fetch_row($result);
if($rownum > 0){
echo "Logged in successfully";
$_SESSION['Fname'] = $row[4];
$_SESSION['Lname'] = $row[5];
$_SESSION['id']= $row[0];
$_SESSION['privilege'] = $row[3];
$_SESSION['position'] = $row[6];
}else{
  echo "invalid";

}
}else{
  echo "invalid";
}

 ?>
