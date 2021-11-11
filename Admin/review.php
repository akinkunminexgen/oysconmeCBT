<?php

session_start();
$idST= $_GET['reg_no'];
  if (array_key_exists("reg_no", $_GET)){
include("connection.php");


if(!$_GET['reg_no']){
  echo "<p>An ID number is required</p>";
}else{

  //get id for students
  $sqlST = "SELECT * From `student` WHERE registration = '".$idST."'";
  $resST = mysqli_query($link, $sqlST) or die (mysqli_error($link));
  $num_row = mysqli_num_rows($resST);
  if ($num_row > 0) {
    $resST = mysqli_fetch_assoc($resST);
    $idno= $resST['id'];
  }
  else {
    echo "No result for student Yet ";
    exit();
  }

  $res_Page = 10;
  $sql = "SELECT * From `testattempt` WHERE stdid = '".$idno."'";
  $res = mysqli_query($link, $sql) or die (mysqli_error($link));
  $num_row = mysqli_num_rows($res);

  $num_page = ceil($num_row/$res_Page);

  if(!isset($_GET['page'])){
    $page = 1;
  }else {
    $page = $_GET['page'];
  }

  $off_set = ($page - 1) * $res_Page;

$testattempt= "testattempt";
$student = "student";
$test = "test";

$display="";

//to display the Score
$query1 = "SELECT * From `testscore` WHERE stdid = '".$idno."'";
$result1 = mysqli_query($link, $query1) or die (mysqli_error($link));
$numrow1 = mysqli_num_rows($result1);
if($numrow1 > 0){
  $scor = mysqli_fetch_assoc($result1);
  $score = 'Score is '.$scor['score'];
}else {
  $score = "Score not yet confirmed";
}

$query1 = "SELECT * From $student WHERE id = '".$idno."'";
$result1 = mysqli_query($link, $query1) or die (mysqli_error($link));
$numrow1 = mysqli_num_rows($result1);
if($numrow1 > 0){
  $quer = "SELECT * From $testattempt WHERE stdid = '".$idno."' LIMIT ".$off_set.",".$res_Page."";
  $resul = mysqli_query($link, $quer) or die (mysqli_error($link));
  $numro = mysqli_num_rows($resul);
  if($numro < 1){
    echo "No ID in attempt";
  }else{
  echo '<div class="box box-default" id="refes">
  <div class="box-header with-border">
    <h3 class="box-title"> Review Test Score </h3>
    </div>
    <div class="box-footer bg-gray">
    <div class="row">
    <div class="col-md-6">
      Update Student timer <a href="#" <span class="badge text-danger"> '.$idno.'</span></a>
    </div>
    <div class="col-md-6 text-right">
      <span class="badge">'.$score.'</span>
    </div>

      </div>
    </div>

    <div class="row">
    <div class="col-xs-12">
  <div  class="box-body">
  <table class="table table-bordered table-hover bg-gray">

  <tr>
      <th>Number</th>
      <th>Name</th>
      <th>Question No</th>
      <th>Subject</th>
      <th>student answer</th>
      <th>Answer</th>
      <th>Remark</th>
    </tr>

  ';
$number = 1;

  while($row1 = mysqli_fetch_assoc($result1)){
    $query2 = "SELECT * From $testattempt WHERE stdid='".$idno."' LIMIT ".$off_set.",".$res_Page."";
    $result2 = mysqli_query($link, $query2) or die (mysqli_error($link));

      while($row2 = mysqli_fetch_assoc($result2)){

        $query3 = "SELECT `subject` From $test WHERE id=".$row2['testid']."";
        $result3 = mysqli_query($link, $query3) or die (mysqli_error($link));
          while($row3 = mysqli_fetch_assoc($result3)){

        if ($row2['ans'] === $row2['correctans']){
          $display ="<p><span style='font-size: 1em; color:green'> <i class='fa fa-check-square-o'></i></span>  Correct </p>";
        }
        else{
          $display= "<p><span style='font-size: 1em; color:red'><i class='fa fa-times-circle'></i></span>  Wrong </p>";
        }

        echo '
        <tr><td>
            <label>
              '.$number.'
              </label>
        </td>
        <td>
            <label>
              '.$row1['Firstname'].' '.$row1['Lastname'].'
              </label>
        </td>
        <td>
            <label>
              '.$row2['quid'].'
              </label>
        </td>
        <td>
            <label>
              '.$row3['subject'].'
              </label>
        </td>
        <td>
            <label>
              '.$row2['ans'].'
              </label>
        </td>
        <td>
            <label>
              '.$row2['correctans'].'
              </label>
        </td>
        <td>
            <label>
              '.$display.'
              </label>
        </td></tr>

      ';
        }
        $number++;
      }

  }
  echo ' </table>
          </div>
          </div>
          </div>
          <ul class="pagination pagination-sm no-margin pull-right">
        ';

        for ($page = 1; $page <= $num_page ; $page++) {
          echo' <li><button title="Page '.$page.'" class="page_num1 btn btn-primary" data-value ='.$page.'>'.$page.'</button></li>';
        }

    echo    '
          </ul>
          <div class="box-footer bg-gray">
            Students details
          </div>
          </div>
  ';
}
}else {
  echo "No ID";
}

}
}
else{
  echo "Server error";
}

 ?>
 <?php include('script.php') ?>
 <script type="text/javascript">
var stud = "<?php echo $idST ?>";
 $('.page_num1').click(function(){
   //alert('okay it is time');
   var valueR = $(this).data('value');
     var formData = jQuery(this).serialize();
               $.ajax({
                 type:"GET",
                 url:"review.php?reg_no="+ stud +" &page="+valueR,
                 data:formData,
                 success: function(html){
                 if(html==0){
                   return false;
                   }else{

                     //$('#alrtD').append(html)
                     $( "#refes" ).load("review.php?reg_no="+stud+"&page="+valueR+"#refes" );
                   }
               }
             });
   //e.preventDefault();
   });
</script>
