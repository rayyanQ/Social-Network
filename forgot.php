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

				//forgot password form
				$("#forgot").on("submit", function(event){
					event.preventDefault();
					var email = $("#email").val();
					$.post('ajax/forgot.php',{email:email},function(data){
						$('#error').html(data);
					});
				});

				//reset password form
				$("#reset").on("submit", function(event){
					event.preventDefault();
					var pass1 = $("#pass1").val();
					var pass2 = $("#pass2").val();
					var userID = $(this).data("id");
					if(pass1 == pass2){
						$.post('ajax/reset.php',{pass:pass1,userID:userID},function(data){
							$('#resetError').html(data);
						});
					}
					else{
						$('#resetError').html("Your passwords don't match.");
					}
				});

			});
		</script>
	</head>
	<body>
		<header><a href="index.php">Hubuddies</a></header>
		<?php
			include("./head/connect.php");
			//connect variable name: $conn

			if (isset($_GET['uid'])){
				$uid = $_GET['uid'];
				$_SESSION['uid'] = $uid;
				$forgotCheck = mysqli_query($conn, "SELECT UserID FROM ForgotPassword WHERE ForgotUID='$uid' AND UsedLink='0'");
				if (mysqli_num_rows($forgotCheck)===1) {
					$get = mysqli_fetch_assoc($forgotCheck);
					$userID = $get['UserID'];
					echo '
					<center id="body">
						<form method="post" class="form" id="reset" data-id="'. $userID .'">
							<h2 class="selected">Reset Password</h2><br>
							<input type="password" class="txt" id="pass1" placeholder="Enter a new password" required="required"><br>
							<input type="password" class="txt" id="pass2" placeholder="Re-enter the password" required="required"><br>
							<b id="resetError"></b><br>
							<input type="submit" value="Submit" class="submit">
						</form>
					</center>
					';	
				}
				else{
					echo "Galat Link.";
				}
			}
			else{
				echo '
				<center id="body">
					<form method="post" class="form" id="forgot">
						<h2 class="selected">Forgot Password</h2><br>
						<input type="email" class="txt" id="email" placeholder="Email" required="required"><br>
						<b id="error"></b><br>
						<input type="submit" value="Submit" class="submit">
					</form>
				</center>
				';	
			}
		?>
		
	</body>
</html>