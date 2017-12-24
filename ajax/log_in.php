<?php
$conn = mysqli_connect('rayyanaqcom.domaincommysql.com', 'hubuddies', 'hubuddies17','hubuddies');
if(isset($_POST['email']) === true & isset($_POST['password']) === true ){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$getting_salt = mysqli_query($conn, "SELECT salt FROM users WHERE email='$email' AND closed='no' LIMIT 1");
	$salting = mysqli_fetch_assoc($getting_salt);
	$salt = $salting["salt"];
	//backwards compatibility
	if($salt != ""){
		$password = md5(md5(sha1($salt . $password)));
	}
	else
	{
		$password = md5($password);
		$password = md5($password);
		$password = sha1($password);
	}
	
	$userexist = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password' AND closed='no' LIMIT 1");
	$userCount = mysqli_num_rows($userexist);
	if ($userCount == 1) {
		while($row = mysqli_fetch_array($userexist)){ 
			$username = $row["username"];
		}
		$logged_in_query = mysqli_query($conn, "UPDATE users SET logged_in='yes' WHERE username='$username'");
		session_start();
		$_SESSION['username'] = $username;
		echo"<meta http-equiv=\"refresh\" content=\"0; url=http://www.hubuddies.com/home.php\">";
	}
	else
	{
		echo 'The email (or/and) password is incorrect.';
	}
}
?>