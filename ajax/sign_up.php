<?php
$con = mysqli_connect("rayyanaqcom.domaincommysql.com","hubuddies","hubuddies17","hubuddies");
if(isset($_POST['username']) == true & isset($_POST['email']) == true & isset($_POST['password']) == true){
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$date = date("Y-m-d");


	$char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.";
	$salt = substr(str_shuffle($char), 0, 15);
	$pswd = md5(md5(sha1($salt . $password)));

	$usernameCheck = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
	$username_check = mysqli_num_rows($usernameCheck);

	$emailCheck = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");
	$email_check = mysqli_num_rows($emailCheck);

	if ($username_check == 0) {
		if ($email_check == 0) {
			$registering = mysqli_query($con, "INSERT INTO users VALUES ('','$username','','','$email','','','$pswd','yes','$username,$email','','','$salt','$date','0','Write something about yourself.','','','','no')");
			session_start();
			$_SESSION["username"] = $username;
			echo"<meta http-equiv=\"refresh\" content=\"0; url=http://www.hubuddies.com/settings.php\">";
		}
		else {
			echo"email already exists";
		}
	}
	else {
		echo"username already exists";
	}
}
?>