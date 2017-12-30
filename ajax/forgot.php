<?php

include("../head/connect.php");
//connect variable name: $conn

if(isset($_POST['email']) == true){
	$email = $_POST['email'];
	$ip = $_SERVER['REMOTE_ADDR'];//user ip address
	$date = date("Y-m-d");

	$idCheck = mysqli_query($conn, "SELECT ID FROM Users WHERE Email='$email' AND Closed='0'");
	$emailCheck = mysqli_num_rows($idCheck);

	if ($emailCheck == 1) {
		$row = mysqli_fetch_assoc($idCheck);
		$id = $row["ID"];

		$char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.";
		$forgotUID = substr(str_shuffle($char), 0, 20);

		$forgot = mysqli_query($conn, "INSERT INTO ForgotPassword (UserID,ForgotUID,RequestIP,RequestDate,UsedLink) VALUES ('$id','$forgotUID','$ip','$date','0')");

		$subject = "Hubuddies.com | Password Reset Request";
		$message = "
		<html>
			<head>
				<style>
					body{
						padding: 0px;
						margin: 0px;
						font-family: Raleway;
						background: #efefef;
					}
					a{
						color: #fff;
						text-decoration: none;
					}
					header{
						top: 0px;
						width: 98%;
						line-height: 150%;
						background: #3cade6;
						color: #fff;
						font-size: 3em;
						padding-left: 2%;
						z-index: 1;
					}
					.card{
						width: 500px;
						min-width: 50%;
						max-width: 90%;
						background: #fff;
						margin: 20px auto;
						padding: 5px 2em;
					}
					h2{
						text-align: center;
					}
					#submit{
						min-width: 20%;
						height: 50px;
						background: #3cade6;
						border: 1px solid #2f9fd6;
						color: #fff;
						font-size: 1em;
						padding: 0px 0.5em;
					}
				</style>
			</head>
			<body>
				<header><a href='http://www.hubuddies.com/forgot.php?uid=" . $forgotUID . "'>Hubuddies</a></header>
					<div class='card'>
						<h2>Password Reset Request</h2>
						You requested to reset your password.<br>
						Click the button below to reset your password.<br><br>
						<a href='http://www.hubuddies.com/forgot.php?uid=" . $forgotUID . "'><button id='submit'>Reset Password</button></a>
						<br>
						<br>
						If the button does not work, copy and paste this in the address bar: http://www.hubuddies.com/forgot.php?uid=" . $forgotUID . ".
						<br>
						<br>
						If you did not request to change your password, please ignore this email.
					</div>
			</body>
		</html>
		";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <support@hubuddies.com>' . "\r\n";

		mail($email,$subject,$message,$headers);

		echo"A password reset link has been sent to your email address.";
	}
	else {
		echo"We can't find the email you entered in our database.";
	}
}
?>