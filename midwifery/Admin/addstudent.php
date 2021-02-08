<?php

session_start();

include("connection.php");

$Fname= mysqli_real_escape_string($link, $_POST['Fname']);
$Lname= mysqli_real_escape_string($link, $_POST['Lname']);
$Email= mysqli_real_escape_string($link, $_POST['Email']);
$Uname= mysqli_real_escape_string($link, $_POST['Uname']);
$Pword = mysqli_real_escape_string($link, $_POST['Pword']);
$Pword2 = mysqli_real_escape_string($link, $_POST['Pword2']);
$student = "student";
$test = "test";

$query1 = "SELECT * From $student WHERE username='".$Uname."' and Firstname= '".$Fname."' ";
$result1 = mysqli_query($link, $query1) or die (mysqli_error($link));
$numrow1 = mysqli_num_rows($result1);
if($numrow1 > 0){
  echo '  <div class="alert alert-warning alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                That Username already exists in the database
              </div>
  ';
}else{
  if($Pword == $Pword2){
    $query = "INSERT into $student (Firstname, Lastname, Email, username, password) values('$Fname', '$Lname', '$Email', '$Uname', '$Pword')";
    $result = mysqli_query($link, $query) or die (mysqli_error($link));
    if($result){
      echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                      Addition successful!!!
                  </div>
    ';
    }else{
      echo '  <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    Error(s) has occured!! Addition is unsuccessful
                  </div>
      ';
    }
  } else{
    echo '  <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                  That passwords does not match
                </div>
    ';
  }

}


 ?>
