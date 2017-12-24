<?php
	session_start();
	if(isset($_SESSION['username'])){
		header("Location: home.php");
	}
?>
<!doctype html>
<html>
	<head>
		<title>Hubuddies</title>
		<meta charset="UTF-8">
		<meta name="title" content="Hubuddies | Find new friends at hubuddies">
		<meta name="description" content="Find new friends at hubuddies.com">
		<meta name="keywords" content="rayyan,hubuddies,hubuddies.com,social network, ahmed, quraishi">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="./css/index.css">
		<link rel="shortcut icon" href="img/favicon.ico">
		<script type="text/javascript" src="./js/jquery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){

				//login form
				$("#log_in").on("submit", function(event){
					event.preventDefault();
					var email = $("#email_log").val();
					var password = $("#pass_log").val();
					$.post('ajax/log_in.php',{email:email,password:password},function(data){
						$('#error').html(data);
					});
				});

				//sign up form
				$("#sign_up").on("submit", function(event){
					event.preventDefault();
					var username = $("#username").val();
					var email = $("#email_sign").val();
					var password = $("#pass_sign").val();
					if(password.length > 4){	
						$.post('ajax/sign_up.php',{username:username,email:email,password:password},function(data){
							$('#make').html(data);
						});
					}
					else{
						$('#make').html("Your password must contain at least 5 characters");
					}
				});

				//tab functionality
				function si() {
					document.getElementById("log_in").style.display = "none";
					document.getElementById("sign_up").style.display = "block";	
				}
				function li() {
					document.getElementById("log_in").style.display = "block";
					document.getElementById("sign_up").style.display = "none";	
				}
			});
		</script>
	</head>
	<body>
		<header><a href="index.php">Hubuddies</a></header>
		<center id="body">
				<form method="post" class="form" id="log_in">
					<h2 class="selected">Log In</h2><h2> | </h2><h2 class="un_selected" onclick="si()">Sign Up</h2><br>
					<input type="email" placeholder="Email" class="txt" id="email_log" required="required"><br>
					<input type="password" placeholder="Password" class="txt" id="pass_log" required="required"><br>
					<b id="error"></b><br>
					<input type="submit" value="Submit" class="submit">
				</form>
				<form method="post" class="form" id="sign_up">
					<h2 class="un_selected" onclick="li()">Log In</h2><h2> | </h2><h2 class="selected">Sign Up</h2><br>
					<input type="text" placeholder="Username*" class="txt" required="required" id="username"><br>
					<input type="email" placeholder="Email*" class="txt" required="required" id="email_sign"><br>
					<input type="password" placeholder="Password*" class="txt" required="required" id="pass_sign"><br>
					<b id="make"></b><br>
					<input type="submit" value="Submit" class="submit">
				</form>
		</center>
	</body>
</html>