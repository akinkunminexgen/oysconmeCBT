<?php

session_start();

if(!$_SESSION['id']){

 header('location: login.php');
}
if ($_SESSION['privilege'] !== 'High'){

  $_SESSION['alert'] = "alert-warning";
  $_SESSION['message'] = "You are not permitted to register an admin";

	header('location: dashboard.php');
}

 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registration Page</title>
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


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="index2.html"><b>Admin</b>(CONE)</a>
  </div>

  <div class="register-box-body" id="casebody" >
    <p class="login-box-msg">Register a new account</p>

    <form method="post" id="regD">
      <div class="form-group has-feedback">
        <input type="text" name="Fname" class="form-control" required placeholder="First name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="Lname" class="form-control" required placeholder="Last name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
            <div class="form-group has-feedback">
        <input type="text" name="position" class="form-control" placeholder="Position of the staff">
        <span class="glyphicon glyphicon-tag form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <select class="form-control select2" required name="privilege" style="width: 100%;">
          <option selected disabled>choose a privilege</option>
          <option>High</option>
          <option>Medium</option>
          <option>Low</option>
        </select>
        </div>
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="Pword" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="Pword2" class="form-control" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        <label id="notmatch1"></label>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label id="chckB">
              <input type="checkbox" > I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>



    <a href="login.php" class="text-center">I already have an account</a>
  </div>
  <div id ="showcasebody">
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
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
$('#chckB').click(function(){
  alert('you know');
var a=  $(this).data('value');
  alert(a);
});

  $('#regD').submit(function(e){
    if($('[name=Pword]').val() !== $('[name=Pword2]').val()){
      $('#notmatch1').append("The passwords does not match");
      $('#notmatch1').css("color", "red");
      e.preventDefault();
    }else if (  $('#chckB').val() === 1) {
       $('#chckB').css("color", "red");
       alert('oh no');
    }else{
    var formData = jQuery(this).serialize();
              $.ajax({
                type:"POST",
                url:"registerquery.php",
                data:formData,
                success: function(html){
                if(html==0){
                  return false;

                  }else{
                    if (html == "successful") {
                      $('#casebody').hide();
                      $('#showcasebody').append('<h1> Registration Successful </h1>');
                      setTimeout((function(){ window.location = 'dashboard.php'  }), 2000);
                    }
                  else {
                    $('#notmatch1').append(html);
                    }
                  }
              }
            });

            e.preventDefault();
          }
  });

</script>
</body>
</html>
