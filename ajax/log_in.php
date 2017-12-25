<?php

include("../head/connect.php");
//connect variable name: $conn

if(isset($_POST['phone_email']) === true & isset($_POST['password']) === true ){
	$phone_email = $_POST['phone_email'];
	$password = $_POST['password'];

	//Get username, password, and salt
	$userquery = mysqli_query($conn, "SELECT username,password,salt FROM users WHERE (email='$phone_email' OR phone='$phone_email') AND closed='no'");
	$userCount = mysqli_num_rows($userquery);

	if($userCount == 1){ //check if user exists
		$row = mysqli_fetch_assoc($userquery);
		$username = $row["username"];
		$salt = $row["salt"];
		$hash = $row['password'];
		$password = $password . $salt;

		if(password_verify($password, $hash)){ //check password
			session_start();
			//set session variables
			$_SESSION['username'] = $username;
			$_SESSION['email'] = $email;
			echo"<meta http-equiv=\"refresh\" content=\"0; url=http://www.hubuddies.com/home.php\">";
		}
		else
		{
			echo 'The email (and/or) password is incorrect.';
		}

	}
	else
	{
		echo 'The email (and/or) password is incorrect.';
	}
}

?>