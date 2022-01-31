<html>
<head>
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
	<!-- for styling -->
	<style>
		.fixation{
      position: fixed;
    bottom: 115;
    right: 45;
		}


		.buttocks
		{
		background-color:green;
    font-size: 20px;
		color: black;
		border: solid black 3px;
		width:75px;
    height: 55px;
		}

    .buttocks:hover
    {
      background-color:red;
      font-size: 20px;
  		color: black;
  		border: solid black 3px;
  		width:75px;
      height: 55px;
    }

    #resulter
    {
      font-size: 30px;
      background-color:white;
  		border: solid black 2px;
  		width:236px;
      height: 55px;
    }
	</style>
</head>
<!-- create table -->
<body>
	<table border="1" class="fixation">
		<tr>
			<td colspan="3"><input type="text" id="resulter"/></td>
			<!-- clr() function will call clr to clear all value -->
			<td><input class="buttocks" type="button" value="c" onclick="clr()"/> </td>
		</tr>
		<tr>
			<!-- create button and assign value to each button -->
			<!-- dis("1") will call function dis to display value -->
			<td><input class="buttocks" type="button" value="1" onclick="dis('1')"/> </td>
			<td><input class="buttocks" type="button" value="2" onclick="dis('2')"/> </td>
			<td><input class="buttocks" type="button" value="3" onclick="dis('3')"/> </td>
			<td><input class="buttocks" type="button" value="/" onclick="dis('/')"/> </td>
		</tr>
		<tr>
			<td><input class="buttocks" type="button" value="4" onclick="dis('4')"/> </td>
			<td><input class="buttocks" type="button" value="5" onclick="dis('5')"/> </td>
			<td><input class="buttocks" type="button" value="6" onclick="dis('6')"/> </td>
			<td><input class="buttocks" type="button" value="-" onclick="dis('-')"/> </td>
		</tr>
		<tr>
			<td><input class="buttocks" type="button" value="7" onclick="dis('7')"/> </td>
			<td><input class="buttocks" type="button" value="8" onclick="dis('8')"/> </td>
			<td><input class="buttocks" type="button" value="9" onclick="dis('9')"/> </td>
			<td><input class="buttocks" type="button" value="+" onclick="dis('+')"/> </td>
		</tr>
		<tr>
			<td><input class="buttocks" type="button" value="." onclick="dis('.')"/> </td>
			<td><input class="buttocks" type="button" value="0" onclick="dis('0')"/> </td>
			<!-- solve function call function solve to evaluate value -->
			<td><input class="buttocks" type="button" value="=" onclick="solve()"/> </td>
			<td><input class="buttocks" type="button" value="*" onclick="dis('*')"/> </td>
		</tr>
	</table>
</body>
</html>
