<?php

session_start();
if ($_SESSION['privilege'] !== 'High'){
	  $_SESSION['alert'] = "alert-warning";
	  $_SESSION['message'] = "You are not permitted to view the timer";

	header('location: dashboard.php');
}

 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Timer page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <style type="text/css">
    .Mycontainer{

      margin: auto;
      width: 500px;

    }

  </style>


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="Mycontainer">
  <div class="register-logo">
        <b>Timer</b>(CONE)
  </div>
  <div id ="ShowCase">
  </div>

<div class="login-box-body">
  <form method="post" id="clkB">
    <div class="row">
      <div class="col-md-6">
    <div class="form-group">
      <label>Subject</label>
      <select class="form-control select2" required name="subject" style="width: 100%;">
        <option value="" selected disabled>choose a subject in the list below</option>
        <option value="Mathematics">Mathematics</option>
        <option value="English">English</option>
        <option value="Physics">Physics</option>
        <option value="Chemistry">Chemistry</option>
        <option value="Biology">Biology</option>
        <option value="Current-affairs">Current-affairs</option>
      </select>
    </div>
  </div>
  <div class="col-md-6">
<div class="form-group">
  <label>Time</label>
    <input type="number" name="timer" class="form-control" placeholder="minutes" required>
    <br>
    <button type="submit" name="submit" class="btn btn-info pull-right">Add Time</button>
  </div>
  </div>
  </div>
  </form>
<a href="dashboard.php"><i class="icon fa fa-arrows-h"></i>Go back to dashboard</a>
</div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>

$('#clkB').submit(function(e){

  var formData = jQuery(this).serialize();
            $.ajax({
              type:"POST",
              url:"timerqueryadd.php",
              data:formData,
              success: function(html){
              $('#ShowCase').append(html);
            }
          });

          e.preventDefault();

});


$(document).ready(function(){
setInterval(function(){ updatetimer();},3000);

function updatetimer(){
    var formData = jQuery(this).serialize();
              $.ajax({
                type:"GET",
                url:"timerquery.php",
                data:formData,
                success: function(html){
                    $('#ShowCase').empty(html);
                $('#ShowCase').append(html);
              }
            });

            //e.preventDefault();
          }

  });

</script>
</body>
</html>
