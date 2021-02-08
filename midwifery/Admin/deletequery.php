<?php

session_start();

include("connection.php");

$id = $_GET['studid'];
$someval = $_GET['abstr'];

$query = "DELETE FROM $someval WHERE id ='".$id."'";
$result = mysqli_query($link, $query) or die (mysqli_error($link));
if ($result){
echo '<div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Deleted successfully!!!
            </div>
';
}else {
  echo "Error(s) have occured";
}

 ?>
