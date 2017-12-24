<?php
	session_start();
	$user = $_SESSION["username"];

	$con = mysqli_connect('rayyanaqcom.domaincommysql.com', 'hubuddies', 'hubuddies17','hubuddies');

	if(isset($_POST['first_name']) == true || isset($_POST['last_name']) == true || isset($_POST['gender']) == true || isset($_POST['dob']) == true) {
		if(isset($_POST['first_name']) == true) {
			$first_name = $_POST['first_name'];
			$setting_query = mysqli_query($con, "UPDATE users SET first_name='$first_name' WHERE username='$user'");
		}
		if(isset($_POST['last_name']) == true) {
			$last_name = $_POST['last_name'];
			$setting_query = mysqli_query($con, "UPDATE users SET last_name='$last_name' WHERE username='$user'");
		}
		if(isset($_POST['gender']) == true) {
			$gender = $_POST['gender'];
			$setting_query = mysqli_query($con, "UPDATE users SET gender='$gender' WHERE username='$user'");
		}
		if(isset($_POST['dob']) == true) {
			$dob = $_POST['dob'];
			$setting_query = mysqli_query($con, "UPDATE users SET dob='$dob' WHERE username='$user'");
		}
		header("location:settings.php");
	}
?>
<!doctype html>
<html>
	<head>
		<title>Hubuddies</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="./css/settings.css">
		<link rel="shortcut icon" href="img/favicon.ico">
	</head>
	<body>
		<header><a href="home.php">Hubuddies</a></header>
		<center id="body">
			<form method="post" class="form" id="sign_up" action="settings.php">
				<h2 class="selected">Settings</h2><br>
				<input type="text" placeholder="First Name" class="txt" name="first_name"><br>
				<input type="text" placeholder="Last Name" class="txt" name="last_name"><br>
				Gender: <input type="radio" name="gender" value="male" id="male"><label for="male">Male</label>
				&nbsp;<input type="radio" name="gender" value="female" id="female"><label for="female">Female</label><br>
				Date of birth: <input type="date" name="dob"><br><br>
				<b id="error"></b><br>
				<input type="submit" value="Submit" class="submit"><br>
				<a href="http://www.hubuddies.com/home.php" id="skip">Continue</a>
			</form>
		</center>
		<footer></footer>
	</body>
</html>