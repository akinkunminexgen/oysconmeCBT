<?php

session_start();
include("connection.php");
  if (array_key_exists("reg_no", $_GET)){
    $idST= $_GET['reg_no'];


if(!$_GET['reg_no']){
  echo "<p>An ID number is required</p>";
  exit();
}else{

  //get id for students
  $sqlST = "SELECT * From `student` WHERE registration = '".$idST."'";
  $resST = mysqli_query($link, $sqlST) or die (mysqli_error($link));
  $num_row = mysqli_num_rows($resST);
  if ($num_row > 0) {
    $row1 = mysqli_fetch_assoc($resST);
    $idno= $row1['id'];
  }
  else {
    echo "No ID";
    exit();
  }

  $sql = "SELECT * From `system_cookies` WHERE stdid = '".$idno."'";
  $res = mysqli_query($link, $sql) or die (mysqli_error($link));
  $num_row = mysqli_num_rows($res);
  if ($num_row > 0) {
    $Tyming = mysqli_fetch_assoc($res);

    echo '<div class="box box-default" id="refes">
    <div class="box-header with-border">
      <h3 class="box-title"> Review Student Login </h3>
      </div>

      <div class="row">
      <div class="col-xs-12">
    <div  class="box-body">
    <table class="table table-bordered table-hover bg-gray">

    <tr>
        <th>Name</th>
        <th>Time left</th>
        <th>Activity</th>
      </tr>

      <tr>
      <td>
          <label>
            '.$row1['Firstname'].' '.$row1['Lastname'].'
            </label>
      </td>
      <td class="showClick">
          <label>
            '.$Tyming['time_cookies'].'
            </label>
      </td>
      <td class="clickshow">
          <input type="text" name="time_left" class="form-control" value='.$Tyming['time_cookies'].' required>
      </td>

      <td class="clickshow">
          <select name="activity"  class="form-control" required >
          <option value='.$Tyming['login_status'].'> '.$Tyming['login_status'].' </option>';
          if ($Tyming['login_status'] == "ACTIVE") {
            echo '<option value="INACTIVE">INACTIVE</option>';
          }
          else {
            echo '<option value="ACTIVE">ACTIVE</option>';
          }


echo '
          </select>
      </td>

      <td class="clickshow">
          <input  id="SUBMIT" type="submit" name="submit" class="form-control btn btn-info" required>
      </td>

      <td class="showClick">
          <label>
            '.$Tyming['login_status'].'
            </label>
      </td>
      </tr>
    ';
  }else {
    echo "No Login Status";
    exit();
  }
}
}
else {
  // to update the system cookies time and status

  if (isset($_GET['id_no'])) {
      $idno= $_GET['id_no'];
      $tym = $_GET['tym_left'];
      $activity = $_GET['activity'];

      $query ="UPDATE `system_cookies` SET time_cookies='".$tym."', login_status='".$activity."' WHERE stdid='".$idno."'";
    	$result = mysqli_query($link, $query) or die (mysqli_error($link));
      $_SESSION['message'] = "updated successfully";
      $_SESSION['alert'] = 'alert-success';
  }
}







?>

<?php include('script.php') ?>
<script type="text/javascript">
var idno = "<?php echo $idno ?>";


$(document).ready(function() {
  $('.clickshow').hide();

  $('.showClick').click(function(){
    $('.clickshow').show();
    $('.showClick').hide();

  });

  $('#SUBMIT').click(function(){
    var tymleft =   $('[name=time_left]').val();
    var activity =  $('[name=activity]').val();

    var formData = jQuery(this).serialize();
              $.ajax({
                type:"GET",
                url:"reviewLogins.php?id_no="+ idno +" &activity="+activity+"&tym_left="+tymleft,
                data:formData,
                success: function(html){
                if(html==0){
                  return false;
                  }else{
                    location.reload(true);
                  }
              }
            });
  });

  });
</script>
