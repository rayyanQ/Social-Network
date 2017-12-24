<?php
	session_start();
	if(isset($_SESSION['username'])){
		$user = $_SESSION["username"];
	}
	else{
		header("Location: home.php");
	}
?>
<!doctype html>
<html>
	<head>
		<title>Hubuddies</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="./css/index.css">
		<link rel="shortcut icon" href="img/favicon.ico">
		<script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
		<script type="text/javascript">
			var socket = new io.Socket('localhost',{
				port: 8080
			});
			socket.connect(); 

			// Add a connect listener
			socket.on('connect',function() {
				console.log('Client has connected to the server!');
			});
			var i = 4;
			var j = 1;
			var k = 0;
			for(){

				
			}
		</script>
	</head>
	<body>
		<header><a href="home.php">Hubuddies</a></header>
		<center id="body">
		</center>
		<footer></footer>
	</body>
</html>