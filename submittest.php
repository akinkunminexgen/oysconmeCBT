<?php
session_start();

include("connection.php");

//$query = "SELECT * From `testattempt` WHERE stdid='".$_SESSION['stid']."'";
//$result = mysqli_query($link, $query)  or die (mysqli_error($link));
//$num_row = mysqli_num_rows($result);
//$fetch = mysqli_fetch_assoc($result);

$query1 = "SELECT `atid` From `testattempt` WHERE stdid='".$_SESSION['stid']."' AND ans = correctans LIMIT 100";
$result1 = mysqli_query($link, $query1)  or die (mysqli_error($link));
$num_row1 = mysqli_num_rows($result1);
$fetch = mysqli_fetch_assoc($result1);

$score=$num_row1/100 * 100;
if ($score == 0) {
  $score = "Zero";
}

$que = "SELECT `ID` From `testscore` WHERE stdid='".$_SESSION['stid']."' LIMIT 1";
$resu = mysqli_query($link, $que)  or die (mysqli_error($link));
$num_ro = mysqli_num_rows($resu);
if ($num_ro > 0) {
  echo "$score";
  setcookie("id", $_SESSION['stid'], time() - 60 * 60);
  setcookie("Fname", $_SESSION['Fname'], time() - 60 * 60);
  setcookie("Lname", $_SESSION['Lname'], time() - 60 * 60);
  setcookie("mathematics", $_SESSION['mathematics'], time() - 60 * 60);
        setcookie("username", $_SESSION['username'], time() - 60 * 60);
        if(isset($_SESSION['stid'])){
            $_SESSION=array();
            session_regenerate_id();
            session_destroy();
      }


} else {
  $sql = "INSERT INTO `testscore`(stdid, score) VALUES ('".$_SESSION['stid']."', '".$score."')";
  $result = mysqli_query($link, $sql)  or die (mysqli_error($link));
  if ($result) {
    echo "$score";
    setcookie("id", $_SESSION['stid'], time() - 60 * 60);
    setcookie("Fname", $_SESSION['Fname'], time() - 60 * 60);
    setcookie("Lname", $_SESSION['Lname'], time() - 60 * 60);
    setcookie("mathematics", $_SESSION['mathematics'], time() - 60 * 60);
          setcookie("username", $_SESSION['username'], time() - 60 * 60);
          if(isset($_SESSION['stid'])){
    $_SESSION=array();
    session_regenerate_id();
    session_destroy();

}

  }
}



 ?>
