<?php
session_start();

include("connection.php");

$query = "SELECT * From `test`";
$result = mysqli_query($link, $query)  or die (mysqli_error($link));
$num_row = mysqli_num_rows($result);
echo '<div class="box box-default" id="refes">
<div class="box-header with-border">
  <h3 class="box-title"> Test time </h3>
  </div>
  <div class="row">
  <div class="col-xs-12">
<div  class="box-body">
<table class="table table-bordered table-hover bg-gray">

<tr>
    <th><h5>Subject</h5></th>
    <th><h5>Time given</h5></th>
  </tr>

';
while($row = mysqli_fetch_assoc($result)){
  echo '
  <tr><td>
      <label>
        '.$row['subject'].'
        </label>
  </td>

  <td>
      <label>
        '.$row['timer'].' minutes
        </label>
  </td></tr>

';

}
   echo '</table>
        </div>
        </div>
        </div>
        </div>
      ';




 ?>
