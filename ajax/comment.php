<?php
include("../head/connect.php");
//connect variable name: $conn

if(isset($_POST['id']) === true & isset($_POST['comment']) === true & isset($_POST['post_user']) === true){
	session_start();
	$user = $_SESSION["username"];
	$id = $_POST["id"];
	$comment = trim($_POST['comment']);
	$post_user = $_POST['post_user'];

	$sqlCommand = "INSERT INTO post_comments VALUES(\"\", \"$comment\",\"$user\" ,\"post_user\" ,\"0\" ,\"$id\")";  
	$query = mysqli_query($conn, $sqlCommand) or die(mysqli_error()); 
	//$id = mysql_insert_id();
	//put the post on the page
	$gettingUserInfo = mysqli_query($conn, "SELECT profile_pic FROM users WHERE username='$user'");
	$getInfo = mysqli_fetch_assoc($gettingUserInfo);
	$profilepicInfo = $getInfo['profile_pic'];
	if ($profilepicInfo == "") {
		$profilepicInfo = "./img/default_pic.jpg";
	}
	else
	{
		$profilepicInfo = "./userdata/profile_pics/".$profilepicInfo;
	}
	  
	echo'
	<div class="comment">
        <a href="profile.php?u='.$user.'" style="float:left; padding-right:1%;">
        	<img src="'.$profilepicInfo.'" height="30" width="30">
        </a>
            <a href="profile.php?u='.$user.'"><b>'.$user.'</b></a>
             : &nbsp; '.htmlspecialchars($comment).'
    </div>
    <br>
    ';
}
?>