<?php


session_start();

include("connection.php");
$Uname = $_POST['username'];
$position = $_POST['position'];
$pre = $_POST['privilege'];
$Fname = $_POST['Fname'];
$Lname = $_POST['Lname'];
$Pword = $_POST['Pword'];
$Pword2 = $_POST['Pword2'];

$query1 = "SELECT * From `admin` WHERE username='".$Uname."' and Firstname= '".$Fname."' ";
$result1 = mysqli_query($link, $query1) or die (mysqli_error($link));
$numrow1 = mysqli_num_rows($result1);
if($numrow1 > 0){
  echo '  <div class="alert alert-warning alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                That Username already exists in the database
              </div>
  ';
}else {

if($Pword == $Pword2 ){
$query = "INSERT INTO `admin` (username, password, pre, Firstname, Lastname, Position) VALUES ('$Uname', '$Pword', '$pre', '$Fname','$Lname', '$position')";
$result = mysqli_query($link, $query) or die (mysqli_error($link));
      if($result){
        $ids = mysqli_insert_id($link);
        $query = "UPDATE `admin` set password ='".md5($ids.md5($Pword))."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";;
        $resultUP = mysqli_query($link, $query) or die (mysqli_error($link));
          if ($resultUP) {
            echo "successful";
          }
      }
      else
      {
        echo '  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                      Error(s) have occured!! Account could not be created
                    </div>
        ';
      }
}
else
{
  echo '  <div class="alert alert-warning alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                That passwords does not match
              </div>
  ';
}
}


 ?>
