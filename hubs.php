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
			<?php echo '<a class="nav_item" href="profile.php">'. $user.'</a>';?>
			<a href="home.php" class="nav_item">Home</a>
			<a href="hubs.php" class="nav_item">Hubs</a>
			<a href="settings.php" class="nav_item">Settings</a>
			<a href="logout.php" class="nav_item">Logout</a>
		</div>
		<center id="body">
			<?php
				if(numOfHubs > 0){
					echo"
						<div class='box' id='" . $hubId . "'>
						</div>
					";
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