<?php

session_start();

include("connection.php");

$res_Page = 10;
$sql = "SELECT * From `testscore`";
$res = mysqli_query($link, $sql) or die (mysqli_error($link));
$num_row = mysqli_num_rows($res);

$num_page = ceil($num_row/$res_Page);

if(!isset($_GET['page'])){
  $page = 1;
}else {
  $page = $_GET['page'];
}

$off_set = ($page - 1) * $res_Page;



$testscore= "testscore";
$student = "student";
$test = "test";

$query1 = "SELECT * From $testscore LIMIT ".$off_set.",".$res_Page."";
$result1 = mysqli_query($link, $query1) or die (mysqli_error($link));
$numrow1 = mysqli_num_rows($result1);
if($numrow1 > 0){

  echo '<div class="box box-default" id="refes">
  <div class="box-header with-border">
    <h3 class="box-title"> Test Score</h3>
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
            '.$row2['Firstname'].' '.$row2['Lastname'].'
            </label>
      </td>
      <td>
          <label>
            '.$row['score'].'
            </label>
      </td>
      <td>
          <label>
            <button data-value="'. $row2['registration'].'" class="btn-primary 4rmviewrslt">View</button>
            </label>
      </td></tr>

    ';

  }
}
echo ' </table>
        </div>
        </div>
        </div>
        <ul class="pagination pagination-sm no-margin pull-right">
      ';

      for ($page = 1; $page <= $num_page ; $page++) {
        echo' <li><button title="Page '.$page.'" class="page_num btn btn-primary" data-value ='.$page.'>'.$page.'</button></li>';
      }

  echo    '
        </ul>
        <div class="box-footer bg-gray">
          Students Score
        </div>
        </div>
';
}
else{
   echo "no results";
}

 ?>
<?php include('script.php') ?>
<script type="text/javascript">

$('.4rmviewrslt').click(function(){
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

$('.page_num').click(function(e){
  var valueR = $(this).data('value');
    var formData = jQuery(this).serialize();
              $.ajax({
                type:"GET",
                url:"viewresults.php?page="+ valueR,
                data:formData,
                success: function(html){
                if(html==0){
                  return false;
                  }else{
                        //alert(html);
                    //$('#alrtD').append(html)
                    $( "#refes" ).load("viewresults.php?page="+ valueR +"#refes" );
                  }
              }
            });
  e.preventDefault();
  });
</script>
