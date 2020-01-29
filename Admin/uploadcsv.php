<?php
include("connection.php");
if (isset($_POST['submitFile'])) {
  print_r($_FILES);
  $file = $_FILES['file']['tmp_name'];
  $handle = fopen($file, "r");
  $filename = explode('.', $_FILES['file']['name']);


  if ($file == NULL || $filename[1] !== 'csv') {
  $msg =  '  <div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                  Please select a CSV file to import!!!
                </div>
    ';
  }
  else {
    $i = 1;
    $msg.= '<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-ban"></i> Alert!</h4>';
    while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
      {

        $qnum=  mysqli_real_escape_string($link, $filesop[0]);
        $question =  mysqli_real_escape_string($link, $filesop[1]);
        $subject =  mysqli_real_escape_string($link, $filesop[2]);
        $optionA = mysqli_real_escape_string($link, $filesop[3]);
        $optionB = mysqli_real_escape_string($link, $filesop[4]);
        $optionC = mysqli_real_escape_string($link, $filesop[5]);
        $optionD = mysqli_real_escape_string($link, $filesop[6]);
        $corans = mysqli_real_escape_string($link, $filesop[7]);

        //to generate the id of the company and error handling for wrong company's name
        $query = "SELECT * FROM `question` WHERE qno = '".$qnum."' AND test = '".$subject."'";
        $result = mysqli_query($link, $query) or die (mysqli_error($link));
        $numquery = mysqli_num_rows($result);
        if($numquery > 0){
            $sql = false;
          $msg.= "Failed to import at row ".$i."That question has already existed in the database <br>";
        }else {
          echo "you are the one";
        //  $query = "INSERT into `question` (qno, question, test, option1, option2, option3, option4, correctanswer) values('$qnum', '$question', '$subject','$optionA',' $optionB', '$optionC', '$optionD', '$corans')";
          $result = mysqli_query($link, $query) or die (mysqli_error($link));
          if ($result) {
            $sql = true;
          }
        }

      $i++;

    }
    $msg.='</div>';

    if ($sql) {
      $msg.= '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                      Question(s) imported successfully
                  </div>
    ';
    }
    echo $msg;
}
}







 ?>
