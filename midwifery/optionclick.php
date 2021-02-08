<?php
session_start();
include("connection.php");
//$qno=$_GET['qno'];
$subject= $_SESSION['subject'];
$ans= mysqli_real_escape_string($link, $_POST['RadioGroup1']);
$corans = mysqli_real_escape_string($link, $_SESSION['cor']);

if (!$_SESSION['testid']) {
  $query12 = "SELECT `id` From `test` WHERE subject='".$subject."'";
  $resul = mysqli_query($link, $query12)  or die (mysqli_error($link));
  $fet = mysqli_fetch_assoc($resul);
  $_SESSION['testid']=$fet['id'];
}

$query = "SELECT `atid` FROM `testattempt` WHERE  stdid='". $_SESSION['stid']."' and testid='".$_SESSION['testid']."' and quid='".$_SESSION['qno']."' LIMIT 1";
$result = mysqli_query($link, $query) or die (mysqli_error($link));
$row = mysqli_num_rows($result);

if($row > 0){

  	$query ="UPDATE `testattempt` SET ans='".$ans."', correctans='".$corans."' WHERE quid='".$_SESSION['qno']."' and stdid='". $_SESSION['stid']."' and testid='".$_SESSION['testid']."'";
  	$result = mysqli_query($link, $query) or die (mysqli_error($link));

} else{

  $query2 = "INSERT INTO `testattempt`(stdid, testid, quid, ans, correctans) VALUES ('".$_SESSION['stid']."', '".$_SESSION['testid']."', '".$_SESSION['qno']."', '".$ans."', '".$corans."')";
	$result = mysqli_query($link, $query2) or die (mysqli_error($link));
}



 ?>
