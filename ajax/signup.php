<?php

include("../head/connect.php");
//connect variable name: $conn

if(isset($_POST['username']) == true & isset($_POST['email']) == true & isset($_POST['password']) == true){
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$ip = $_SERVER['REMOTE_ADDR'];//user ip address
	$date = date("Y-m-d");

	//creating salt
	$char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.";
	$salt = substr(str_shuffle($char), 0, 15);
	$password = md5(md5(sha1($password . $salt)));
	$password = password_hash($password, PASSWORD_DEFAULT);

	$usernameCheck = mysqli_query($conn, "SELECT Username FROM Users WHERE Username='$username'");
	$username_check = mysqli_num_rows($usernameCheck);

	$emailCheck = mysqli_query($conn, "SELECT Email FROM Users WHERE Email='$email'");
	$email_check = mysqli_num_rows($emailCheck);

	if ($username_check == 0) {
		if ($email_check == 0) {
			$registering = mysqli_query($conn, "INSERT INTO Users (Username,Email,Password,IP,Salt,SignUpDate,EmailConfirmed,Closed) VALUES ('$username','$email','$password','$ip','$salt','$date','0','0')");
			session_start();
			$_SESSION["username"] = $username;
			$_SESSION['email'] = $email;

			$subject = "Hubuddies.com | Email Confirmation";

			$message = "
			<html>
				<head>
					<style>
						/* latin-ext */
						@font-face {
						  font-family: 'Raleway';
						  font-style: normal;
						  font-weight: 300;
						  src: local('Raleway Light'), local('Raleway-Light'), url(https://fonts.gstatic.com/s/raleway/v11/ZKwULyCG95tk6mOqHQfRBCEAvth_LlrfE80CYdSH47w.woff2) format('woff2');
						  unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
						}
						/* latin */
						@font-face {
						  font-family: 'Raleway';
						  font-style: normal;
						  font-weight: 300;
						  src: local('Raleway Light'), local('Raleway-Light'), url(https://fonts.gstatic.com/s/raleway/v11/-_Ctzj9b56b8RgXW8FArifk_vArhqVIZ0nv9q090hN8.woff2) format('woff2');
						  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
						}
						body{
							padding: 0px;
							margin: 0px;
							font-family: Raleway;
							background: #efefef;
						}
						a{
							color: inherit;
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
							box-shadow: 0px 0px 5px 0px #ccc;
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
					<header><a href='http://www.hubuddies.com'>Hubuddies</a></header>
						<div class='card'>
							<h2>Email Confirmation</h2>
							Hi!<br><br>
							Thank you for registering.<br><br>
							To confirm your email address, just click the button below.<br><br>
							<a href='http://www.hubuddies.com'><button id='submit'>Confirm my email address</button></a>
							<br>
							<br>
							If the button does not work, copy and paste this in the address.
						</div>
				</body>
			</html>
			";

			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: <support@hubuddies.com>' . "\r\n";

			mail($email,$subject,$message,$headers);

			echo"<meta http-equiv=\"refresh\" content=\"0; url=http://www.hubuddies.com/settings.php\">";
		}
		else {
			echo"Email already exists.";
		}
	}
	else {
		echo"Username already exists.";
	}
}
?>