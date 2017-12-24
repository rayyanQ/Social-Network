<?php
session_start();
if(isset($_SESSION['username'])){
	$user = $_SESSION["username"];
}
else
{
	header("Location: index.php");
}
?>
<!doctype html>
<html>
	<head>
		<title>Hubuddies</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="./css/home.css">
		<link rel="shortcut icon" href="img/favicon.ico">
		<script type="text/javascript" src="./js/jquery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#postbox").on("submit", function(event){
					event.preventDefault();
					var post = $("#post_txt").val();
					var privacy = $('.privacy:checked').val();
					if (post.length > 0) {
						$.post('./ajax/post.php',{post:post,privacy:privacy},function(data){
							$("#post_txt").val("");
							$("#postbox").after(data);
						});
					}
				});
				$(".comment_area").on("submit", function(event){
					event.preventDefault();
					var id = $(this).attr("id");
					var comment = $(this).children().val();
					var post_user = $(this).parent().attr("id");
					if(comment.length > 0){
						$.post('./ajax/comment.php',{id:id,comment:comment,post_user:post_user},function(data){
							$("#" + id).children().val("");

							$("#" + post_user).parent().append(data);
						});
					}
				});
			});
		</script>
	</head>
	<body>
		<input type="checkbox" id="menu"><label for="menu"><p></p><p></p><p></p></label>
		<header><a href="home.php">Hubuddies</a></header>
		<div id="glass"></div>
		<div id="nav">
			<?php echo '<a class="nav_item" href="profile.php">'. $user .'</a>';?>
			<a href="home.php" class="nav_item">Home</a>
			<a href="hubs.php" class="nav_item">Hubs</a>
			<a href="settings.php" class="nav_item">Settings</a>
			<a href="logout.php" class="nav_item">Logout</a>
		</div>
		<center id="body">
			<form id="postbox" method="post">
				<textarea id="post_txt"></textarea><br>
				<input type="radio" name="privacy" id="friends" value="friends" class="privacy"><label for="friends">Friends</label>
				<input type="radio" name="privacy" id="public" value="public" class="privacy"><label for="public">Public</label>
				<input type="submit" value="post" id="submit">
			</form>
			<?php
			$con = mysqli_connect('rayyanaqcom.domaincommysql.com', 'hubuddies', 'hubuddies17','hubuddies');

			$FriendsQuery = mysqli_query($con, "SELECT friend_array FROM users WHERE username='$user'");
	        $friendRow = mysqli_fetch_assoc($FriendsQuery);
	        $friendArray = $friendRow['friend_array'];
	        $friend_array = explode(",",$friendArray);
	        $friend_list = implode("','",$friend_array);
	        $friendArray = "'" . $friend_list  . " '";
	        $getposts = mysqli_query($con, "SELECT * FROM posts WHERE added_by='$user' AND deleted='no' OR user_posted_to='$user' AND deleted='no' OR added_by IN ($friendArray) AND deleted='no' OR privacy='public' AND deleted='no' ORDER BY id DESC LIMIT 30"); 
	        while($row = mysqli_fetch_assoc($getposts)){
				$id = $row['id'];
				$body = $row['body'];	
				$image = $row['image'];
				$video = $row['video'];
				$date_added = $row['date_added'];
				$added_by = $row['added_by'];
				$deleted = $row['deleted'];

				$userinfo = mysqli_query($con, "SELECT profile_pic FROM users WHERE username='$user'");
                $getpic = mysqli_fetch_assoc($userinfo);
                $profilePic = $getpic['profile_pic'];
                if ($profilePic == "") {
                  $profilePic = "./img/default_pic.jpg";
                }
                else
                {
                  $profilePic = "./userdata/profile_pics/".$profilePic;
                }

                $postinfo = mysqli_query($con, "SELECT profile_pic FROM users WHERE username='$added_by'");
                $postpic = mysqli_fetch_assoc($postinfo);
                $postprofile = $postpic['profile_pic'];
                if ($postprofile == "") {
                  $postprofile = "./img/default_pic.jpg";
                }
                else
                {
                  $postprofile = "./userdata/profile_pics/".$postprofile;
                }
				echo'
				<div class="post">
					<p class="added_by">
						<a href="profile.php?u='.$added_by.'" style=" float:left; padding-right:1%;">
		                	<img src="'.$postprofile.'" height="40" width="40">
		                </a>
						'.$added_by.'<br>'.$date_added.'
					</p><br>
					<p class="body">'.htmlspecialchars($body).'</p><br>
					<p class="ls"></p>
					<div class="comments"><br>
						<div class="comment" id="'.$added_by.'">
							<a href="profile.php?u='.$user.'" style=" float:left; padding-right:1%;">
			                	<img src="'.$profilePic.'" class="comment_img">
			                </a>
			                <form method="post" class="comment_area" id="'.$id.'"><input type="text" placeholder="Comment" class="comment_box"></form>
		                </div>
		                <br>';
						$getComments = mysqli_query($con, "SELECT * FROM post_comments WHERE post_id='$id' AND post_removed='0' LIMIT 10");
						while ($comment = mysqli_fetch_assoc($getComments)) {
			                $commentBody = @$comment["post_body"];
			                $commentPostedTo = @$comment["posted_to"];
			                $commentPostedBy = @$comment["posted_by"];
			                $commentRemoved = @$comment["post_removed"];

			                $commentGetUserInfo = mysqli_query($con, "SELECT profile_pic FROM users WHERE username='$commentPostedBy'");
			                $commentGetInfo = mysqli_fetch_assoc($commentGetUserInfo);
			                $commentProfilepicInfo = $commentGetInfo['profile_pic'];
			                if ($commentProfilepicInfo == "") {
			                  $commentProfilepicInfo = "./img/default_pic.jpg";
			                }
			                else
			                {
			                  $commentProfilepicInfo = "./userdata/profile_pics/".$commentProfilepicInfo;
			                }
			                //use htmlentities instead of htmlspecialchars if want to replace all html chars
			                echo'
			                <div class="comment">
				                <a href="profile.php?u='.$commentPostedBy.'" style="float:left; padding-right:1%;">
				                	<img src="'.$commentProfilepicInfo.'" height="30" width="30">
				                </a>
					                <a href="profile.php?u='.$commentPostedBy.'"><b>'.$commentPostedBy.'</b></a>
					                 : '.htmlspecialchars($commentBody).'
			                </div><br>
			                ';
						}
			            echo'
					</div>
				</div>
				';
			}
			?>
		</center>
		<footer></footer>
		<script type="text/javascript">
			if(window.innerWidth > 950){
				document.getElementById("menu").checked = true;
			}
			document.getElementById("public").checked = true;
		</script>
	</body>
</html>