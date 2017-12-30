<?php

include("../head/connect.php");
//connect variable name: $conn

if(isset($_POST['pass']) === true & isset($_POST['userID']) === true ){
	$password = $_POST['pass'];
	$userID = $_POST['userID'];

	//creating salt
	$char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.";
	$salt = substr(str_shuffle($char), 0, 15);
	$password = md5(md5(sha1($password . $salt)));//need to change
	$password = password_hash($password, PASSWORD_DEFAULT);

	$reset = mysqli_query($conn, "UPDATE Users SET Password='$password',Salt='$salt' WHERE ID='$userID' AND Closed='0'");
	echo"<meta http-equiv=\"refresh\" content=\"0; url=http://www.hubuddies.com/\">";
}
?>