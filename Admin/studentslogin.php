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
      unset($_SESSION['alert']);
      ?>

    </section>
    <section class="content" id="fetchLOG">
      <div class="box box-default" id="exmLOG">
      <div class="box-header with-border">
        <h3 class="box-title">Review Login</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
      </div>
      <div class="box-body">
        <form method="get"  id="revLOG1">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                 <label>Review <strong>student's</strong> Activeness by providing
                 <span> Student Reg number</span></label>
                 <input type="text" name="reg_no" class="form-control"  placeholder="Enter Student's Reg No." required>
               </div>
               </div>

               <div class="col-md-6">
                 <div class="form-group">
                     <button id ="revLOG" type="submit" name="submit" class="btn btn-lg btn-info pull-right">Review Login(s)</button>
                    </div>
                    </div>


        </div>
      </form>
      </div>
      <div id="showLOG"></div>
      <div id ="alertLOG">
        <div class="akinkunmi alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        <p id="alertLOGP"><p>
                    </div>
      </div>
      <div class="box-footer bg-gray">
        Provide student's ID number
      </div>
      </div>

    </section>
  </div>

  </div>

<?php include('script.php') ?>


<script type="text/javascript">

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
} //for targeting numbers only for an input tag



  $('#regStd').click(function(){
    var trigga = "ReloadReg1";
   $.cookie('trigger', trigga);
  $.cookie('WLH',"trigger2018" );
  location.reload();
  });

  $('#revPg').click(function(){
    var trigga = "ReloadReg2";
  $.cookie('trigger', trigga);
  $.cookie('WLH',"trigger2018" );
  location.reload();
  });



$(document).ready(function() {


  var trigger="";
  $('#exmLOGP').hide();
  $('#alertLOG').hide();



var Wlh = $.cookie('WLH');
  if (Wlh == "trigger2018") {
      var trigger=  $.cookie('trigger');
    switch (trigger) {
      case "ReloadReg1":
        $('#addQn').hide();
       $('#exmRevP').hide();
        $('#HideStudentReg').show();
          $.removeCookie("trigger");
          $.removeCookie("WLH");
        break;
        case "ReloadReg2":
          $('#addQn').hide();
          $('#HideStudentReg').hide();
         $('#exmLOGP').show();
         $('#alertLOG').hide();
           $.removeCookie("trigger");
           $.removeCookie("WLH");

          break;

      default:

    }

  } // to show registration form and hide question insertion form



  $('#revLOG1').submit(function(e){
    //var valueR = $('[name=studid]').val();
  //e.preventDefault();
    var formData = jQuery(this).serialize();
              $.ajax({
                type:"GET",
                url:"reviewLogins.php",
                data:formData,
                success: function(html){
                if(html==0){
                  return false;

                  }else{
                    //alert(html);
                    if(html=="No ID"){
                      //$('#alertRev').empty(html)
                      $('#showRLOG').empty(html);
                      $('#alertLOG').show();
                      $('#alertLOGP').empty(html);
                      $('#alertLOGP').append('No Student with such ID number');
                      setTimeout(function(){$('#alertLOG').hide() ; }, 2000);
                    }else if(html=="No Login Status"){
                      $('#showLOG').empty(html);
                        $('#alertLOG').show();
                        $('#alertLOGP').append('The Student is not yet present for the examination');
                          setTimeout(function(){$('#alertLOG').hide() ; }, 2000);
                    }
                    else{
                      //$('#alertRev').empty(html);
                      $('#showLOG').empty(html)
                      $('#showLOG').append(html)
                  }
                  }
              }
            });
            e.preventDefault();
  });



 });

</script>
</body>
</html>
