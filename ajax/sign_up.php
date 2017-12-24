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

	$usernameCheck = mysqli_query($conn, "SELECT username FROM users WHERE username='$username'");
	$username_check = mysqli_num_rows($usernameCheck);

	$emailCheck = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
	$email_check = mysqli_num_rows($emailCheck);

	if ($username_check == 0) {
		if ($email_check == 0) {
			$registering = mysqli_query($conn, "INSERT INTO users (username,email,password,keywords,ip,salt,sign_up_date,activated,closed) VALUES ('$username','$email','$password','$username,$email','$ip','$salt','$date','0','no')");
			session_start();
			$_SESSION["username"] = $username;
			$_SESSION['email'] = $email;
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