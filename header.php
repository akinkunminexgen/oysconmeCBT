<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="Admin/bower_components/bootstrap/dist/css/bootstrap.min.css">  -->
  <link rel="stylesheet" href="./Admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="./Admin/bower_components/Ionicons/css/ionicons.min.css">

	<link rel="stylesheet" href="./Admin/alertify/themes/alertify.core.css" />
	<link rel="stylesheet" href="./Admin/alertify/themes/alertify.default.css" id="toggleCSS" />
  <title>Login Page</title>
  <style type="text/css">

    .page_num{
      border-radius: 5px;
      margin-left: 4px;

    }
      .containn{
        width: 350px;
       margin:0 auto;
       background-color: #aaaabb;
       margin-top: 30px;
       padding: 30px 30px 30px 30px;
       border-radius: 20px;
      }
      .containnSeg{
        width: 500px;
       margin:0 auto;
       text-align: center;
       background-color:#b970a5;
       padding: 8px 8px 8px 8px;
       color: white;
      }
      #incream{
      height: 60%;
      }
      #conflo{
        width: 300px;
        position: relative;
   left: 930px;
      }
      body {
    margin: 0;
    padding: 0;
    background-color: #dac4d1;
  height: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.prev{
  display: none;
}
  .container-fluid{
      text-align: center;
      color: white;
      background-color: #b970a5;
      padding: 20px;
      border-bottom-left-radius: 6px;
      border-bottom-right-radius: 6px;
  }

  .container-flu{
      color: black;
      background-color: #062f43;
      padding: 20px;
      border-bottom-left-radius: 6px;
      border-bottom-right-radius: 6px;
  }

  .container-down{
      text-align: center;
      color: white;
      background-color: #b970a5;
      padding: 5px 60px;
      position: fixed;
      bottom: 0px;
      width: 100%;
      }
      #responsecontainer{
        background-color: #72c9f0;
        margin: 100px;
      }
      .clock{
        margin-top: 20px;
      }

      .container-down h6{
        -webkit-animation-name: movetrans;
        -webkit-animation-duration: 20s;
        -webkit-animation-timing-function: linear;
        -webkit-animation-iteration-count: infinite;
      }
      @-webkit-keyframes movetrans {
        0%   { -webkit-transform:translateX(1200px);	}
        50%  { -webkit-transform:translateX(0px);}
        100% { -webkit-transform:translateX(-1200px);}
    }
      .flex-container {

				display: flex;
				flex-wrap: nowrap;
			}
		.flex-container div{

				margin: 0px;
				width: 570px;
			}
      .major-body{
        width: 0 auto;
        margin: 0 auto;
      }


      .fixation
      {
        position: absolute;
        bottom: 80px;
        right: 15px;
      }

      #fixation
      {
        margin: -950px;
      }

      .buttocks
      {
      background-color:green;
      font-size: 20px;
      color: black;
      border: solid black 3px;
      width:51px;
      height: 41px;
      }

      .buttocks:hover
      {
        background-color:red;
        font-size: 20px;
        color: black;
        border: solid black 3px;
        width:51px;
        height: 41px;
      }

      #resulter
      {
        font-size: 30px;
        background-color:white;
        border: solid black 2px;
        width:166px;
        height: 45px;
      }

</style>
<script>
  //function that display value
  function dis(val)
  {
    document.getElementById("resulter").value+=val
  }

  //function that evaluates the digit and return resulter
  function solve()
  {
    let x = document.getElementById("resulter").value
    let y = eval(x)
    document.getElementById("resulter").value = y
  }

  //function that clear the display
  function clr()
  {
    document.getElementById("resulter").value = ""
  }
</script>


</style>

  </head>
