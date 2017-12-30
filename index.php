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
					var phone_email = $("#phone_email_log").val();
					var password = $("#pass_log").val();
					$.post('ajax/log_in.php',{phone_email:phone_email,password:password},function(data){
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
						$.post('ajax/signup.php',{username:username,email:email,password:password},function(data){
							$('#make').html(data);
						});
					}
					else{
						$('#make').html("Your password must contain at least 5 characters");
					}
				});

				//tab functionality
				$("#su").on("click", function(){
					$("#log_in").hide();
					$("#sign_up").show();
				});
				$("#li").on("click", function(){
					$("#log_in").show();
					$("#sign_up").hide();
				});
			});
		</script>
	</head>
	<body>
		<header><a href="index.php">Hubuddies</a></header>
		<center id="body">
				<form method="post" class="form" id="log_in">
					<h2 class="selected">Log In</h2><h2> | </h2><h2 id="su" class="un_selected">Sign Up</h2><br>
					<input type="text" class="txt" id="phone_email_log" placeholder="Email/Mobile Number" required="required"><br>
					<input type="password" class="txt" id="pass_log" placeholder="Password" required="required"><br>
					<b id="error"></b><br>
					<a href="forgot.php">Forgot password?</a><br>
					<input type="submit" value="Submit" class="submit">
				</form>
				<form method="post" class="form" id="sign_up">
					<h2 class="un_selected" id="li">Log In</h2><h2> | </h2><h2 class="selected">Sign Up</h2><br>
					<input type="text" class="txt" id="username" placeholder="Username*" required="required"><br>
					<input type="email" class="txt" id="email_sign" placeholder="Email*" required="required"><br>
					<input type="password" class="txt" id="pass_sign" placeholder="Password*" required="required"><br>
					<b id="make"></b><br>
					<input type="submit" value="Submit" class="submit">
				</form>
		</center>
	</body>
</html>