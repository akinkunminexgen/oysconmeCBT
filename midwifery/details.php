
<?php
session_start();
include("header.php");
include("connection.php");


if (array_key_exists("id", $_COOKIE)) {
	$_SESSION['stid'] = $_COOKIE['id'];
	$_SESSION['Fname'] = $_COOKIE['Fname'];
	$_SESSION['Lname'] = $_COOKIE['Lname'];
	$_SESSION['username'] = $_COOKIE['username'];
	$_SESSION['passport'] = $_COOKIE['passport'];
	$_SESSION['mathematics'] = $_COOKIE['mathematics'];

	$sql = "SELECT * From `system_cookies` WHERE stdid ='". $_SESSION['stid']."' LIMIT 1";

	 $result = mysqli_query($link, $sql) or die (mysqli_error($link));
		$num_row = mysqli_num_rows($result);
			$row2 = mysqli_fetch_assoc($result);
			if ($num_row > 0) {
				$_SESSION['MathematicsNews'] = $row2['Mathematics'];
				$_SESSION['EnglishNews'] = $row2['English'];
				$_SESSION['BiologyNews'] = $row2['Biology'];
				$_SESSION['ChemistryNews'] = $row2['Chemistry'];
				$_SESSION['PhysicsNews'] = $row2['Physics'];
				$_SESSION['Current-affairsNews'] = $row2['Affairs'];
				$_SESSION['timecookies'] = $row2['time_cookies'];
			}
}
if (!$_SESSION['stid']){

	header('location: WelcomePage.php');
}

?>
<body>
  <div class="container-fluid">
    <h4>COLLEGE OF NURSING AND MIDWIFERY, ELEYELE, IBADAN</h4>
  </div>

  <div class ="container">

  <div class="table ">
    <table class="table">

        <tr>
            <th>Surname:</th> <td>  <?php echo $_SESSION['Lname']; ?>  </td>

         <th>Firstname:</th>  <td>  <?php echo $_SESSION['Fname']; ?>   </td>

				   <td>  <img src="./<?php echo $_SESSION['passport']; ?>" alt="passport">  </td>
          </tr>
          <tr class="bg-info">
          <th>Username:</th>   <td> <?php echo $_SESSION['username']; ?>   </td>
        </tr>
     <tr>
        </tr>

      </table>
      <table class="table" >
        <tr class="bg-info">
          <th>instructions</th>
				</tr>
				<tr>
            <td>
							<ul> Once you click the start button, your time starts </ul>
          <ul>The questions will be in six sections which will be seen on top</ul>
          <ul>Kindly click the answer you feel it is correct for each question</ul>
          <ul>Once done with a particular section, move to the next section</ul>
          <ul>Do not logout, unless if you have submitted. if you do!! you are done with your exams</ul>
					<ul>Do not click submit button unless you feel you are done</ul>

        </td>
        </tr>
      </table>


   <button type="button" class="btn btn-primary btn-block" onClick=window.location='ExamConductor.php?topic=<?php echo $_SESSION['mathematics'] ?>'>Start Test</button>
   </div>

  </div>


  <div class="container-down">
    <h6 class="movedisplay dis">Goodluck in your exam</h6>
  </div>
<?php include("footer.php");
?>
<script type="text/javascript">

function RemoveCookieTime(){
Cookies.remove('hour');
Cookies.remove('minute');
Cookies.remove('second');

}
function RemoveCookieSubject(){
Cookies.remove('Mcookie');
Cookies.remove('Ecookie');
Cookies.remove('Pcookie');
Cookies.remove('Ccookie');
Cookies.remove('Bcookie');
Cookies.remove('Cucookie');
}
RemoveCookieSubject();
RemoveCookieTime();

 </script>
