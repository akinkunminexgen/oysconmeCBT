<?php
session_start();
$error ="";

if(isset($_GET['logout'])) {
session_destroy();
unset($_SESSION['stid']);
header('location: WelcomePage.php');
}
   if ((array_key_exists("stid", $_SESSION) AND $_SESSION['stid']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {

        header("Location: details.php");
        /*setcookie("id", $_SESSION['stid'], time() - 60 * 60);
        setcookie("Fname", $_SESSION['Fname'], time() - 60 * 60);
        setcookie("Lname", $_SESSION['Lname'], time() - 60 * 60);
        setcookie("mathematics", $_SESSION['mathematics'], time() - 60 * 60);
              setcookie("username", $_SESSION['username'], time() - 60 * 60);

        session_destroy(); */
   }
    if (array_key_exists("submit", $_POST)){
   include("connection.php");



		if(!$_POST['regNo']){
			$error.= "A registration number is required<br>";
		}


		if($error != ""){
			$error.="<p>There were error(s) in your form</p>";
		} else {
      $username = mysqli_real_escape_string($link, $_POST['regNo']);
      $passcode = mysqli_real_escape_string($link, $_POST['password']);
			$query = "SELECT `id`,`Firstname`,`Lastname`,`registration`,`password`, `passport` From `student` WHERE `registration` = '$username' LIMIT 1";

			$result = mysqli_query($link, $query)or die (mysqli_error($link));
      $row = mysqli_fetch_assoc($result);
			if(!$row > 0){

				$error.='  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                      Registration number is not valid
                    </div>
        ';
			}
			else{
					//echo "Logged in successful";
          $hash = $row['password'];
          if (password_verify($passcode, $hash))
           {
                $_SESSION['Fname'] = $row['Firstname'];
                  $_SESSION['Lname'] = $row['Lastname'];
                $_SESSION['username'] = $row['registration'];
                $_SESSION['stid']= $row['id'];
                $_SESSION['passport']= $row['passport'];
                $_SESSION['mathematics'] = "Mathematics";


          //check testscore to know whether the student has submitted
          $sql = "SELECT * From `testscore` WHERE stdid ='". $_SESSION['stid']."' LIMIT 1";

    			$result = mysqli_query($link, $sql) or die (mysqli_error($link));
          $num_row = mysqli_num_rows($result);

          if ($num_row > 0) {

            $error.='  <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h5><i class="icon fa fa-ban"></i> Alert! </h5>
                          <h6>(ACESS DENIED)</h6>
                          You Have Already Taken This Exam
                        </div> ';
                        session_destroy();
          } else {
            //since the student has not submitted, check the system cookies
            $sql = "SELECT * From `system_cookies` WHERE stdid ='". $_SESSION['stid']."' LIMIT 1";

             $result = mysqli_query($link, $sql) or die (mysqli_error($link));
              $num_row = mysqli_num_rows($result);
                $row2 = mysqli_fetch_assoc($result);
                if ($num_row > 0) {
                  if ($row2['login_status'] == 'ACTIVE') {
                    $error.='  <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  <h5><i class="icon fa fa-ban"></i> Alert! </h5>
                                  <h6>(ACESS DENIED)</h6>
                                  You Have Logged In On Another System, Please Contact the Administrator
                                </div> ';
                                session_destroy();
                  }else {
                    $_SESSION['MathematicsNews'] = $row2['Mathematics'];
                    $_SESSION['EnglishNews'] = $row2['English'];
                    $_SESSION['BiologyNews'] = $row2['Biology'];
                    $_SESSION['ChemistryNews'] = $row2['Chemistry'];
                    $_SESSION['PhysicsNews'] = $row2['Physics'];
                    $_SESSION['Current-affairsNews'] = $row2['Affairs'];
                    $_SESSION['timecookies'] = $row2['time_cookies'];

                    setcookie("id", $_SESSION['stid'], time() + 60 * 60);
                    setcookie("Fname", $_SESSION['Fname'], time() + 60 * 60);
                    setcookie("Lname", $_SESSION['Lname'], time() + 60 * 60);
                    setcookie("username", $_SESSION['username'], time() + 60 * 60);
                    setcookie("passport", $_SESSION['passport'], time() + 60 * 60);
                    setcookie("mathematics", $_SESSION['mathematics'], time() + 60 * 60);
                    header("Location: details.php");
                  }
                }else {
                  setcookie("id", $_SESSION['stid'], time() + 60 * 60);
                  setcookie("Fname", $_SESSION['Fname'], time() + 60 * 60);
                  setcookie("Lname", $_SESSION['Lname'], time() + 60 * 60);
                  setcookie("username", $_SESSION['username'], time() + 60 * 60);
                  setcookie("passport", $_SESSION['passport'], time() + 60 * 60);
                  setcookie("mathematics", $_SESSION['mathematics'], time() + 60 * 60);
                  header("Location: details.php");
                }



          }
        } else {
          $error.='  <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        Invalid password
                      </div>
          ';
        }


          //setcookie("id", $row[0], time()+ 60);

				}
			}
}







 ?>

<?php include("header.php");
?>
<body>

<div class="major-body">
    <div class="container-fluid">
      <div class="flex-container">
        <div>
        <img src="images/Oyo-State.jpg" alt="Smiley face" width="90px" height="100px" >
      </div>
      <div>
        <h4 style="margin-top:15px">OYO STATE COLLEGE OF NURSING AND MIDWIFERY, ELEYELE, IBADAN</h4>
      </div>
      <div>
        <img src="images/logo.jpg" alt="Smiley face" width="90px" height="100px">
      </div>
      </div>
    </div>

    <div class="container">
      <div class="containnSeg">
        <h4>2021 ENTRANCE EXAMINATION</h4>
        <h4>BASIC MIDWIFERY</h4>
      </div>

    <div class="containn">
      <div id="error" ><?php echo $error; ?></div>
      <form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Examination Number</label>
    <input type="text" name="regNo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required placeholder="Enter Exam number">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" required placeholder="Pin">
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Login</button>
</form>

    </div>
    </div>
    <div class="container-down">
      <h6 class="movedisplay dis">Exam malpractice is a crime, do not get involved!!!   ****   2021 OYSCONME</h6>
    </div>
  </div>

    <?php include("footer.php");
    ?>
