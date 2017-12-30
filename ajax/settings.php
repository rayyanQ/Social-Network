<?php

session_start();
$user = $_SESSION["username"];

include("../head/connect.php");
//connect variable name: $conn

if(isset($_POST['firstName']) == true & isset($_POST['lastName']) == true & isset($_POST['gender']) == true & isset($_POST['dob']) == true){
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$gender = $_POST['gender'];
	$dob = $_POST['dob'];

	$settingsUpdate = mysqli_query($conn, "UPDATE Users SET FirstName='$firstName',LastName='$lastName',Gender='$gender',DateOfBirth='$dob' WHERE Username='$user'");
	echo "Changes Saved";

}
?>