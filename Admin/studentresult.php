<?php
session_start();
include("connection.php");
$msg = "";
$ok ="";
if(!$_SESSION['id']){

 header('location: login.php');
}





 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title>Dashboard</title>
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
 <!-- AdminLTE Skins. Choose a skin from the css/skins
      folder instead of downloading all of them to reduce the load. -->
 <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
      <?php include('headers.php'); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard Interface
        <small>Preview of UI</small>
      </h1>

      <?php if (isset($_SESSION['alert'])) {
        echo '<div class="alert '.$_SESSION['alert'].' alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        <p id="alertLOGP">'.$_SESSION['message'].'<p>
                    </div>';
      }

      ?>

    </section>
    <section class="content" id="fetch">

    </section>
  </div>

  </div>

<?php
unset($_SESSION['alert']);
unset($_SESSION['message']);
 include('script.php') ?>


<script type="text/javascript">


$(document).ready(function() {

  $('.owo2').addClass('active');

    //e.preventDefault();
    var formData = jQuery(this).serialize();

              $.ajax({
                type:"GET",
                url:"viewresults.php?page=1",
                data:formData,
                success: function(html){
                if(html==0){
                  //alert("something is wrong");
                  return false;

                }else{
                    $('#fetch').empty(html)
                    $('#fetch').append(html)
                  }
              }
            });



 });

</script>
</body>
</html>
