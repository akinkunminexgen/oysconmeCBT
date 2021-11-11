<?php
session_start();
include("connection.php");
$msg = "";
$ok ="";
if(!$_SESSION['id']){

 header('location: login.php');
}
if (isset($_POST['submitFile'])) {
  //print_r($_FILES);
  $file = $_FILES['file']['tmp_name'];
  $handle = fopen($file, "r");
  $filename = explode('.', $_FILES['file']['name']);


  if ($file == NULL || $filename[1] !== 'csv') {
  $msg =  '  <div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                  Please select a CSV file to import!!!
                </div>
    ';
  }
  else {
    $i = 1;
    while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
      {

        $qnum=  mysqli_real_escape_string($link, $filesop[0]);
        $question =  mysqli_real_escape_string($link, $filesop[1]);
        $subject =  mysqli_real_escape_string($link, $filesop[2]);
        $optionA = mysqli_real_escape_string($link, $filesop[3]);
        $optionB = mysqli_real_escape_string($link, $filesop[4]);
        $optionC = mysqli_real_escape_string($link, $filesop[5]);
        $optionD = mysqli_real_escape_string($link, $filesop[6]);
        $corans = mysqli_real_escape_string($link, $filesop[7]);

        //to generate the id of the company and error handling for wrong company's name
        $query = "SELECT * FROM `question` WHERE qno = '".$qnum."' AND test = '".$subject."'";
        $result = mysqli_query($link, $query) or die (mysqli_error($link));
        $numquery = mysqli_num_rows($result);
        if($numquery > 0){
            $sql = false;
          $ok.= "Failed to import at row ".$i."That question has already existed in the database <br>";
        }else {
          $query = "INSERT into `question` (qno, question, test, option1, option2, option3, option4, correctanswer) values('$qnum', '$question', '$subject','$optionA',' $optionB', '$optionC', '$optionD', '$corans')";
          $result = mysqli_query($link, $query) or die (mysqli_error($link));
          if ($result) {
            $sql = true;
          }
        }

      $i++;

    }
    if ($ok !== "") {
      $msg.= '<div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    '.$ok.'
                    </div>';
    }

    if ($sql) {
      $msg.= '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                      Question(s) imported successfully
                  </div>
    ';
    }
}
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

    </section>
    <section class="content" id="fetch">

      <div class="box box-default" id="addQn">
      <div class="box-header with-border">
        <h3 class="box-title"><strong>INSERT/ADD</strong> Questions</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form method="post" id="insertCSV" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Upload spreedsheet</label>
                <input type="file" id="fileUpload" name="file" class="form-control" required placeholder="Upload a CSV file" accept=".csv">
              </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <button type="submit" name="submitFile" class="btn btn-lg btn-info pull-right">Submit</button>
               </div>

          </div>
          </div>
        </form>
        <br>
        <br>

        <form method="post" id="insertqns" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-12">
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
                 <label>Question Number</label>
                 <input type="number" name="qnum" class="form-control" required onkeypress="return isNumberKey(event)" placeholder="Enter a number" style="width: 150px;">
               </div>
               <div class="form-group">
                    <label>Upload images</label>
                    <input type="file" id="fileUpload" name="fileUpload" class="form-control" placeholder="Upload files" style="width: 200px;">
                  </div>
              </div>
              <div class="col-md-12">
            <div class="form-group">
                 <label>Question</label>
                 <textarea class="form-control" name="question" rows="3" required placeholder="Enter question here..."></textarea>
               </div>

          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="form-group">
                 <label>Option A</label>
                <input type="text" name="optionA" class="form-control" required placeholder="Enter ...">
               </div>

               <div class="form-group">
                    <label>Option B</label>
                    <input type="text" name="optionB" class="form-control" required placeholder="Enter ...">
                  </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
                 <label>Option C</label>
                <input type="text" name="optionC" class="form-control" required placeholder="Enter ...">
               </div>

               <div class="form-group">
                    <label>Option D</label>
                    <input type="text" name="optionD" class="form-control" required placeholder="Enter...">
                  </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
                 <label>Correct Answer</label>
                <input type="text" name="CorAns" class="form-control" required placeholder="Enter the correct answer">
               </div>

          </div>
          <div class="col-md-4">
            <div class="form-group">
              <br>
                <button type="submit" name="submit" class="btn btn-lg btn-info pull-right">Submit</button>
               </div>

          </div>


        <!-- /.row -->
      </form>
      </div>
      <div id ="alertQns"><?php echo $msg; ?></div>
    </div>
      <!-- /.box-body -->
      <div class="box-footer bg-gray">
        Fill questions for storage into the database
      </div>
    </div>

  <!-- to show student registration form -->
  <div class="box box-default" id="HideStudentReg">
  <div class="box-header with-border">
    <h3 class="box-title">Registration</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
  <div class="box-body">
    <form method="post" id="Stdadd">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
             <label>First Name</label>
             <input type="text" name="Fname" class="form-control" required placeholder="First Name">
           </div>
           </div>
        <div class="col-md-6">
           <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="Lname" class="form-control" required placeholder="Last Name">
              </div>

      </div>
      <div class="col-md-6">
        <div class="form-group">
             <label>Email Address</label>
             <input type="email" name="Email" class="form-control" required placeholder="Email Address">
           </div>
         </div>
          <div class="col-md-6">
           <div class="form-group">
                <label>Username</label>
                <input type="username" name="Uname" class="form-control" required placeholder="Enter username">
              </div>
            </div>
              <div class="col-md-12">
           <div class="form-group">
                <label>Password</label>
                <input type="password" name="Pword" class="form-control" required  placeholder="Password">
              </div>
            <div class="form-group">
                   <label>Re-Enter Password</label>
                   <input type="password" name="Pword2" class="form-control" required placeholder="Confirm Password">
                   <label id="notmatch" style="color:red;"></label>
                 </div>


      <button type="submit" name="submit" class="btn btn-lg btn-info pull-right">Register</button>
    </div>
    </div>
  </form>
  </div>
  <div id ="alertStd">
</div>
  <div class="box-footer bg-gray">
    Register a Student
  </div>
</div>


<!-- to review student's result -->
<div class="box box-default" id="exmRevP">
<div class="box-header with-border">
  <h3 class="box-title">Review Page</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
  </div>
</div>
<div class="box-body">
  <form method="get"  id="revSTD1">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
           <label>Review <strong>students</strong> result by providing
           <span> Student ID number</span></label>
           <input type="text" name="reg_no" class="form-control"  placeholder="Enter Student's Reg No." required>
         </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
               <button id ="revSTD" type="submit" name="submit" class="btn btn-lg btn-info pull-right">Review result</button>
              </div>
              </div>


  </div>
</form>
</div>
<div id="showRev"></div>
<div id ="alertRev">
  <div class="alert alert-warning alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                  <p id="alertRevP"><p>
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

$('.clickSTD').click(function(){
  //e.preventDefault();
  var formData = jQuery(this).serialize();

            $.ajax({
              type:"POST",
              url:"viewresults.php",
              data:formData,
              success: function(html){
              if(html==0){
                //alert("something is wrong");
                return false;

                }else{
                  //alert(html);
                  $('#fetch').empty(html)
                  $('#fetch').append(html)
                }
            }
          });

});

$('#AllStd').click(function(){
  //e.preventDefault();
  //alert("can you see me?")
  var formData = jQuery(this).serialize();

            $.ajax({
              type:"POST",
              url:"allstudents.php",
              data:formData,
              success: function(html){
              if(html==0){
                //alert("something is wrong");
                return false;

                }else{
                //  alert(html);
                  $('#fetch').empty(html)
                  $('#fetch').append(html)
                }
            }
          });
          e.preventDefault();
});


$('.clickquestion').click(function(){
  var valueD = $(this).data('value');
// $(this).css("background-color", "red").show();
 //$(this).click(window.location='dashboard.php?topic='+ valueD);
 //e.preventDefault();
 var formData = jQuery(this).serialize();

           $.ajax({
             type:"POST",
             url:"questionAdmin.php?topic="+ valueD,
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
  $('#HideStudentReg').hide(); //to hide student registration form
  $('#exmRevP').hide();


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
         $('#exmRevP').show();
         $('#alertRev').hide();
           $.removeCookie("trigger");
           $.removeCookie("WLH");

          break;

      default:

    }

  } // to show registration form and hide question insertion form



  $('#revSTD1').submit(function(e){
    //var valueR = $('[name=studid]').val();
  //e.preventDefault();
    var formData = jQuery(this).serialize();
              $.ajax({
                type:"GET",
                url:"review.php",
                data:formData,
                success: function(html){
                if(html==0){
                  return false;

                  }else{
                    //alert(html);
                    if(html=="No ID"){
                      //$('#alertRev').empty(html)
                      $('#showRev').empty(html);
                      $('#alertRev').show();
                      $('#alertRevP').empty(html);
                      $('#alertRevP').append('No Student with such ID number');
                      setTimeout(function(){$('#alertRev').hide() ; }, 1500);
                    }else if(html=="No ID in attempt"){
                      $('#showRev').empty(html);
                        $('#alertRev').show();
                        $('#alertRevP').append('The Student was not present for the examination');
                    }
                    else{
                      //$('#alertRev').empty(html);
                      $('#showRev').empty(html)
                      $('#showRev').append(html)
                  }
                  }
              }
            });
            e.preventDefault();
  });


//From the link in viewresults.php inorder to check for student result





  $('#Stdadd').submit(function(e){
    if($('[name=Pword]').val() !== $('[name=Pword2]').val()){
      $('#notmatch').append("The passwords do not match");
      e.preventDefault();
    }else{
    var formData = jQuery(this).serialize();
              $.ajax({
                type:"POST",
                url:"addstudent.php",
                data:formData,
                success: function(html){
                if(html==0){
                  return false;

                  }else{
                    //alert(html);
                    $('#alertStd').empty(html)
                    $('#alertStd').append(html)
                  }
              }
            });
            e.preventDefault();
          }
  });



  $('#insertqns').submit(function(e){


    var form = $(this);
    var formdata = false;
    if (window.FormData){
        formdata = new FormData(form[0]);
    }

    var formAction = form.attr('action');
              $.ajax({
                type:"POST",
                url:"addquestion.php",
                cache: false,
                contentType: false,
                processData: false,
                data:formdata ? formdata : form.serialize(),
                success: function(html){
                if(html==0){
                  return false;

                  }else{
                    $('#alertQns').empty(html)
                    $('#alertQns').append(html)
                  }
              }
            });
            e.preventDefault();
  });


 });

</script>
</body>
</html>
