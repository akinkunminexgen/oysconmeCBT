<?php

session_start();

include("connection.php");

$id = $_GET['studid'];
$someval = $_GET['abstr'];

$query = "DELETE FROM $someval WHERE id ='".$id."'";
$result = mysqli_query($link, $query) or die (mysqli_error($link));
if ($result){
  $_SESSION['alert']= 'alert-success';
$_SESSION['message']= 'Deleted successfully!!!';
}else {
  $_SESSION['alert']= 'alert-danger';
$_SESSION['message']= "Error(s) have occured";

}
echo "just echo something";

 ?>
