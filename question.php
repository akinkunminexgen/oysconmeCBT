<?php
session_start();
include("connection.php");
$subject= $_GET['topic'];
$qno = $_GET['qno'];
$num_list = $_GET['nom'];
$_SESSION['subject'] = $subject;

if (!$_SESSION['testid']) {
  $query12 = "SELECT `id` From `test` WHERE subject='".$subject."'";
  $resul = mysqli_query($link, $query12)  or die (mysqli_error($link));
  $fet = mysqli_fetch_assoc($resul);
  $_SESSION['testid']=$fet['id'];
}


$query = "SELECT `qno`,`question`,`option1`,`option2`,`option3`,`option4`,`correctanswer` From `question` WHERE test='".$subject."' AND qno='".$qno."' LIMIT 1";
$result = mysqli_query($link, $query)  or die (mysqli_error($link));
$fetch = mysqli_fetch_assoc($result);

$_SESSION['qno']=$fetch['qno'];
  $_SESSION['question']=$fetch['question'];
  $_SESSION['opt1']=$fetch['option1'];
$_SESSION['opt2']=$fetch['option2'];
$_SESSION['opt3']=$fetch['option3'];
$_SESSION['opt4']=$fetch['option4'];
$_SESSION['cor']=$fetch['correctanswer'];

$query2 = "SELECT `ans` From `testattempt` WHERE stdid='". $_SESSION['stid']."' and testid='".$_SESSION['testid']."' and quid='".$_SESSION['qno']."' LIMIT 1";
$result2 = mysqli_query($link, $query2) or die (mysqli_error($link));
$row = mysqli_fetch_assoc($result2);

if ($row['ans']===$_SESSION['opt1']){
$opt1="checked";
}
else{
	$opt1="";
	}

	if ($row['ans']===$_SESSION['opt2']){
$opt2="checked";
}
else{
	$opt2="";
	}

	if ($row['ans']===$_SESSION['opt3']){
$opt3="checked";
}
else{
	$opt3="";
	}

	if ($row['ans']===$_SESSION['opt4']){
$opt4="checked";
}
else{
	$opt4="";
	}

 echo '<table class="table table-bordered" style="margin-top : -80px;">
 <tr><td>

<div id="questions"> <h6><textarea style="width: 500px; height : 180px;" readonly>QUESTION '.$num_list.': '.$_SESSION['question'].'</textarea></h6>

 </td>
 <td> <img src="./'.$_SESSION['passport'].'" alt="passport"> </td></tr>
 <tr><td>
     <label> <strong>A</strong>
       <input type="radio" name="RadioGroup1" '.$opt1.' value="'.$_SESSION['opt1'].'" id="RadioGroup1_0">
     '.$_SESSION['opt1'].' </label>
     </td></tr>
     <tr><td>
     <label><strong>B</strong>
       <input type="radio" name="RadioGroup1" '.$opt2.' value="'.$_SESSION['opt2'].'" id="RadioGroup1_1">
     '.$_SESSION['opt2'].'</label></td></tr>
     <br>
     <tr> <td>
     <label><strong>C</strong>
       <input type="radio" name="RadioGroup1" '.$opt3.' value="'.$_SESSION['opt3'].'" id="RadioGroup1_2">
        '.$_SESSION['opt3'].'</label></td></tr>
     <br><tr><td>
     <label><strong>D</strong>
       <input type="radio" name="RadioGroup1" '.$opt4.' value="'.$_SESSION['opt4'].'" id="RadioGroup1_3">
       '.$_SESSION['opt4'].'</label></td></tr>
     <br>
	    <input name="correct" type="hidden" id="qn3" value='.$_SESSION['cor'].' >
  <tr><td>

   </div>
   </div>
   </td></tr>
   </table>
 '
 ?>
  <script src="./bootstrap/jquery-3.3.1.min.js"></script>
 <script type="text/javascript">

    //on option click
jQuery("#RadioGroup1_0,#RadioGroup1_1,#RadioGroup1_2,#RadioGroup1_3").change(function(e){

								e.preventDefault();
								var formData = jQuery(this).serialize();
								$.ajax({
									type:"POST",
									url:"optionclick.php",
									data:formData,
									success: function(html){
                    //alert(html);
									if(html==0){

										//alert("No");

										return false;

										}else{
											//alert("Yes");
											//alert(ar[inc]);
										//	alert(html);
										}
								}
							});
});
</script>
