<!doctype html>
<html>
	<head>
		<title>Hubuddies</title>
		<meta charset="UTF-8">
		<meta name="title" content="Hubuddies | Find new friends at hubuddies">
		<meta name="description" content="Make new friends at hubuddies.com">
		<meta name="keywords" content="rayyan,hubuddies,hubuddies.com,social network, text only, facebook, ahmed, quraishi">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="./css/index.css">
		<link rel="shortcut icon" href="img/favicon.ico">
		<script type="text/javascript" src="./js/jquery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#log_in").on("submit", function(event){
					event.preventDefault();
					var email = $("#email_log").val();
					var password = $("#pass_log").val();
					$.post('ajax/log_in.php',{email:email,password:password},function(data){
						$('#error').html(data);
					});
				});
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
			});
		</script>
	</head>
	<body>
		<script type="text/javascript">
			function si() {
				document.getElementById("log_in").style.display = "none";
				document.getElementById("sign_up").style.display = "block";	
			}
			function li() {
				document.getElementById("log_in").style.display = "block";
				document.getElementById("sign_up").style.display = "none";	
			}
		</script>
		<header><a href="index.php">Hubuddies</a></header>