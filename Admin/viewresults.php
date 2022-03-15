<?php
ob_start();
session_start();
include("connection.php");
include ("mypagination.php");


if (isset($_GET['page'])) {

$res_Page = 10;
$sql = "SELECT * From `testscore`";
$res = mysqli_query($link, $sql) or die (mysqli_error($link));
$num_row = mysqli_num_rows($res);

$num_page = ceil($num_row/$res_Page);

if(!isset($_GET['page'])){
  $paged = 1;
}else {
  $paged = $_GET['page'];
}

$off_set = ($paged - 1) * $res_Page;
$chpage =$paged;


$testscore= "testscore";
$student = "student";
$test = "test";

$query1 = "SELECT * From $testscore ORDER BY `score` DESC LIMIT ".$off_set.",".$res_Page."";
$result1 = mysqli_query($link, $query1) or die (mysqli_error($link));
$numrow1 = mysqli_num_rows($result1);
if($numrow1 > 0){

  echo '<div class="box box-default" id="refes">
  <div class="box-header with-border">
    <h3 class="box-title"> Test Score</h3>
    </div>

    <div class="row">

        <div class="col-lg-4 col-md-6">
          <input type="text" class="form-control" id="regnum" placeholder="Reg No." required/>
        </div>
        <div class="col-md-4">
            <button class="searchSTD btn btn-primary" type="submit">Search</button>
          </div>
    </div>

    <div class="row">
    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
  <div  class="box-body">
  <table class="table table-bordered table-hover bg-gray">

  <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Result</th>
      <th>View Answer</th>
    </tr>

  ';


while($row = mysqli_fetch_assoc($result1)){
  $query2 = "SELECT * From $student WHERE id=".$row['stdid']."";
  $result2 = mysqli_query($link, $query2) or die (mysqli_error($link));
  while($row2 = mysqli_fetch_assoc($result2)){


      echo '

      <tr><td>
          <label>
            '.$row2['id'].'
            </label>
      </td>
      <td>
          <label>
            '.$row2['Lastname'].', '.$row2['Firstname'].'
            </label>
      </td>
      <td>
          <label>
            '.$row['score'].'
            </label>
      </td>
      <td>
          <label>
            <button data-value="'. $row2['registration'].'" class="btn-primary 4rmviewrslt1">View</button>
            </label>
      </td></tr>

    ';

  }
}
echo ' </table>
        </div>
        </div>
        </div>
                <div class="box-footer bg-gray">
                <ul class="pagination pagination-sm no-margin pull-left">';

              paginateAKIN($paged, $num_page, $chpage);
  echo '        </ul>
                  <div class="pull-right text-muted text-bold">
                    <div class="btn-group dropup">
                   <button data-toggle="dropdown" class="btn btn-success btn-xs mb-2 dropdown-toggle" title="Generate result"><i class="fa fa-user icon-white"></i> Download Result <span class="caret"></span></button>
                  <ul class="dropdown-menu dropdown-primary drop-drop">

                    <li><a href="viewresults.php?download=indigene"><i class="fa fa-print"></i><button class="btn btn-info btn-xs">For Indigene</button></a></li>
                    <li><a href="viewresults.php?download=nonindigene"><i class="fa fa-print"></i><button class="btn btn-info btn-xs">For Non-indigene</button></a></li>

                    <li class="divider"></li>
                    <li><span class="badge badge-secondary text-info">Download Applicants Result</span></li>
                  </ul>
                  </div>
                 </div>
                </div>
';

}
else{
 echo '<div class="alert alert-warning alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                 <p id="alertLOGP">No results yet<p>
             </div>';

   exit();
}
}

// check for student result

if (isset($_GET['reg_no'])) {

  $sql = "SELECT * From `student` WHERE `registration` = '".$_GET['reg_no']."'";
  $res = mysqli_query($link, $sql) or die (mysqli_error($link));
  $num_row = mysqli_num_rows($res);

  if($num_row > 0){
    $res = mysqli_fetch_assoc($res);

    $sql = "SELECT * From `testscore` WHERE `stdid` = '".$res['id']."'";
    $result = mysqli_query($link, $sql) or die (mysqli_error($link));
    $num_row = mysqli_num_rows($result);
    if ($num_row > 0) {
      $result = mysqli_fetch_assoc($result);
      echo '<div class="box box-default" id="refes">
      <div class="box-header with-border">
        <h3 class="box-title"> Test Score</h3>
        </div>

        <div class="row">
            <div class="col-md-8 col-xs-12 col-sm-4">
            </div>
            <div class="col-md-2 col-xs-12 col-sm-3">
              <input type="text" class="form-control" id="regnum" placeholder="Reg No." required/>
            </div>
            <div class="col-md-1 col-xs-12  mb-1">
                <button class="searchSTD btn btn-primary" type="submit">Search</button>
              </div>
        </div>

        <div class="row">
        <div class="col-xs-12">
      <div  class="box-body">
      <table class="table table-bordered table-hover bg-gray">

      <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Result</th>
          <th>View Answer</th>
          <th>Delete</th>
        </tr>

        <tr><td>
            <label>
              '.$res['id'].'
              </label>
        </td>
        <td>
            <label>
              '.$res['Lastname'].', '.$res['Firstname'].'
              </label>
        </td>
        <td>
            <label>
              '.$result['score'].'
              </label>
        </td>
        <td>
            <label>
              <button data-value="'. $res['registration'].'" class="btn-primary 4rmviewrslt1">View</button>
              </label>
        </td>
        <td>
            <label>
            <input type="password" class="" id="pazcod" placeholder="passcode" required>
            <input type="hidden" class="" id="tble" value="testscore" required>
              <button value="'. $result['ID'].'" class="btn-primary 4delete" title>Delete</button>
              </label>
        </td>
        </tr>

      ';




    }else {
      echo "no results";
      $_SESSION['alert']= 'alert-warning';
    $_SESSION['message']= "student is yet to submit";
    exit();
    }


  }else {
    echo "no results";
    $_SESSION['alert']= 'alert-warning';
  $_SESSION['message']= "no such student";
    exit();
  }

}

//Expoort result to CSV iles
if (isset($_GET['download'])) {
  if ($_GET['download'] == 'indigene') {
    $stat = '=31';
  }else {
    $stat = '!=31';
  }

  $sql = "SELECT registration, Lastname, Firstname, Middlename, name, locations.lga, Score From student
          INNER JOIN testscore ON student.id=testscore.stdid INNER JOIN states ON student.state=states.id
          INNER JOIN locations ON locations.id=student.lga WHERE states.id $stat ORDER BY score DESC";
  $result = mysqli_query($link, $sql) or die (mysqli_error($link));
  $num_row = mysqli_num_rows($result);

  if($num_row > 0){

  // file name for download
  $fileName = "StudentResults".date('Ymd').".xls";

  // headers for download
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=\"$fileName\"");

  $flag = false;
  while ($row = mysqli_fetch_assoc($result)){
        if(!$flag){
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag = true;
        }
        echo implode("\t", array_values($row)) . "\n";
    }

      exit();

}else {

      $_SESSION['alert']= 'alert-warning';
    $_SESSION['message']= "An error as occurred!";
    header("refresh: 3");
    exit();
}

}




 ?>
<?php include('script.php') ?>
<script type="text/javascript">

$(".dropdown-toggle").click(function(){
  $(".drop-drop").toggle();
});

$('.4rmviewrslt1').click(function(){
  var stud = $(this).data('value');
  var valueR = 1;
//e.preventDefault();
  var formData = jQuery(this).serialize();
            $.ajax({
              type:"GET",
              url:"review.php?reg_no="+stud+" &page="+valueR,
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

//search for student
$('.searchSTD').click(function(e){
  var valueR = $('#regnum').val();
  if(valueR.length == 0){
    $('#regnum').after('<div class="text-danger">Reg No. is Required</div>');
  }else{

    var formData = jQuery(this).serialize();
              $.ajax({
                type:"GET",
                url:"viewresults.php?reg_no="+ valueR,
                data:formData,
                cache: false,
                success: function(html){
                if(html==0){
                  return false;
                  }else{
                    if (html=='no results') {
                      window.location = 'studentresult.php';
                    }else {
                      //$('#alrtD').append(html)
                     $('#fetch').empty();
                     $('#fetch').append(html);
                      //$( "#refes" ).load("viewresults.php?page="+ valueR +"#refes" );

                    }
                  }
              }
            });
        }
  //e.preventDefault();
  });


  //search for student
  $('.4delete').click(function(e){
    var pazcod = $('#pazcod').val();
    var valueR = $('.4delete').val();
    var tble = $('#tble').val();
    if(pazcod.length == 0 || pazcod != '12345G78'){
      $('#pazcod').after('<div class="text-danger">require a (correct) passcode</div>');
    }else{

      var formData = jQuery(this).serialize();
                $.ajax({
                  type:"GET",
                  url:"deletequery.php?studid="+valueR+ "&abstr="+tble,
                  data:formData,
                  cache: false,
                  success: function(html){
                  if(html==0){
                    return false;
                    }else{
                          window.location = 'studentresult.php';
                    }
                }
              });
          }
    //e.preventDefault();
    });

$('.page_num').click(function(e){
  var valueR = $(this).data('value');
    var formData = jQuery(this).serialize();
              $.ajax({
                type:"GET",
                url:"viewresults.php?page="+ valueR,
                data:formData,
                cache: false,
                success: function(html){
                if(html==0){
                  return false;
                  }else{
                        //alert(html);
                    //$('#alrtD').append(html)
                    $('#fetch').empty();
                    $('#fetch').append(html);
                    //$( "#refes" ).load("viewresults.php?page="+ valueR +"#refes" );
                  }
              }
            });
  e.preventDefault();
  });
</script>
