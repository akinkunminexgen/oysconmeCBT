<?php
session_start();
include("connection.php");

$subject= $_SESSION['subject'];
$space = "";
//echo "you";
if (isset($_GET['cokuqno'])) {
$qno=$_GET['cokuqno'];

if(!isset($_SESSION[$subject.'New'])){
$_SESSION[$subject.'New'] = "yes";

    if ($subject == 'Current-affairs') {
      $subject = 'Affairs';
    }


$query = "SELECT `id` FROM `system_cookies` WHERE  stdid='". $_SESSION['stid']."' LIMIT 1";
$result = mysqli_query($link, $query) or die (mysqli_error($link));
$row = mysqli_num_rows($result);

if($row > 0){

  $query2 = "UPDATE `system_cookies` SET $subject ='".$qno."' WHERE stdid='".$_SESSION['stid']."'";
  $result = mysqli_query($link, $query2) or die (mysqli_error($link));
  echo "successful";
} else{

  $query2 = "INSERT INTO `system_cookies`(stdid, $subject) VALUES ('".$_SESSION['stid']."', '".$qno."')";
	$result = mysqli_query($link, $query2) or die (mysqli_error($link));
	echo "successful";
}

}
}

if (isset($_GET['cokutime'])) {
  if (!isset($_SESSION[$subject.'tym'])) {
      $_SESSION[$subject.'tym'] = 'yes';
      $query2 = "UPDATE `system_cookies` SET time_cookies ='".$_GET['cokutime']."', login_status = 'ACTIVE' WHERE stdid='".$_SESSION['stid']."'";
      $result = mysqli_query($link, $query2) or die (mysqli_error($link));
      echo "successful";
      }
}


 ?>
