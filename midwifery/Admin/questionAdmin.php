<?php
session_start();

include("connection.php");
$subject= $_GET['topic'];
$question = "question";

$res_Page = 10;
$sql = "SELECT * From $question WHERE test='".$subject."'";
$res = mysqli_query($link, $sql) or die (mysqli_error($link));
$num_row = mysqli_num_rows($res);

$num_page = ceil($num_row/$res_Page);

if(!isset($_GET['page'])){
  $page = 1;
}else {
  $page = $_GET['page'];
}

$off_set = ($page - 1) * $res_Page;

$query = "SELECT * From $question WHERE test='".$subject."' ORDER BY `qno` ASC LIMIT ".$off_set.",".$res_Page."";
$result = mysqli_query($link, $query) or die (mysqli_error($link));
echo '
<div class="box box-default" id="refes">
<div class="box-header with-border">
  <h3 class="box-title"> '.$subject.' Questions</h3>
  </div>
        <div class="row">
          <div class="col-xs-12">
        <div  class="box-body">
        <table class="table table-bordered table-hover bg-gray">

        <tr>
            <th>Number</th>
            <th>Question</th>
            <th>Option A</th>
            <th>Option B</th>
            <th>Option C</th>
            <th>Option D</th>
            <th>Correct Answer</th>
          </tr>

';

while($row = mysqli_fetch_assoc($result)){

  echo '

  <tr><td>
  <label>
    '.$row['qno'].'
    </label>
  <button title="Delete from database" class="delFrmD" data-value ='.$row['id'].'><span style="font-size: 1em; color:red"><i class= "fa fa-trash"></i></span>
  </button>

  </td>
  <td>
      <label>
        '.$row['question'].'
        </label>
  </td>
  <td>
      <label>
        '.$row['option1'].'
        </label>
  </td>
  <td>
      <label>
        '.$row['option2'].'
        </label>
  </td>
  <td>
      <label>
        '.$row['option3'].'
        </label>
  </td>
  <td>
      <label>
        '.$row['option4'].'
        </label>
  </td>
  <td>
      <label>
        '.$row['correctanswer'].'
        </label>
  </td></tr>

';

}

echo ' </table>
        <div id="alrtD"></div>
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
          Carefully check if the question is properly numbered.
        </div>
        </div>
';
 ?>
<?php include('script.php') ?>
<script type="text/javascript">

$('.delFrmD').click(function(e){
  var valueR = $(this).data('value');
  var valueD = "<?php echo $subject;?>";
  var value = "<?php echo $question;?>";
  if (confirm("Are you sure?")) {
    var formData = jQuery(this).serialize();
              $.ajax({
                type:"GET",
                url:"deletequery.php?studid="+ valueR +"&abstr="+ value,
                data:formData,
                success: function(html){
                if(html==0){
                  return false;
                  }else{

                    $('#alrtD').append(html)
                    setTimeout(function(){ $( "#refes" ).load("questionAdmin.php?topic=" +valueD +"#refes" ); }, 1500);
                  }
              }
            });
  } else {

  }
  e.preventDefault();
  });

  $('.page_num').click(function(e){
    var valueR = $(this).data('value');
    var valueD = "<?php echo $subject;?>";
      var formData = jQuery(this).serialize();
                $.ajax({
                  type:"GET",
                  url:"questionAdmin.php?topic="+ valueD +"&page="+ valueR,
                  data:formData,
                  success: function(html){
                  if(html==0){
                    return false;
                    }else{

                      //$('#alrtD').append(html)
                      $( "#refes" ).load("questionAdmin.php?topic=" +valueD +"&page="+ valueR +"#refes" );
                    }
                }
              });
    e.preventDefault();
    });
</script>
