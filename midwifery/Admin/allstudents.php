<?php
session_start();

include("connection.php");
$student = "student";

$res_Page = 10;
$sql = "SELECT * From $student";
$res = mysqli_query($link, $sql) or die (mysqli_error($link));
$num_row = mysqli_num_rows($res);

$num_page = ceil($num_row/$res_Page);

if(!isset($_GET['page'])){
  $page = 1;
}else {
  $page = $_GET['page'];
}

$off_set = ($page - 1) * $res_Page;

$query = "SELECT * From $student ORDER BY `Firstname` ASC LIMIT ".$off_set.",".$res_Page."";
$result = mysqli_query($link, $query) or die (mysqli_error($link));
echo '
<div class="box box-default" id="refes">
<div class="box-header with-border">
  <h3 class="box-title"> Students List </h3>
  </div>
        <div class="row">
          <div class="col-xs-12">
        <div  class="box-body">
        <table class="table table-bordered table-hover bg-gray">

        <tr>
            <th>ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Username</th>
            <th>Email Address</th>
          </tr>

';

while($row = mysqli_fetch_assoc($result)){

  echo '

  <tr><td>
      <label>
        '.$row['id'].'
        </label>
        <button title="Delete from database" class="delFrmDs" data-value ='.$row['id'].'><span style="font-size: 1em; color:red"><i class= "fa fa-trash"></i></span>
  </td>
  <td>
      <label>
        '.$row['Firstname'].'
        </label>
  </td>
  <td>
      <label>
        '.$row['Lastname'].'
        </label>
  </td>
  <td>
      <label>
        '.$row['username'].'
        </label>
  </td>
  <td>
      <label>
        '.$row['Email'].'
        </label>
  </td>
  </tr>

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
          Students details
        </div>
        </div>
';

 ?>
 <?php include('script.php') ?>
 <script type="text/javascript">

 $('.delFrmDs').click(function(e){
   var valueR = $(this).data('value');
   var valueD = "<?php echo $student;?>";
   if (confirm("Are you sure?")) {
     var formData = jQuery(this).serialize();
               $.ajax({
                 type:"GET",
                 url:"deletequery.php?studid="+ valueR +"&abstr="+ valueD,
                 data:formData,
                 success: function(html){
                 if(html==0){
                   return false;
                   }else{

                     $('#alrtD').append(html)
                     setTimeout(function(){ $( "#refes" ).load("allstudents.php#refes" ); }, 1500);
                   }
               }
             });
   } else {

   }
   e.preventDefault();
   });
   $('.page_num').click(function(e){
     var valueR = $(this).data('value');
       var formData = jQuery(this).serialize();
                 $.ajax({
                   type:"GET",
                   url:"allstudents.php?page="+ valueR,
                   data:formData,
                   success: function(html){
                   if(html==0){
                     return false;
                     }else{

                       //$('#alrtD').append(html)
                       $( "#refes" ).load("allstudents.php?page="+ valueR +"#refes" );
                     }
                 }
               });
     e.preventDefault();
     });
 </script>
