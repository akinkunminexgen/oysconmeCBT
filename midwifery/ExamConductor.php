<?php
session_start();
include("connection.php");
if (!$_SESSION['stid']){

	header('location: WelcomePage.php');
}
$subject= $_GET['topic'];

$init = 0;
if (!isset($_SESSION['timing'])) {
	//check for time in system_cookies
	if (isset($_SESSION['timecookies'])) {
		$hrs = floor(($_SESSION['timecookies']/60)%60);
		$minute = $_SESSION['timecookies']%60;
	  $sec = 0;
	}else {
	//Calculate time for examination
$query = "SELECT `timer` From `test`";
$result = mysqli_query($link, $query)  or die (mysqli_error($link));
$numrows=mysqli_num_rows($result);
if ($numrows > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $init += $row['timer'];
  }
  $hrs = floor(($init/60)%60);
	$minute = $init%60;
  $sec = 0;
	$_SESSION['timing'] = $init;
}
}
}else {
	$hrs = floor(($_SESSION['timing']/60)%60);
	$minute = $_SESSION['timing']%60;
  $sec = 0;
}
//take test ID
  $query12 = "SELECT `id` From `test` WHERE subject='".$subject."'";
  $resul = mysqli_query($link, $query12)  or die (mysqli_error($link));
  $fet = mysqli_fetch_assoc($resul);
  $_SESSION['testid']=$fet['id'];



 ?>
<?php include("header.php"); ?>
<body>
<nav class="navbar fixed-top navbar-light bg-light">
	<label>name: <span><strong><?php echo $_SESSION['Lname']." ".$_SESSION['username']?></strong></span></label>
      <div>
            <button type="button" class="btn btn-primary btnv" data-value= "Mathematics">Mathematics</button>
            <button type="button" class="btn btn-primary btnv" data-value= "English">English</button>
            <button type="button" class="btn btn-primary btnv" data-value= "Physics">Physics</button>
            <button type="button" class="btn btn-primary btnv" data-value= "Chemistry">Chemistry</button>
            <button type="button" class="btn btn-primary btnv" data-value= "Biology">Biology</button>
            <button type="button" class="btn btn-primary btnv" data-value= "Current-affairs">Current-affairs</button>
      </div>
  <div class="my-2 my-lg-0">
     <button id="remC" class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
</div>
</nav>
<div class="container-flu">
<div class="clock container-fluid">
  <span align="center" style="font-size:24px; background:#FFF;">
    <span style="color:black;" class="hr"></span>
    <span style="color:white;"> <span style="color:black;"> h: </span></span>
    <span style="color:black;" class="min"></span>
    <span style="color:white;"> <span style="color:black;"> min </span></span>
  <span class="sec" style="color:black;" ></span></span>
</div>

 <table class=" table">


 <tr><td>

 <div id="questions">

  </div>
  <form action ="process_ans.php" name="form1" class="login" id="form1" >
  <input name="qn" type="hidden" id="qn"/>
  <input name="qnarray" type="hidden" id="qn1" />
   <input name="qnarray2" type="hidden" id="qn2" />

	 <div class="container-down">
		 <div id="paginate"></div>
	 </div>
   <div class="pull-right">
      <input  name="Submit" type="button" class="sub btn btn-primary" value="Submit" />
    </div>
 </form>
</td></tr>
</table>

</div>
      <?php
      //count the total number of a particular subject
      include("connection.php");
      $query = "SELECT COUNT(id) as `count` From `question` WHERE test='".$subject."'";
      $result = mysqli_query($link, $query);
			$fetch = mysqli_fetch_assoc($result);
      $numrow = $fetch['count'];

			if(isset($_SESSION[$subject.'News'])){ $_SESSION[$subject.'News'];}else{$_SESSION[$subject.'News'] = "";}
       ?>

			 <script src="./bootstrap/js/bootstrap.min.js"></script>
			 <script src="./bootstrap/jquery-3.3.1.min.js"></script>
			 <script src="./Admin/js-cookie-master/src/js.cookie.js"></script>
			 <script src="./Admin/alertify/lib/alertify.min.js"></script>

			 <script type="text/javascript">
// assign php variable to javascript variable
 var totalq = <?php echo $numrow ?>;
 var sub_ject = "<?php echo $subject ?>";



 function RemoveCookieSubject(){
 Cookies.remove('Mcookie');
 Cookies.remove('Ecookie');
 Cookies.remove('Pcookie');
 Cookies.remove('Ccookie');
 Cookies.remove('Bcookie');
 Cookies.remove('Cucookie');
}

function RemoveCookieTime(){
Cookies.remove('hour');
Cookies.remove('minute');
Cookies.remove('second');

}



function countdown2(){

if (hours < 0 ) {
  $('.clock').html('Time UP.');
  $('#questions').hide();
  $('.nextq').hide();
  $('.prev').hide();
}else {

 if (seconds <= 0) {
    minutes = minutes - 1;
    seconds = 60;
  }
	//insert into system cookies table to save up the remain time
	if (minutes == 58 || minutes == 49 || minutes == 39 || minutes == 29 || minutes == 24 || minutes == 19 || minutes == 14 || minutes == 9 || minutes == 3) {
		minute = (hours * 60) + minutes;
		var formData = jQuery(this).serialize();
		$.ajax({
									 type:"POST",
									 url:"systemcookies.php?topic="+sub_ject+"&cokutime="+minute,
									 data:formData,
									 success: function(html){
									 if(html==0){
										 return false;
										 }else{
										 }
								 }
							 });
	}

  if (minutes <= 0) {
    hours = hours - 1;
    minutes = 59;
  }
  seconds = seconds - 1;
  $('.hr').html(hours);
   $('.min').html(minutes);
  $('.sec').html(seconds).hide();
  }
  Cookies.set('hour', hours, { expires: 1 });
  Cookies.set('minute', minutes, { expires: 1 });
  Cookies.set('second', seconds, { expires: 1 });
  //alert($.cookie('second'));
}

//cookie.json = true;


if(Cookies.get('hour') != null) {
  var hours = Cookies.getJSON('hour');
  var minutes = Cookies.getJSON('minute');
  var seconds = Cookies.getJSON('second');
  var interval = setInterval ('countdown2()', 900);
} else {
  var hours = <?php echo $hrs ?>;
  var minutes = <?php echo $minute ?>;
	var seconds = <?php echo $sec ?>;
  var interval = setInterval ('countdown2()', 900);
}
//setInterval ('countdown2()', 1000);

    var inc = -1;
    var ar = [];
    var arraydata = [];
		var cukies = "<?php echo $_SESSION[$subject.'News']; ?>";

//console.log(ar.pop());
//console.log(ar);
//to get random numbers for each subject
function manipuLate(num_gen, totalq, ar, name){
  //$.cookie.json = true;
  if(cukies != ""){
	  var newCukies = cukies.split(",");
	  Cookies.set(name, newCukies, { expires: 1 });
  }
  else{
  if (!Cookies.get(name)){
    while (ar.length < num_gen) {
      var r = Math.floor(Math.random() * totalq) + 1;
      if (ar.indexOf(r) === -1) {
        ar.push(r);
      }
    }
    Cookies.set(name, ar, { expires: 1 });
  //  alert('the is the previous cookies');
  }else{
    //alert('i whelllooooooo is');
    Cookies.getJSON(name);
  }
}
  return Cookies.getJSON(name);

}


//to randomized for english language that has different sections
var max, min, nom;
max = 5;
min = 1;


function manipuLateEnglish(num_gen, totalq, ar, name){

//  $.cookie.json = true;
if(cukies != ""){
	var newCukies = cukies.split(",");
	Cookies.set(name, newCukies, { expires: 1 });
}else{
  if (!Cookies.get(name)){
    while (ar.length < num_gen) {
		//	alert('part minumum'+ min +' and max is '+ max);
			var r = Math.floor(Math.random() * (max-min+1)) + min;
			//alert('r is '+ r);
			if (ar === undefined || ar.length == 0) {
  				ar.push(1);
						}
			if (ar.indexOf(r) === -1) {
				ar.push(r);
			nom = ar.length;
			switch(nom) {
											  case 5:
											    	ar.push(6);
											    break;
											  case 10:
											    	ar.push(17);
											    break;
													case 15:
												    	ar.push(49);
												    break;
												  case 20:
												    	ar.push(59);
												    break;
											}
			if (nom >= 5 && nom < 10) {
				max = 16
				min = 6
			}
			if (nom >= 10 && nom < 15) {
				max = 48
				min = 17
			}
			if (nom >= 15 && nom < 20) {
				max = 58
				min = 49
			}
			if (nom >= 20 && nom < 25) {
				max = 88
				min = 59

			}
		}

			}
Cookies.set(name, ar, { expires: 1 });
    }
    //  alert('the is the previous cookies');
  else{

    Cookies.getJSON(name);
  }
}
	return Cookies.getJSON(name);
}
//the end of Englsih randomization
var n = 1;
//create a paginate button
function paginated(num_gen){
	for (var i = 0; i < num_gen ; i++) {

	$('#paginate').append('<button title="Page '+n+'" id="jstknw'+i+'" class="page_num btn btn-secondary" data-value ="'+i+'">'+n+'</button>')
	n++;
}
}

//put array into a variable and change to string to put in d db
var dab;
function cookiesStringnify(name){
		if(Cookies.get(name) != null) {
			dab = Cookies.getJSON(name).join();
		}
	return dab;
}

//to store random number into cookies
    if (sub_ject == 'Mathematics')
      {
        $('[data-value=Mathematics]').css("background-color", "#d4d4d4");
            var num_gen = 20;
            var name ='Mcookie';
          arraydata =  manipuLate(num_gen, totalq, ar, name);
					cookiesStringnify(name);
					paginated(num_gen);
			}
        else if (sub_ject == 'English')
        {
          $('[data-value=English]').css("background-color", "#d4d4d4");
            var num_gen = 25;
            var name ='Ecookie';
              arraydata = manipuLateEnglish(num_gen, totalq, ar, name);
						cookiesStringnify(name);
						paginated(num_gen);
          }
          else if (sub_ject == 'Physics') {
            $('[data-value=Physics]').css("background-color", "#d4d4d4");
            var num_gen = 15;
            var name ='Pcookie';
              arraydata = manipuLate(num_gen, totalq, ar, name);
							cookiesStringnify(name);
							paginated(num_gen);
          }
          else if (sub_ject == 'Chemistry') {
            $('[data-value=Chemistry]').css("background-color", "#d4d4d4");
            var num_gen = 15;
            var name ='Ccookie';
              arraydata = manipuLate(num_gen, totalq, ar, name);
							cookiesStringnify(name);
							paginated(num_gen);
          }
          else if (sub_ject == 'Biology') {
            $('[data-value=Biology]').css("background-color", "#d4d4d4");
            var num_gen = 15;
            var name ='Bcookie';
              arraydata = manipuLate(num_gen, totalq, ar, name);
							cookiesStringnify(name);
							paginated(num_gen);
          }else {
            $('[data-value=Current-affairs]').css("background-color", "#d4d4d4");
              var num_gen = 10;
              var name ='Cucookie';
                arraydata = manipuLate(num_gen, totalq, ar, name);
								cookiesStringnify(name);
								paginated(num_gen);
          }




//to choose a subject
var valueD = "<?php echo $subject ?>";
$(".btnv").click(function(){
  valueD = $(this).data('value');
 $(this).click(window.location='ExamConductor.php?topic='+valueD);
 //$(this).css("color", "red").show();
});






     inc++;
   $('#qn').val(inc);
   $('#qn1').val(ar);
   console.log(inc);
   $('#qn2').val(ar[inc]);
   //alert(stclass);
   // To process student answer
   var qn= $('#qn2').val();
   var cor =$('#qn3').val();


   $(document).ready(function(e){
   var formData = jQuery(this).serialize();

             $.ajax({
               type:"POST",
               url:"question.php?topic="+valueD+"&qno="+arraydata[inc]+"&nom="+(inc+1),
               data:formData,
               success: function(html){
               if(html==0){

                 //alert("something is wrong");

                 return false;

                 }else{
                   //alert("everything is alright");
                   //alert(ar[inc]);
                   //alert(html);
                   $('#questions').empty(html)
                   $('#questions').append(html)

                 }
             }
           });
//to add to system cookies table
					 $.ajax({
					                type:"POST",
					                url:"systemcookies.php?topic="+sub_ject+"&cokuqno="+dab,
					                data:formData,
					                success: function(html){
					                if(html==0){

					                  //alert("something is wrong");

					                  return false;

					                  }else{
					                    //alert("everything is alright");



					                  }
					              }
					            });

});


         jQuery(".page_num").click(function(e){
	 			 $('.prev').show();
	 		 var z = $(this).data('value');
			 		$('#jstknw'+z).addClass("active");
								e.preventDefault();
								//alert(totalq);
								var formData = jQuery(this).serialize();
								$.ajax({

									type:"POST",
									url:"question.php?topic="+valueD+"&qno="+arraydata[z]+"&nom="+(z+1),
									data:formData,
									success: function(html){
									if(html==0){

									//	alert("something is wrong");

										return false;

										}else{
											//alert("everything is alright");
											//alert(ar[inc]);
											//alert(html);
											$('#questions').empty(html)
											$('#questions').append(html)

										}
								}
							});


});



//add cookies random number to database
jQuery(".btnv").click(function(e){
	 			var formData = jQuery(this).serialize();
				alert('you');
$.ajax({
               type:"POST",
               url:"systemcookies.php?topic="+sub_ject+"&cokuqno="+dab,
               data:formData,
               success: function(html){
               if(html==0){

                 //alert("something is wrong");

                 return false;

                 }else{
                   //alert("everything is alright");



                 }
             }
           });

});


function submitted(){
	var formData = jQuery(this).serialize();
	$.ajax({

		type:"POST",
		url:"submittest.php",
		data:formData,
		success: function(html){
		if(html==0){

			return false;

			}else{

			$('#questions').fadeIn()
			$('#questions').text("THANKS FOR ATTEMPTING THE TEST").css({"color":"white", "font-size":"40px"});
			//$('#questions').append(html+"%").css({"color":"red", "font-size":"40px"});
			clearInterval(interval);
			RemoveCookieSubject();
			RemoveCookieTime();
			$('#remC').hide();
			$('.sub').hide();
			$(".btnv").hide();
			var delay = 10000;
			 setTimeout((function(){

				 window.location = 'WelcomePage.php?logout=1'  }), delay);

			}
	}
});
}

//logout
$('#remC').click(function(e){
	alertify.confirm("ARE YOU SURE YOU WANT TO SUBMIT? \n IF YOU CLICK OKAY(IT MEANS YOUR EXAM IS OVER)", function (e) {
	 if (e) {
		 RemoveCookieTime();
					submitted();
	 } else {
			 // user clicked "cancel"
	 }

});
});

//submit
jQuery(".sub").click(function(e){
	 alertify.confirm("ARE YOU SURE YOU WANT TO SUBMIT? \n IF YOU CLICK OKAY(IT MEANS YOUR EXAM IS OVER)", function (e) {
    if (e) {
				RemoveCookieTime();
						submitted();
    } else {
        // user clicked "cancel"
    }

});
});





 </script>
</body>
</html>
