<!doctype html>
<html>
	<head>
		<title>Hubuddies</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="./css/index.css">
		<link rel="shortcut icon" href="img/favicon.ico">
	</head>
	<body>
		<header><a href="index.php">Hubuddies</a></header>
		<center id="body">
			<div class="form">
				<?php
				include("./head/connect.php");
				//connect variable name: $conn

				if (isset($_GET['uid'])){
					$uid = $_GET['uid'];
					$emailCheck = mysqli_query($conn, "SELECT UserID FROM IDConfirmation WHERE EmailUID='$uid' AND Confirmed='0'");
					$phoneCheck = mysqli_query($conn, "SELECT UserID FROM IDConfirmation WHERE PhoneUID='$uid' AND Confirmed='0'");
					if (mysqli_num_rows($emailCheck)===1) {
						$get = mysqli_fetch_assoc($emailCheck);
						$userID = $get['UserID'];
						$confirmed = mysqli_query($conn, "UPDATE IDConfirmation SET Confirmed='1' WHERE EmailUID='$uid' AND UserID='$userID'");
						$confirmed2 = mysqli_query($conn, "UPDATE Users SET EmailConfirmed='1' WHERE ID='$userID'");
						echo "
						<h2>Thank you for confirming your email address.<h2>
						<br><br>
						<a href='http://www.hubuddies.com/settings.php' id='submit'>Continue</button></a>
						";
						echo "<meta http-equiv=\"refresh\" content=\"0; url=http://www.hubuddies.com/settings.php\">";	
					}
					else if (mysqli_num_rows($phoneCheck)===1) {
						$get = mysqli_fetch_assoc($phoneCheck);
						$userID = $get['UserID'];
						$confirmed = mysqli_query($conn, "UPDATE IDConfirmation SET Confirmed='1' WHERE PhoneUID='$uid' AND UserID='$userID'");
						$confirmed2 = mysqli_query($conn, "UPDATE Users SET PhoneConfirmed='1' WHERE ID='$userID'");
						echo "
						<h2>Thank you for confirming your email address.<h2>
						<br><br>
						<a href='http://www.hubuddies.com/settings.php' id='submit'>Continue</button></a>
						";
						echo "<meta http-equiv=\"refresh\" content=\"0; url=http://www.hubuddies.com/settings.php\">";	
					}
					else
					{
					echo "<h2>Galat Link</h2>";
					echo "<meta http-equiv=\"refresh\" content=\"0; url=http://www.hubuddies.com/\">";	
					}
				}
				else{
					echo "<h2>Galat Link</h2>";
					echo "<meta http-equiv=\"refresh\" content=\"0; url=http://www.hubuddies.com/\">";	
				}
				?>
			</div>
		</center>
	</body>
</html>