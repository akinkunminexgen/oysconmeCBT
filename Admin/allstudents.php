<?php
ob_start();
session_start();

include("connection.php");
include ('mypagination.php');


$student = "student";

$res_Page = 10;
$sql = "SELECT * From $student";
$res = mysqli_query($link, $sql) or die (mysqli_error($link));
$num_row = mysqli_num_rows($res);

$num_page = ceil($num_row/$res_Page);

if(!isset($_GET['page'])){
  $paged = 1;
}else {
  $paged = $_GET['page'];
}

$off_set = ($paged - 1) * $res_Page;
$chpage = $paged;

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
            <th>Username</th>
            <th>First name</th>
            <th>Last name</th>
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
        '.$row['registration'].'
        </label>
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
  </tr>

';

}

echo ' </table>
        </div>
        </div>
        </div>
                <div class="box-footer bg-gray">
                <ul class="pagination pagination-sm no-margin pull-left">';

              paginateAKIN($paged, $num_page, $chpage);
  echo '        </ul>
                <div class="pull-right text-muted text-bold"> Student List</div>
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
                       $('#fetch').empty();
                       $('#fetch').append(html);
                       //$( "#refes" ).load("allstudents.php?page="+ valueR +"#refes" );
                     }
                 }
               });
     e.preventDefault();
     });
 </script>
