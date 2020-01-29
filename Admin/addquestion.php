<?php
session_start();

//if(array_key_exists('submit', $_POST)){
include("connection.php");
$subject= mysqli_real_escape_string($link, $_POST['subject']);
$question = mysqli_real_escape_string($link, $_POST['question']);
$qnum = mysqli_real_escape_string($link, $_POST['qnum']);
$option1 = mysqli_real_escape_string($link, $_POST['optionA']);
$option2= mysqli_real_escape_string($link, $_POST['optionB']);
$option3 = mysqli_real_escape_string($link, $_POST['optionC']);
$option4 = mysqli_real_escape_string($link, $_POST['optionD']);
$corans = mysqli_real_escape_string($link, $_POST['CorAns']);

$UploadedFileName = $_FILES['fileUpload']['name'];

$query0 = "SELECT * FROM `question` WHERE qno = '".$qnum."' AND test = '".$subject."'";
$result0 = mysqli_query($link, $query0) or die (mysqli_error($link));
$numquery0 = mysqli_num_rows($result0);

if($numquery0 > 0){
  echo '  <div class="alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                That question has already existed in the database
              </div>
  ';
}
else{
  if($UploadedFileName!='')
  {
    $upload_directory = "MyUploadImages/";
    $TargetPath = $upload_directory.$UploadedFileName;

    $query = "INSERT into `question` (qno, question, test, option1, option2, option3, option4, correctanswer, images) values('$qnum', '$question', '$subject','$option1',' $option2', '$option3', '$option4', '$corans', '$TargetPath')";
    $result = mysqli_query($link, $query) or die (mysqli_error($link));
    if($result){
      echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                      Question added successfully
                  </div>
    ';
    }else{
      echo '  <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    Error(s) has occured!! Question can not be added successfully
                  </div>
      ';
    }

  }
  else {


$query = "INSERT into `question` (qno, question, test, option1, option2, option3, option4, correctanswer) values('$qnum', '$question', '$subject','$option1',' $option2', '$option3', '$option4', '$corans')";
$result = mysqli_query($link, $query) or die (mysqli_error($link));
if($result){
  echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                  Question added successfully
              </div>
';
}else{
  echo '  <div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                Error(s) has occured!! Question can not be added successfully
              </div>
  ';
}
}
}
//}
//else{
//    echo "neccessary keys does not exists";
//}

 ?>
