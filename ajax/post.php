<?php
	if(isset($_POST['post']) === true & isset($_POST['privacy']) === true){
		session_start();
		$user = $_SESSION["username"];
		$post = trim($_POST['post']);
		$privacy = $_POST['privacy'];
		$date_added = date("Y-m-d");
		$added_by = $user;
		$user_posted_to = $user;
		
		$con = mysqli_connect('rayyanaqcom.domaincommysql.com', 'hubuddies', 'hubuddies17','hubuddies');

		$sqlCommand = "INSERT INTO posts VALUES(\"\", \"$post\",\"\" ,\"\" ,\"\" ,\"$privacy\" ,\"$date_added\",\"$added_by\",\"$user_posted_to\", \"\", \"no\")";  
		$query = mysqli_query($con, $sqlCommand) or die(mysqli_error()); 
		//$id = mysql_insert_id();
		//put the post on the page
		$gettingUserInfo = mysqli_query($con, "SELECT profile_pic FROM users WHERE username='$added_by'");
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
		<div class="post">
			<p class="added_by">
				<a href="profile.php?u='.$added_by.'" style=" float:left; padding-right:1%;">
                	<img src="'.$profilepicInfo.'" height="40" width="40">
                </a>
				'.$added_by.'<br>'.$date_added.'
			</p><br>
			<p class="body">'.htmlspecialchars($post).'</p><br>
			<p class="ls"></p>
			<div class="comments"><br>
				<div class="comment">
					<a href="profile.php?u='.$user.'" style=" float:left; padding-right:1%;">
	                	<img src="'.$profilepicInfo.'" class="comment_img">
	                </a>
	                <form method="post" class="comment_area"><input type="text" placeholder="Comment" class="comment_box"></form>
                </div>
                <br>
			</div>
		</div>';

	}
?>