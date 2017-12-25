<?php
	session_start();
	$user = $_SESSION["username"];

	include("./head/connect.php");
	//connect variable name: $conn

	$userData = mysqli_query($conn, "SELECT FirstName,LastName,Gender,DateOfBirth FROM Users WHERE Username='$user' AND Closed='0'");
	$get = mysqli_fetch_assoc($userData);
	$FirstName = $get['FirstName'];
	$LastName = $get['LastName'];
	$Gender = $get['Gender'];
	$DateOfBirth = $get['DateOfBirth'];
?>
<!doctype html>
<html>
	<head>
		<title>Hubuddies</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="./css/settings.css">
		<link rel="shortcut icon" href="img/favicon.ico">
		<script type="text/javascript" src="./js/jquery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#settings").on("submit", function(event){
					event.preventDefault();
					var firstName = $("#firstName").val();
					var lastName = $("#lastName").val();
					var gender = $('.gender:checked').val();
					var dob = $("#dob").val();
					$.post('./ajax/settings.php',{firstName:firstName,lastName:lastName,gender:gender,dob:dob},function(data){
						$("#error").html(data);
					});
				});
			});
		</script>
	</head>
	<body>
		<header><a href="home.php">Hubuddies</a></header>
		<center id="body">
			<form method="post" class="form" id="settings">
				<h2 class="selected">Settings</h2><br>
				<?php

				$male="";$female="";
				if($Gender == "male"){$male="checked";}
				if($Gender == "female"){$female="checked";}

				echo '
				<input type="text" placeholder="First Name" class="txt" id="firstName" value="'. $FirstName.'"><br>
				<input type="text" placeholder="Last Name" class="txt" id="lastName" value="'.$LastName.'"><br>
				Gender: <input type="radio" name="gender" value="male" id="male" class="gender" '. $male .'><label for="male">Male</label>
				&nbsp;<input type="radio" name="gender" value="female" id="female" class="gender" '. $female .'><label for="female">Female</label><br>
				Date of birth: <input type="date" name="dob" id="dob" value="'. $DateOfBirth .'"><br><br>
				';
				?>
				<b id="error"></b><br>
				<input type="submit" value="Save" class="submit"><br>
				<a href="http://www.hubuddies.com/home.php" id="skip">Continue</a>
			</form>
		</center>
	</body>
</html>